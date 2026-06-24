<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Report;
use App\Models\User;
use App\Models\Category;
use App\Models\Claim;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_items' => Item::count(),
            'items_tersedia' => Item::where('status', 'tersedia')->count(),
            'items_terklaim' => Item::where('status', 'terklaim')->count(),
            'total_users' => User::where('role', 'mahasiswa')->count(),
            'total_claims' => Claim::count(),
            'total_categories' => Category::count(),
            'total_reports' => Report::count(),
        ];

        $latestItems = Item::with(['user', 'category'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestItems'));
    }

    public function index()
    {
        $reports = Report::with(['item', 'admin'])->latest()->paginate(10);

        return view('admin.reports.index', compact('reports'));
    }

    public function store(Request $request, Item $item)
    {
        $request->validate([
            'reason' => ['required', 'string', 'max:1000'],
        ], [
            'reason.required' => 'Alasan penghapusan wajib diisi.',
        ]);

        Report::create([
            'item_id' => $item->id,
            'admin_id' => auth()->id(),
            'reason' => $request->reason,
        ]);

        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil dihapus dan dilaporkan sebagai spam.');
    }
}
