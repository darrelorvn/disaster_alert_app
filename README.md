# Siaga Bencana Laravel

Skeleton project Laravel untuk aplikasi informasi, pelaporan, dan penanganan bencana berdasarkan arsitektur `Manprosi kelompok 1.drawio`.

Project ini sengaja belum diprogram penuh. Struktur, route, controller, model, request, service, repository, migration, dan view placeholder sudah disiapkan agar tahap berikutnya tinggal mengisi business logic, integrasi API, validasi detail, UI, dan database seeding.

## Target teknis

- Laravel: `^12.0`
- PHP: `^8.2`
- Database default: SQLite untuk development lokal
- Arsitektur: MVC + Service Layer + Repository Layer
- Role utama: `user` / masyarakat dan `officer` / petugas
- API-ready: route API sudah dipisahkan dari route halaman web placeholder

## Modul berdasarkan arsitektur

### User / Masyarakat

- Beranda user
- Peta dan evakuasi
- Laporkan bencana
- Panduan aman
- Profil pengguna
- Riwayat laporan
- Preferensi notifikasi dan keamanan akun

### Petugas

- Beranda petugas
- Peta monitoring
- Kelola data
- Kelola laporan bencana
- Kelola jalur evakuasi
- Kelola shelter dan posko
- Kelola fasilitas kesehatan
- Catatan penanggulangan
- Profil petugas
- Pengaturan keamanan, notifikasi internal, SOP, dan bantuan

### Integrasi yang disiapkan

- API BMKG melalui `BmkgService`
- Rekomendasi AI/LLM melalui `AiRecommendationService`
- Geofencing/radius pantauan melalui `GeofenceService`
- Alert darurat melalui `DisasterAlertService`

## Cara menjalankan setelah diekstrak

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Untuk frontend asset Laravel/Vite:

```bash
npm install
npm run dev
```

## Catatan penting

Folder `vendor/` dan `node_modules/` tidak disertakan. Itu normal untuk project Laravel. Install dependency dengan Composer dan npm di komputer lokal.

Project ini masih skeleton. Banyak method berisi `TODO` atau response placeholder. Ini disengaja agar sesuai permintaan: setup sudah ada, tapi implementasi fitur belum dikerjakan.

## Struktur utama

```text
app/
├── Enums/
├── Http/
│   ├── Controllers/
│   │   ├── Api/
│   │   │   ├── User/
│   │   │   ├── Officer/
│   │   │   └── Integration/
│   │   └── Web/
│   ├── Requests/
│   └── Resources/
├── Models/
├── Repositories/
├── Services/
└── Providers/

database/
├── migrations/
└── seeders/

routes/
├── api.php
├── web.php
└── console.php

resources/views/
├── layouts/
├── pages/user/
└── pages/officer/

docs/
├── architecture.md
├── route-map.md
└── development-todo.md
```
