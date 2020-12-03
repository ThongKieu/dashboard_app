<?php
include('../../config.php');
$database = new Getdatabase();
$conn = $database->getConnection();
$ac = $_POST['ac'] ;
if($ac==NULL){$ac=$_GET['ac'];}
if($ac == '1'){
        $nv = $_POST['nv'];
        $thuoctinh   = $_POST['thongtin'];
        $id= $_POST['id_thongbao'];

        try{
            $q = $conn ->prepare("UPDATE note_ad SET `thuoc_tinh` ='$thuoctinh',`ng_them` = '$nv',`ngay_them`= '$timelive' WHERE id_thongbao ='$id'")  ;
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
elseif($ac == '2'){
                $nv = $_POST['nv'];
                $thuoctinh   = $_POST['thongtin'];
                
                
                try{
                    $q = $conn ->prepare("INSERT INTO note_ad (`thuoc_tinh`,`ng_them`,`ngay_them`,`status_ad`) VALUE ('$thuoctinh', '$nv','$timelive','0')")  ;
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
elseif($ac==3){
    try{
    $id= $_GET['id'];
    $q = $conn ->prepare(" UPDATE note_ad SET status_ad ='1' WHERE id_thongbao = '$id'");
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