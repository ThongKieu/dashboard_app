<?php
include '../../../config.php';


if(!$conn)
{
	echo json_encode("Connection Failed");
} 
else 

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
    stmt="INSERT into users(name,email,password) VALUES(:name,:email,password)";
    try{
    $pstmt=$dbh->prepare($stmt);//$dbh database handler for executing mysql query
    $pstmt->bindParam(':name',$name,PDO::PARAM_STR);
    $pstmt->bindParam(':email',$email,PDO::PARAM_STR);
    $pstmt->bindParam(':password',$password,PDO::PARAM_STR);
    $status=$pstmt->execute();
    if($status){
        //next line of code 
    }


    }catch(PDOException $pdo){
        echo $pdo->getMessage();
    }





?>