<?php 
require '../config.php';
include_once 'class/pagination.php';
require 'class/PHPExcel.php';



$sql="SELECT 
    info_cus.name_cus,
    info_cus.phone_cus,
    info_cus.add_cus,
    info_cus.des_cus,
    info_cus.yc_book, 
    info_cus.note_book,
    info_cus.kind_book,
    info_cus.date_book,
    info_cus.flag_status,
    info_worker.name_worker,
    work_do.sum_chi,
    work_do.sum_thu, 
    work_do.thanh_toan

    
    FROM info_cus
    INNER JOIN work_do ON work_do.id_cus = info_cus.id_cus
    INNER JOIN info_worker ON work_do.id_worker = info_worker.id_worker
    WHERE info_cus.flag_book = '1'  order by info_cus.date_book DESC 
 ";
    $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 20;
    $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
    $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
    $result= $conn->query($sql);
    $result ->setFetchMode(PDO::FETCH_ASSOC);  
    $nu = $result->rowCount();
    if($nu > 0){
    $result-> execute();
    
    $Paginator  = new Paginator( $conn, $sql );
 
    $results    = $Paginator->getData( $limit, $page );
    }

     
    $objExcel= new PHPExcel;
    $objExcel ->setActiveSheetIndex(0);
    $sheet = $objExcel->getActiveSheet()->setTitle('Sheet1');

    $rownCount = 1;
    $sheet ->setCellValue('A'.$rownCount,'Yêu Cầu CV');
    $sheet ->setCellValue('B'.$rownCount,'Họ Tên KH');
    $sheet ->setCellValue('C'.$rownCount,'Địa Chỉ KH');
    $sheet ->setCellValue('D'.$rownCount,'Quận');
    $sheet ->setCellValue('E'.$rownCount,'Số điện Thoại');

    $sheet ->setCellValue('F'.$rownCount,'Ghi Chú');
    $sheet ->setCellValue('G'.$rownCount,'Loại');
    $sheet ->setCellValue('H'.$rownCount,'Ngày Đặt Lịch');
    $sheet ->setCellValue('I'.$rownCount,'Tình Trang');
    $sheet ->setCellValue('J'.$rownCount,'Thợ làm');
    $sheet ->setCellValue('K'.$rownCount,'Tiền Thu');
    $sheet ->setCellValue('L'.$rownCount,'Tiền Chi');
    
    while ($row = $result->fetch()){
            $rownCount++;
            $sheet ->setCellValue('A'.$rownCount,$row['yc_book']);
            $sheet ->setCellValue('B'.$rownCount,$row['name_cus']);
            $sheet ->setCellValue('C'.$rownCount,$row['add_cus']);
            $sheet ->setCellValue('D'.$rownCount,$row['des_cus']);
            $sheet ->setCellValue('E'.$rownCount,$row['phone_cus']);
            $sheet ->setCellValue('F'.$rownCount,$row['note_book']);
            $sheet ->setCellValue('G'.$rownCount,$row['kind_book']);
            $sheet ->setCellValue('H'.$rownCount,$row['date_book']);
            $sheet ->setCellValue('I'.$rownCount,$row['thanh_toan']);
            $sheet ->setCellValue('J'.$rownCount,$row['name_worker']);
            $sheet ->setCellValue('K'.$rownCount,$row['sum_thu']);
            $sheet ->setCellValue('L'.$rownCount,$row['sum_chi']);
    }
    $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
    $filename = 'ThongTinKh.csv'.$time_search;
    $objWriter->save($filename);

    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Content-Type: application/vnd.openxmlformats officedocument.spreadsheetmt.sheet');
    header('Content-Length: '.filesize($filename));
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: no-cache');
    readfile($filename);
    return ;

?>
