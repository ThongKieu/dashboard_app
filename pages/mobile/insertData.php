<?php
include '../../config.php';
    $database = new Getdatabase();
    $conn = $database->getConnection();

    $tenApp =$_POST['tenCont'];
	$sdtApp =$_POST['sdtCont'];
	$diachiApp =$_POST['diaChiCont'];
	$yccvApp =$_POST['yccvCont'];
	$quanApp =$_POST['quanCont'];
    $sqlc = "INSERT INTO `mobile_data`(`tenkh`, `sdt`, `diachi`, `yccv`, `quan_huyen`) 
				VALUES ('".$tenApp."','".$sdtApp."','".$diachiApp."','".$yccvApp."','".$quanApp."')";
    $qc = $conn->prepare($sqlc);
	$qc->execute();
    echo json_encode("thanh cong");
   
    
?>