<!DOCTYPE html>
<html lang="en">
<?php
    include('../conf/config_poliklinik.php');

    $nama_dokter = $_SESSION['nama'];
?>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-1">
              <div class="col-sm-6">
                <h1>Daftar Periksa Pasien</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dokter.php">Home</a></li>
                  <li class="breadcrumb-item active">Daftar Periksa Pasien</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <div class="card">
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>No Urut</th>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = mysqli_query($koneksi, "SELECT pasien.nama, daftar_poli.keluhan, daftar_poli.status_periksa, daftar_poli.id, daftar_poli.no_antrian 
                                                            FROM daftar_poli 
                                                            INNER JOIN pasien ON daftar_poli.id_pasien = pasien.id 
                                                            INNER JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id 
                                                            INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id 
                                                            WHERE dokter.nama = '$nama_dokter'
                                                            ORDER BY daftar_poli.no_antrian ASC");
                            if ($query) {
                            while ($dok = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?php echo $dok['no_antrian']; ?></td>
                            <td><?php echo $dok['nama']; ?></td>
                            <td><?php echo $dok['keluhan']; ?></td>
                            <td>
                                <?php if ($dok['status_periksa'] == 1) {
                                ?>
                                    <button type='button' class='btn btn-sm btn-warning edit-btn' data-toggle="modal" data-target="#editModal<?php echo $dok['id'] ?>">Edit</button>
                                    <div class="modal fade" id="editModal<?php echo $dok['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addModalLabel">Perbarui Periksa Pasien</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                        $idDaftarPoli = $dok['id'];
                                                        require '../conf/config_poliklinik.php';
                                                        $ambilDataPeriksa = mysqli_query($koneksi, "SELECT * FROM periksa INNER JOIN daftar_poli ON periksa.id_daftar_poli = daftar_poli.id WHERE daftar_poli.id = '$idDaftarPoli'");
                                                        $ambilData = mysqli_fetch_assoc($ambilDataPeriksa);
                                                    ?>
                                                    <form action="periksaPasien/edit_periksa_pasien.php" method="post">
                                                        <input type="hidden" name="id" value="<?php echo $dok['id'] ?>">
                                                        <div class="form-group">
                                                            <label for="nama">Nama Pasien</label>
                                                            <input type="text" class="form-control" id="nama" name="nama" required value="<?php echo $dok['nama'] ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tanggal_periksa">Tanggal Periksa</label>
                                                            <input type="datetime-local" class="form-control" id="tanggal_periksa" name="tanggal_periksa" required value="<?php echo $ambilData['tgl_periksa'] ?>">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="catatan">Catatan</label>
                                                            <textarea class="form-control" rows="3" id="catatan" name="catatan" required><?php echo $ambilData['catatan'] ?></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php  } else { ?>
                                    <button type='button' class='btn btn-sm btn-primary edit-btn' data-toggle="modal" data-target="#periksaModal<?php echo $dok['id'] ?>">Periksa</button>
                                    <div class="modal fade" id="periksaModal<?php echo $dok['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addModalLabel">Periksa Pasien</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetData()>
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="dataPeriksa" action="periksaPasien/periksa_pasien.php" method="post">
                                                        <input type="hidden" name="id" value="<?php echo $dok['id'] ?>">
                                                        <div class="form-group">
                                                            <label for="nama">Nama Pasien</label>
                                                            <input type="text" class="form-control" id="nama" name="nama" required value="<?php echo $dok['nama'] ?>" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tanggal_periksa">Tanggal Periksa</label>
                                                            <input type="datetime-local" class="form-control" id="tanggal_periksa" name="tanggal_periksa" required>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="catatan">Catatan</label>
                                                            <textarea class="form-control" rows="3" id="catatan" name="catatan" required></textarea>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label>Obat</label>
                                                            <select class="select2" multiple="multiple" data-placeholder="Pilih Obat" style="width: 100%;" name="obat[]">
                                                                <?php
                                                                require '../conf/config_poliklinik.php';
                                                                $getObat = "SELECT * FROM obat";
                                                                $queryObat = mysqli_query($koneksi, $getObat);
                                                                while ($doks = mysqli_fetch_assoc($queryObat)) {
                                                                ?>
                                                                    <option value="<?php echo $doks['id'] ?>">
                                                                        <?php echo $doks['nama_obat'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Periksa</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </td>
                        </tr>
                      <?php
                          }
                        } else {
                          // Handle query error
                          echo "Error: " . mysqli_error($koneksi);
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
        </div>
      </section>
      <!-- /.content -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script>
      function resetData() {
          document.getElementById("dataPeriksa").reset();
      }
    </script>
  </body>
</html>