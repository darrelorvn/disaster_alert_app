<?php

namespace App\Http\Controllers\Web\Officer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaDataController extends Controller
{
    public function laporan()
    {
        return view('pages.officer.kelola-data.laporan-bencana');
    }

    public function evakuasi()
    {
        return view('pages.officer.kelola-data.jalur-evakuasi');
    }

    public function shelter()
    {
        return view('pages.officer.kelola-data.shelter-posko');
    }

    public function faskes()
    {
        return view('pages.officer.kelola-data.fasilitas-kesehatan');
    }

    public function penanggulangan()
    {
        return view('pages.officer.kelola-data.catatan-penanggulangan');
    }
}