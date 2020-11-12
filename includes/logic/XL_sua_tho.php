<?php
     include '../../config.php';
     
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
            $sql = "UPDATE `info_worker` SET
            
            `name_worker`='$nameTho',
            `ho_worker`='$hoTho',
            `add_worker`='$addTho',
            `phone_cty`='$telCty',
            `phone_worker`='$telTho',
            `kind_worker`='$kind_Tho',
            `cap_tho`='$cpTho'
            WHERE id_worker ='$id'";
            $q = $conn->query($sql);
            
            if($q)
            {
                header("location:".BASE_URL."index.php?do=0");
            }
           }
           catch(PDOException $e)
           {
            die("Could not connect to the database $dbname :" . $e->getMessage());
           }
    
    }

//Đóng database


?>