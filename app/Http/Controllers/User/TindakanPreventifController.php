<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTindakanPreventifRequest;
use App\Http\Requests\UpdateTindakanPreventifRequest;
use App\Models\TindakanPreventif;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TindakanPreventifController extends Controller
{
    public function index()
    {
        $tindakans = TindakanPreventif::query()
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pages.user.tindakan-preventif.index', compact('tindakans'));
    }

    public function create()
    {
        return view('pages.user.tindakan-preventif.create');
    }

    public function store(StoreTindakanPreventifRequest $request)
    {
        $data = $request->validated();
        
        $data['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('tindakan-preventif', 'public');
        }

        TindakanPreventif::create($data);

        return redirect()
            ->route('user.tindakan-preventif.index')
            ->with('success', 'Tindakan preventif berhasil dicatat.');
    }

    public function show(TindakanPreventif $tindakanPreventif)
    {
        if ($tindakanPreventif->user_id !== Auth::id()) {
            abort(403);
        }

        return view('pages.user.tindakan-preventif.show', compact('tindakanPreventif'));
    }

    public function edit(TindakanPreventif $tindakanPreventif)
    {
        if ($tindakanPreventif->user_id != Auth::id()) {
            abort(403);
        }

        return view('pages.user.tindakan-preventif.edit', compact('tindakanPreventif'));
    }

    public function update(UpdateTindakanPreventifRequest $request, TindakanPreventif $tindakanPreventif)
    {
        if ($tindakanPreventif->user_id != Auth::id()) {
            abort(403);
        }

        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($tindakanPreventif->foto) {
                Storage::disk('public')->delete($tindakanPreventif->foto);
            }
            $data['foto'] = $request->file('foto')->store('tindakan-preventif', 'public');
        }

        $tindakanPreventif->update($data);

        return redirect()
            ->route('user.tindakan-preventif.index')
            ->with('success', 'Tindakan preventif berhasil diperbarui.');
    }

    public function destroy(TindakanPreventif $tindakanPreventif)
    {
        if ($tindakanPreventif->user_id !== Auth::id()) {
            abort(403);
        }

        TindakanPreventif::destroy($tindakanPreventif->id);

        return redirect()
            ->route('user.tindakan-preventif.index')
            ->with('success', 'Tindakan preventif berhasil dihapus.');
    }
}