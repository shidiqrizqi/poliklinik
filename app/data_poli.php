<?php
  include('../conf/config_poliklinik.php');

  $no_rm = '';
  $nama = $_SESSION['nama'];

  $query = "SELECT no_rm FROM pasien WHERE nama = ?";
  $stmt = $koneksi->prepare($query);
  $stmt->bind_param("s", $nama);
  $stmt->execute();
  $result = $stmt->get_result();

  if (!$result) {
      die("Query error: " . $koneksi->error);
  }

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $no_rm = $row['no_rm'];
  }

  $stmt->close();
?>

<?php 
    // Check if the success message is set
    if (isset($_SESSION['success_message'])) {
      echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
      
      // Unset the session variable to avoid displaying the message on page refresh
      unset($_SESSION['success_message']);
    }
  ?>
<!DOCTYPE html>
<html lang="en">
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-1">
              <div class="col-sm-6">
                <h1>Daftar Poli</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="pasien.php?page=dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Daftar Poli</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
      </section>

      <section class="content-header">
        <div class="container-fluid">
          <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Daftar Poli</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="poli/daftar_poli.php">
              <div class="card-body">
                  <input type="hidden" name="id_pasien" value="<?php echo $id_pasien; ?>" required readonly>
                  <div class="form-group">
                      <label for="exampleInputNamaDokter">Nomor Rekam Medis</label>
                      <input type="text" class="form-control" name="no_rm" value="<?php echo $no_rm; ?>" required readonly>
                  </div>
                  <div class="form-group">
                      <label for="inputPoli">Pilih Poli</label>
                      <select id="inputPoli" class="form-control" name="nama_poli" required>
                        <option>Pilih</option>
                        <?php
                          $query = mysqli_query($koneksi,"SELECT id, nama_poli FROM poli");
                          while($dok = mysqli_fetch_array($query)){
                            echo '<option value="'.$dok['id'].'">'.htmlentities($dok['nama_poli']).'</option>';
                          }
                        ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="inputJadwal">Pilih Jadwal</label>
                      <select id="inputJadwal" class="form-control" name="id_jadwal" required>
                        <option value="900">Pilih</option>
                        <?php
                          $query = mysqli_query($koneksi,"SELECT jadwal_periksa.*, dokter.nama FROM jadwal_periksa LEFT JOIN dokter ON jadwal_periksa.id_dokter = dokter.id");
                          while($dok = mysqli_fetch_array($query)){
                            echo '<option value="'.$dok['id'].'">'.htmlentities($dok['nama'])." | ".htmlentities($dok['hari'])." | ".htmlentities($dok['jam_mulai'])." - ".htmlentities($dok['jam_selesai']).'</option>';
                          }
                        ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputNamaDokter">Keluhan</label>
                      <textarea id="keluhan" type="text" class="form-control" rows="3" name="keluhan" required></textarea>
                  </div>
                  <!-- /.card-body -->
              </div>
              <!-- /.card-body -->
              
              <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Daftar</button>
              </div>
            </form>
          </div>
        </div>
      </section>

      <section class="content-header">
        <div class="container-fluid">
          <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Riwayat Daftar Poli</h3>
            </div>

            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th>Poli</th>
                    <th>Dokter</th>
                    <th>Hari</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Antrian</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $query = mysqli_query($koneksi,"SELECT daftar_poli.id, daftar_poli.no_antrian, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai, dokter.nama, poli.nama_poli
                                                    FROM daftar_poli 
                                                    LEFT JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id
                                                    LEFT JOIN dokter ON jadwal_periksa.id_dokter = dokter.id
                                                    LEFT JOIN poli ON dokter.id_poli = poli.id
                                                    LEFT JOIN pasien ON daftar_poli.id_pasien = pasien.id
                                                    WHERE pasien.nama = '$nama'
                                                    ORDER BY daftar_poli.id DESC");
                    while ($dok = mysqli_fetch_array($query)) {

                  ?>
                  <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $dok['nama_poli'];?></td>
                    <td><?php echo $dok['nama'];?></td>
                    <td><?php echo $dok['hari'];?></td>
                    <td><?php echo $dok['jam_mulai'];?></td>
                    <td><?php echo $dok['jam_selesai']; ?></td>
                    <td><?php echo $dok['no_antrian']; ?></td>
                    <td>
                      <a href="pasien.php?page=detail-poli&& id=<?php echo $dok['id']?>" class="btn btn-sm btn-success">Detail</a>
                    </td>
                  </tr>
                  <?php $no++; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>   

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script>
      // Function to load jadwal based on selected poli
      function loadJadwal(poliId) {
        console.log('Loading jadwal for poli_id:', poliId);

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://localhost/poliklinik_sidik/app/get_jadwal.php?poli_id=' + poliId, true);
        xhr.onload = function () {
          if (xhr.status === 200) {
            console.log('Response:', xhr.responseText);
            document.getElementById('inputJadwal').innerHTML = xhr.responseText;
          }
        };
        xhr.send();
      }

      // Event listener for poli selection
      document.getElementById('inputPoli').addEventListener('change', function () {
        var poliId = this.value;
        console.log('Selected poli_id:', poliId);
        loadJadwal(poliId);
      });

      // Check if there is an initial value selected for poli
      var initialPoliId = document.getElementById('inputPoli').value;
      if (initialPoliId !== 'Pilih') {
        console.log('Initial poli_id:', initialPoliId);
        loadJadwal(initialPoliId);
      }
    </script>
  </body>
</html>