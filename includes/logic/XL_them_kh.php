<?php
     include '../../config.php';
     $database = new Getdatabase();
     $conn = $database->getConnection();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["nameKH"])) { $namKH= $_POST['nameKH']; }
    if(isset($_POST["addKH"])) { $addKH = $_POST['addKH']; }
    if(isset($_POST["telKH"])) { $telKH = $_POST['telKH']; }
    if(isset($_POST["desKH"])) { $desKH = $_POST['desKH']; }
    if(isset($_POST["ycKH"])) { $yc_book = $_POST['ycKH']; }
    if(isset($_POST["kind_book"])) { $kind_book = $_POST['kind_book']; }
    if(isset($_POST["date_book"])) { $date_book = $_POST['date_book']; }
    if(isset($_POST["note_book"])) { $note_book = $_POST['note_book']; }
    if(isset($_POST["nv_add"])) { $nv_add = $_POST['nv_add']; }
       //Code xử lý, insert dữ liệu vào table
        if($date_book == null )
        {
            $date_book = date('Y-m-d H:i');
        }
       
        $sql = "INSERT INTO `info_cus`( `name_cus`, `phone_cus`, `add_cus`, `des_cus`, `yc_book`, `note_book`, `kind_book`, `date_book`, `flag_book`,`flag_status`,`nv_add`) 
            VALUES ('$namKH','$telKH','$addKH','$desKH','$yc_book','$note_book','$kind_book','$date_book',0,NULL,'$nv_add')";
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if($q){
            header("location: " . BASE_URL . "index.php");
                 
                 }
    }
    

//Đóng database


?>