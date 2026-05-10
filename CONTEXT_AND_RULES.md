# AI Context & Rules — Sentinel Public Safety

> **Versi Dokumen:** 1.1.0
> **Terakhir Diperbarui:** Sabtu, 10 May 2026

---

## 📁 Project Context

### Gambaran Umum
- **Nama Project:** Sentinel Public Safety
- **Tipe Aplikasi:** Web App Fullstack + API-ready
- **Tujuan Utama:** Menyediakan platform informasi, pelaporan, dan penanganan bencana bagi masyarakat dan petugas BMKG/BAZARNAS
- **Target Pengguna:** Masyarakat umum (`user`) dan Pegawai BMKG/BAZARNAS (`officer`)

### Tech Stack
| Layer | Teknologi |
|---|---|
| Backend Framework | Laravel `^12.0` |
| PHP | `^8.2` |
| Frontend Build Tool | Vite |
| CSS Framework | Tailwind CSS |
| Database (dev) | SQLite |
| ORM | Eloquent ORM |
| Template Engine | Blade |
| Arsitektur | MVC + Service Layer + Repository Layer |

### Role Pengguna
| Role | Slug | Deskripsi |
|---|---|---|
| Masyarakat | `user` | Pengguna umum — melapor, melihat info bencana, dan mendapat rekomendasi |
| Pegawai BMKG/BAZARNAS | `officer` | Pengelola data, laporan, jalur evakuasi, shelter, dan informasi bencana |

### Struktur Direktori Utama
```
sentinel-public-safety/
├── app/
│   ├── Enums/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/
│   │   │   │   ├── User/
│   │   │   │   ├── Officer/
│   │   │   │   └── Integration/
│   │   │   └── Web/
│   │   ├── Requests/
│   │   └── Resources/
│   ├── Models/
│   ├── Repositories/
│   ├── Services/
│   └── Providers/
├── database/
│   ├── migrations/
│   └── seeders/
├── routes/
│   ├── api.php
│   ├── web.php
│   └── console.php
└── resources/views/
    ├── layouts/
    ├── pages/user/
    └── pages/officer/
```

---

### Modul Aplikasi

#### 👤 Masyarakat (`user`)

| Modul | Scope / Kemampuan |
|---|---|
| Laporkan Bencana | Melaporkan bencana alam di area sekitar, lengkap dengan waktu kejadian, jenis bencana, foto, deskripsi, dan titik lokasi |
| Tindakan Preventif | Mencatat tindakan preventif yang dilakukan untuk menghindari bencana, dilengkapi waktu, aktivitas, dan foto bukti |
| Riwayat & Geofencing | Melihat riwayat bencana dalam radius tertentu (x km) dari lokasi pengguna melalui fitur geofencing |
| Shelter & Posko | Mengetahui shelter, lokasi pengungsian, dan pos terpadu terdekat beserta nomor darurat yang bisa dihubungi |
| Jalur Evakuasi | Melihat jalur evakuasi atau jalur aman yang tersedia saat bencana terjadi |
| Fasilitas Kesehatan | Mengetahui pusat kesehatan terdekat yang tersedia saat bencana terjadi |
| Rekomendasi AI | Mendapatkan rekomendasi tindakan pasca bencana maupun preventif berdasarkan riwayat kejadian, dihasilkan dengan bantuan LLM/GPT |
| Catatan Penanggulangan | Mencatat tindakan penanggulangan pasca bencana yang telah dilakukan |

#### 🪖 Pegawai BMKG/BAZARNAS (`officer`)

| Modul | Scope / Kemampuan |
|---|---|
| Integrasi BMKG | Mendapatkan informasi kejadian bencana dari BMKG secara langsung melalui integrasi API BMKG |
| Agregasi Media Sosial | Mendapatkan informasi secara otomatis dari media sosial (Twitter, dll.) dan media berita mainstream; penarikan informasi dilakukan secara otomatis |
| Peta Sebaran Bencana | Melihat peta sebaran bencana berdasarkan titik-titik lokasi yang dilaporkan oleh masyarakat |
| Analisis Lokasi Rawan | Melihat lokasi yang sering mengalami bencana berulang sehingga dapat mengambil tindak lanjut yang tepat untuk mencegah kejadian serupa |
| Kelola Jalur Evakuasi | Memasukkan informasi jalur evakuasi atau jalur aman yang dapat digunakan masyarakat saat bencana berlangsung |
| Kelola Fasilitas Kesehatan | Memasukkan informasi pusat kesehatan terdekat yang akan ditampilkan kepada masyarakat saat bencana terjadi |
| Rekomendasi AI | Mendapatkan rekomendasi tindakan pasca bencana maupun preventif berdasarkan riwayat kejadian, dihasilkan dengan bantuan LLM/GPT |
| Catatan Penanggulangan | Mencatat tindakan penanggulangan pasca bencana yang telah dilakukan |

