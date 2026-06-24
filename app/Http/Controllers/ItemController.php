<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\PickupPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with(['user', 'category', 'pickupPoint']);

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('items.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $pickupPoints = PickupPoint::all();

        return view('items.create', compact('categories', 'pickupPoints'));
    }

    public function store(StoreItemRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('items', 'public');
        }

        Item::create($data);

        return redirect()->route('items.index')
            ->with('success', 'Barang temuan berhasil dilaporkan!');
    }

    public function show(Item $item)
    {
        $item->load(['user', 'category', 'pickupPoint', 'claims.claimant']);

        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        if ($item->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $categories = Category::all();
        $pickupPoints = PickupPoint::all();

        return view('items.edit', compact('item', 'categories', 'pickupPoints'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        if ($item->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($item->photo) {
                Storage::disk('public')->delete($item->photo);
            }
            $data['photo'] = $request->file('photo')->store('items', 'public');
        }

        $item->update($data);

        return redirect()->route('items.show', $item)
            ->with('success', 'Data barang berhasil diperbarui!');
    }

    public function destroy(Item $item)
    {
        if ($item->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        if ($item->photo) {
            Storage::disk('public')->delete($item->photo);
        }

        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil dihapus!');
    }
}
