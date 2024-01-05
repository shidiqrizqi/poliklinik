<?php
    $url = $_SERVER['REQUEST_URI'];
    $url = explode("=", $url);
    $id_poli = $url[count($url)-1];
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Riwayat Poli</h3>
            </div>
            <!-- /.card-header -->
            
            <div class="card-body">
                <?php 
                    $query = mysqli_query($koneksi,"SELECT daftar_poli.id, daftar_poli.no_antrian, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai, dokter.nama, poli.nama_poli 
                                                    FROM daftar_poli 
                                                    LEFT JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id
                                                    LEFT JOIN dokter ON jadwal_periksa.id_dokter = dokter.id
                                                    LEFT JOIN poli ON dokter.id_poli = poli.id
                                                    WHERE daftar_poli.id = $id_poli");
                    while ($dok = mysqli_fetch_array($query)) {
                ?>
                <center>
                    <h5>Nama Poli</h5>
                    <?php echo $dok['nama_poli'];?>
                    <hr>

                    <h5>Nama Dokter</h5>
                    <?php echo $dok['nama'];?>
                    <hr>

                    <h5>Hari</h5>
                    <?php echo $dok['hari'];?>
                    <hr>

                    <h5>Mulai</h5>
                    <?php echo $dok['jam_mulai'];?>
                    <hr>

                    <h5>Selesai</h5>
                    <?php echo $dok['jam_selesai'];?>
                    <hr>

                    <h5>Nomor Antrian</h5>
                    <button class="btn btn-success"><?php echo $dok['no_antrian'];?></button>
                    <hr>
                </center>
                <?php } ?>

                <a href="pasien.php?page=data-poli" class="btn btn-primary btn-block">Kembali</a>
            </div>
        </div>
    </div>
</section>