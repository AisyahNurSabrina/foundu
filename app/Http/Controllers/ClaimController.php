<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Item;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function store(Request $request, Item $item)
    {
        if ($item->user_id !== auth()->id()) {
            abort(403, 'Hanya penemu yang bisa menandai barang sebagai terklaim.');
        }

        if ($item->status === 'terklaim') {
            return redirect()->route('items.show', $item)
                ->with('error', 'Barang sudah ditandai sebagai terklaim.');
        }

        $request->validate([
            'proof_text' => ['required', 'string', 'max:1000'],
        ], [
            'proof_text.required' => 'Bukti/keterangan klaim wajib diisi.',
        ]);

        Claim::create([
            'item_id' => $item->id,
            'claimed_by' => auth()->id(),
            'proof_text' => $request->proof_text,
            'claimed_at' => now(),
        ]);

        $item->update(['status' => 'terklaim']);

        return redirect()->route('items.show', $item)
            ->with('success', 'Barang berhasil ditandai sebagai terklaim!');
    }
}
