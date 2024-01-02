<?php
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM obat WHERE id='$id'");
    $view = mysqli_fetch_array($query);
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Perbarui Data Obat</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method='get' action='update/update_data_obat.php'>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputNamaObat">Nama Obat</label>
                    <input type="text" class="form-control" id="exampleInputNamaObat" placeholder="Nama Obat" name="nama_obat" value="<?php echo $view['nama_obat']; ?>">
                    <input type="text" class="form-control" id="exampleInputNamaObat" placeholder="Nama Obat" name="id" value="<?php echo $view['id']; ?>" hidden>
                </div>
                <div class="form-group">
                    <label for="exampleInputKemasan">Kemasan</label>
                    <input type="text" class="form-control" id="exampleInputKemasan" placeholder="Kemasan" name="kemasan" value="<?php echo $view['kemasan']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputHarga">Harga</label>
                    <input type="text" class="form-control" id="exampleInputHarga" placeholder="Harga" name="harga" value="<?php echo $view['harga']; ?>">
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