# Architecture Mapping dari Draw.io

Dokumen ini memetakan isi file Draw.io ke struktur Laravel.

## Role

1. User / Masyarakat
2. Petugas / Officer

## Modul User

### Homepage User

Komponen:
- Bottom navigation/navbar
- Header situasi lokasi user
- Beranda
- Peta dan evakuasi
- Laporkan bencana
- Panduan aman
- Profil
- Indikator status terkini
- Lokasi user
- Banner peringatan darurat kondisional
- Informasi bencana aktif di sekitar
- Button lihat jalur evakuasi
- Button shelter terdekat
- Quick action shelter/fasilitas kesehatan
- List 5 bencana terbaru di sekitar
- Rekomendasi AI responsif

Laravel mapping:
- Web: `UserPageController@home`
- API: `Api\User\HomeController`
- Service: `DisasterAlertService`, `AiRecommendationService`, `GeofenceService`

### Peta dan Evakuasi User

Komponen:
- Tab jalur evakuasi
- Tab shelter dan pos darurat
- Tab fasilitas kesehatan
- Peta interaktif
- Pin lokasi
- Tooltip
- Nama jalur/shelter/fasilitas kesehatan
- Jarak dari lokasi user
- Jenis bencana
- Kapasitas
- Filter berdasarkan bencana
- Pengaturan radius pantauan/geofencing

Laravel mapping:
- Web: `UserPageController@map`
- API: `Api\User\MapEvacuationController`
- Model: `EvacuationRoute`, `EmergencyPlace`
- Service: `GeofenceService`

### Laporkan Bencana

Komponen:
- Identitas laporan
- Jenis bencana dropdown
- Waktu kejadian date picker
- Deskripsi text field
- Lokasi kejadian
- Deteksi lokasi otomatis
- Penanda manual di peta
- Upload foto max 3
- Ambil foto kamera
- Keterangan foto
- Preview laporan
- Kirim laporan final
- Syarat dan ketentuan
- Notifikasi laporan terkirim

Laravel mapping:
- Web: `UserPageController@report`
- API: `Api\User\DisasterReportController`
- Request: `StoreDisasterReportRequest`
- Model: `DisasterReport`, `ReportAttachment`
- Repository: `DisasterReportRepository`

### Panduan Aman

Komponen:
- Pendidikan dan berita
- Berita terkini
- Video tutorial first aid
- Rekomendasi tindakan preventif saat bencana aman

Laravel mapping:
- Web: `UserPageController@safety`
- API: `Api\User\SafetyGuideController`
- Model: `SafetyGuide`
- Service: `AiRecommendationService`

### Profil Masyarakat

Komponen:
- Header profil
- Foto profil dan nama
- ID peran masyarakat/petugas
- Data pribadi edit
- Informasi dasar email dan nomor HP
- Riwayat laporan
- Preferensi notifikasi
- Keamanan akun
- Kebijakan privasi
- Bantuan/tutorial
- Kontak darurat pusat
- Logout

Laravel mapping:
- Web: `UserPageController@profile`
- API: `Api\User\ProfileController`
- Model: `User`, `NotificationPreference`, `DisasterReport`

## Modul Petugas

### Homepage Petugas

Komponen:
- Bottom navigation/navbar
- Beranda
- Kelola data
- Profil
- Peta
- Filter jenis bencana dan status laporan
- Titik sebaran bencana
- Detail dan status bencana
- Rekomendasi tindakan by LLM
- Status koneksi API BMKG
- Banner penanganan bencana prioritas
- Ringkasan statistik
- Total laporan masuk
- Laporan belum ditangani
- Wilayah waspada/siaga
- Feed informasi dan laporan terbaru

Laravel mapping:
- Web: `OfficerPageController@home`
- API: `Api\Officer\DashboardController`
- Service: `BmkgService`, `AiRecommendationService`, `DisasterAlertService`

### Kelola Data Petugas

Tab:
- Laporan bencana
- Jalur evakuasi
- Shelter dan posko
- Fasilitas kesehatan
- Catatan penanggulangan

Fitur umum:
- Search bar
- Filter status, jenis bencana, rentang waktu, wilayah
- List card data
- Detail
- Edit
- Hapus
- Tambah data

Laravel mapping:
- Web: `OfficerPageController@manageData`
- API controllers:
  - `ReportManagementController`
  - `EvacuationRouteManagementController`
  - `EmergencyPlaceManagementController`
  - `HealthFacilityManagementController`
  - `MitigationNoteController`

### Profil Petugas

Komponen:
- Identitas diri
- Foto profil
- Nama lengkap
- NIP / ID Staff
- Instansi terkait
- Jabatan / role
- Pengaturan keamanan
- Ubah email / no telepon
- Ganti password
- Autentikasi 2FA
- Pengaturan notifikasi internal
- Filter alert
- Sound settings
- Sistem notifikasi
- Help & support petugas
- Panduan SOP
- Hubungi admin
- Logout

Laravel mapping:
- Web: `OfficerPageController@profile`
- API: `Api\Officer\ProfileController`
- Model: `User`, `NotificationPreference`
