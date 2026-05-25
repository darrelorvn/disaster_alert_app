<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Controller;
use App\Models\EmergencyPlace;
use App\Enums\EmergencyPlaceType;
use App\Http\Requests\Officer\StoreEmergencyPlaceRequest;
use Illuminate\Http\Request;

class EmergencyPlaceManagementController extends Controller
{
    /**
     * Menampilkan daftar Shelter & Posko (Read - Index)
     */
    public function index(Request $request)
    {
        // Hanya ambil tipe Shelter dan Posko Darurat
        $query = EmergencyPlace::query()
            ->whereIn('type', [
                EmergencyPlaceType::Shelter->value,
                EmergencyPlaceType::EmergencyPost->value
            ]);

        // Filter berdasarkan Input Type (jika ada)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter berdasarkan Status (jika ada)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $places = $query->latest()->paginate(10)->withQueryString();

        // Kirim opsi tipe spesifik ke View untuk Dropdown Filter
        $types = [
            EmergencyPlaceType::Shelter,
            EmergencyPlaceType::EmergencyPost
        ];

        // Memanggil View 'shelter-posko' yang berada di dalam folder officer/kelola-data
        return view('pages.officer.kelola-data.shelter-posko', compact('places', 'types'));
    }

    /**
     * Menampilkan form tambah data (Create)
     */
    public function create()
    {
        // Dropdown form hanya menampilkan tipe Shelter dan Posko
        $types = [
            EmergencyPlaceType::Shelter,
            EmergencyPlaceType::EmergencyPost
        ];
        
        return view('pages.officer.kelola-data.create.shelter-posko', compact('types'));
    }

    /**
     * Menyimpan data baru (Store)
     */
    public function store(StoreEmergencyPlaceRequest $request)
    {
        EmergencyPlace::create($request->validated());

        return redirect()
            ->route('officer.kelola-data.shelter.index')
            ->with('success', 'Data Shelter/Posko berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit data (Edit)
     */
    public function edit(EmergencyPlace $place)
    {
        $types = [
            EmergencyPlaceType::Shelter,
            EmergencyPlaceType::EmergencyPost
        ];

        return view('pages.officer.kelola-data.update.shelter-posko', compact('place', 'types'));
    }

    /**
     * Memperbarui data (Update)
     */
    public function update(StoreEmergencyPlaceRequest $request, EmergencyPlace $place)
    {
        $place->update($request->validated());

        return redirect()
            ->route('officer.kelola-data.shelter.index')
            ->with('success', 'Data Shelter/Posko berhasil diperbarui.');
    }

    /**
     * Menghapus data (Destroy)
     */
    public function destroy(EmergencyPlace $place)
    {
        $place->delete();

        return redirect()
            ->route('officer.kelola-data.shelter.index')
            ->with('success', 'Data Shelter/Posko berhasil dihapus.');
    }
}