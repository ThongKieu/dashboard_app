<?php
include '../../config.php';
$database = new Getdatabase();
$conn = $database->getConnection();
$hd = $_GET['hd'];

if($hd=='ks')
{
  $id = $_GET['id_cus'];
    try {
    
    $sql = " UPDATE `info_cus` SET flag_status='Khảo Sát',`flag_book`=1 where id_cus='$id'";
    $q = $conn->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    header("location: " . BASE_URL . "index.php");
  }
  catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
  }
}
elseif($hd=='huy')
{
  $id = $_GET['id_cus'];
  $nhuy = $_GET['nnHuy'];
  
  try {
    
    $sql = " UPDATE `info_cus` SET flag_status='Hủy' ,`flag_book`= 1, `note_book` ='$nhuy' where id_cus='$id'";
    $q = $conn->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    header("location: " . BASE_URL . "index.php");
  }
  catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
  }
} 

elseif($hd=='cho')
{
  $id = $_GET['id_cus'];
  $nhuy = $_GET['nnHuy'];
  try {
    
    $sql = " UPDATE `info_cus` SET flag_status='Chờ',`flag_book`=1 where id_cus='$id'";
    $q = $conn->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    header("location: " . BASE_URL . "index.php");
  }
  catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
  }
}


