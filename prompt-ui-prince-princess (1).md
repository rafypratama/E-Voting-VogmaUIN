# Prompt: Redesign UI Aplikasi Pemilihan Prince & Princess (Tema Terang + Animasi)

Ubah keseluruhan UI aplikasi pemilihan Prince & Princess ini — termasuk **halaman admin** — agar terlihat **cerah, elegan, dan berkesan royal** dengan dominasi warna terang dan animasi yang memperindah pengalaman. Jauh dari tampilan generik AI.

---

## Palet Warna (Terang & Mewah)

- **Background utama**: putih bersih atau cream lembut (`#FFFDF5`, `#FFF8EE`)
- **Aksen utama**: gold/amber cerah (`#F5C518`, `#FFD700`) atau rose gold (`#E8A598`)
- **Warna pendukung**: lavender muda, blush pink, atau sky blue pastel
- **Teks**: dark charcoal (`#1A1A2E`) agar kontras dan mudah dibaca
- **Hindari**: abu-abu gelap, hitam pekat, atau background gelap sebagai dominan

---

## Halaman Utama / Voting

1. **Background** — Putih atau cream dengan subtle pattern ornamen kerajaan (damask, floral, atau bintang tipis).
2. **Gradien** — Gunakan gradien lembut terang seperti putih ke light gold, atau pink pastel ke white.
3. **Aksen Dekoratif** — Ornamen mahkota, bintang, atau motif kerajaan pada header dan card kandidat.
4. **Card Kandidat** — Background putih bersih dengan border gold tipis, shadow lembut keemasan, foto terpampang elegan.
5. **Tombol Voting** — Gold cerah atau rose gold dengan teks putih, efek shimmer saat hover.

---

## Halaman Admin

1. **Warna** — Tetap terang namun lebih **bersih dan profesional**: background putih/off-white, sidebar light gold atau cream dengan aksen gold.
2. **Sidebar/Navbar Admin** — Warna terang premium (cream atau light champagne), highlight gold untuk menu aktif, ikon elegan.
3. **Tabel & Data** — Tabel bersih dengan row alternating cream/putih, header dengan warna gold muda, hover effect subtle.
4. **Tombol Aksi** — Gold untuk aksi utama, merah muda elegan untuk hapus, biru muda untuk edit.
5. **Dashboard** — Chart dan statistik dengan warna cerah dan harmonis, terasa segar dan informatif.

---

## Animasi (Wajib Diterapkan)

### Page Load / Masuk Halaman
- **Fade-in + slide up** pada seluruh elemen saat halaman pertama kali dibuka:
  ```css
  @keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  ```
- Terapkan dengan `animation-delay` bertahap (staggered) agar elemen muncul satu per satu secara elegan — header dulu, lalu card kandidat, lalu tombol.

### Card Kandidat
- **Hover lift**: card terangkat sedikit saat di-hover dengan transisi halus:
  ```css
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  transform: translateY(-6px);
  box-shadow: 0 12px 32px rgba(212, 160, 23, 0.18);
  ```
- **Shimmer effect** pada border gold saat hover (animasi kilau berjalan dari kiri ke kanan).

### Tombol Voting
- **Shimmer/glint** berjalan dari kiri ke kanan saat hover:
  ```css
  @keyframes shimmer {
    0%   { background-position: -200% center; }
    100% { background-position: 200% center; }
  }
  background: linear-gradient(90deg, #f5c518 25%, #fff8c0 50%, #f5c518 75%);
  background-size: 200%;
  animation: shimmer 1.5s infinite;
  ```
- **Pulse ring** saat tombol voting berhasil diklik (ripple effect emas melebar lalu menghilang).

### Header & Mahkota
- **Floating** lembut pada ikon mahkota di header:
  ```css
  @keyframes floatCrown {
    0%, 100% { transform: translateY(0px); }
    50%       { transform: translateY(-6px); }
  }
  animation: floatCrown 3s ease-in-out infinite;
  ```
- **Sparkle/bintang** kecil berkedip-kedip di sekitar area header secara acak.

### Vote Bar / Progress Bar
- Animasi **fill dari kiri ke kanan** saat halaman dimuat:
  ```css
  @keyframes fillBar {
    from { width: 0%; }
    to   { width: var(--target-width); }
  }
  animation: fillBar 1.2s ease-out forwards;
  ```

### Halaman Admin
- **Row tabel** muncul satu per satu (staggered fade-in) saat halaman admin dibuka.
- **Stat card** angka naik secara animasi (count-up) dari 0 ke nilai asli saat pertama ditampilkan.
- **Sidebar menu** aktif memiliki animasi highlight geser (sliding indicator) saat berpindah menu.
- Hover pada baris tabel: background berubah warna dengan transisi smooth `0.2s ease`.

### Transisi Halaman
- Gunakan **fade transition** halus saat berpindah antar halaman (misal dari halaman voting ke admin).

---

## Kesan Keseluruhan

- Halaman publik: **cerah, glamor, mewah — seperti undangan gala penobatan yang elegan**
- Halaman admin: **terang, bersih, profesional — tetap dalam tema royal**
- Animasi: **halus, tidak berlebihan** — mempercantik tanpa mengganggu pengalaman pengguna
- Konsisten di semua halaman — font, warna, spacing, animasi, dan komponen harus selaras.
- Tampilan akhir harus memberi kesan **glamor, mewah, dan berkesan** — seperti gala malam penobatan, bukan halaman web biasa.

> Terapkan semua perubahan langsung ke kode secara menyeluruh. Pastikan semua elemen menggunakan tema **terang** dan animasi **tidak memperlambat performa halaman** (gunakan `will-change: transform` dan `transform` daripada `top/left` untuk animasi yang smooth).
