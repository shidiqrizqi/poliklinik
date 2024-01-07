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
                <h1>Riwayat Pasien</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dokter.php">Home</a></li>
                  <li class="breadcrumb-item active">Riwayat Pasien</li>
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
                <div class="card-header">
                  <h3 class="card-title">Daftar Riwayat Pasien</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Alamat</th>
                        <th>No. KTP</th>
                        <th>No. Hp</th>
                        <th>No. RM</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no = 1;
                      $query = "SELECT daftar_poli.status_periksa, pasien.id, pasien.nama as nama_pasien, pasien.alamat, pasien.no_ktp, pasien.no_hp, pasien.no_rm 
                                FROM daftar_poli 
                                INNER JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id 
                                INNER JOIN pasien ON daftar_poli.id_pasien = pasien.id 
                                INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id 
                                WHERE dokter.nama = '$nama_dokter' AND status_periksa = '1' 
                                GROUP BY pasien.id;";
                      $result = mysqli_query($koneksi, $query);

                      while ($data = mysqli_fetch_assoc($result)) {

                      ?>
                        <tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $data['nama_pasien']; ?></td>
                          <td><?php echo $data['alamat']; ?></td>
                          <td><?php echo $data['no_ktp']; ?></td>
                          <td><?php echo $data['no_hp']; ?></td>
                          <td><?php echo $data['no_rm']; ?></td>
                          <td>
                            <button type='button' class='btn btn-sm btn-primary edit-btn' data-toggle="modal" data-target="#detailModal<?php echo $data['id'] ?>">
                              Detail Riwayat Periksa
                            </button>

                            <div class="modal fade" id="detailModal<?php echo $data['id'] ?>">
                              <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Riwayat <?php echo $data['nama_pasien'] ?></h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                          <thead>
                                            <tr>
                                              <td>No</td>
                                              <td>Tanggal Periksa</td>
                                              <td>Nama Pasien</td>
                                              <td>Nama Dokter</td>
                                              <td>Keluhan</td>
                                              <td>Obat</td>
                                              <td>Biaya</td>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                            $id_pasien = $data['id'];
                                            $no = 1;
                                            $ambilData = "SELECT detail_periksa.id as id_detailPeriksa, periksa.tgl_periksa, pasien.nama as nama_pasien, dokter.nama as nama_dokter, daftar_poli.keluhan, periksa.catatan, GROUP_CONCAT(obat.nama_obat) as nama_obat, SUM(obat.harga) + periksa.biaya_periksa as harga_obat 
                                                          FROM detail_periksa 
                                                          INNER JOIN periksa ON detail_periksa.id_periksa = periksa.id 
                                                          INNER JOIN daftar_poli ON periksa.id_daftar_poli = daftar_poli.id 
                                                          INNER JOIN pasien ON daftar_poli.id_pasien = pasien.id 
                                                          INNER JOIN obat ON detail_periksa.id_obat = obat.id 
                                                          INNER JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id 
                                                          INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id  
                                                          WHERE dokter.nama = '$nama_dokter' AND pasien.id = '$id_pasien' 
                                                          GROUP BY pasien.id, periksa.tgl_periksa";

                                            $results = mysqli_query($koneksi, $ambilData);
                                            while ($datas = mysqli_fetch_assoc($results)) {

                                            ?>
                                            <tr>
                                              <td><?php echo $no++; ?></td>
                                              <td><?php echo $datas['tgl_periksa'] ?></td>
                                              <td><?php echo $datas['nama_pasien'] ?></td>
                                              <td><?php echo $datas['nama_dokter'] ?></td>
                                              <td style="white-space: pre-line;"><?php echo $datas['keluhan'] ?></td>
                                              <td style="white-space: pre-line;"><?php echo $datas['nama_obat'] ?></td>
                                              <td><?php echo $datas['harga_obat'] ?></td>
                                            </tr>
                                            <?php } ?>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                    <div class="modal-footer justify-content-end">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                  <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
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

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
  </body>
</html>