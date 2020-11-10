<?php
include '../../config.php';

$id = $_GET['id_cus'];
$tho = $_GET['tho'];
$nv = $_GET['nv'];
try{
$sql =" SELECT * FROM info_cus where id_cus = '$id'";
$q = $conn->query($sql);
$q->setFetchMode(PDO::FETCH_ASSOC);
 $r = $q->fetch();

$yc = "Bảo hành ".$r['yc_book']." - ".$r['date_book']." Lịch của ".$tho;

$na = $r['name_cus'];
$p = $r['phone_cus'];
$a = $r['add_cus'];
$d = $r['des_cus'];
$k = $r['kind_book'];

 echo $r['name_cus'];
$sql ="INSERT INTO `info_cus`( `name_cus`, `phone_cus`, `add_cus`, `des_cus`, `yc_book`,  `kind_book`, `date_book`, `flag_book`, `flag_status`, `nv_add`) 
       VALUES ('$na','$p','$a','$d','$yc','$k','$timelive', 0,NULL,'$nv')";
$n = $conn->query($sql);
if($n)
{
    header("location:".BASE_URL."index.php");
}


}
catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
  }
