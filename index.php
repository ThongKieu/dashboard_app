<?php 
require "config.php";
if(!isset($_SESSION["username"]))  
{  
     header("location:login.php?action=login");  
}  ?>



<?php include 'pages/layouts/header.php';?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php  include 'pages/layouts/nav_menu_left.php';?> 

  <!-- Content Wrapper. Contains page content -->
<?php  include 'pages/layouts/main_info.php';?>
  <!-- /.content-wrapper -->
  <?php include 'pages/layouts/footer.php';?>
  <!-- Control Sidebar -->
 
  