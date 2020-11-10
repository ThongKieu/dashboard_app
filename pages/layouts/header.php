<?php $iduser = $_SESSION['username'];

try{
    
    $sql = "SELECT * FROM users where username like '$iduser'";
    $q= $conn->query($sql);
    $q ->setFetchMode(PDO::FETCH_ASSOC);
    $ruser=$q->fetch();
    $us = $ruser['username'];
    $sql2 = "SELECT * FROM notication where not nv_noti like '%$us%' ORDER BY id_noti DESC ";
    $q2= $conn->query($sql2);
    $q2 ->setFetchMode(PDO::FETCH_ASSOC);
    $q2->execute();
    $numboti = $q2 -> rowCount();

}
catch (PDOException $e)
{
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Trang thông tin | Thợ Việt</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="css/min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="icon" href="dist/fa-worker.png">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo text-decoration-nones">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini " ><b>TV</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Thợ Việt</b> Homecare</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle text-decoration-nones" data-toggle="push-menu" role="button">
        <span class="sr-only">Menu</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less
          Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo $numboti; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Bạn có <?php echo $numboti; ?> Thông báo mới!</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php 
                  while ($rno = $q2->fetch()):
                  echo "<li>
                    <a href='includes/logic/setnoti.php?id_noti=".$rno['id_noti']."&user=".$ruser['id'].$ruser['username']."'>
                      <i class='fa fa-user text-red'></i> ".$rno['info_noti']."
                    </a>
                  </li>";
                  endwhile;
                  ?>
                </ul>
              </li>
              <li class="footer"><a href="<?php echo BASE_URL.'index.php?action=allnoti';?>">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/<?php echo $ruser['ava_img']?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $ruser['real_name']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/<?php echo $ruser['ava_img']?>" class="img-circle" alt="User Image">

                <p>
                <?php echo $ruser['real_name']." - ".$ruser['contact_number'];?>
                  <small></small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="pages/users/protifile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo BASE_URL.'logout.php';?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>