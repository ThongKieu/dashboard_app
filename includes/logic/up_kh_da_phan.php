<?php
include '../../config.php';
$database = new Getdatabase();
$conn = $database->getConnection();
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
        


try {
        
        
         $sql = "UPDATE info_cus SET          
            name_cus='$n',
            phone_cus='$t',
            add_cus='$a',
            des_cus='$d',
            yc_book='$y',
            note_book='$no',
            kind_book='$k',
            date_book='$da', 
            flag_book = '1'
            
          WHERE id_cus='$id'";
        
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
