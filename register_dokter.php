<?php
    include('conf/config_poliklinik.php');
  ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="app/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="app/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <style>
    .login-box {
      padding-left: 400px;
      width: 850px;
      padding-bottom: 30px;
    }
  </style>
</head>

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a class="h1"><b>Poli</b>klinik</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new account</p>

      <form action="conf/aut_registrasi_dokter.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Input Nama" name="nama">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Input Alamat" name="alamat">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-map-marker"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Input Nomor HP" name="no_hp">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <select class="form-control" name="nama_poli">
                <option selected>Pilih ID Poli</option>
                <?php
                    $query = mysqli_query($koneksi,"SELECT id, nama_poli FROM poli");
                    while($dok = mysqli_fetch_array($query)){
                        echo '<option value="'.$dok['id'].'">'.htmlentities($dok['nama_poli']).'</option>';
                    }
                ?>
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-id-badge"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Input Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div class="text-center">
        <p class="mt-3">Sudah punya akun ? <a href="index.php?page=login-dokter"><b>Login</b></a></p>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="app/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="app/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="app/plugins/sweetalert2/sweetalert2.min.js"></script>

<?php
if(isset ($_GET['error'])){
  $error = ($_GET['error']);
  if ($error == 3) {
    echo "
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            icon: 'warning',
            title: 'Silahkan input nama, alamat, no. hp, id poli, password, dan konfirmasi password terlebih dulu !'
        })
    </script>";
  } 
  else if ($error == 4) {
    echo "
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            icon: 'warning',
            title: 'Password dan konfirmasi password tidak cocok !'
        })
    </script>";
  } 
  else if ($error == 5) {
    echo "
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            icon: 'error',
            title: 'Gagal menyimpan data ke database !'
        })
    </script>";
  }
}  
?>