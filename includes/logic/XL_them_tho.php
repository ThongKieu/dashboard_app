<?php
     include '../../config.php';
     $database = new Getdatabase();
     $conn = $database->getConnection();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["nameTho"])) { $nameTho= $_POST['nameTho']; }
    if(isset($_POST["addTho"])) { $addTho = $_POST['addTho']; }
    if(isset($_POST["hoTho"])) { $hoTho = $_POST['hoTho']; }
    if(isset($_POST["telTho"])) { $telTho = $_POST['telTho']; }
    if(isset($_POST["telCty"])) { $telCty = $_POST['telCty']; }
    if(isset($_POST["id"])) { $id = $_POST['id']; }   
    if(isset($_POST["cpTho"])) { $cpTho = $_POST['cpTho']; }
    if(isset($_POST["kind_Tho"])) { $kind_Tho = $_POST['kind_Tho']; }
 
       try{
        $sql = "INSERT INTO `info_worker`( `name_worker`, `ho_worker`, `add_worker`, `phone_cty`, `phone_worker`, `kind_worker`, `status_worker`, `cap_tho`)
                VALUES ('$nameTho','$hoTho','$addTho','$telCty','$telTho','$kind_Tho','0','$cpTho')";
        $q = $conn->query($sql);
       
        if($q)
        {
            header("location:".BASE_URL."index.php?action=wk&do=0");
        }
       }
       catch(PDOException $e)
       {
        die("Could not connect to the database $dbname :" . $e->getMessage());
       }
        
   
    }

//Đóng database


?>