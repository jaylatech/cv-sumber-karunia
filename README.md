# Web Penjualan

## Persyaratan
- PHP >= 7.4.24
- Composer Versi 2
- VSCode

## CATATAN
- Sebelum melakukan instalasi projek, pastikan git terminal telah dikonfigurasi dengan username github
- Caranya :
  - Buat akun github di halaman https://www.github.com ( jika sudah punya lanjut no 2 )
  - Buka terminal Git Bash dan setup email dan username github
    - Setup username
      ```bash
        git config user.name "username github"
      ```
    - Setup username
      ```bash
        git config user.email "emailanda@gmail.com"

## Instalasi
1. Buka terminal dan clone projek ini dari github

```bash
git clone https://github.com/jaylatech/cv-sumber-karunia.git
```

2. Arahkan lokasi terminal ke lokasi projek yang sudah di clone
```bash
cd pa-riva
```

3. Buka Visual Studio Code
```bash
code .
```

4. Ganti nama file .env.example menjadi .env
```bash
.env.example (sebelum)
.env (sesudah)
```

5. Nyalakan XAMPP dan buat database baru (nama database bebas)

6. Sesuaikan nama database yang telah dibuat pada file .env
```bash
DB_CONNECTION=mysql         (default)
DB_HOST=127.0.0.1           (default)
DB_PORT=3306                (default)
DB_DATABASE=penjualan_db    (rubah sesuai dengan db yang telah dibuat)
DB_USERNAME=root            (default)
DB_PASSWORD=                (default)
```

7. Instal depedency laravel dan lainnya
```bash
composer install
```

8. Buat Key projek baru
```bash
php artisan key:generate
```

9.  Lakukan migrate database beserta data dummynya
```bash
php artisan migrate:fresh --seed
```

10. Instal depedency javascript
```bash
npm install
```

11. Jalankan server laravel
```bash
php artisan serve
```

12. Buka terminal baru, untuk compile asset Frontend
```bash
npm run watch
```

13. Buka browser localhost:8000 dan masuk sebagai admin
```bash
email: admin@gmail.com
password: 11111111
```