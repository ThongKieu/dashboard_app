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
                <th class='col-xs-2'>Thao Tác</th>
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
                    <td>";
                    // btn nhap
                    echo "<button type='button' data-toggle='modal' data-target='#nhaphtdn".$results->data[$i]['id_work']."' style='padding:4px 9px' class='btn btn-success tooltipButton cls_btn' data-tooltip='Nhập'";if($results->data[$i]['sum_thu'] > 0 ){echo "disabled";} 
                    echo" ><i class='glyphicon glyphicon-import'></i></button>";
                    echo"
                        <!-- Modal -->
                        <div id='nhaphtdn".$results->data[$i]['id_work']."' class='modal fade' role='dialog'>
                        <!-- Modal content-->
                        <div class='modal-content' style='position: fixed;top: 20px;left: 30%;text-align: left;width: 40%;'>
                            <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                <h3 class='modal-title text-center'>Nhập Thông Tin Thu Chi</h3>
                            </div>
                            <div class='modal-body'>
                                <form action='includes/logic/XL_thu_chi.php' id='frm_sua_KH' method='POST' class ='form-container'>
                                    <input type='hidden' name ='id_work' value=".$results->data[$i]['id_work']." >
                                    <input type='hidden' name ='ki' value='6' > 
                                    <input type='hidden' name ='ac' value='1' >                                                    
                                    <input type='hidden' name ='tentho' value='".$results->data[$i]['name_worker']."'>
                                    <input type='hidden' name ='tentho' value='".$results->data[$i]['name_worker']."'>
                                    <label for='ycKH'><b>Nội Dung CV</b></label>
                                    <input type='text' class='form-control' name = 'ycKH' value='".$results->data[$i]['yc_book']."'> 
                                    <label for='addKH'><b>Địa Chỉ</b></label>
                                    <input type='text' class='form-control' name ='addKH' value='".$results->data[$i]['add_cus']."  ".$results->data[$i]['des_cus']."' readonly>
                                    <label for='ycKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                    <input type='text' class='form-control'  name ='telKH' value=".$results->data[$i]['phone_cus']." readonly>
                                    <div class= 'row'>
                                        <div class= 'col-md-6'>
                                            <label for='sumthu'><b>Ngày làm : </b></label>
                                            <input  class='form-control'type='date' class='form-control' name='date_book' value=" ;echo $results->data[$i]['date_book']." readonly/>
                                        </div> 
                                        <div class= 'col-md-6'>
                                            <label for='sumchi'><b>Bảo Hành  : </b></label>
                                            <input type='text' class='form-control' name='thogianbh' value=".$results->data[$i]['operator_time']." >
                                        </div>
                                    </div>
                                    <div class= 'row'>
                                        <div class= 'col-md-6'>
                                            <label for='sumthu'><b>Tổng Thu  : </b></label>
                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumthu' value=".$results->data[$i]['sum_thu']." >
                                        </div> 
                                        <div class= 'col-md-6'>
                                            <label for='sumchi'><b>Tổng Chi  : </b></label>
                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumchi' value=".$results->data[$i]['sum_chi']." >
                                        </div>
                                    </div>
                                        <label for='date_book'><b>Tình trạng thanh toán  : </b></label><br>
                                        <div class='row'>
                                            <div class='col-md-6 text-center'>
                                                <label class='check-container1'>Chưa thanh toán<input type='radio'";if($results->data[$i]['thanh_toan']=='1'){echo "checked='checked'";}echo "name='thanh_toan' value='1'>
                                            </div>
                                            <div class='col-md-6 text-center'>
                                                <label class='check-container1'>Đã thanh toán
                                                <input type='radio'";if($results->data[$i]['thanh_toan']=='0'){echo "checked='checked'";}echo" name='thanh_toan' value='0'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <div class='row'>
                                            <div class='col-md-6 text-center'><button type='submit' value='submit' class='btn btn-sm btn-success' style='width:150px; font-size: 14px'>Thay Đổi Thông tin</button></div>
                                            <div class='col-md-6 text-center'><button type='button' class='btn btn-danger' style='width:150px;' data-dismiss='modal'>Hủy</button></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>";
                        // btn sua 
                        echo "<button type='button' data-toggle='modal' data-target='#suahtdn".$results->data[$i]['id_work']."'class='btn btn-sm btn-warning tooltipButton cls_btn' data-tooltip='Sửa'><i class='fa fa-pencil' aria-hidden='true'></i></button>";
                                    echo "<!-- Modal -->
                                    <div id='suahtdn".$results->data[$i]['id_work']."' class='modal fade' role='dialog'>
                                        <!-- Modal content-->
                                        <div class='modal-content' style=' position: fixed;top: 30px;left: 30%;text-align: left;width: 40%;  overflow: auto;'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h3 class='modal-title text-center'>Sửa Thông Tin Lịch Điện Nước Đã Hoàn Thành</h3>
                                            </div>
                                            <div class='modal-body'>
                                                <form action='includes/logic/XL_thu_chi.php' id='frm_sua_KH' method='POST' class ='form-container'>
                                                    <input type='hidden' name ='id_work' value=".$results->data[$i]['id_work']." >                                                   
                                                    <input type='hidden' name ='id_cus' value=".$results->data[$i]['id_cus']." > 
                                                    <input type='hidden' name ='ki' value='6'>
                                                    <input type='hidden' name ='ac' value='2' >
                                                    <label for='ycKH'><b>Nội Dung CV</b></label>
                                                    <input type='text' class='form-control' name = 'ycKH' value='".$results->data[$i]['yc_book']."'> 
                                                    <label for='telKH'><b>Địa Chỉ</b></label>
                                                    <input  class='form-control'type='text' name ='addKH' value='".$results->data[$i]['add_cus']."  ".$results->data[$i]['des_cus']."' readonly>
                                                    <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                    <input  class='form-control'type='text' name ='telKH' value=".$results->data[$i]['phone_cus']." readonly>
                                                    
                                                    
                                                    <label for='note_book'><b>Ghi Chú Công Việc </b></label>
                                                    <textarea class='form-control' type='text' name='note_work' value='".$results->data[$i]['note_work']."' ></textarea>
                                                    <div class= 'results->data[$i]'>
                                                        <div class= 'col-md-6'>
                                                            <label for='thochinh'><b>Thợ Chính</b></label>
                                                            <input  class='form-control'type='text' class='form-control' name = 'tentho' value='".$results->data[$i]['name_worker']."'> 
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='thophu'><b>Thợ Phụ</b></label>
                                                            <input  class='form-control'type='text' class='form-control' name = 'phu' value='".$results->data[$i]['phu']."'> 
                                                        </div>
                                                    </div> 
                                                    <div class= 'row'>
                                                        <div class= 'col-md-6'>
                                                            <label for='thochinh'><b>Ngày Làm :</b></label>
                                                            <input  class='form-control'type='date' class='form-control' name='date_book' value=" ;echo $results->data[$i]['date_book']." readonly>
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='thophu'><b>Thời Gian Bảo Hành:</b></label>
                                                            <input  class='form-control' type='text' class='form-control' name = 'bh' value='".$results->data[$i]['operator_time']."'> 
                                                        </div>
                                                    </div> 
                                                    <div class= 'row' >
                                                        <div class= 'col-md-6'>
                                                            <label for='sumthu'><b>Tổng Thu  : </b></label>
                                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumthu' value=".$results->data[$i]['sum_thu'].">
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='sumchi'><b>Tổng Chi  : </b></label>
                                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumchi' value=".$results->data[$i]['sum_chi']." >
                                                        </div>
                                                    </div>
                                                    <label for='date_book'><b>Tình trạng thanh toán  : </b></label>
                                                    <div class='row'  style='background-color: #f1f1f1;border-radius:5px;'>
                                                        <div class='col-md-6 text-center'>
                                                            <label class='check-container1'>Chưa thanh toán</label><input type='radio'";if($results->data[$i]['thanh_toan']=='1'){echo" checked='checked'";} echo "name='thanh_toan' value='1'>
                                                        </div>
                                                        <div class='col-md-6 text-center'>
                                                            <label class='check-container1'>Đã thanh toán</label>
                                                            <input type='radio'";if($results->data[$i]['thanh_toan']=='0'){echo "checked='checked'";}echo" name='thanh_toan' value='0'>
                                                        </div>
                                                    </div>
                                                    <label for='date_book'><b>Loại CV: </b></label>
                                                    <div class='row'  style='background-color: #f1f1f1;border-radius:5px;'>
                                                        <div class='col-sm-4 text-center'> 
                                                            <label class='check-container1' >Điện Lạnh</label>
                                                            <input type='radio'"; if($results->data[$i]['kind_book']=='Điện Lạnh'){echo "checked='checked'";} echo "name='kind_book' value='Điện Lạnh'>
                                                        </div>
                                                        <div class='col-sm-4 text-center'>
                                                            <label class='check-container1'>Điện Nước</label>
                                                            <input type='radio'"; if($results->data[$i]['kind_book']=='Điện Nước'){echo "checked='checked'";} echo" name='kind_book' value='Điện Nước'>
                                                        </div>
                                                        <div class='col-sm-4 text-center'>
                                                            <label class='check-container1'>Đồ Gỗ</label>
                                                            <input  type='radio'";if($results->data[$i]['kind_book']=='Đồ Gỗ'){echo "checked='checked'";} echo" name='kind_book' value='Đồ Gỗ'>
                                                        </div> 
                                                    </div>
                                            </div>
                                            <div class='modal-footer'>
                                                <div class='row'>
                                                    <div class='col-md-6 text-center'>
                                                        <button type='submit' value='submit' class='btn btn-sm btn-success' style='width:150px; font-size: 14px'>Thay Đổi Thông tin</button>
                                                    </div>
                                                    <div class='col-md-6 text-center'>
                                                        <button type='button' class='btn btn-danger' style='width:150px;' data-dismiss='modal'>Hủy</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>";
                        // btn khao sat     
                        echo"<a class='btn btn-sm btn-primary cls_btn tooltipButton cls_a' data-tooltip='Khảo Sát' "; if($results->data[$i]['sum_thu']  > 0 ){echo "disabled='disabled'";} echo  " href='".BASE_URL."includes/logic/deleteKH.php?hd=ks&id=".$results->data[$i]['id_cus']."'><i class='fa fa-list-alt'></i></a>";
                        // btn huy
                        echo  "<button type='button' class='btn btn-sm btn-warning cls_btn tooltipButton' data-tooltip='Hủy Lịch' data-toggle='modal' data-target='#my".$results->data[$i]['id_cus']."' "; if($results->data[$i]['sum_thu'] > 0 ){echo "disabled";}  echo "><i class='fa fa-trash' aria-hidden='true'></i></button>
                            <!-- Modal -->
                            <div id='my".$results->data[$i]['id_cus']."' class='modal fade' role='dialog'>
                                <div class='modal-dialog'>
                                    <!-- Modal content-->
                                    <div class='modal-content'>
                                        <form action='includes/logic/deleteKH.php' method='GET'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h4 class='modal-title'>Nguyên Nhân Hủy</h4>
                                            </div>
                                            <div class='modal-body'>
                                                <input type='hidden' name='hd' value='huy'>
                                                <input type='hidden' name='id_cus' value='".$results->data[$i]['id_cus']."'>
                                                <textarea style = 'width:100%' name='nnHuy'></textarea>
                                            </div>
                                            <div class='modal-footer'>
                                                <input type='submit' class='btn btn-default' value='Xác Nhận'/>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </td>
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