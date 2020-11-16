<?php


include '../../config.php';

$hd = $_GET['hd'];
$id = $_GET['id_cus'];
$nhuy = $_GET['nnHuy'];
$ki= $_GET['ki'];
if($hd=='ks')
{
  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
    $sql = " UPDATE `info_cus` SET flag_status='Khảo Sát',`flag_book`=1 where id_cus='$id'";
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    header("location: " . BASE_URL . "index.php");
  }
  catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
  }
}
elseif($hd=='huy')
{
  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
    $sql = " UPDATE `info_cus` SET flag_status='Hủy' ,`flag_book`= 1, `note_book` ='$nhuy' where id_cus='$id'";
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    header("location: " . BASE_URL . "index.php?action=".$ki);
  }
  catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
  }
} 

elseif($hd=='cho')
{
  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
    $sql = " UPDATE `info_cus` SET flag_status='Chờ',`flag_book`=1 where id_cus='$id'";
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    header("location: " . BASE_URL . "index.php?action=".$ki);
  }
  catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
  }
}


