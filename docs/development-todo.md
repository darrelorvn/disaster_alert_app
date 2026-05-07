# Development TODO

## Prioritas 1: Fondasi

- Install Composer dependency.
- Jalankan migration.
- Tambahkan authentication: Laravel Breeze, Jetstream, atau Sanctum sesuai kebutuhan.
- Tambahkan middleware role `user`, `officer`, dan `admin`.
- Tambahkan policy untuk laporan, jalur evakuasi, shelter/posko, fasilitas kesehatan, dan catatan penanggulangan.

## Prioritas 2: Modul User

- Isi logic `HomeController` untuk status lokasi dan bencana aktif.
- Isi logic `MapEvacuationController` untuk peta, jarak, radius, filter, dan geofencing.
- Isi logic `DisasterReportController` untuk preview, upload foto, validasi lokasi, dan submit laporan.
- Isi logic `SafetyGuideController` untuk artikel, berita, video tutorial, dan rekomendasi preventif.
- Isi logic `ProfileController` untuk update profil, keamanan akun, riwayat laporan, dan preferensi notifikasi.

## Prioritas 3: Modul Petugas

- Isi dashboard statistik.
- Isi peta monitoring dan titik sebaran bencana.
- Isi feed informasi dan laporan terbaru.
- Isi CRUD jalur evakuasi.
- Isi CRUD shelter dan posko.
- Isi CRUD fasilitas kesehatan.
- Isi CRUD catatan penanggulangan.
- Isi workflow verifikasi dan update status laporan.

## Prioritas 4: Integrasi

- Implementasi `BmkgService`.
- Implementasi `AiRecommendationService`.
- Implementasi queue/scheduler untuk sinkronisasi BMKG.
- Implementasi notifikasi darurat.
- Implementasi log audit untuk aksi petugas.

## Prioritas 5: Testing

- Feature test route user.
- Feature test route petugas.
- Unit test service geofencing.
- Unit test status laporan.
- Integration test upload foto laporan.
