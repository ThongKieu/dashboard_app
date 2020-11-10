<?php
include('../../config.php');
$ac = $_GET['ac'] ;
if($ac == 'them'){
$name_be = $_GET['nameBN'];
$add_be = $_GET['addBN'];
$grtho = $_GET['grBN']; 

try{
    $q = $conn ->prepare("INSERT INTO vsbn(`name_be`,`add_be`,`group_tho`) VALUE ('$name_be','$add_be','$grtho')") ;
    $q->execute();
    if($q)
    {
        header("location:".BASE_URL."index.php");
    }
}
catch(PDOException $e)
{
    echo $e->getMessage();
} 
}
else{
    try{
    $id= $_GET['id'];
    $q = $conn ->prepare(" UPDATE vsbn SET status_be ='1' WHERE id_be= '$id'");
    $q->execute();
    if($q)
    {
        header("location:".BASE_URL."index.php");
    }
}
catch(PDOException $e)
{
    echo $e->getMessage();
} 
}