# Disaster Alert App

Project berbasis Laravel 12 menggunakan Vite dan Tailwind CSS.

---

# Requirement

Pastikan perangkat sudah terinstall:

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL
- Git

---

# 1. Clone Repository

```bash
git clone <repository-url>
cd disaster_alert_app
```

---

# 2. Create a New Branch

Sebelum mulai development, buat branch baru sesuai fitur atau task yang dikerjakan.

```bash
git checkout -b feature/<branch-name>
```

Contoh:

```bash
git checkout -b feature/login-page
```

---

# 3. Install Dependency Backend

```bash
composer install
```

---

# 4. Setup Environment

## Windows

```bash
copy .env.example .env
```

## Linux / MacOS

```bash
cp .env.example .env
```

---

# 5. Generate Application Key

```bash
php artisan key:generate
```

---

# 6. Setup Database

Buat database baru di MySQL, misalnya:

```plaintext
disaster_alert
```

Lalu sesuaikan konfigurasi database pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=disaster_alert
DB_USERNAME=root
DB_PASSWORD=
```

---

# 7. Jalankan Migration

```bash
php artisan migrate
```

---

# 8. Install Dependency Frontend

```bash
npm install
```

---

# 9. Menjalankan Backend Laravel

```bash
php artisan serve
```

Backend akan berjalan di:

```plaintext
http://127.0.0.1:8000
```

---

# 10. Menjalankan Frontend Vite

Buka terminal baru lalu jalankan:

```bash
npm run dev
```

Vite digunakan untuk:
- Tailwind CSS
- Asset JS/CSS
- Hot Reload

---
