<?php
include '../../config.php';

        $id = $_POST["id"];
        $n=$_POST['nameNV'];
        $a=$_POST['addNV'];
        $t=$_POST['telNV'];
        $mk=$_POST['mkMoi'];
        $av =$_POST['ava_img'];

try {   
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
       if(empty($mk))
       {
        $sql = "UPDATE users SET 
                
                real_name='$n',
                contact_number='$t',
                addressNV='$a',
                ava_img='$av'
                WHERE id='$id'
                ";

        $q = $pdo->query($sql);

        $q->setFetchMode(PDO::FETCH_ASSOC);
        if($q){
            header("location: " . BASE_URL . "index.php");
            
        }
    }
    else {
        $mk = password_hash($mk,PASSWORD_DEFAULT);
        $sql = "UPDATE users SET 
                
        real_name='$n',
        contact_number='$t',
        addressNV='$a', 
        ava_img='$av',
        password = '$mk'
        WHERE id='$id'
        ";

    $q = $pdo->query($sql);

    $q->setFetchMode(PDO::FETCH_ASSOC);
    if($q){
        header("location: " . BASE_URL . "login.php");
        
    }
    }
        
    } catch (PDOException $e) {
        die("Could not connect to the database $dbname :" . $e->getMessage());
      }
   
?>
