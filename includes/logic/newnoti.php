<?php 
 include_once '../../config.php';
 $database = new Getdatabase();
$conn = $database->getConnection();
$noti = $_POST['info_noti'];
$nv_add = $_POST['nv'];

 $sql = "INSERT INTO `notication`   (`info_noti`, `nv_add`,`date_noti`, `nv_noti`) VALUE ('$noti','$nv_add','$timelive',' ')"; 
 $q = $conn->query($sql);
 if($q)
 {
    header("location: " . BASE_URL . "index.php");
    
 }