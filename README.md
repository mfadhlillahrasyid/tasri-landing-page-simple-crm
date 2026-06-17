# Tasri CRM (Taman Asoka Asri)

Sistem **Customer Relationship Management (CRM)** berbasis web yang dirancang khusus untuk mengelola calon pembeli properti (leads), penugasan tim marketing, dan melacak riwayat closing di proyek Taman Asoka Asri.

## 🚀 Fitur Utama

- **Role-Based Access Control**: Pemisahan hak akses antara **Admin** (memiliki akses penuh) dan **Marketing** (hanya dapat mengelola lead yang ditugaskan kepada mereka).
- **Manajemen Leads (Rotator & Assignment)**: Mendukung auto-assign ke marketing secara bergilir (rotator) atau penugasan manual oleh Admin.
- **Status Tracking**: Melacak status calon pembeli mulai dari *Cold*, *Warm*, hingga *Closing*.
- **Proteksi Data Closing**: Lead yang sudah berstatus *Closing* akan dikunci dan tidak bisa diubah lagi kategorinya untuk mencegah manipulasi data.
- **Integrasi WhatsApp**: Tombol *follow-up* instan yang akan membuka WhatsApp dengan template pesan perkenalan secara dinamis.
- **Unggah Bukti Closing**: Mendukung pengunggahan hingga 5 gambar bukti closing.
- **Activity Logging**: Pencatatan aktivitas user (Login, Logout, Update, Delete) secara terpusat untuk keperluan audit.
- **Single Page Application (SPA) Feel**: Menggunakan **Hotwire Turbo** dan **AJAX Polling** untuk transisi halaman instan dan *real-time update* tanpa me-reload halaman penuh.

## 🛠️ Tech Stack

- **Backend**: Native PHP (8.x+) dengan arsitektur MVC kustom (tanpa framework).
- **Database**: MySQL / MariaDB via PDO (`Database.php`).
- **Frontend/Styling**: Tailwind CSS & DaisyUI (via CDN).
- **JavaScript**: Vanilla ES6 Modules & Hotwire Turbo.

## 📂 Struktur Direktori

Aplikasi ini dibangun dengan struktur **MVC (Model-View-Controller)** kustom:

```text
tasri-crm/
├── app/
│   ├── Controller/      # Logika aplikasi dan pemrosesan request (Admin, Auth, dll)
│   ├── Enum/            # Enumerasi konstanta (UserRoles, LeadCategories)
│   └── Repository/      # Model database / interaksi query SQL (User, Customer, Log)
├── assets/
│   ├── css/             # Styling tambahan
│   ├── js/              # Skrip Vanilla JS (Komponen UI)
│   └── uploads/         # Direktori unggahan gambar (Avatar & Closing)
├── config/              # Konfigurasi aplikasi & koneksi PDO Database
├── data/                # Penyimpanan file dinamis (seperti logs.json)
├── routes/              # Konfigurasi rute (Web.php)
├── views/               # Tampilan antarmuka / HTML
│   ├── admin/           # Halaman khusus area Admin/Dashboard
│   ├── components/      # Komponen UI modular (Tabel, Button, Modal, Dropzone)
│   └── layouts/         # Layout utama aplikasi
└── index.php            # Entry point aplikasi (Front Controller)
```

## ⚙️ Persyaratan Instalasi

1. PHP versi 8.0 atau lebih tinggi.
2. Web Server (Apache/Nginx/Laragon/XAMPP).
3. MySQL / MariaDB.

## 🚀 Cara Instalasi (Development)

1. **Clone Repository**
   ```bash
   git clone <url-repo-anda> tasri-crm
   cd tasri-crm
   ```

2. **Pengaturan Database**
   - Buat database baru di MySQL (misal: `tasri_crm`).
   - Eksekusi file dump SQL yang Anda miliki untuk membuat tabel `users`, `customers`, `settings`, `customer_closing_images`, dll.
   - Sesuaikan kredensial database di file `config/Database.php` (pastikan username & password cocok).

3. **Izin Folder (Permissions)**
   Pastikan folder berikut memiliki izin tulis (*write/read*) agar sistem dapat mengunggah gambar dan mencatat *log* dengan lancar:
   - `assets/uploads/`
   - `data/`

4. **Jalankan Aplikasi**
   - **Menggunakan Laragon/XAMPP**: Akses melalui virtual host (misal: `http://tasri-crm.test`).
   - **Menggunakan PHP Built-in Server**:
     ```bash
     php -S localhost:8000
     ```
     Lalu buka `http://localhost:8000` di browser.

## 🛡️ Keamanan
- Fitur Log Activity saat ini disimpan di `data/logs.json`. Jangan lupa memastikan folder `data/` tidak bisa diakses langsung via URL browser (lindungi dengan `.htaccess` jika dideploy ke *production*).
