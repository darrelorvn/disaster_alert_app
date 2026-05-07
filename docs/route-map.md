# Route Map

## Web Routes

| Method | URI | Name | Controller |
|---|---|---|---|
| GET | `/` | `user.home` | `UserPageController@home` |
| GET | `/user/home` | `user.home` | `UserPageController@home` |
| GET | `/user/peta-evakuasi` | `user.map` | `UserPageController@map` |
| GET | `/user/laporkan-bencana` | `user.report` | `UserPageController@report` |
| GET | `/user/panduan-aman` | `user.safety` | `UserPageController@safety` |
| GET | `/user/profil` | `user.profile` | `UserPageController@profile` |
| GET | `/petugas/home` | `officer.home` | `OfficerPageController@home` |
| GET | `/petugas/kelola-data` | `officer.manage-data` | `OfficerPageController@manageData` |
| GET | `/petugas/profil` | `officer.profile` | `OfficerPageController@profile` |

## API Prefix

Semua API menggunakan prefix `/api/v1`.

## API User

- `GET /api/v1/user/home`
- `GET /api/v1/user/home/active-disasters`
- `GET /api/v1/user/home/latest-reports`
- `GET /api/v1/user/home/quick-actions`
- `GET /api/v1/user/peta-evakuasi`
- `GET /api/v1/user/peta-evakuasi/jalur`
- `GET /api/v1/user/peta-evakuasi/shelter-posko`
- `GET /api/v1/user/peta-evakuasi/fasilitas-kesehatan`
- `GET /api/v1/user/peta-evakuasi/radius`
- `GET /api/v1/user/laporan-bencana`
- `POST /api/v1/user/laporan-bencana/preview`
- `POST /api/v1/user/laporan-bencana`
- `GET /api/v1/user/laporan-bencana/{report}`
- `GET /api/v1/user/panduan-aman`
- `GET /api/v1/user/panduan-aman/berita`
- `GET /api/v1/user/panduan-aman/video`
- `GET /api/v1/user/panduan-aman/{guide}`
- `GET /api/v1/user/profil`
- `PUT /api/v1/user/profil`
- `GET /api/v1/user/profil/riwayat-laporan`
- `GET /api/v1/user/profil/preferensi-notifikasi`
- `GET /api/v1/user/profil/keamanan`

## API Petugas

- `GET /api/v1/petugas/dashboard`
- `GET /api/v1/petugas/dashboard/statistik`
- `GET /api/v1/petugas/dashboard/peta`
- `GET /api/v1/petugas/dashboard/feed`
- `GET /api/v1/petugas/laporan-bencana`
- `GET /api/v1/petugas/laporan-bencana/{report}`
- `PATCH /api/v1/petugas/laporan-bencana/{report}/status`
- REST API Resource untuk `/jalur-evakuasi`
- REST API Resource untuk `/shelter-posko`
- REST API Resource untuk `/fasilitas-kesehatan`
- REST API Resource untuk `/catatan-penanggulangan`

## API Integrasi

- `GET /api/v1/integrations/bmkg/status`
- `GET /api/v1/integrations/bmkg/latest`
- `POST /api/v1/integrations/bmkg/sync`
- `POST /api/v1/integrations/ai/recommendation/responsive`
- `POST /api/v1/integrations/ai/recommendation/preventive`
