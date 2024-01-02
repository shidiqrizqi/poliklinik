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
                <h1>Kelola Obat</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Obat</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content-header">
        <div class="container-fluid">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
            Tambah Data
          </button>
          <br></br>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Obat</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th>Nama Obat</th>
                        <th>Kemasan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $query = mysqli_query($koneksi,"SELECT * FROM obat");
                        while($dok = mysqli_fetch_array($query)){
                          
                      ?>
                      <tr>
                        <td><?php echo $dok['id'];?></td>
                        <td><?php echo $dok['nama_obat'];?></td>
                        <td><?php echo $dok['kemasan'];?></td>
                        <td><?php echo 'Rp. ' . number_format($dok['harga'], 0, ',', '');?></td>
                        <td>
                          <a href="index.php?page=edit-data-obat&& id=<?php echo $dok['id']?>" class="btn btn-sm btn-success">Ubah</a>
                          <a onClick="hapus_data_obat(<?php echo $dok['id']?>)" class="btn btn-sm btn-danger">Hapus</a>
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

      <!-- Tambah Data Dokter -->
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Obat</h4>
              <button onclick="resetData()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="dataObat" method="post" action="add/tambah_data_obat.php">
              <div class="modal-body">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputNamaObat">Nama Obat</label>
                    <input type="text" class="form-control" id="exampleInputNamaObat" placeholder="Nama Obat" name="nama_obat" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputKemasan">Kemasan</label>
                    <input type="text" class="form-control" id="exampleInputKemasan" placeholder="Kemasan" name="kemasan" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputHarga">Harga</label>
                    <input type="text" class="form-control" id="exampleInputHarga" placeholder="Harga" name="harga" required>
                  </div>
                  <!-- /.card-body -->
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
        document.getElementById("dataObat").reset();
      }

      function hapus_data_obat(data_id){
        Swal.fire({
          title: "Apakah yakin data ingin dihapus ?",
          showCancelButton: true,
          confirmButtonText: "Hapus Data",
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            window.location=("delete/hapus_data_obat.php?id="+data_id)
          }
        });
      }
    </script>
  </body>
</html>