### Integrasi Eksternal yang Disiapkan
| Service Class | Integrasi |
|---|---|
| `BmkgService` | API BMKG — data cuaca & gempa secara langsung |
| `AiRecommendationService` | AI/LLM (GPT) — rekomendasi tindakan preventif & pasca bencana |
| `GeofenceService` | Geofencing / radius pantauan wilayah per pengguna |
| `DisasterAlertService` | Alert darurat ke pengguna |

---

## 🤖 AI Rules & Conventions

Panduan berikut **wajib diikuti** saat membantu development project ini.

---

### 1. Umum

- Gunakan **Bahasa Indonesia** untuk komentar kode dan komunikasi; nama fungsi/class/method tetap **English**.
- Ikuti **konvensi bawaan Laravel** — tidak perlu reinvent the wheel.
- Jika ada lebih dari satu cara, pilih yang **paling idiomatis di Laravel**.
- Project ini adalah **skeleton** — saat mengisi `TODO`, jangan ubah struktur yang sudah ada kecuali ada alasan kuat.
- Jangan install package baru tanpa konfirmasi eksplisit.
- Selalu perhatikan **role** (`user` / `officer`) saat menulis logika — akses dan alur keduanya berbeda.

---

### 2. Arsitektur: MVC + Service + Repository

Project ini menggunakan **tiga lapis** di atas MVC standar Laravel:

```
Controller → Service → Repository → Model
```

| Layer | Tanggung Jawab |
|---|---|
| **Controller** | Terima request, panggil Service, kembalikan response |
| **Service** | Business logic — validasi bisnis, orkestrasi, kalkulasi |
| **Repository** | Akses database — query Eloquent terisolasi di sini |
| **Model** | Definisi relasi, fillable, cast, scope |

#### Aturan penting arsitektur:
- **Controller tidak boleh** mengandung query Eloquent langsung — delegasikan ke Repository via Service.
- **Service tidak boleh** tahu tentang HTTP request/response — terima data plain, kembalikan data plain.
- **Repository hanya boleh** berisi query database, tidak ada business logic.
- Untuk fitur yang tidak butuh business logic, boleh Controller → Repository langsung, tapi tetap via Service lebih disarankan.

#### Contoh alur yang benar:
```php
// ✅ Controller
public function store(StoreLaporanRequest $request): JsonResponse
{
    $laporan = $this->laporanService->createLaporan($request->validated());
    return response()->json(new LaporanResource($laporan), 201);
}

// ✅ Service
public function createLaporan(array $data): Laporan
{
    // business logic di sini (misal: tentukan status awal, kirim alert, dll.)
    return $this->laporanRepository->create($data);
}

// ✅ Repository
public function create(array $data): Laporan
{
    return Laporan::create($data);
}
```

---

### 3. PHP & Laravel

#### Naming Convention
| Komponen | Format | Contoh |
|---|---|---|
| Controller | Singular + `Controller` | `LaporanController`, `ShelterController` |
| Model | Singular, PascalCase | `Laporan`, `JalurEvakuasi`, `Shelter` |
| Service | Singular + `Service` | `LaporanService`, `BmkgService` |
| Repository | Singular + `Repository` | `LaporanRepository`, `ShelterRepository` |
| Migration | snake_case deskriptif | `create_laporans_table` |
| Form Request | Verb + Model + `Request` | `StoreLaporanRequest`, `UpdateShelterRequest` |
| API Resource | Model + `Resource` | `LaporanResource`, `ShelterResource` |
| Route name | snake_case dot notation | `laporan.store`, `officer.shelter.index` |

