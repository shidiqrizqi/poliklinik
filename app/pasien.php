<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  if(!isset($_SESSION['nama'])){
    header('Location: ../index.php?page=register-pasien&&session=expired');
    exit();
  }
  include('header_pasien.php');
?>
<?php
  include('../conf/config_poliklinik.php');
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <?php
    //include('preloader.php');
  ?>

  <!-- Navbar -->
    <?php
        include('navbar_pasien.php');
    ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?php
      include('logo_sidebar.php');
    ?>
    <!-- Sidebar -->
    <?php
        include('sidebar_pasien.php');
    ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <?php
      if (isset($_GET['page'])){
        if($_GET['page']=='dashboard'){
          include('dashboard_pasien.php');
        }
        else if($_GET['page']=='data-poli'){
          include('data_poli.php');
        }
        else if($_GET['page']=='detail-poli'){
          include('detail_poli.php');
        }
        else{
          include('not_found.php');
        }
      }
      else{
        include('dashboard.php');
      }
    ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    include('footer.php');
  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>
</html>
