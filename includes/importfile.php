<?php 
require 'includes/class/PHPExcel.php';

if(isset($_POST['btnGui']))
{
     
    $file = $_FILES['file']['tmp_name'];
    $error = $_FILES['file']['error'];
    
    $objReader = PHPExcel_IOFactory :: createReaderForFile($file);
    $objReader ->setLoadSheetsOnly('Điện Nước');
    $objPHPExcel = $objReader->load($file);
    $sheetData = $objPHPExcel->getActiveSheet()->toArray(' ',true,true,true);

    $hightRow = $objPHPExcel->setActiveSheetIndex()->getHighestRow();
    for($row = 2 ; $row <= $hightRow; $row ++)
    {
        $yccv = $sheetData[$row]['A'];
        $nameKH = $sheetData[$row]['D'];
        $addKH = $sheetData[$row]['E'];
        $desKH = $sheetData[$row]['F'];
        $telKH = $sheetData[$row]['G'];
        $note_book = $sheetData[$row]['C'];
        $kind_book = 'Điện Nước';
        $date_book = date('Y-m-d');
        $nv = $ruser['real_name'];
        $sql = "INSERT INTO `info_cus`( `name_cus`, `phone_cus`, `add_cus`, `des_cus`, `yc_book`, `note_book`, `kind_book`, `date_book`, `flag_book`,`nv_add`) 
        VALUES ('$nameKH','$telKH','$addKH','$desKH','$yccv','$note_book','$kind_book','$date_book','0','$nv') ";
        $q = $conn->query($sql);
        
    }

    $objReader ->setLoadSheetsOnly('Điện Lạnh');
    $objPHPExcel = $objReader->load($file);
    $sheetData = $objPHPExcel->getActiveSheet()->toArray(' ',true,true,true);

    $hightRow = $objPHPExcel->setActiveSheetIndex()->getHighestRow();
    for($row = 2 ; $row <= $hightRow; $row ++)
    {
        $yccv = $sheetData[$row]['A'];
        $nameKH = $sheetData[$row]['D'];
        $addKH = $sheetData[$row]['E'];
        $desKH = $sheetData[$row]['F'];
        $telKH = $sheetData[$row]['G'];
        $note_book = $sheetData[$row]['C'];
        $kind_book = 'Điện Lạnh';
        $date_book = date('Y-m-d');
        $nv = $ruser['real_name'];
        $sql = "INSERT INTO `info_cus`( `name_cus`, `phone_cus`, `add_cus`, `des_cus`, `yc_book`, `note_book`, `kind_book`, `date_book`, `flag_book`,`nv_add`) 
        VALUES ('$nameKH','$telKH','$addKH','$desKH','$yccv','$note_book','$kind_book','$date_book','0','$nv') ";
        $q = $conn->query($sql);
        
    }
    
    $objReader ->setLoadSheetsOnly('Đồ Gỗ');
    $objPHPExcel = $objReader->load($file);
    $sheetData = $objPHPExcel->getActiveSheet()->toArray(' ',true,true,true);

    $hightRow = $objPHPExcel->setActiveSheetIndex()->getHighestRow();
    for($row = 2 ; $row <= $hightRow; $row ++)
    {
        $yccv = $sheetData[$row]['A'];
        $nameKH = $sheetData[$row]['D'];
        $addKH = $sheetData[$row]['E'];
        $desKH = $sheetData[$row]['F'];
        $telKH = $sheetData[$row]['G'];
        $note_book = $sheetData[$row]['C'];
        $kind_book = 'Điện Gỗ';
        $date_book = date('Y-m-d');
        $nv = $ruser['real_name'];
        $sql = "INSERT INTO `info_cus`( `name_cus`, `phone_cus`, `add_cus`, `des_cus`, `yc_book`, `note_book`, `kind_book`, `date_book`, `flag_book`,`nv_add`) 
        VALUES ('$nameKH','$telKH','$addKH','$desKH','$yccv','$note_book','$kind_book','$date_book','0','$nv') ";
        $q = $conn->query($sql);
        
    }
    if($q){
        echo "<h2> Thêm Dữ liệu Thành Công ! </h2>";
    }
    
}
?>



<div class="row">
    <div class="col-sm-6">
        <form action="#" method="POST" enctype="multipart/form-data">
        <input type="file" name="file" class="col-sm-4">
        <button type="submit" name="btnGui">Import</button>
        <form>
    </div>

</div>

</div>
  
    