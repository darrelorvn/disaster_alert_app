<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Controller;
use App\Models\EmergencyPlace;
use App\Enums\EmergencyPlaceType;
use App\Http\Requests\Officer\StoreEmergencyPlaceRequest;
use Illuminate\Http\Request;

class HealthFacilityManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = EmergencyPlace::query()
            ->whereIn('type', [
                EmergencyPlaceType::HealthFacility->value ?? 'health_facility',
                EmergencyPlaceType::HealthPost->value ?? 'health_post'
            ]);

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $places = $query->latest()->paginate(10)->withQueryString();

        $types = [
            EmergencyPlaceType::HealthFacility ?? 'health_facility',
            EmergencyPlaceType::HealthPost ?? 'health_post'
        ];

        return view('pages.officer.kelola-data.fasilitas-kesehatan', compact('places', 'types'));
    }

    public function create()
    {
        $types = [
            EmergencyPlaceType::HealthFacility ?? 'health_facility',
            EmergencyPlaceType::HealthPost ?? 'health_post'
        ];
        
        return view('pages.officer.kelola-data.create.fasilitas-kesehatan', compact('types'));
    }

    public function store(StoreEmergencyPlaceRequest $request)
    {
        EmergencyPlace::create($request->validated());

        return redirect()
            ->route('officer.kelola-data.faskes.index')
            ->with('success', 'Data fasilitas kesehatan berhasil ditambahkan.');
    }

    public function edit(EmergencyPlace $facility)
    {
        $types = [
            EmergencyPlaceType::HealthFacility ?? 'health_facility',
            EmergencyPlaceType::HealthPost ?? 'health_post'
        ];

        return view('pages.officer.kelola-data.update.fasilitas-kesehatan', compact('facility', 'types'));
    }

    public function update(StoreEmergencyPlaceRequest $request, EmergencyPlace $facility)
    {
        $facility->update($request->validated());

        return redirect()
            ->route('officer.kelola-data.faskes.index')
            ->with('success', 'Data fasilitas kesehatan berhasil diperbarui.');
    }

    public function destroy(EmergencyPlace $facility)
    {
        $facility->delete();

        return redirect()
            ->route('officer.kelola-data.faskes.index')
            ->with('success', 'Data fasilitas kesehatan berhasil dihapus.');
    }
}