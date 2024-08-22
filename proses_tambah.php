<?php
if ($_POST) {
    include_once("connection.php");

    // Ambil data dari form
    $id_paket_wisata = $_POST['nama_paket'];
    $nama_pemesan = $_POST['nama_pemesan'];
    $no_tlp = $_POST['no_tlp'];
    $tanggal_pemesanan = $_POST['tanggal_pemesanan']; // Menggunakan nama yang konsisten
    $jumlah_hari = $_POST['jumlah_hari'];
    $jumlah_peserta = $_POST['jumlah_peserta'];

    // Ambil data harga dari checkbox (nilai harga dari checkbox)
    $layanan_penginapan = isset($_POST['layanan_penginapan']) ? floatval($_POST['layanan_penginapan']) : 0;
    $layanan_transportasi = isset($_POST['layanan_transportasi']) ? floatval($_POST['layanan_transportasi']) : 0;
    $layanan_makan = isset($_POST['layanan_makan']) ? floatval($_POST['layanan_makan']) : 0;

    // Hitung total harga
    $harga_paket = $layanan_penginapan + $layanan_transportasi + $layanan_makan;
    $total_tagihan = $harga_paket * $jumlah_hari * $jumlah_peserta;

    // Query untuk menyimpan data
    $sql_insert = "INSERT INTO daftar_pesanan (id_paket_wisata, nama_pemesan, no_tlp, tanggal_pemesanan, jumlah_hari, jumlah_peserta, layanan_penginapan, layanan_transportasi, layanan_makan, harga_paket, total_tagihan)
                   VALUES ('$id_paket_wisata', '$nama_pemesan', '$no_tlp', '$tanggal_pemesanan', '$jumlah_hari', '$jumlah_peserta', '$layanan_penginapan', '$layanan_transportasi', '$layanan_makan', '$harga_paket', '$total_tagihan')";

    // Eksekusi query
    if (mysqli_query($conn, $sql_insert)) {
        echo "Pemesanan berhasil disimpan.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Tutup koneksi
    mysqli_close($conn);
}
?>
