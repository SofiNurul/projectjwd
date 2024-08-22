<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <title>Wonderfull Indonesia</title>
</head>
<body>
    <?php
        function renderAktifMenu($val1, $val2){
            $result = "";
            if($val1 == $val2){
                $result = "active-menu";
            }
            return $result;
        }
    ?>
    <div class="main-container">
        <div class="img-header">
            <div class="brand-container">
                <h1>Selamat Datang</h1>
                <h2>Di Keindahan Alam Indonesia</h2>

                <img src="image/logo_wonderfull.png" alt="">
            </div> <!-- end brand-container-->
            <img src="image/wonderful1.jpg" alt="candi">
            <img src="image/wonderful2.jpg" alt="sawah">
            <img src="image/wonderful3.jpg" alt="komodo">
            <img src="image/wonderful4.jpg" alt="raja ampat">
            <img src="image/wonderful5.jpg" alt="pulau">
            <img src="image/wonderful6.jpg" alt="borobudur">
            <img src="image/wonderful12.jpg" alt="gunung bromo">
            <img src="image/wonderful7.jpg" alt="rumah adat">
            <img src="image/wonderful13.jpg" alt="prambanan">
            <img src="image/wonderful10.jpg" alt="bali">

        </div> <!-- end img-header-->
        <div class="menu-header">
            <a class="<?php echo renderAktifMenu($aktif_menu, "beranda"); ?>" href="index.php">Beranda</a>
            <a class="<?php echo renderAktifMenu($aktif_menu, "form_pendaftaran"); ?>" href="form_pendaftaran.php" target="_blank">Daftar Paket Wisata</a>
            <a class="<?php echo renderAktifMenu($aktif_menu, "list_pendaftaran"); ?>" href="list_pendaftaran.php" target="_blank">Modifikasi pesanan</a>
            
        </div> <!-- end menu-header-->
