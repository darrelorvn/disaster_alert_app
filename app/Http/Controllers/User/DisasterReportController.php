<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreDisasterReportRequest;
use App\Models\DisasterReport;
use App\Models\ReportAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisasterReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = DisasterReport::query()
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pages.user.report-disaster', compact('reports'));
    }

    public function create()
    {
        return view('pages.user.report-disaster'); 
    }

    public function store(StoreDisasterReportRequest $request)
    {
        // 1. Ambil data payload
        $payload = $request->except(['photos', 'photo_captions']);
        $payload['user_id'] = Auth::id();
        $payload['status'] = 'submitted';
        
        // 2. Simpan Laporan
        $report = DisasterReport::create($payload);

        // 3. Simpan Lampiran (Foto) jika ada
        if ($request->hasFile('photos')) {
            $captions = $request->input('photo_captions', []);

            foreach ($request->file('photos') as $index => $photo) {
                $path = $photo->store('reports', 'public');

                ReportAttachment::create([
                    'disaster_report_id' => $report->id,
                    'file_path' => $path,
                    'caption' => $captions[$index] ?? null,
                    'mime_type' => $photo->getMimeType(),
                    'size' => $photo->getSize(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Laporan Anda berhasil dikirim dan sedang ditinjau oleh tim!');
    }

    public function show(DisasterReport $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $report->load('attachments');

        return view('pages.user.report-disaster', compact('report'));
    }
}