# DOKUMENTASI IMPLEMENTASI UAS PEMWEB
### Oleh
## 20230801547 - David Boy
---

# DOCKER COMMANDS REFERENCE

| Command | Fungsi | Contoh |
|---------|--------|--------|
| `dcu` | docker-compose up -d | `dcu` |
| `dcd` | docker-compose down | `dcd` |
| `dcm` | Create model, controller, seeder, migration, filament resource | `dcm Customer` |
| `dci` | Project init (migrate, seed, fresh) | `dci` |
| `dcr` | Remove model, controller, seeder, migration, filament resource | `dcr Customer` |
| `dcp` | Git add, commit, push | `dcp "commit message"` |
| `dca` | php artisan | `dca make:middleware Test` |

---

# PROSES SLR
```bash
https://themewagon.com/themes/logis/
Rumpun Ilmu : Software Engineering
Deskripsi : Bikin Aplikasi Web Ekspor-Impor
P (Platform) : Web app export import
I (Intervention) : Teknologi laravel filament dimana ada penjual, pembeli, admin, owner
C (Comparison) = Masih menggunakan manual
O (Outcome) = Aplikasi web yang bisa penjualan form untuk penjual menghasilkan invoice, pembeli menerima invoice, admin dapat mentrack semua penjualan
S (Suspect) = Aplikasi mempermudah dalam perencanaan import export

terlampir file SLR dengan nama SLR.pdf
```

# BRD
```
terlampir file BRD berdasarkan SLR dengan nama file BRD.md
```

---

# IMPLEMENTASI DATABASE & MODELS

## 1. Start Docker Container
```bash
dcu
```

## 2. Membuat Model, Migration, Controller, Seeder, Filament Resource
```bash
# Membuat Category (model, migration, seeder, controller, filament resource)
dcm Category

# Membuat Product
dcm Product

# Membuat Customer
dcm Customer

# Membuat Sale
dcm Sale

# Membuat SaleItem
dcm SaleItem

# Membuat Invoice
dcm Invoice

# Membuat SaleStatusHistory
dcm SaleStatusHistory
```

## 3. Jalankan Migrate dan Seed
```bash
# Project init (migrate fresh + seed)
dci
```

---

# IMPLEMENTASI FILAMENT WIDGETS

## 4. Membuat Dashboard Widgets
```bash
# Membuat widget StatsOverview
dca make:filament-widget StatsOverview --stats-overview --panel=admin

# Membuat widget SalesChart
dca make:filament-widget SalesChart --chart --panel=admin

# Membuat widget LatestSales
dca make:filament-widget LatestSales --table --panel=admin

# Membuat widget LatestInvoices
dca make:filament-widget LatestInvoices --table --panel=admin
```

## 5. Generate Shield Permissions
```bash
dca shield:generate --all --panel=admin
dca shield:super-admin --user=1
```

---

# IMPLEMENTASI FRONTEND WEBSITE

## 6. Setup Struktur Views

```bash
cd src/resources/views

# Membuat folder layouts, pages, partials
mkdir layouts && mkdir pages && mkdir partials

# Membuat layout utama
cd layouts
touch layout.blade.php

# Membuat halaman pages
cd ../pages
touch app.blade.php
touch about.blade.php
touch services.blade.php
touch service-details.blade.php
touch pricing.blade.php
touch contact.blade.php
touch get-a-quote.blade.php

# Membuat partials
cd ../partials
touch about.blade.php
touch cta.blade.php
touch faq.blade.php
touch featured-services.blade.php
touch features.blade.php
touch footer.blade.php
touch header.blade.php
touch hero.blade.php
touch href.blade.php
touch pricing.blade.php
touch script.blade.php
touch services.blade.php
touch testimonials.blade.php

# Membuat folder untuk PDF template
cd ..
mkdir pdf
cd pdf
touch invoice.blade.php
```

---

# IMPLEMENTASI API

## 7. Membuat API Controllers

```bash
cd src/app/Http/Controllers

# Membuat folder Api
mkdir Api
cd Api

# Membuat controllers
touch ProductController.php
touch CategoryController.php
touch SaleController.php
touch DashboardController.php
```

---

# IMPLEMENTASI PDF INVOICE

## 8. Install PDF Package
```bash
# Masuk ke container dan install dompdf
dca tinker
# atau
docker-compose exec php composer require barryvdh/laravel-dompdf

# Membuat controller untuk PDF
dca make:controller InvoicePdfController
```

---

# MENJALANKAN APLIKASI

## 9. Fresh Migrate dengan Seed
```bash
# Project init (migrate fresh + seed)
dci

# Generate Shield permissions
dca shield:generate --all --panel=admin

# Assign super admin
dca shield:super-admin --user=1
```

## 10. Git Push
```bash
dcp "feat: complete implementation of export-import application"
```

---

# AKSES APLIKASI

## Frontend
| Halaman | URL |
|---------|-----|
| Home | http://uaspemweb.test/ |
| About | http://uaspemweb.test/about |
| Services | http://uaspemweb.test/services |
| Service Details | http://uaspemweb.test/service-details |
| Pricing | http://uaspemweb.test/pricing |
| Contact | http://uaspemweb.test/contact |
| Get a Quote | http://uaspemweb.test/get-a-quote |

## Admin Panel
| Halaman | URL |
|---------|-----|
| Login | http://uaspemweb.test/admin/login |
| Dashboard | http://uaspemweb.test/admin |

## API Endpoints
| Endpoint | URL |
|----------|-----|
| Products | http://uaspemweb.test/api/v1/products |
| Categories | http://uaspemweb.test/api/v1/categories |
| Sales | http://uaspemweb.test/api/v1/sales (auth) |
| Dashboard Stats | http://uaspemweb.test/api/v1/dashboard/stats (auth) |

---

# AKUN LOGIN

| Email | Password | Role |
|-------|----------|------|
| admin@admin.com | password | Super Admin |
| owner@eksporimpor.com | password | Owner |
| admin@eksporimpor.com | password | Admin |
| sales1@eksporimpor.com | password | Penjual |
| buyer@customer.com | password | Pembeli |

---

# TESTING API DENGAN POSTMAN

## 1. Import Collection
- File → Import → pilih `EkspImpor-API.postman_collection.json`

## 2. Generate Token untuk Authenticated Endpoints
```bash
dca tinker
```
Lalu di tinker:
```php
$user = \App\Models\User::find(1);
echo $user->createToken('postman')->plainTextToken;
```

## 3. Set Token di Postman
- Buka Collection → Variables
- Set `api_token` dengan token yang di-copy dari tinker
