<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DisasterEvent;
use App\Models\DisasterReport;

class ClearExpiredReports extends Command
{
    protected $signature = 'disaster:clear-expired';
    protected $description = 'Hapus laporan dan kejadian bencana yang sudah melewati waktu expired';

    public function handle()
    {
        $this->info('Memulai pembersihan data expired...');

        // Cari event yang sudah expired
        $expiredEvents = DisasterEvent::whereNotNull('expired_at')
            ->where('expired_at', '<=', now())
            ->get();

        $count = 0;
        foreach ($expiredEvents as $event) {
            // Hapus laporan terkait (karena cascade delete biasanya tidak diset di migration awal, kita hapus manual atau andalkan relasi)
            // Di migration 2026_05_07_000200_create_disaster_reports_table.php, disaster_event_id diset nullOnDelete.
            // Jika ingin benar-benar hapus laporannya juga:
            DisasterReport::where('disaster_event_id', $event->id)->delete();
            $event->delete();
            $count++;
        }

        $this->info("Berhasil menghapus {$count} kejadian bencana beserta laporannya.");
    }
}
