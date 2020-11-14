  <?php

    include '../../config.php';
    $id = $_GET['id_cus'];
	$do = $_GET['do'];
    $dateup= date('Y-m-d');
   try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
    if($do == '0'){
    $sql = "UPDATE info_cus 
             set   flag_book = '0'  , flag_status = NULL , date_book = '$dateup' where id_cus ='$id'";
	}
	   else
	   {
	   	$sql="DELETE FROM info_cus where id_cus = '$id'";
	   }
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    if(isset($q))
    {
        header("location: " . BASE_URL . "index.php"); 
    }
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
    ?>