<?php
    require '../../config.php';
    $database = new Getdatabase();
    $conn = $database->getConnection();
    $id = $_GET['id'];
    $re = $conn -> prepare("DELETE from notication where id_noti = '$id'");
    $re->execute();
    if($re)
    {
        header("location:".BASE_URL."index.php?action=allnoti");
    }