<?php

namespace App\Http\Controllers;

use App\Models\PickupPoint;
use Illuminate\Http\Request;

class PickupPointController extends Controller
{
    public function index()
    {
        $pickupPoints = PickupPoint::withCount('items')->paginate(10);

        return view('pickup-points.index', compact('pickupPoints'));
    }

    public function create()
    {
        return view('pickup-points.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'Nama titik pengambilan wajib diisi.',
            'location.required' => 'Lokasi wajib diisi.',
        ]);

        PickupPoint::create($request->only(['name', 'location']));

        return redirect()->route('pickup-points.index')
            ->with('success', 'Titik pengambilan berhasil ditambahkan!');
    }

    public function edit(PickupPoint $pickupPoint)
    {
        return view('pickup-points.edit', compact('pickupPoint'));
    }

    public function update(Request $request, PickupPoint $pickupPoint)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'Nama titik pengambilan wajib diisi.',
            'location.required' => 'Lokasi wajib diisi.',
        ]);

        $pickupPoint->update($request->only(['name', 'location']));

        return redirect()->route('pickup-points.index')
            ->with('success', 'Titik pengambilan berhasil diperbarui!');
    }

    public function destroy(PickupPoint $pickupPoint)
    {
        if ($pickupPoint->items()->count() > 0) {
            return redirect()->route('pickup-points.index')
                ->with('error', 'Titik pengambilan tidak bisa dihapus karena masih digunakan!');
        }

        $pickupPoint->delete();

        return redirect()->route('pickup-points.index')
            ->with('success', 'Titik pengambilan berhasil dihapus!');
    }
}
