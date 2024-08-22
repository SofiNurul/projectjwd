<?php
include_once("connection.php");

$aktif_menu = "form_pendaftaran";

include_once("header.php");

function selectedPaketWisata($val1, $val2){
    return $val1 == $val2 ? "selected" : "";
}

$harga_penginapan = $harga_transportasi = $harga_makan = 0; // Default values

// Cek apakah id_paket_wisata ada di query string
$id_paket_wisata = isset($_GET['id_paket_wisata']) ? intval($_GET['id_paket_wisata']) : 0;

if ($id_paket_wisata > 0) {
    $sql_selected_paket = "SELECT * FROM paket_wisata WHERE id_paket_wisata = $id_paket_wisata";
    $selected_paket = mysqli_query($conn, $sql_selected_paket);
    if ($row = mysqli_fetch_array($selected_paket)) {
        $kode_paket_wisata = $row['id_paket_wisata'];
        $nama_paket = $row['nama_paket'];
        $harga_penginapan = $row['harga_penginapan'];
        $harga_transportasi = $row['harga_transportasi'];
        $harga_makan = $row['harga_servis_makan'];
    }
}
?>

<div class="form-container">
    <h2>Form Pemesanan Paket Wisata</h2>
    <form action="proses_tambah.php" method="post">
        <label for="nama_paket">Nama Paket</label>
        <select name="nama_paket" id="nama_paket" required>
            <option value="">Pilih Paket Wisata</option>
            <?php
            $sql = "SELECT * FROM paket_wisata";
            $results = mysqli_query($conn, $sql);
            while ($data_paket = mysqli_fetch_array($results)) {
            ?>
                <option value="<?php echo $data_paket['id_paket_wisata']; ?>" 
                    <?php echo isset($nama_paket) ? selectedPaketWisata($data_paket['id_paket_wisata'], $id_paket_wisata) : ''; ?>>
                    <?php echo $data_paket['nama_paket']; ?>
                </option>
            <?php
            }
            ?>
        </select>

        <label for="nama_pemesan">Nama Pemesan</label>
        <input type="text" name="nama_pemesan" id="nama_pemesan" required />

        <label for="no_tlp">Tlp/Hp</label>
        <input type="text" name="no_tlp" id="no_tlp" required />

        <label for="tgl_pesan">Tanggal Pemesanan</label>
        <input type="date" name="tgl_pesan" id="tgl_pesan" required />

        <label for="jumlah_hari">Waktu Pelaksanaan Perjalanan</label>
        <input type="number" name="jumlah_hari" id="jumlah_hari" value="1" min="1" required />

        <label for="">Pelayanan Paket Perjalanan</label>
        
        <div class="layanan-container">
            <div class="item-layanan">
                <label for="layanan_penginapan">Penginapan (Rp <?php echo number_format($harga_penginapan, 0, ',', '.'); ?>)</label>
                <input type="checkbox" name="layanan_penginapan" id="layanan_penginapan"
                value="<?php echo $harga_penginapan;?>" />
            </div>
            <div class="item-layanan">
                <label for="layanan_transportasi">Transportasi (Rp <?php echo number_format($harga_transportasi, 0, ',', '.'); ?>)</label>
                <input type="checkbox" name="layanan_transportasi" id="layanan_transportasi"
                value="<?php echo $harga_transportasi;?>" />
            </div>
            <div class="item-layanan">
                <label for="layanan_makan">Service Makan (Rp <?php echo number_format($harga_makan, 0, ',', '.'); ?>)</label>
                <input type="checkbox" name="layanan_makan" id="layanan_makan"
                value="<?php echo $harga_makan;?>" />
            </div>
        </div>

        <label for="jumlah_peserta">Jumlah Peserta</label>
        <input type="number" name="jumlah_peserta" id="jumlah_peserta" value="1" min="1" required />

        <label for="harga_paket">Harga Paket Perjalanan</label>
        <input type="text" name="harga_paket" id="harga_paket" readonly />

        <label for="jumlah_tagihan">Jumlah Tagihan</label>
        <input type="text" name="jumlah_tagihan" id="jumlah_tagihan" readonly />

        <div class="btn-container">
            <input type="submit" value="Simpan">
            <button type="button" id="btn-hitung">Hitung</button>
            <button type="reset" id="btn-reset">Reset</button>
        </div>
    </form>
</div> <!-- end form-container -->

<div class="footer">
    <h3>Sofi Nurul Afifa (JWD F) - Pelatihan VSGA JWD 2024</h3>
</div> <!-- end footer -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" 
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
  $("#nama_paket").on('change', function(){
    var idPaket = $(this).val();
    if(idPaket){
        window.location.href = 'form_pendaftaran.php?id_paket_wisata=' + idPaket;
    }
  });

  $("#btn-hitung").on('click', function(event){
    event.preventDefault();

    // Mengecek apakah setidaknya satu checkbox dicentang
    var isChecked = $("#layanan_penginapan").is(':checked') ||
                    $("#layanan_transportasi").is(':checked') ||
                    $("#layanan_makan").is(':checked');

    if (!isChecked) {
        alert("Silakan pilih setidaknya satu layanan.");
        return;
    }

    // Mengambil nilai dari input jumlah_hari dan jumlah_peserta
    var jumlahHari = parseFloat($("#jumlah_hari").val());
    var jumlahPeserta = parseFloat($("#jumlah_peserta").val());

    // Validasi jumlah_hari dan jumlah_peserta minimal 1
    if (isNaN(jumlahHari) || jumlahHari < 1) {
        alert("Jumlah hari harus minimal 1.");
        return;
    }

    if (isNaN(jumlahPeserta) || jumlahPeserta < 1) {
        alert("Jumlah peserta harus minimal 1.");
        return;
    }

    // Menghitung harga paket perjalanan berdasarkan checkbox yang dicentang
    var hargaPaket = 0;
    var hargaPenginapan = parseFloat($("#layanan_penginapan").val()) || 0;
    var hargaTransportasi = parseFloat($("#layanan_transportasi").val()) || 0;
    var hargaMakan = parseFloat($("#layanan_makan").val()) || 0;

    if ($("#layanan_penginapan").is(':checked')) {
        hargaPaket += hargaPenginapan;
    }
    if ($("#layanan_transportasi").is(':checked')) {
        hargaPaket += hargaTransportasi;
    }
    if ($("#layanan_makan").is(':checked')) {
        hargaPaket += hargaMakan;
    }

    // Menghitung total tagihan dengan jumlah hari dan jumlah peserta
    var totalTagihan = hargaPaket * jumlahHari * jumlahPeserta;

    // Menampilkan harga paket perjalanan dan total tagihan
    $("#harga_paket").val(hargaPaket.toLocaleString('id-ID', { minimumFractionDigits: 0 }));
    $("#jumlah_tagihan").val(totalTagihan.toLocaleString('id-ID', { minimumFractionDigits: 0 }));

    // Menampilkan alert dengan total harga
    alert("Harga Paket Perjalanan: Rp " + hargaPaket.toLocaleString('id-ID', { minimumFractionDigits: 0 }) + 
          "\nTotal Tagihan: Rp " + totalTagihan.toLocaleString('id-ID', { minimumFractionDigits: 0 }));
  });

  $("#btn-reset").on('click', function(){
    // Reset nilai input harga_paket dan jumlah_tagihan
    $("#harga_paket").val('');
    $("#jumlah_tagihan").val('');
    
    // Uncheck all checkboxes
    $("#layanan_penginapan").prop('checked', false);
    $("#layanan_transportasi").prop('checked', false);
    $("#layanan_makan").prop('checked', false);
  });
});
</script>
