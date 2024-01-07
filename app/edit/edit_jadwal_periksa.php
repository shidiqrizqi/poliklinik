<?php
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM jadwal_periksa WHERE id='$id'");
    $view = mysqli_fetch_array($query);
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Perbarui Jadwal Periksa</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method='get' action='update/update_jadwal_periksa.php'>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                            <label>Hari</label>
                            <select class="form-control" name="hari">
                                <option value="Senin" <?php echo $view['hari'] == 'Senin' ? 'selected' : ''; ?>>Senin</option>
                                <option value="Selasa" <?php echo $view['hari'] == 'Selasa' ? 'selected' : ''; ?>>Selasa</option>
                                <option value="Rabu" <?php echo $view['hari'] == 'Rabu' ? 'selected' : ''; ?>>Rabu</option>
                                <option value="Kamis" <?php echo $view['hari'] == 'Kamis' ? 'selected' : ''; ?>>Kamis</option>
                                <option value="Jumat" <?php echo $view['hari'] == 'Jumat' ? 'selected' : ''; ?>>Jumat</option>
                                <option value="Sabtu" <?php echo $view['hari'] == 'Sabtu' ? 'selected' : ''; ?>>Sabtu</option>
                            </select>
                            <input type="text" class="form-control" id="exampleInputHari" placeholder="Hari" name="id" value="<?php echo $view['id']; ?>" hidden>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputJamMulai">Jam Mulai</label>
                    <input type="time" class="form-control" id="exampleInputJamMulai" placeholder="Jam Mulai" name="jam_mulai" value="<?php echo $view['jam_mulai']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputJamSelesai">Jam Selesai</label>
                    <input type="time" class="form-control" id="exampleInputJamSelesai" placeholder="Jam Selesai" name="jam_selesai" value="<?php echo $view['jam_selesai']; ?>">
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="Y" <?php echo $view['aktif'] == 'Y' ? 'selected' : ''; ?>>Aktif</option>
                                <option value="N" <?php echo $view['aktif'] == 'N' ? 'selected' : ''; ?>>Tidak Aktif</option>
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