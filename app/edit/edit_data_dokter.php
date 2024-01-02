<?php
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT dokter.*, poli.nama_poli FROM dokter LEFT JOIN poli ON dokter.id_poli = poli.id WHERE dokter.id='$id'");
    $view = mysqli_fetch_array($query);
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Perbarui Data Dokter</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method='get' action='update/update_data_dokter.php'>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputNamaDokter">Nama Dokter</label>
                    <input type="text" class="form-control" id="exampleInputNamaDokter" placeholder="Nama Dokter" name="nama" value="<?php echo $view['nama']; ?>">
                    <input type="text" class="form-control" id="exampleInputNamaDokter" placeholder="Nama Dokter" name="id" value="<?php echo $view['id']; ?>" hidden>
                </div>
                <div class="form-group">
                    <label for="exampleInputAlamat">Alamat</label>
                    <input type="text" class="form-control" id="exampleInputAlamat" placeholder="Alamat" name="alamat" value="<?php echo $view['alamat']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputNoHp">Nomor Hp</label>
                    <input type="text" class="form-control" id="exampleInputNoHp" placeholder="Nomor Hp" name="no_hp" value="<?php echo $view['no_hp']; ?>">
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                            <label>Poli</label>
                            <select class="form-control" name="nama_poli">
                                <!-- <option value="<?php //echo $view['id']; ?>" selected><?php //echo $view['nama_poli']; ?></option> -->
                                <?php
                                    echo '<option value="'.$view['id_poli'].'" selected>'.htmlentities($view['nama_poli']).'</option>';
                                    $query = mysqli_query($koneksi,"SELECT id, nama_poli FROM poli");
                                    while($dok = mysqli_fetch_array($query)){
                                        echo '<option value="'.$dok['id'].'">'.htmlentities($dok['nama_poli']).'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</section>