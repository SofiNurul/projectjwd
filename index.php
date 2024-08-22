<?php
include_once("connection.php");

$aktif_menu = "beranda";

include_once("header.php");
?>
        <div class="konten-pariwisata">
            <div class="info-container">
            <?php
            $sql = "SELECT * FROM paket_wisata";
            $results = mysqli_query($conn, $sql);
            while ($data_paket = mysqli_fetch_array($results)) {
                $path_gambar = "image/";
                $data_paket['img_paket'];
            ?>

        <div class="paket-container">
            <?php
            $path_gambar = "image/" . $data_paket['img_paket'];
            ?>
            <img src="<?php echo $path_gambar; ?>" alt="paket wisata bali">
            <h4><?php echo $data_paket['nama_paket']; ?></h4>
            <h3><?php echo $data_paket['deksripsi_paket']; ?></h3>
            <a href="form_pendaftaran.php?id_paket_wisata=<?php echo $data_paket['id_paket_wisata']; ?>">Daftar</a>
        </div> <!-- end paket-container-->
                
                <?php 
            }
                ?>
    
            </div> <!-- end info-container-->
    
            <div class="promosi-container">
                <div class="video-container">
                    <h3>Paket Wisata 1</h3>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/rCOqCwtorgM?si=0Y1rSn4pRyebAfBx" 
                    title="YouTube video player" 
                    frameborder="0" allow="accelerometer; 
                    autoplay; clipboard-write; encrypted-media; gyroscope; 
                    picture-in-picture; web-share" 
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                </iframe>
                </div> <!-- end video-container-->

                <div class="video-container">
                    <h3>Paket Wisata 2</h3>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/RaTWq98hzF0?si=99J_vE0_PN7lTK6o" 
                    title="YouTube video player" 
                    frameborder="0" allow="accelerometer; 
                    autoplay; clipboard-write; 
                    encrypted-media; gyroscope; 
                    picture-in-picture; web-share" 
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                </iframe>
                </div> <!-- end video-container-->

                <div class="video-container">
                    <h3>Paket Wisata 3</h3>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/1V_4-f5Ocy4?si=GiXEpyy-FjCORxCd" 
                    title="YouTube video player" 
                    frameborder="0" allow="accelerometer; 
                    autoplay; clipboard-write; encrypted-media; gyroscope; 
                    picture-in-picture; web-share" 
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                </iframe>
                </div> <!-- end video-container-->

                <div class="video-container">
                    <h3>Paket Wisata 4</h3>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/7xCd6ow9210?si=UfcCr9CQlKWZQFrO" 
                    title="YouTube video player" 
                    frameborder="0" allow="accelerometer; 
                    autoplay; clipboard-write; encrypted-media; gyroscope; 
                    picture-in-picture; web-share" 
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                </iframe>
                </div> <!-- end video-container-->
            </div> <!--end promosi-container-->
        </div> <!-- konten-pariwisata-->

        <?php include('form_pendaftaran.php'); ?>

    </div> <!--end main-container-->
</body>
</html>



