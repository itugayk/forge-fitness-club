# 🏋️ Forge Fitness Club

**Premium fitness / spor salonu** web sitesi — ders programı, üyelik başvurusu, ders
rezervasyonu ve tam donanımlı yönetim paneli.

> **Marka:** Forge Fitness Club · **Slogan:** _Kendini Dövüştür. Daha Güçlü Çık._
> **Demo:** [fitness.demo.dijifa.com](https://fitness.demo.dijifa.com)

Laravel 12 · Filament 3 · Livewire 3 · Tailwind CSS v4 · Alpine.js · MySQL

---

## ✨ Özellikler

### Public Site (dinamik, koyu & enerjik tasarım)
- **Ana Sayfa** — video/görsel hero, hizmet kartları, fiyat tablosu (aylık/3 aylık/yıllık geçişli),
  eğitmenler, galeri, üye yorumları, animasyonlu sayaçlar, blog önizleme.
- **Ders Programı** — Livewire ile **reaktif haftalık takvim** (gün × saat). Derse tıkla → detay
  modalı (eğitmen, kontenjan, seviye, salon) → **"Yerini Ayır"** ile rezervasyon, kontenjan anında düşer.
- **Hizmetler & Üyelik** — hizmet detayları + fiyatlandırma.
- **Eğitmenler** — kadro listesi + eğitmen profil sayfaları (bio, sertifika, ders programı).
- **Galeri** — kategoriye göre filtrelenebilir (Alpine).
- **Blog** — yazı listesi + detay sayfaları.
- **Üye Ol** — paket + periyot seçimi (reaktif özet/fiyat) → başvuru kaydı.
- **İletişim** — form + harita + iletişim bilgileri.

### Yönetim Paneli (`/admin` · Filament 3, Türkçe)
- **Dashboard** — istatistik kartları, gün bazlı rezervasyon grafiği, son başvurular tablosu.
- **Ders Programı** CRUD (gün, saat, kategori, eğitmen, kontenjan, seviye, salon) + filtreler.
- **Ders Kategorileri** (renk kodlu), **Eğitmenler**, **Hizmetler**, **Üyelik Paketleri**.
- **Ders Rezervasyonları** & **Üyelik Başvuruları** yönetimi (durum takibi, badge'ler).
- **Blog**, **Galeri**, **Üye Yorumları** içerik yönetimi.
- **İletişim Mesajları** (okundu/okunmadı).

### SEO
- JSON-LD: `ExerciseGym` / `SportsActivityLocation` / `HealthClub` (adres, koordinat, çalışma saatleri).
- Open Graph + Twitter meta etiketleri, anlamlı başlık/açıklamalar.

---

## 🚀 Docker ile Çalıştırma (önerilen)

```bash
docker compose up -d --build
```

- İlk açılışta migrasyon + seed otomatik çalışır (MySQL hazır olunca).
- `app` servisi port **80**'i `expose` eder; **Coolify/Traefik** gibi bir ters proxy
  arkasında domain ile yayınlanır. Saf yerel erişim için compose'a
  `ports: ["8080:80"]` ekleyip `http://localhost:8080` üzerinden açabilirsiniz.

Servisler: `app` (nginx + php-fpm + supervisor) ve `mysql` (8.0).

**Coolify ile deploy:** repoyu bir Coolify uygulaması olarak ekleyin
(Build Pack = **Docker Compose**, compose yolu `/docker-compose.yml`). Coolify
imajı kurar, app + MySQL'i ayağa kaldırır, proxy + SSL'i yönetir.

---

## 🛠️ Yerel Geliştirme (PHP + SQLite)

```bash
composer install
npm install
cp .env.example .env        # yerelde DB_CONNECTION=sqlite kullanılır
php artisan key:generate
php artisan migrate --seed
npm run build               # veya: npm run dev
php artisan serve
```

`http://localhost:8000` adresinde açılır.

---

## 🔑 Yönetici Girişi (seed)

| E-posta                     | Şifre      |
|-----------------------------|------------|
| `admin@forgefitness.com`    | `password` |

---

## 🌱 Seed İçeriği

- 8 ders kategorisi (CrossFit, HIIT, Yoga, Pilates, Spinning, Fonksiyonel, Kickbox, Kuvvet)
- 8 eğitmen, 6 hizmet, 4 üyelik paketi
- **42 derslik dolu haftalık program** + gerçekçi doluluk oranlarıyla 500+ rezervasyon
- 6 blog yazısı, 6 üye yorumu, 12 galeri görseli
- Örnek üyelik başvuruları, ders rezervasyonları ve iletişim mesajları

Tüm seeder'lar **idempotent**'tir (tekrar çalıştırma güvenli).

---

## 🧱 Mimari Notlar

- **Marka/iletişim ayarları:** `config/forge.php`
- **Görsel URL çözümleme:** `App\Support\Media` (seed'de Unsplash URL'leri, admin yüklemelerinde `public` disk)
- **Livewire bileşenleri:** `app/Livewire/` — `Timetable`, `MembershipForm`, `ContactForm`
- **Filament kaynakları:** `app/Filament/Resources/`, widget'lar `app/Filament/Widgets/`
- **Tema:** `resources/css/app.css` — `ink` (koyu) + `volt` (#c5ff3d) + `flame` (#ff5e1a), Anton/Bebas + Inter

---

_Bu bir portfolyo/demo projesidir. Üyelik başvuruları ve rezervasyonlar gerçek ödeme içermez._
