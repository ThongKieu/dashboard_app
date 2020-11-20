<?php


include '../../config.php';

$hd = $_GET['hd'];

if($hd=='ks')
{
  $id = $_GET['id'];
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
  $id = $_GET['id_cus'];
  $nhuy = $_GET['nnHuy'];
  
  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
    $sql = " UPDATE `info_cus` SET flag_status='Hủy' ,`flag_book`= 1, `note_book` ='$nhuy' where id_cus='$id'";
    $q = $pdo->query($sql);
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
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
    $sql = " UPDATE `info_cus` SET flag_status='Chờ',`flag_book`=1 where id_cus='$id'";
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    header("location: " . BASE_URL . "index.php");
  }
  catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
  }
}


