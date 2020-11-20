<?php
include '../../config.php';

$action = $_POST['ac'];
$ki = $_POST['ki'];
if($action == 1){ // nhập thu chi mới
      $id=$_POST['id_work'];
      $tongthu=$_POST['sumthu'];
      $tongchi= $_POST['sumchi'];
      //$time_search = $_POST['time_search'];
      $thanh_toan = $_POST['thanh_toan'];
      try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
      
            $sql = "UPDATE work_do SET sum_chi = '$tongchi', sum_thu = '$tongthu', date_done = '$timelive', thanh_toan = '$thanh_toan' where id_work like '%$id%'";
      
              $q = $pdo->query($sql);
              $q->setFetchMode(PDO::FETCH_ASSOC);
             if($q){ header("location: " . BASE_URL . "index.php");}
            } catch (PDOException $e) {
              die("Could not connect to the database $dbname :" . $e->getMessage());
            }
}
elseif($action == 2)
{     // sửa thông tin thu chi 
      $id_cus     = $_POST['id_cus'];
      $id_work    = $_POST['id_work'];
      $yc         = $_POST['ycKH'];
      $note       = $_POST['note_work'];
      $bh         = $_POST['bh'];
      $phu        = $_POST['phu'];
      $tongthu    = $_POST['sumthu'];
      $tongchi    = $_POST['sumchi'];
      $thanh_toan = $_POST['thanh_toan'];
      try{
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
            //update dữ liệu bảng lịch đã làm
            $sql = "UPDATE work_do SET sum_chi = '$tongchi', sum_thu = '$tongthu', thanh_toan = '$thanh_toan'   where id_work ='$id_work'";      
            $q = $pdo->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
             //update dữ liệu khách hàng
            $kh = "UPDATE info_cus SET yc_book='$yc', operator_time = '$bh' WHERE id_cus = '$id_cus'";
            $q1 = $pdo->query($kh);
            $q1->setFetchMode(PDO::FETCH_ASSOC);
           
            if($q1){ header("location: " . BASE_URL . "index.php");}    
      }
      catch (PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
          }
}
elseif($action == 3){
      $id_work    = $_POST['id_work'];
      $note       = $_POST ['note_work'];
      $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
      $sql=" UPDATE work_do SET note_work = '$note' WHERE id_work = '$id_work'";
      $q = $pdo->query($sql);
      $q->setFetchMode(PDO::FETCH_ASSOC);


      if($q){ header("location: " . BASE_URL . "index.php");} 
}

  ?>
    