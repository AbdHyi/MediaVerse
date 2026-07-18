# Panduan Deploy MediaVerse ke Railway

## 0. Generate APP_KEY dulu (dari lokal)

Jangan pakai APP_KEY yang sama dengan `.env` lokal kamu untuk production. Generate baru:

```bash
php artisan key:generate --show
```

Copy hasilnya (contoh: `base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx=`), nanti dipakai di step 3.

## 1. Push ke GitHub

Pastikan `Dockerfile`, `docker/entrypoint.sh`, `.dockerignore`, dan `railway.json` (semua file baru dari saya) ikut ke-commit & push ke repo GitHub kamu.

## 2. Buat Project di Railway

1. Login ke [railway.app](https://railway.app) pakai akun GitHub.
2. **New Project → Deploy from GitHub repo** → pilih repo MediaVerse kamu.
3. Railway akan otomatis mendeteksi `Dockerfile` dan mulai build (biarkan dulu, nanti gagal karena belum ada env var & DB — itu normal, lanjut ke step berikutnya).

## 3. Tambah MySQL

1. Di project yang sama, klik **+ New → Database → Add MySQL**.
2. Railway otomatis generate variable seperti `MYSQLHOST`, `MYSQLPORT`, `MYSQLDATABASE`, `MYSQLUSER`, `MYSQLPASSWORD` di service MySQL itu.

## 4. Set Environment Variables di service Web (bukan di service MySQL)

Buka service **web** kamu (bukan MySQL) → tab **Variables** → tambahkan:

```
APP_NAME=MediaVerse
APP_ENV=production
APP_KEY=<paste hasil step 0>
APP_DEBUG=false
APP_URL=https://<domain-yang-railway-kasih>.up.railway.app

DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}

SESSION_DRIVER=database
SESSION_SECURE_COOKIE=true
CACHE_STORE=database
QUEUE_CONNECTION=sync

FILESYSTEM_DISK=public
MAIL_MAILER=log
```

> Notasi `${{MySQL.MYSQLHOST}}` itu **variable reference** bawaan Railway — otomatis nyambung ke service MySQL yang kamu buat di step 3, tanpa perlu copy-paste manual. Ketik persis begitu (sesuaikan nama service kalau kamu rename MySQL-nya).

> `APP_URL` isi setelah Railway kasih domain publik-nya (muncul di tab **Settings → Networking → Generate Domain** pada service web). Setelah dapat domain, balik lagi ke Variables dan update `APP_URL`.

## 5. (Opsional tapi disarankan) Pasang Volume buat storage upload

Supaya poster/avatar yang di-upload admin **setelah** deploy tidak hilang saat redeploy:

1. Di service web → tab **Settings → Volumes → New Volume**.
2. Mount path: `/var/www/html/storage/app/public`
3. Redeploy.

Tanpa ini, foto seed yang sudah ada di repo tetap aman (ikut ke-build), tapi upload baru pasca-deploy bisa hilang kalau kamu redeploy lagi.

## 6. Deploy & Verifikasi

1. Railway otomatis redeploy tiap kali kamu ubah Variables. Tunggu build selesai (cek tab **Deployments** → **View Logs**).
2. Entrypoint script otomatis jalanin migrasi (`migrate --force`) & `storage:link` saat container start — kamu **tidak perlu** SSH manual buat migrate.
3. Buka domain Railway-nya, cek: halaman utama tampil, coba login pakai akun `admin@mediaverse.test` (dari `AbsoluteAdminSeeder`) — **tapi seeder tidak otomatis jalan di production**. Kalau butuh data awal (absolute admin + dummy media), jalankan sekali lewat Railway CLI:

```bash
railway run php artisan db:seed --force
```

## Troubleshooting cepat

| Gejala | Kemungkinan penyebab |
|---|---|
| Build sukses tapi 502/tidak bisa diakses | `APP_URL` belum diisi domain yang benar, atau `SESSION_SECURE_COOKIE` belum `true` (Railway pakai HTTPS) |
| Login gagal terus / redirect loop | `SESSION_DOMAIN` sebaiknya dikosongkan (jangan diisi `mediaverse.test` sisa config lokal) |
| Poster/avatar 404 | Pastikan `FILESYSTEM_DISK=public` ter-set, dan symlink `storage:link` berhasil (cek log entrypoint) |
| Deploy gagal di step `npm run build` | Cek log build — biasanya karena `package-lock.json` tidak ikut ke-push ke GitHub |
