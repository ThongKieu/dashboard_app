<?php
include '../../config.php';

        $id = $_POST["id_cus"];
        $n=$_POST['nameKH'];
        $a=$_POST['addKH'];
        $d=$_POST['desKH'];
        $t=$_POST['telKH'];
        $y=$_POST['ycKH'];
        $no=$_POST['note_book'];
        $k=$_POST['kind_book'];
        $da = $_POST['date_book'];
        $action = $_POST['action'];
		$nv= $_POST['nv'];
        


try {
      $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
        if($action == 0)
        {
          $sql = "UPDATE info_cus SET 
            name_cus='$n',
            phone_cus='$t',
            add_cus='$a',
            des_cus='$d',
            yc_book='$y',
            note_book='$no',
            kind_book='$k',
            date_book='$da',
            flag_book='0' WHERE id_cus='$id'";
        }
        elseif($action == 1){
          $sql= "INSERT INTO `info_cus`( `name_cus`, `phone_cus`, `add_cus`, `des_cus`, `yc_book`, `note_book`, `kind_book`, `date_book`, `flag_book`,`flag_status`,`nv_add`) 
          VALUES ('$n','$t','$a','$d','$y','$no','$k','$da',0,NULL,'$nv')";
        }
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if($q){
            echo 'sửa thành công';
           header("location: " . BASE_URL . "index.php");
        }
    } catch (PDOException $e) {
        die("Could not connect to the database $dbname :" . $e->getMessage());
      }
   
?>
