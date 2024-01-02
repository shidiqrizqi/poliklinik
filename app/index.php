<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header('Location: ../index.php?page=login-admin&&session=expired');
    exit();
  }
  include('header.php');
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
        include('navbar.php');
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
        include('sidebar.php');
    ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <?php
      if (isset($_GET['page'])){
        if($_GET['page']=='dashboard'){
          include('dashboard.php');
        }
        else if($_GET['page']=='data-dokter'){
          include('data_dokter.php');
        }
        else if($_GET['page']=='edit-data-dokter'){
          include('edit/edit_data_dokter.php');
        }
        else if($_GET['page']=='data-obat'){
          include('data_obat.php');
        }
        else if($_GET['page']=='edit-data-obat'){
          include('edit/edit_data_obat.php');
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
