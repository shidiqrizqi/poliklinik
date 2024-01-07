<!DOCTYPE html>
<html lang="en">
  <?php
    include('../conf/config_poliklinik.php');
  ?>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-1">
              <div class="col-sm-6">
                <h1>Jadwal Periksa</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Jadwal Periksa</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content-header">
        <div class="container-fluid">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
            Tambah Jadwal Periksa
          </button>
          <br></br>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Daftar Jadwal Periksa</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th>Nama Dokter</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no = 1;
                        $nama_dokter = $_SESSION['nama'];
                        $query = mysqli_query($koneksi,"SELECT jadwal_periksa.*, dokter.nama FROM jadwal_periksa 
                                                        LEFT JOIN dokter ON jadwal_periksa.id_dokter = dokter.id 
                                                        WHERE dokter.nama = '$nama_dokter'");
                        while($dok = mysqli_fetch_array($query)){
                          
                      ?>
                      <tr>
                        <td><?php echo $no++;?></td>
                        <td><?php echo $dok['nama'];?></td>
                        <td><?php echo $dok['hari'];?></td>
                        <td><?php echo $dok['jam_mulai'];?></td>
                        <td><?php echo $dok['jam_selesai']; ?></td>
                        <td>
                            <?php 
                                if ($dok['aktif'] == 'Y'){
                                    echo 'Aktif';
                                }
                                else if ($dok['aktif'] == 'N'){
                                    echo 'Tidak Aktif';
                                } 
                                else {
                                    echo 'Tidak ada jadwal';
                                } 
                            ?>
                        </td>
                        <td>
                          <a href="dokter.php?page=edit-jadwal-periksa&& id=<?php echo $dok['id']?>" class="btn btn-sm btn-success">Ubah</a>
                          <a onClick="hapus_jadwal_periksa(<?php echo $dok['id']?>)" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                      </tr>
                      <?php } ?>
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

      <!-- Tambah Jadwal Periksa -->
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Jadwal Periksa</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetData()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="dataJadwal" method="post" action="add/tambah_jadwal_periksa.php">
              <div class="modal-body">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- select -->
                      <div class="form-group">
                        <input type="hidden" name="hidden_nama" value="<?php echo $nama_dokter; ?>" hidden>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- select -->
                      <div class="form-group">
                        <label>Hari</label>
                        <select class="form-control" name="hari" required>
                            <option value="" selected disabled>Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputJamMulai">Jam Mulai</label>
                    <input type="time" class="form-control" id="exampleInputJamMulai" placeholder="Jam Mulai" name="jam_mulai" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputJamSelesai">Jam Selesai</label>
                    <input type="time" class="form-control" id="exampleInputJamSelesai" placeholder="Jam Selesai" name="jam_selesai" required>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- select -->
                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="" selected disabled>Pilih</option>
                            <option value="Y">Aktif</option>
                            <option value="N">Tidak Aktif</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="submit" class="btn btn-default" data-dismiss="modal" onclick="resetData()">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </div>  
            </form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </div>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <script>
      // Reset the form after submission
      function resetData() {
        document.getElementById("dataJadwal").reset();
      }

      function hapus_jadwal_periksa(data_id){
        Swal.fire({
          title: "Apakah yakin data ingin dihapus ?",
          showCancelButton: true,
          confirmButtonText: "Hapus Data",
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            window.location=("delete/hapus_jadwal_periksa.php?id="+data_id)
          }
        });
      }
    </script>
  </body>
</html>