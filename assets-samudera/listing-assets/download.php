<?php
$file_path = 'pdf/berita_acara.pdf'; // Ganti dengan path file yang ingin diunduh
$file_name = basename($file_path); // Mengambil nama berkas dari path

// Pastikan tipe konten yang benar agar browser tahu jenis berkas yang diunduh
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$file_name\"");

// Baca dan keluarkan isi berkas ke output
readfile($file_path);
