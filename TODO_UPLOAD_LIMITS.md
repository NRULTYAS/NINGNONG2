# TODO - Upload limit fixes

## Completed
- [x] Upload limit foto paket catering: dinaikkan di `application/controllers/Admin/Catering.php` (tambah & edit)

## Pending
- [ ] Upload limit foto produk: naikkan di `application/controllers/Admin/Produk.php` (tambah & edit)
  - `max_size` : 10240
  - `max_width` : 4000
  - `max_height`: 4000

## Notes
Tool `edit_file` sulit untuk replace parsial karena string yang sama muncul lebih dari satu lokasi di file.
Solusi: rewrite full file `application/controllers/Admin/Produk.php` atau ganti via blok yang unik.
