<?php
include '../../config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$id_thu = $_GET['id_cus'];
$ki = $_GET['ki'];
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
    
    $sql = "UPDATE info_cus SET flag_book = 0  WHERE id_cus='$id_thu' ";
              
    $q = $pdo->query($sql);
    //$q->setFetchMode(PDO::FETCH_ASSOC);
    $sql_delwork= "DELETE FROM `work_do` WHERE id_cus ='$id_thu'";
    $q2 =$pdo->query($sql_delwork);
    if($q){
         header("location: " . BASE_URL . "index.php");
    }
    } catch (PDOException $e) {
        die("Could not connect to the database $dbname :" . $e->getMessage());
    }
  ?>