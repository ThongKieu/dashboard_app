<style>
td:nth-child(9) {
    text-align: center;
    }
    td:nth-child(10) {
    text-align: center;
    }
    th{
        text-align: center;
    }
   
    </style>
<?php 
    include_once 'includes/class/pagination.php';
    
    $hd      = ( isset( $_GET['hd'] ) ) ? $_GET['hd'] : 'ktra' ;

    $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 20;
    $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
    $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
    $sqlc ="SELECT id_cus FROM info_cus
    WHERE  date_book like '%$timelive%' 
      ORDER BY info_cus.date_book DESC";
    $t= $conn->query($sqlc);
    $t ->setFetchMode(PDO::FETCH_ASSOC);  
    $n = $t->rowCount();
    if($n >   0){
    if(isset($_GET['tentho'])){
    
        $tentho= $_GET['tentho'];
        try {

            $sql = "SELECT work_do.id_cus, work_do.id_work,info_cus.add_cus,info_cus.des_cus,info_cus.date_book, info_cus.phone_cus,info_worker.name_worker,info_cus.note_book,
                    work_do.sum_chi, work_do.sum_thu,work_do.note_work, info_cus.flag_status, phu,yc_book, thanh_toan,operator_time, kind_book  FROM work_do , info_cus, info_worker 
                    WHERE  info_cus.flag_book = 1 and work_do.id_cus = info_cus.id_cus 
                    and work_do.id_worker = info_worker.id_worker 
                    and info_worker.name_worker like '%$tentho%'
                    and info_cus.date_book like '%$timelive%' 
                    ORDER BY info_cus.date_book DESC";
           
            $result= $conn->query($sql);
            $result ->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();  
            $num = $result ->rowCount();
            if($num > 0){
            $Paginator  = new Paginator( $conn, $sql );
            $_hd = $Paginator->gethd($hd);
            $results    = $Paginator->getData( $limit, $page );
            }
            
            }catch (PDOException $e) 
            {
                die("Could not connect to the database $dbname :" . $e->getMessage());
            }
            
    }
    else 
    {
        try {

            $sql = "SELECT work_do.id_cus, work_do.id_work,info_cus.add_cus,info_cus.des_cus,info_cus.date_book, info_cus.phone_cus,info_worker.name_worker,info_cus.note_book,
                    work_do.sum_chi, work_do.sum_thu,work_do.note_work, info_cus.flag_status, phu,yc_book,thanh_toan,operator_time,kind_book  FROM work_do , info_cus, info_worker 
                    WHERE  info_cus.flag_book = 1 and work_do.id_cus = info_cus.id_cus and work_do.id_worker = info_worker.id_worker
                    and info_cus.date_book like '%$timelive%' 
                         ORDER BY info_cus.date_book DESC";
            $result= $conn->query($sql);
            $result ->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            $num = $result ->rowCount(); 
            if($num > 0){
                $Paginator  = new Paginator( $conn, $sql );
                $_hd = $Paginator->gethd($hd);
                $results    = $Paginator->getData( $limit, $page );
                }

            }catch (PDOException $e) 
            {
                die("Could not connect to the database $dbname :" . $e->getMessage());
            }
    } 

    if($num > 0){
   echo "
   <table class='table table-bordered table-hover'>
        <thead>
            <tr>
                <th class='col-xs-2'>Địa Chỉ </th>
                <th class='col-xs-1'>Số Điện Thoại</th>
                <th class='col-xs-1'>Thợ Làm</th>
                <th class='col-xs-1'>Phụ</th>
                <th class='col-xs-1'>Ghi Chú</th>
                <th class='col-xs-1'>Trạng Thái</th>
                <th class='col-xs-1'>Tổng Thu</th>
                <th class='col-xs-1'>Tổng Chi</th>
               
                <th class='col-xs-1'>Phản Hồi</th>
            </tr>
        </thead>
        <tbody>";
            for( $i = 0 ; $i < count( $results->data ); $i++ ) : 
                echo "<tr>
                    <td>".$results->data[$i]['add_cus']."</td> 
                    <td>".$results->data[$i]['phone_cus']."</td> 
                    <td>".$results->data[$i]['name_worker']."</td>
                    <td>".$results->data[$i]['phu']."</td> 
                    <td>".$results->data[$i]['note_book']."</td> 
                    <td>".$results->data[$i]['flag_status']."</td> 
                    <td>".$results->data[$i]['sum_chi']."</td>
                    <td>".$results->data[$i]['sum_thu']."</td>
   
                    <td>"; if($results->data[$i]['note_work']==NULL){
                            echo "<a href ='".BASE_URL."includes/logic/thu_chi.php?id_work=".$results->data[$i]['id_work']."&idq=3'class='btn btn-sm btn-danger'>Chăm Sóc</a>";}
                            else{echo $results->data[$i]['note_work'];}
                    echo "</td>   
                </tr>";endfor;
            echo "</tbody>
        </table>";
        echo $Paginator->createLinks( $links, 'pagination pagination-sm' );
    echo " </div>";} 
else
{
    echo "<h2> Không Có Dữ Liệu </h2>";
}
    }
else {
    echo " Không có dữ liệu";
}