#### Route Structure
- Route web: `routes/web.php` — untuk halaman Blade
- Route API: `routes/api.php` — untuk endpoint JSON, dipisah berdasarkan role:
  ```
  /api/user/...        → fitur masyarakat
  /api/officer/...     → fitur pegawai BMKG/BAZARNAS
  /api/integration/... → integrasi eksternal (BMKG, AI, dll.)
  ```

#### Laravel Best Practices
- Gunakan **Form Request** untuk semua validasi input (`app/Http/Requests/`)
- Gunakan **API Resource** untuk semua response JSON (`app/Http/Resources/`)
- Gunakan **Route Model Binding** jika memungkinkan
- Gunakan **Eager Loading** (`with()`) untuk cegah N+1 query
- Gunakan **Enums** (`app/Enums/`) untuk nilai konstan seperti status laporan, tipe bencana, dll.
- Semua perubahan skema DB lewat **Migration**, tidak ada alter manual

#### Eloquent & Database
- Selalu definisikan `$fillable` di setiap Model
- Gunakan **soft delete** untuk data laporan, shelter, dan data kritikal lainnya
- Nama tabel: plural snake_case → `laporans`, `jalur_evakuasis`, `shelters`
- Foreign key: `[singular_model]_id` → `user_id`, `laporan_id`
- Gunakan **database transaction** untuk operasi multi-step (misal: buat laporan + kirim alert)

---

### 4. API Response

Selalu gunakan format response yang konsisten untuk semua endpoint API:

```json
// Success
{
  "success": true,
  "message": "Laporan berhasil dibuat.",
  "data": { }
}

// Error
{
  "success": false,
  "message": "Laporan tidak ditemukan.",
  "errors": { }
}
```

- Gunakan **HTTP status code** yang tepat (`200`, `201`, `422`, `403`, `404`, `500`)
- Semua response collection harus terpaginasi jika data bisa banyak

---

### 5. Frontend (Vite + Tailwind CSS)

- Gunakan `@vite()` directive di Blade, bukan `mix()`
- Gunakan **utility classes Tailwind** langsung di Blade/HTML
- Ekstrak UI berulang ke **Blade component** (`php artisan make:component`)
- Pisahkan partial view ke `resources/views/partials/`
- Pisahkan layout `user` dan `officer` — keduanya memiliki UI yang berbeda secara signifikan

---

### 6. Keamanan

- Selalu gunakan `@csrf` di setiap form web
- Gunakan **Policy atau Gate** untuk authorization berdasarkan role (`user` / `officer`)
- Jangan expose data sensitif di response API
- Semua konfigurasi sensitif (API key BMKG, token GPT, dll.) wajib di `.env`
- Validasi semua input — gunakan Form Request

---

### 7. Integrasi Eksternal

Saat mengimplementasi Service integrasi, ikuti aturan ini:

- **`BmkgService`** — wrapper HTTP client ke API BMKG; handle error/timeout dengan graceful fallback
- **`AiRecommendationService`** — call ke LLM/GPT; selalu async atau cache hasilnya, jangan blocking
- **`GeofenceService`** — logika radius/koordinat per user; gunakan helper geospasial yang tersedia
- **`DisasterAlertService`** — kirim notifikasi darurat; pastikan idempotent (tidak kirim duplikat)

Semua integrasi eksternal harus:
1. Di-wrap dalam `try/catch`
2. Log error jika gagal (`Log::error(...)`)
3. Tidak menghalangi alur utama user jika integrasi gagal

---

### 8. Yang Harus Dihindari AI

- ❌ Jangan taruh query Eloquent di Controller — gunakan Repository
- ❌ Jangan taruh business logic di Controller — gunakan Service
- ❌ Jangan ubah struktur folder yang sudah ada tanpa konfirmasi
- ❌ Jangan hardcode API key, URL, atau konfigurasi sensitif
- ❌ Jangan buat endpoint API tanpa Form Request dan API Resource
- ❌ Jangan abaikan perbedaan role `user` dan `officer` — selalu cek konteks akses
- ❌ Jangan isi `TODO` dengan implementasi parsial yang merusak struktur yang ada
- ❌ Jangan gunakan raw `DB::` query jika bisa pakai Eloquent