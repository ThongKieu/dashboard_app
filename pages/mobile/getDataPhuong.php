<?php
    include '../../../config.php';

    //$a = json_decode($_GET['yccv'],true);
    $database = new Getdatabase();
    $conn = $database->getConnection();
    $list = array();
	$sql = "SELECT tenquan FROM quan "; 
	$result = $conn->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$result ->execute();
	if($result){
		while($row1 = $result->fetch()){
			$list[]=$row1;
		}
		echo json_encode($list,JSON_UNESCAPED_UNICODE);
	};
?>