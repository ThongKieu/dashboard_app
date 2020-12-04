<?php 
$database = new Getdatabase();
$conn = $database->getConnection();
    if(!isset($_GET['time_search'])){
        $time_search = date('Y-m-d');
    }
    else 
    {
        $time_search= $_GET['time_search'];
    }
    try {
        $sql = "SELECT work_do.id_cus, work_do.id_work,info_cus.add_cus,info_cus.des_cus,info_cus.date_book, info_cus.phone_cus,info_worker.name_worker,info_cus.note_book,work_do.sum_chi, work_do.sum_thu,work_do.note_work, info_cus.flag_status,nv_phan,thongtinthem, thanh_toan, info_cus.yc_book, operator_time,info_cus.kind_book, info_cus.phu, info_cus.name_cus FROM work_do , info_cus, info_worker WHERE  info_cus.flag_book = 1 and work_do.id_cus = info_cus.id_cus and work_do.id_worker = info_worker.id_worker and info_cus.date_book like '%$time_search%'  and info_cus.kind_book like '%nuoc%' ORDER BY flag_status ASC";
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $sql2 = "SELECT work_do.id_cus, work_do.id_work,info_cus.add_cus,info_cus.des_cus,info_cus.date_book, info_cus.phone_cus,info_worker.name_worker,info_cus.note_book, work_do.sum_chi, work_do.sum_thu,work_do.note_work, info_cus.flag_status,nv_phan,thongtinthem, thanh_toan, info_cus.yc_book, operator_time,info_cus.kind_book, info_cus.phu,info_cus.name_cus FROM work_do , info_cus, info_worker WHERE  info_cus.flag_book = 1 and work_do.id_cus = info_cus.id_cus and work_do.id_worker = info_worker.id_worker and info_cus.date_book like '%$time_search%'  and info_cus.kind_book like '%lanh%' ORDER BY name_worker ASC ";
        $q2 = $conn->query($sql2);
        $q2->setFetchMode(PDO::FETCH_ASSOC);
        $sql3 = "SELECT work_do.id_cus, work_do.id_work,info_cus.add_cus,info_cus.des_cus,info_cus.date_book, info_cus.phone_cus,info_worker.name_worker,info_cus.note_book,work_do.sum_chi, work_do.sum_thu,work_do.note_work, info_cus.flag_status,nv_phan,thongtinthem, thanh_toan, info_cus.yc_book, operator_time,info_cus.kind_book, info_cus.phu,info_cus.name_cus FROM work_do , info_cus, info_worker WHERE  info_cus.flag_book = 1 and work_do.id_cus = info_cus.id_cus and work_do.id_worker = info_worker.id_worker and info_cus.date_book like '%$time_search%'  and info_cus.kind_book like '%go%' ORDER BY name_worker ASC ";
        $q3 = $conn->query($sql3);
        $q3->setFetchMode(PDO::FETCH_ASSOC);

         // Dữ liệu thợ
    $tho= $conn->prepare("select * FROM info_worker where status_worker = 0 and today_off = 0  order by name_worker ASC ");
    $tho->setFetchMode(PDO::FETCH_ASSOC); // set kiểu mảng cho giá trị trả về
    $tho->execute();
    $rs = $tho->fetchAll();

    } catch (PDOException $e){
         die("Could not connect to the database $dbname :" . $e->getMessage());
    }

    if(!isset($q)){
        echo "<h2> Không có dữ liệu</h2>";
        
    }
    else{
        //echo  $time_search . "hôm nay là" ;
        // lich dien nuoc    
        echo "<h3 id='lichDienNuoc'> Lịch Điện Nước</h3> 
            <table class='table table-bordered table-hover'>
                <thead>
                <tr>
                    <th class='col-sm-1'>Nội Dung CV </th>
                    <th class='col-sm-1'>Thời Gian</th>
                    <th class='col-sm-1'>Địa Chỉ </th>
                    <th class='col-sm-1'>Số Điện Thoại</th>
                    <th class='col-sm-1'>Ghi Chú</th>
                    <th class='col-sm-1'>Thợ Làm</th>
                    <th class='col-sm-1'>Trạng Thái</th>
                    <th class='col-sm-1'>Tổng Thu</th>
                    <th class='col-sm-1'>Tổng Chi</th>
                    <th class='col-sm-1'>Phản Hồi</th>
                    <th class='col-sm-2'>Thao Tác</th>
                </tr>
                </thead>
                <tbody>";
                    while ($row = $q->fetch()):
                        echo "<tr>
                                <td>".($row['yc_book'])."</td>
                                <td>".($row['date_book'])." <br> BH: ".$row['operator_time']."</td>
                                <td>".($row['add_cus']." , ".$row['des_cus'])."</td>
                                <td>".($row['phone_cus'])."</td> 
                                <td>".($row['note_book'])."</td>
                                <td>".($row['name_worker'])." + " .$row['phu']."</td>
                                <td>".($row['flag_status'])."</td> 
                                <td>".($row['sum_thu'])."</td>
                                <td>".($row['sum_chi'])."</td>
                                <td>"; 
                                //cham soc kh
                                    if($row['note_work']==NULL){
                                        echo "<button type='button' data-toggle='modal' data-target='#my1".$row['id_cus']."' class='btn btn-danger tooltipButton cls_btn' data-tooltip='Chăm Sóc'>Chăm Sóc</button>";
                                        echo"
                                        <!-- Modal -->
                                        <div id='my1".$row['id_cus']."' class='modal fade' role='dialog'>
                                            <!-- Modal content-->
                                            <div class='modal-content modal_content1'>
                                                <div class='modal-header'>
                                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                    <h3 class='modal-title text-center'>Thông Tin Chăm Sóc Khách Hàng</h3>
                                                </div>
                                                <div class='modal-body'>
                                                    <form action='includes/logic/XL_thu_chi.php' method='POST' class ='form-container'>
                                                        <input type='hidden' name ='id_work' value=".$row['id_work']." >
                                                        <input type='hidden' name ='ki' value='6' >
                                                        <input type='hidden' name ='ac' value='3' >
                                                        
                                                        <input type='hidden'class='form-control' name ='nv' value='".$ruser['real_name']."'>
                                                        <input type='hidden' name ='tentho' value='".$row['name_worker']."'>
                                                        <label for='nameKH'><b>Tên Khách Hàng</b></label>
                                                        <input type='text' class='form-control' name ='nameKH' value='".$row['name_cus']."' readonly>
                                                        <label for='ycKH'><b>Nội Dung CV</b></label>
                                                        <input type='text' class='form-control' name = 'ycKH' value='".$row['yc_book']."' readonly> 
                                                        <label for='telKH'><b>Địa Chỉ</b></label>
                                                        <input type='text' class='form-control' name ='telKH' value='".$row['add_cus']."  ".$row['des_cus']."' readonly>
                                                        <label for='ycKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                        <input type='text' class='form-control'  name ='telKH' value=".$row['phone_cus']." readonly>
                                                        <label for='ycKH'><b>Phản Hồi Của KH</b></label>
                                                        <textarea type='text' class='form-control'  name ='note_work' value='' ></textarea>
                                                        <label for='sumthu'><b>Tổng Thu  : </b></label>
                                                        <input type='text' name='sumthu' value=".$row['sum_thu']." id='sumthu' readonly maxlength='5' maxlength='9'  onkeypress='validate(event)'/>
                                                        <label for='text'><b>Tổng Chi  : </b></label>
                                                        <input type='text' class='form-control' min='1' max='1000000000.00' step='0.01'  name='sumchi' value=".$row['sum_chi']." id='sumchi' readonly>
                                                        <label for='date_book'><b>Tình trạng thanh toán  : </b></label><br>
                                                        <div class='row'>
                                                            <div class='col-md-6 text-center'>
                                                                <label class='check-container1'>Chưa thanh toán</label>
                                                                <input  type='radio'";if($row['thanh_toan']=='1'){echo "checked='checked'";}echo "name='thanh_toan' value='1'>
                                                            </div>
                                                            <div class='col-md-6 text-center'>
                                                                <label class='check-container1'>Đã thanh toán</label>
                                                                <input type='radio'";if($row['thanh_toan']=='0'){echo "checked='checked'";}echo" name='thanh_toan' value='0'>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class='modal-footer modal_footer1'>
                                                    <div class='row'>
                                                        <div class='col-md-6 text-center'><button type='submit' value='submit' class='btn btn-sm btn-success' >Thay Đổi Thông tin</button></div>
                                                        <div class='col-md-6 text-center'><button type='button' class='btn btn-danger' data-dismiss='modal'>Hủy</button></div>
                                                    </div>
                                                </div>
                                                    </form>
                                            </div>
                                        </div>";
                                    }
                                    else{ echo $row['note_work'];}
                                echo "</td><td class='text-center'>";
                                    // btn nhap
                                    echo "<button type='button' data-toggle='modal' data-target='#nhaphtdn".$row['id_cus']."' class='btn btn-success tooltipButton cls_btn' data-tooltip='Nhập'";
                                     if($row['flag_status'] != NULL ){echo "disabled";} 
                                    echo" ><i class='glyphicon glyphicon-import'></i></button>";
                                    echo"
                                    <!-- Modal -->
                                    <div id='nhaphtdn".$row['id_cus']."' class='modal fade' role='dialog'>
                                        <!-- Modal content-->
                                        <div class='modal-content modal_content1' >
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h3 class='modal-title text-center'>Nhập Thông Tin Thu Chi</h3>
                                            </div>
                                            <div class='modal-body'>
                                                <form action='includes/logic/XL_thu_chi.php'   method='POST' class ='form-container'>
                                                    <input type='hidden' name ='id_work' value=".$row['id_work']." >
                                                    <input type='hidden' name ='ki' value='6' > 
                                                    <input type='hidden' name ='ac' value='1' >                                                    
                                                    <input type='hidden' name ='tentho' value='".$row['name_worker']."'>
                                                    <input type='hidden' name ='tentho' value='".$row['name_worker']."'>
                                                    <label for='ycKH'><b>Nội Dung CV</b></label>
                                                    <input type='text' class='form-control' name = 'ycKH' value='".$row['yc_book']."'> 
                                                    <label for='addKH'><b>Địa Chỉ</b></label>
                                                    <input type='text' class='form-control' name ='addKH' value='".$row['add_cus']."  ".$row['des_cus']."' readonly>
                                                    <label for='ycKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                    <input type='text' class='form-control'  name ='telKH' value=".$row['phone_cus']." readonly>
                                                    <div class= 'row'>
                                                        <div class= 'col-md-6'>
                                                            <label for='sumthu'><b>Ngày làm : </b></label>
                                                            <input  class='form-control'type='date' class='form-control' name='date_book' value=" ;echo $row['date_book']." readonly/>
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='sumchi'><b>Bảo Hành  : </b></label>
                                                            <input type='text' class='form-control' name='thogianbh' value=".$row['operator_time']." >
                                                        </div>
                                                    </div>
                                                    <div class= 'row'>
                                                        <div class= 'col-md-6'>
                                                            <label for='sumthu'><b>Tổng Thu  : </b></label>
                                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumthu' value=".$row['sum_thu']." >
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='sumchi'><b>Tổng Chi  : </b></label>
                                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumchi' value=".$row['sum_chi']." >
                                                        </div>
                                                    </div>
                                                    <label for='date_book'><b>Tình trạng thanh toán  : </b></label><br>
                                                    <div class='row'>
                                                        <div class='col-md-6 text-center'>
                                                            <label class='check-container1'>Chưa thanh toán<input type='radio'";if($row['thanh_toan']=='1'){echo "checked='checked'";}echo "name='thanh_toan' value='1'>
                                                        </div>
                                                        <div class='col-md-6 text-center'>
                                                            <label class='check-container1'>Đã thanh toán
                                                            <input type='radio'";if($row['thanh_toan']=='0'){echo "checked='checked'";}echo" name='thanh_toan' value='0'>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class='modal-footer modal_footer1'>
                                                <div class='row'>
                                                    <div class='col-md-6 text-center'><button type='submit' value='submit' class='btn btn-sm btn-success'>Thay Đổi Thông tin</button></div>
                                                    <div class='col-md-6 text-center'><button type='button' class='btn btn-danger' data-dismiss='modal'>Hủy</button></div>
                                                </div>
                                            </div>
                                                </form>
                                        </div>
                                    </div>";
                                    // btn sua
                                    echo "<button type='button' data-toggle='modal' data-target='#suahtdn".$row['id_cus']."'class='btn btn-sm btn-warning tooltipButton cls_btn' data-tooltip='Sửa'";
                                     if($row['flag_status']!= NULL ){echo 'disabled';} echo "><i class='fa fa-pencil' aria-hidden='true'></i></button>";
                                    echo "<!-- Modal -->
                                    <div id='suahtdn".$row['id_cus']."' class='modal fade' role='dialog'>
                                        <!-- Modal content-->
                                        <div class='modal-content modal_content1'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h3 class='modal-title text-center'>Sửa Thông Tin Lịch Điện Nước Đã Hoàn Thành</h3>
                                            </div>
                                            <div class='modal-body'>
                                                <form action='includes/logic/XL_thu_chi.php'   method='POST' class ='form-container'>
                                                    <input type='hidden' name ='id_work' value=".$row['id_work']." >                                                   
                                                    <input type='hidden' name ='id_cus' value=".$row['id_cus']." > 
                                                    <input type='hidden' name ='ki' value='6'>
                                                    <input type='hidden' name ='ac' value='2' >
                                                    <label for='ycKH'><b>Nội Dung CV</b></label>
                                                    <input type='text' class='form-control' name = 'ycKH' value='".$row['yc_book']."'> 
                                                    <label for='telKH'><b>Địa Chỉ</b></label>
                                                    <input  class='form-control'type='text' name ='addKH' value='".$row['add_cus']."  ".$row['des_cus']."' readonly>
                                                    <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                    <input  class='form-control'type='text' name ='telKH' value=".$row['phone_cus']." readonly>
                                                    
                                                    
                                                    <label for='note_book'><b>Ghi Chú Công Việc </b></label>
                                                    <textarea class='form-control' type='text' name='note_work' value='".$row['note_work']."' ></textarea>
                                                    <div class= 'row'>
                                                        <div class= 'col-md-6'>
                                                            <label for='thochinh'><b>Thợ Chính</b></label>
                                                            <input  class='form-control'type='text' class='form-control' name = 'tentho' value='".$row['name_worker']."'> 
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='thophu'><b>Thợ Phụ</b></label>
                                                            <input  class='form-control'type='text' class='form-control' name = 'phu' value='".$row['phu']."'> 
                                                        </div>
                                                    </div> 
                                                    <div class= 'row'>
                                                        <div class= 'col-md-6'>
                                                            <label for='thochinh'><b>Ngày Làm :</b></label>
                                                            <input  class='form-control'type='date' class='form-control' name='date_book' value=" ;echo $row['date_book']." readonly>
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='thophu'><b>Thời Gian Bảo Hành:</b></label>
                                                            <input  class='form-control' type='text' class='form-control' name = 'bh' value='".$row['operator_time']."'> 
                                                        </div>
                                                    </div> 
                                                    <div class= 'row' >
                                                        <div class= 'col-md-6'>
                                                            <label for='sumthu'><b>Tổng Thu  : </b></label>
                                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumthu' value=".$row['sum_thu'].">
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='sumchi'><b>Tổng Chi  : </b></label>
                                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumchi' value=".$row['sum_chi']." >
                                                        </div>
                                                    </div>
                                                    <label for='date_book'><b>Tình trạng thanh toán  : </b></label>
                                                    <div class='row'  style='background-color: #f1f1f1;border-radius:5px;'>
                                                        <div class='col-md-6 text-center'>
                                                            <label class='check-container1'>Chưa thanh toán</label><input type='radio'";if($row['thanh_toan']=='1'){echo" checked='checked'";} echo "name='thanh_toan' value='1'>
                                                        </div>
                                                        <div class='col-md-6 text-center'>
                                                            <label class='check-container1'>Đã thanh toán</label>
                                                            <input type='radio'";if($row['thanh_toan']=='0'){echo "checked='checked'";}echo" name='thanh_toan' value='0'>
                                                        </div>
                                                    </div>
                                                    <label for='date_book'><b>Loại CV: </b></label>
                                                    <div class='row'  style='background-color: #f1f1f1;border-radius:5px;'>
                                                        <div class='col-sm-4 text-center'> 
                                                            <label class='check-container1' >Điện Lạnh</label>
                                                            <input type='radio'"; if($row['kind_book']=='Điện Lạnh'){echo "checked='checked'";} echo "name='kind_book' value='Điện Lạnh'>
                                                        </div>
                                                        <div class='col-sm-4 text-center'>
                                                            <label class='check-container1'>Điện Nước</label>
                                                            <input type='radio'"; if($row['kind_book']=='Điện Nước'){echo "checked='checked'";} echo" name='kind_book' value='Điện Nước'>
                                                        </div>
                                                        <div class='col-sm-4 text-center'>
                                                            <label class='check-container1'>Đồ Gỗ</label>
                                                            <input  type='radio'";if($row['kind_book']=='Đồ Gỗ'){echo "checked='checked'";} echo" name='kind_book' value='Đồ Gỗ'>
                                                        </div> 
                                                    </div>
                                            </div>
                                            <div class='modal-footer modal_footer1'>
                                                <div class='row'>
                                                    <div class='col-md-6 text-center'>
                                                        <button type='submit' value='submit' class='btn btn-sm btn-success'>Thay Đổi Thông tin</button>
                                                    </div>
                                                    <div class='col-md-6 text-center'>
                                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Hủy</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>";
                                    // nhan doi lich 
                                    echo "<button type='button' data-toggle='modal' data-target='#x2htdn".$row['id_cus']."'class='btn btn-sm btn-info tooltipButton cls_btn' data-tooltip='Nhân đôi lịch'><i class='fa fa-copy'></i></button>
                                    <!-- Modal -->
                                    <div id='x2htdn".$row['id_cus']."' class='modal fade' role='dialog'>
                                        <!-- Modal content-->
                                        <div class='modal-content modal_content1' >
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h4 class='modal-title text-center'>Nhân Đôi Lịch Khách Hàng</h4>
                                            </div>
                                            <div class='modal-body'>
                                                <form action='includes/logic/up_tt_KH.php'   method='POST' class ='form-container'>
                                                    <input type='hidden' name ='id_cus' value=".$row['id_cus']." >
                                                    <input type='hidden' name ='action' value='1' >
                                                    <input type='hidden'class='form-control' name ='nv' value='".$ruser['real_name']."'>
                                                    <label for='ycKH'><b>Tên Khách Hàng</b></label>
                                                    <input type='text' class='form-control' name = 'nameKH' value='".$row['name_cus']."'> 
                                                    <label for='ycKH'><b>Nội Dung CV</b></label>
                                                    <input type='text' class='form-control' name = 'ycKH' value='".$row['yc_book']."'> 
                                                    <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                    <input  class='form-control'type='text' name ='telKH' value=".$row['phone_cus']." readonly>
                                                    <div class='row'>
                                                    <div class='col-sm-6 '> 
                                                        <label class='check-container1'>Địa Chỉ Nhà :
                                                        <input  class='form-control'type='text' name ='addKH' value='".$row['add_cus']."' >
                                                        </label>
                                                    </div>
                                                    <div class='col-sm-6 >
                                                        <label class='check-container1'>Quận :
                                                        <input  class='form-control' type='text' name ='desKH' value='".$row['des_cus']."'>
                                                        </label>
                                                    </div>
                                                    </div>
                                                    
                                                    <label for='note_book'><b>Ghi Chú Công Việc </b></label>
                                                    <input class='form-control' type='text' name='note_book' value='".$row['note_book']."' ></input>
                                                    <label for='date_book'><b>Thời gian  : </b></label>
                                                    <input  class='form-control'type='date' class='form-control' name='date_book' value='".$timelive."'>
                                                    <label for='date_book'><b>Loại CV: </b></label>
                                                    <div class='row'>
                                                        <div class='col-sm-4 text-center'> 
                                                            <label class='check-container1'>Điện Lạnh</label>
                                                            <input  type='radio'"; if($row['kind_book']=='Điện Lạnh'){echo "checked='checked'";} echo "name='kind_book' value='Điện Lạnh'>
                                                        </div>
                                                        <div class='col-sm-4 text-center'>
                                                            <label class='check-container1'>Điện Nước</label>
                                                            <input  type='radio'"; if($row['kind_book']=='Điện Nước'){echo "checked='checked'";} echo" name='kind_book' value='Điện Nước'>
                                                        </div>
                                                        <div class='col-sm-4 text-center'>
                                                            <label class='check-container1'>Đồ Gỗ</label> 
                                                            <input  type='radio'";if($row['kind_book']=='Đồ Gỗ'){echo "checked='checked'";} echo" name='kind_book' value='Đồ Gỗ'>  
                                                        </div> 
                                                    </div>
                                            </div>
                                            <div class='modal-footer'>
                                                <div class='row'>
                                                    <div class='col-md-6 text-center modal_footer1'>
                                                        <button type='submit' value='submit' class='btn btn-sm btn-success' >Thay Đổi Thông tin
                                                        </button>
                                                    </div>
                                                    <div class='col-md-6 text-center'>
                                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Hủy</button>
                                                    </div>
                                                </div>
                                            </div>
                                                </form>
                                            </div>
                                        </div>
                                     </div>";
                                    //  btn khao sat 
                                    echo"<a class='btn btn-sm btn-primary cls_btn tooltipButton' data-tooltip='Khảo Sát' "; if($row['flag_status']=='Hủy'|| $row['flag_status']=='Khảo Sát'|| $row['sum_thu']  > 0 ){echo "disabled='disabled'";} echo  " href='".BASE_URL."includes/logic/deleteKH.php?hd=ks&id=".$row['id_cus']."'><i class='fa fa-list-alt'></i></a>";
                                    // btn huy 
                                    echo"<button type='button' class='btn btn-sm btn-warning cls_btn tooltipButton' data-tooltip='Hủy Lịch' data-toggle='modal' data-target='#my5".$row['id_cus']."'"; if($row['flag_status']=='Hủy'||$row['flag_status']=='Khảo Sát'|| $row['sum_thu']  > 0 ){echo 'disabled';} echo "><i class='fa fa-trash' aria-hidden='true'></i></button>
                                    <!-- Modal -->
                                    <div id='my5".$row['id_cus']."' class='modal fade' role='dialog'>
                                        <div class='modal-dialog'>
                                        <!-- Modal content-->
                                        <div class='modal-content'>
                                            <form action='includes/logic/deleteKH.php' method='GET'>
                                                <div class='modal-header'>
                                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                    <h4 class='modal-title'>Nguyên Nhân Hủy</h4>
                                                </div>
                                                <div class='modal-body'>
                                                    <input  class='form-control'type='hidden' name='hd' value='huy'>
                                                    <input  class='form-control'type='hidden' name='id_cus' value='".$row['id_cus']."'>
                                                    <textarea style = 'width:100%' name='nnHuy'></textarea>
                                                </div>
                                                <div class='modal-footer'>
                                                    <input  class='form-control'type='submit' class='btn btn-default' value='Xác Nhận'/>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>                 
                            </td>      
                        </tr>"; endwhile;
                    echo "</tbody>
                </table>";
        //lich dien lanh
        echo "<h3 id='lichDienLanh'> Lịch Điện Lạnh</h3>
            <table class='table table-bordered table-hover'>
            <thead>
            <tr>
                <th class='col-sm-1'>Nội Dung CV </th>
                <th class='col-sm-1'>Thời Gian</th>
                <th class='col-sm-1'>Địa Chỉ </th>
                <th class='col-sm-1'>Số Điện Thoại</th>
                <th class='col-sm-1'>Ghi Chú</th>
                <th class='col-sm-1'>Thợ Làm</th>
                <th class='col-sm-1'>Trạng Thái</th>
                <th class='col-sm-1'>Tổng Thu</th>
                <th class='col-sm-1'>Tổng Chi</th>
                <th class='col-sm-1'>Phản Hồi</th>
                <th class='col-sm-2'>Thao Tác</th>
            </tr>
            </thead>
            <tbody>";
                while ($row2 = $q2->fetch()):
                    echo "<tr>
                            <td>".($row2['yc_book'])."</td>
                            <td>".($row2['date_book'])." => ".$row2['operator_time']."</td>
                            <td>".($row2['add_cus']." , ".$row2['des_cus'])."</td>
                            <td>".($row2['phone_cus'])."</td> 
                            <td>".($row2['note_book'])."</td>
                            <td>".($row2['name_worker'])." + " .$row2['phu']."</td>
                            <td>".($row2['thongtinthem'])."</td> 
                            <td>".($row2['sum_thu'])."</td>
                            <td>".($row2['sum_chi'])."</td>
                            <td>"; 
                            //cham soc kh
                                    if($row2['note_work']==NULL){
                                        echo "<button type='button' data-toggle='modal' data-target='#my1".$row2['id_cus']."' class='btn btn-danger tooltipButton cls_btn' data-tooltip='Chăm Sóc'>Chăm Sóc</button>";
                                        echo"
                                        <!-- Modal -->
                                        <div id='my1".$row2['id_cus']."' class='modal fade' role='dialog'>
                                            <!-- Modal content-->
                                            <div class='modal-content modal_content1'>
                                                <div class='modal-header'>
                                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                    <h3 class='modal-title text-center'>Thông Tin Chăm Sóc Khách Hàng</h3>
                                                </div>
                                                <div class='modal-body'>
                                                    <form action='includes/logic/XL_thu_chi.php' method='POST' class ='form-container'>
                                                        <input type='hidden' name ='id_work' value=".$row2['id_work']." >
                                                        <input type='hidden' name ='ki' value='6' >
                                                        <input type='hidden' name ='ac' value='3' >
                                                        
                                                        <input type='hidden'class='form-control' name ='nv' value='".$ruser['real_name']."'>
                                                        <input type='hidden' name ='tentho' value='".$row2['name_worker']."'>
                                                        <label for='nameKH'><b>Tên Khách Hàng</b></label>
                                                        <input type='text' class='form-control' name ='nameKH' value='".$row2['name_cus']."' readonly>
                                                        <label for='ycKH'><b>Nội Dung CV</b></label>
                                                        <input type='text' class='form-control' name = 'ycKH' value='".$row2['yc_book']."' readonly> 
                                                        <label for='telKH'><b>Địa Chỉ</b></label>
                                                        <input type='text' class='form-control' name ='telKH' value='".$row2['add_cus']."  ".$row2['des_cus']."' readonly>
                                                        <label for='ycKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                        <input type='text' class='form-control'  name ='telKH' value=".$row2['phone_cus']." readonly>
                                                        <label for='ycKH'><b>Phản Hồi Của KH</b></label>
                                                        <textarea type='text' class='form-control'  name ='note_work' value='' ></textarea>
                                                        <label for='sumthu'><b>Tổng Thu  : </b></label>
                                                        <input type='text' class='form-control' min='5' maxlength='9' step='0.01'  name='sumthu' onkeypress='validate(event)' value=".$row2['sum_thu']." id='sumthu' readonly/>
                                                        <label for='text'><b>Tổng Chi  : </b></label>
                                                        <input type='text' class='form-control' min='1' max='1000000000.00' step='0.01'  name='sumchi' value=".$row2['sum_chi']." id='sumchi' readonly>
                                                        <label for='date_book'><b>Tình trạng thanh toán  : </b></label><br>
                                                        <div class='row'>
                                                            <div class='col-md-6 text-center'>
                                                                <label class='check-container1'>Chưa thanh toán</label>
                                                                <input  type='radio'";if($row2['thanh_toan']=='1'){echo "checked='checked'";}echo "name='thanh_toan' value='1'>
                                                            </div>
                                                            <div class='col-md-6 text-center'>
                                                                <label class='check-container1'>Đã thanh toán</label>
                                                                <input type='radio'";if($row2['thanh_toan']=='0'){echo "checked='checked'";}echo" name='thanh_toan' value='0'>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class='modal-footer modal_footer1'>
                                                    <div class='row'>
                                                        <div class='col-md-6 text-center'><button type='submit' value='submit' class='btn btn-sm btn-success' >Thay Đổi Thông tin</button></div>
                                                        <div class='col-md-6 text-center'><button type='button' class='btn btn-danger' data-dismiss='modal'>Hủy</button></div>
                                                    </div>
                                                </div>
                                                    </form>
                                            </div>
                                        </div>";
                                    }
                                    else{ echo $row2['note_work'];}
                                echo "</td><td style='text-align:center'>";
                                    // btn nhap
                                    echo "<button type='button' data-toggle='modal' data-target='#nhaphtdn".$row2['id_cus']."' class='btn btn-success tooltipButton cls_btn' data-tooltip='Nhập'";
                                     if($row2['flag_status'] != NULL ){echo "disabled";} 
                                    echo" ><i class='glyphicon glyphicon-import'></i></button>";
                                    echo"
                                    <!-- Modal -->
                                    <div id='nhaphtdn".$row2['id_cus']."' class='modal fade' role='dialog'>
                                        <!-- Modal content-->
                                        <div class='modal-content modal_content1'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h3 class='modal-title text-center'>Nhập Thông Tin Thu Chi</h3>
                                            </div>
                                            <div class='modal-body'>
                                                <form action='includes/logic/XL_thu_chi.php'   method='POST' class ='form-container'>
                                                    <input type='hidden' name ='id_work' value=".$row2['id_work']." >
                                                    <input type='hidden' name ='ki' value='6' > 
                                                    <input type='hidden' name ='ac' value='1' >                                                    
                                                    <input type='hidden' name ='tentho' value='".$row2['name_worker']."'>
                                                    <input type='hidden' name ='tentho' value='".$row2['name_worker']."'>
                                                    <label for='ycKH'><b>Nội Dung CV</b></label>
                                                    <input type='text' class='form-control' name = 'ycKH' value='".$row2['yc_book']."'> 
                                                    <label for='addKH'><b>Địa Chỉ</b></label>
                                                    <input type='text' class='form-control' name ='addKH' value='".$row2['add_cus']."  ".$row2['des_cus']."' readonly>
                                                    <label for='ycKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                    <input type='text' class='form-control'  name ='telKH' value=".$row2['phone_cus']." readonly>
                                                    <div class= 'row'>
                                                        <div class= 'col-md-6'>
                                                            <label for='sumthu'><b>Ngày làm : </b></label>
                                                            <input  class='form-control'type='date' class='form-control' name='date_book' value=" ;echo $row2['date_book']." readonly/>
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='sumchi'><b>Bảo Hành  : </b></label>
                                                            <input type='text' class='form-control' name='thogianbh' value=".$row2['operator_time']." >
                                                        </div>
                                                    </div>
                                                    <div class= 'row'>
                                                        <div class= 'col-md-6'>
                                                            <label for='sumthu'><b>Tổng Thu  : </b></label>
                                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumthu' value=".$row2['sum_thu']." >
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='sumchi'><b>Tổng Chi  : </b></label>
                                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumchi' value=".$row2['sum_chi']." >
                                                        </div>
                                                    </div>
                                                    <label for='date_book'><b>Tình trạng thanh toán  : </b></label><br>
                                                    <div class='row'>
                                                        <div class='col-md-6 text-center'>
                                                            <label class='check-container1'>Chưa thanh toán<input type='radio'";if($row2['thanh_toan']=='1'){echo "checked='checked'";}echo "name='thanh_toan' value='1'>
                                                        </div>
                                                        <div class='col-md-6 text-center'>
                                                            <label class='check-container1'>Đã thanh toán
                                                            <input type='radio'";if($row2['thanh_toan']=='0'){echo "checked='checked'";}echo" name='thanh_toan' value='0'>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class='modal-footer modal_footer1'>
                                                <div class='row'>
                                                    <div class='col-md-6 text-center'><button type='submit' value='submit' class='btn btn-sm btn-success'>Thay Đổi Thông tin</button></div>
                                                    <div class='col-md-6 text-center'><button type='button' class='btn btn-danger' data-dismiss='modal'>Hủy</button></div>
                                                </div>
                                            </div>
                                                </form>
                                        </div>
                                    </div>";
                                    // btn sua
                                    
                                    echo "<button type='button' data-toggle='modal' data-target='#suahtdn".$row2['id_cus']."'class='btn btn-sm btn-warning tooltipButton cls_btn' data-tooltip='Sửa'";
                                     if($row2['flag_status']!= NULL ){echo 'disabled';} echo "><i class='fa fa-pencil' aria-hidden='true'></i></button>";
                                    echo "<!-- Modal -->
                                    <div id='suahtdn".$row2['id_cus']."' class='modal fade' role='dialog'>
                                        <!-- Modal content-->
                                        <div class='modal-content modal_footer1'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h3 class='modal-title text-center'>Sửa Thông Tin Lịch Điện Nước Đã Hoàn Thành</h3>
                                            </div>
                                            <div class='modal-body'>
                                                <form action='includes/logic/XL_thu_chi.php'   method='POST' class ='form-container'>
                                                    <input type='hidden' name ='id_work' value=".$row2['id_work']." >                                                   
                                                    <input type='hidden' name ='id_cus' value=".$row2['id_cus']." > 
                                                    <input type='hidden' name ='ki' value='6'>
                                                    <input type='hidden' name ='ac' value='2' >
                                                    <label for='ycKH'><b>Nội Dung CV</b></label>
                                                    <input type='text' class='form-control' name = 'ycKH' value='".$row2['yc_book']."'> 
                                                    <label for='telKH'><b>Địa Chỉ</b></label>
                                                    <input  class='form-control'type='text' name ='addKH' value='".$row2['add_cus']."  ".$row2['des_cus']."' readonly>
                                                    <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                    <input  class='form-control'type='text' name ='telKH' value=".$row2['phone_cus']." readonly>
                                                    
                                                    
                                                    <label for='note_book'><b>Ghi Chú Công Việc </b></label>
                                                    <textarea class='form-control' type='text' name='note_work' value='".$row2['note_work']."' ></textarea>
                                                    <div class= 'row'>
                                                        <div class= 'col-md-6'>
                                                            <label for='thochinh'><b>Thợ Chính</b></label>
                                                            <input  class='form-control'type='text' class='form-control' name = 'tentho' value='".$row2['name_worker']."'> 
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='thophu'><b>Thợ Phụ</b></label>
                                                            <input  class='form-control'type='text' class='form-control' name = 'phu' value='".$row2['phu']."'> 
                                                        </div>
                                                    </div> 
                                                    <div class= 'row'>
                                                        <div class= 'col-md-6'>
                                                            <label for='thochinh'><b>Ngày Làm :</b></label>
                                                            <input  class='form-control'type='date' class='form-control' name='date_book' value=" ;echo $row2['date_book']." readonly>
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='thophu'><b>Thời Gian Bảo Hành:</b></label>
                                                            <input  class='form-control' type='text' class='form-control' name = 'bh' value='".$row2['operator_time']."'> 
                                                        </div>
                                                    </div> 
                                                    <div class= 'row' >
                                                        <div class= 'col-md-6'>
                                                            <label for='sumthu'><b>Tổng Thu  : </b></label>
                                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumthu' value=".$row2['sum_thu'].">
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='sumchi'><b>Tổng Chi  : </b></label>
                                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumchi' value=".$row2['sum_chi']." >
                                                        </div>
                                                    </div>
                                                    <label for='date_book'><b>Tình trạng thanh toán  : </b></label>
                                                    <div class='row'  style='background-color: #f1f1f1;border-radius:5px;'>
                                                        <div class='col-md-6 text-center'>
                                                            <label class='check-container1'>Chưa thanh toán</label><input type='radio'";if($row2['thanh_toan']=='1'){echo" checked='checked'";} echo "name='thanh_toan' value='1'>
                                                        </div>
                                                        <div class='col-md-6 text-center'>
                                                            <label class='check-container1'>Đã thanh toán</label>
                                                            <input type='radio'";if($row2['thanh_toan']=='0'){echo "checked='checked'";}echo" name='thanh_toan' value='0'>
                                                        </div>
                                                    </div>
                                                    <label for='date_book'><b>Loại CV: </b></label>
                                                    <div class='row'  style='background-color: #f1f1f1;border-radius:5px;'>
                                                        <div class='col-sm-4 text-center'> 
                                                            <label class='check-container1' >Điện Lạnh</label>
                                                            <input type='radio'"; if($row2['kind_book']=='Điện Lạnh'){echo "checked='checked'";} echo "name='kind_book' value='Điện Lạnh'>
                                                        </div>
                                                        <div class='col-sm-4 text-center'>
                                                            <label class='check-container1'>Điện Nước</label>
                                                            <input type='radio'"; if($row2['kind_book']=='Điện Nước'){echo "checked='checked'";} echo" name='kind_book' value='Điện Nước'>
                                                        </div>
                                                        <div class='col-sm-4 text-center'>
                                                            <label class='check-container1'>Đồ Gỗ</label>
                                                            <input  type='radio'";if($row2['kind_book']=='Đồ Gỗ'){echo "checked='checked'";} echo" name='kind_book' value='Đồ Gỗ'>
                                                        </div> 
                                                    </div>
                                            </div>
                                            <div class='modal-footer modal_footer1'>
                                                <div class='row'>
                                                    <div class='col-md-6 text-center'>
                                                        <button type='submit' value='submit' class='btn btn-sm btn-success'>Thay Đổi Thông tin</button>
                                                    </div>
                                                    <div class='col-md-6 text-center'>
                                                        <button type='button' class='btn btn-danger'data-dismiss='modal'>Hủy</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>";
                                    // nhan doi lich 
                                    echo "<button type='button' data-toggle='modal' data-target='#x2htdn".$row2['id_cus']."'class='btn btn-sm btn-info tooltipButton cls_btn' data-tooltip='Nhân đôi lịch'><i class='fa fa-copy'></i></button>
                                    <!-- Modal -->
                                    <div id='x2htdn".$row2['id_cus']."' class='modal fade' role='dialog'>
                                        <!-- Modal content-->
                                        <div class='modal-content modal_footer1'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h4 class='modal-title text-center'>Nhân Đôi Lịch Khách Hàng</h4>
                                            </div>
                                            <div class='modal-body'>
                                                <form action='includes/logic/up_tt_KH.php'   method='POST' class ='form-container'>
                                                    <input type='hidden' name ='id_cus' value=".$row2['id_cus']." >
                                                    <input type='hidden' name ='action' value='1' >
                                                    <input type='hidden'class='form-control' name ='nv' value='".$ruser['real_name']."'>
                                                    <label for='ycKH'><b>Tên Khách Hàng</b></label>
                                                    <input type='text' class='form-control' name = 'nameKH' value='".$row2['name_cus']."'> 
                                                    <label for='ycKH'><b>Nội Dung CV</b></label>
                                                    <input type='text' class='form-control' name = 'ycKH' value='".$row2['yc_book']."'> 
                                                    <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                    <input  class='form-control'type='text' name ='telKH' value=".$row2['phone_cus']." readonly>
                                                    <div class='row2'>
                                                    <div class='col-sm-6 '> 
                                                        <label class='check-container1'>Địa Chỉ Nhà :
                                                        <input  class='form-control'type='text' name ='addKH' value='".$row2['add_cus']."' >
                                                        </label>
                                                    </div>
                                                    <div class='col-sm-6 >
                                                        <label class='check-container1'>Quận :
                                                        <input  class='form-control' type='text' name ='desKH' value='".$row2['des_cus']."'>
                                                        </label>
                                                    </div>
                                                    </div>
                                                    
                                                    <label for='note_book'><b>Ghi Chú Công Việc </b></label>
                                                    <input class='form-control' type='text' name='note_book' value='".$row2['note_book']."' ></input>
                                                    <label for='date_book'><b>Thời gian  : </b></label>
                                                    <input  class='form-control'type='date' class='form-control' name='date_book' value='".$timelive."'>
                                                    <label for='date_book'><b>Loại CV: </b></label>
                                                    <div class='row'>
                                                        <div class='col-sm-4 text-center'> 
                                                            <label class='check-container1'>Điện Lạnh</label>
                                                            <input  type='radio'"; if($row2['kind_book']=='Điện Lạnh'){echo "checked='checked'";} echo "name='kind_book' value='Điện Lạnh'>
                                                        </div>
                                                        <div class='col-sm-4 text-center'>
                                                            <label class='check-container1'>Điện Nước</label>
                                                            <input  type='radio'"; if($row2['kind_book']=='Điện Nước'){echo "checked='checked'";} echo" name='kind_book' value='Điện Nước'>
                                                        </div>
                                                        <div class='col-sm-4 text-center'>
                                                            <label class='check-container1'>Đồ Gỗ</label> 
                                                            <input  type='radio'";if($row2['kind_book']=='Đồ Gỗ'){echo "checked='checked'";} echo" name='kind_book' value='Đồ Gỗ'>  
                                                        </div> 
                                                    </div>
                                            </div>
                                            <div class='modal-footer modal_footer1'>
                                                <div class='row'>
                                                    <div class='col-md-6 text-center'>
                                                        <button type='submit' value='submit' class='btn btn-sm btn-success'>Thay Đổi Thông tin
                                                        </button>
                                                    </div>
                                                    <div class='col-md-6 text-center'>
                                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Hủy</button>
                                                    </div>
                                                </div>
                                            </div>
                                                </form>
                                            </div>
                                        </div>
                                     </div>";
                                    //  btn khao sat 
                                    echo"<a class='btn btn-sm btn-primary cls_btn tooltipButton' data-tooltip='Khảo Sát' "; if($row2['flag_status']=='Hủy'|| $row2['flag_status']=='Khảo Sát'|| $row2['sum_thu']  > 0 ){echo "disabled='disabled'";} echo  " href='".BASE_URL."includes/logic/deleteKH.php?hd=ks&id=".$row2['id_cus']."'><i class='fa fa-list-alt'></i></a>";
                                    // btn huy 
                                    echo"<button type='button' class='btn btn-sm btn-warning cls_btn tooltipButton' data-tooltip='Hủy Lịch' data-toggle='modal' data-target='#my5".$row2['id_cus']."'"; if($row2['flag_status']=='Hủy'||$row2['flag_status']=='Khảo Sát'|| $row2['sum_thu']  > 0 ){echo 'disabled';} echo "><i class='fa fa-trash' aria-hidden='true'></i></button>
                                    <!-- Modal -->
                                    <div id='my5".$row2['id_cus']."' class='modal fade' role='dialog'>
                                        <div class='modal-dialog'>
                                        <!-- Modal content-->
                                        <div class='modal-content'>
                                            <form action='includes/logic/deleteKH.php' method='GET'>
                                                <div class='modal-header'>
                                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                    <h4 class='modal-title'>Nguyên Nhân Hủy</h4>
                                                </div>
                                                <div class='modal-body'>
                                                    <input  class='form-control'type='hidden' name='hd' value='huy'>
                                                    <input  class='form-control'type='hidden' name='id_cus' value='".$row2['id_cus']."'>
                                                    <textarea style = 'width:100%' name='nnHuy'></textarea>
                                                </div>
                                                <div class='modal-footer'>
                                                    <input  class='form-control'type='submit' class='btn btn-default' value='Xác Nhận'/>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>                 
                            </td>      
                        </tr>"; endwhile;
                    echo "</tbody>
                </table>";
        // lich tho moc
        echo "<h3 id='lichDoGo'> Lịch Thợ Mộc </h3>
                <table class='table table-bordered table-hover'>
                    <thead>
                        <tr>
                            <th class='col-sm-1'>Nội Dung CV </th>
                            <th class='col-sm-1'>Thời Gian</th>
                            <th class='col-sm-1'>Địa Chỉ </th>
                            <th class='col-sm-1'>Số Điện Thoại</th>
                            <th class='col-sm-1'>Ghi Chú</th>
                            <th class='col-sm-1'>Thợ Làm</th>
                            <th class='col-sm-1'>Trạng Thái</th>
                            <th class='col-sm-1'>Tổng Thu</th>
                            <th class='col-sm-1'>Tổng Chi</th>
                            <th class='col-sm-1'>Phản Hồi</th>
                            <th class='col-sm-2'>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>";
                    while ($row3 = $q3->fetch()):
                        echo "<tr>
                                <td>".($row3['yc_book'])."</td>
                                <td>".($row3['date_book'])." => ".$row3['operator_time']."</td>
                                <td>".($row3['add_cus']." , ".$row3['des_cus'])."</td>
                                <td>".($row3['phone_cus'])."</td> 
                                <td>".($row3['note_book'])."</td>
                                <td>".($row3['name_worker'])." + " .$row3['phu']."</td>
                                <td>".($row3['thongtinthem'])."</td> 
                                <td>".($row3['sum_thu'])."</td>
                                <td>".($row3['sum_chi'])."</td>
                                <td>"; 
                                //chắm sóc KH
                                    if($row3['note_work']==NULL){
                                        echo "<button type='button' data-toggle='modal' data-target='#my1".$row3['id_cus']."' class='btn btn-danger tooltipButton cls_btn' data-tooltip='Chăm Sóc'>Chăm Sóc</button>";
                                        echo"
                                        <!-- Modal -->
                                        <div id='my1".$row3['id_cus']."' class='modal fade' role='dialog'>
                                            <!-- Modal content-->
                                            <div class='modal-content modal_content1' >
                                                <div class='modal-header'>
                                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                    <h3 class='modal-title text-center'>Thông Tin Chăm Sóc Khách Hàng</h3>
                                                </div>
                                                <div class='modal-body'>
                                                    <form action='includes/logic/XL_thu_chi.php' method='POST' class ='form-container'>
                                                        <input type='hidden' name ='id_work' value=".$row3['id_work']." >
                                                        <input type='hidden' name ='ki' value='6' >
                                                        <input type='hidden' name ='ac' value='3' >
                                                        
                                                        <input type='hidden'class='form-control' name ='nv' value='".$ruser['real_name']."'>
                                                        <input type='hidden' name ='tentho' value='".$row3['name_worker']."'>
                                                        <label for='nameKH'><b>Tên Khách Hàng</b></label>
                                                        <input type='text' class='form-control' name ='nameKH' value='".$row3['name_cus']."' readonly>
                                                        <label for='ycKH'><b>Nội Dung CV</b></label>
                                                        <input type='text' class='form-control' name = 'ycKH' value='".$row3['yc_book']."' readonly> 
                                                        <label for='telKH'><b>Địa Chỉ</b></label>
                                                        <input type='text' class='form-control' name ='telKH' value='".$row3['add_cus']."  ".$row3['des_cus']."' readonly>
                                                        <label for='ycKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                        <input type='text' class='form-control'  name ='telKH' value=".$row3['phone_cus']." readonly>
                                                        <label for='ycKH'><b>Phản Hồi Của KH</b></label>
                                                        <textarea type='text' class='form-control'  name ='note_work' value='' ></textarea>
                                                        <label for='sumthu'><b>Tổng Thu  : </b></label>
                                                        <input type='text' class='form-control' min='1' max='1000000000.00' step='0.01'  name='sumthu' value=".$row3['sum_thu']." id='sumthu' readonly/>
                                                        <label for='text'><b>Tổng Chi  : </b></label>
                                                        <input type='text' class='form-control' min='1' max='1000000000.00' step='0.01'  name='sumchi' value=".$row3['sum_chi']." id='sumchi' readonly>
                                                        <label for='date_book'><b>Tình trạng thanh toán  : </b></label><br>
                                                        <div class='row'>
                                                            <div class='col-md-6 text-center'>
                                                                <label class='check-container1'>Chưa thanh toán</label>
                                                                <input  type='radio'";if($row3['thanh_toan']=='1'){echo "checked='checked'";}echo "name='thanh_toan' value='1'>
                                                            </div>
                                                            <div class='col-md-6 text-center'>
                                                                <label class='check-container1'>Đã thanh toán</label>
                                                                <input type='radio'";if($row3['thanh_toan']=='0'){echo "checked='checked'";}echo" name='thanh_toan' value='0'>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class='modal-footer modal_footer1'>
                                                    <div class='row'>
                                                        <div class='col-md-6 text-center'><button type='submit' value='submit' class='btn btn-sm btn-success'>Thay Đổi Thông tin</button></div>
                                                        <div class='col-md-6 text-center'><button type='button' class='btn btn-danger' data-dismiss='modal'>Hủy</button></div>
                                                    </div>
                                                </div>
                                                    </form>
                                            </div>
                                        </div>";
                                    }
                                    else{ echo $row3['note_work'];}
                                echo "</td><td style='text-align:center'>";
                                    // btn nhap
                                    echo "<button type='button' data-toggle='modal' data-target='#nhaphtdn".$row3['id_cus']."' class='btn btn-success tooltipButton cls_btn' data-tooltip='Nhập'";
                                     if($row3['flag_status'] != NULL ){echo "disabled";} 
                                    echo" ><i class='glyphicon glyphicon-import'></i></button>";
                                    echo"
                                    <!-- Modal -->
                                    <div id='nhaphtdn".$row3['id_cus']."' class='modal fade' role='dialog'>
                                        <!-- Modal content-->
                                        <div class='modal-content modal_content1'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h3 class='modal-title text-center'>Nhập Thông Tin Thu Chi</h3>
                                            </div>
                                            <div class='modal-body'>
                                                <form action='includes/logic/XL_thu_chi.php'   method='POST' class ='form-container'>
                                                    <input type='hidden' name ='id_work' value=".$row3['id_work']." >
                                                    <input type='hidden' name ='ki' value='6' > 
                                                    <input type='hidden' name ='ac' value='1' >                                                    
                                                    <input type='hidden' name ='tentho' value='".$row3['name_worker']."'>
                                                    <input type='hidden' name ='tentho' value='".$row3['name_worker']."'>
                                                    <label for='ycKH'><b>Nội Dung CV</b></label>
                                                    <input type='text' class='form-control' name = 'ycKH' value='".$row3['yc_book']."'> 
                                                    <label for='addKH'><b>Địa Chỉ</b></label>
                                                    <input type='text' class='form-control' name ='addKH' value='".$row3['add_cus']."  ".$row3['des_cus']."' readonly>
                                                    <label for='ycKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                    <input type='text' class='form-control'  name ='telKH' value=".$row3['phone_cus']." readonly>
                                                    <div class= 'row3'>
                                                        <div class= 'col-md-6'>
                                                            <label for='sumthu'><b>Ngày làm : </b></label>
                                                            <input  class='form-control'type='date' class='form-control' name='date_book' value=" ;echo $row3['date_book']." readonly/>
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='sumchi'><b>Bảo Hành  : </b></label>
                                                            <input type='text' class='form-control' name='thogianbh' value=".$row3['operator_time']." >
                                                        </div>
                                                    </div>
                                                    <div class= 'row'>
                                                        <div class= 'col-md-6'>
                                                            <label for='sumthu'><b>Tổng Thu  : </b></label>
                                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumthu' value=".$row3['sum_thu']." >
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='sumchi'><b>Tổng Chi  : </b></label>
                                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumchi' value=".$row3['sum_chi']." >
                                                        </div>
                                                    </div>
                                                    <label for='date_book'><b>Tình trạng thanh toán  : </b></label><br>
                                                    <div class='row'>
                                                        <div class='col-md-6 text-center'>
                                                            <label class='check-container1'>Chưa thanh toán<input type='radio'";if($row3['thanh_toan']=='1'){echo "checked='checked'";}echo "name='thanh_toan' value='1'>
                                                        </div>
                                                        <div class='col-md-6 text-center'>
                                                            <label class='check-container1'>Đã thanh toán
                                                            <input type='radio'";if($row3['thanh_toan']=='0'){echo "checked='checked'";}echo" name='thanh_toan' value='0'>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class='modal-footer modal_footer1'>
                                                <div class='row'>
                                                    <div class='col-md-6 text-center'><button type='submit' value='submit' class='btn btn-sm btn-success' >Thay Đổi Thông tin</button></div>
                                                    <div class='col-md-6 text-center'><button type='button' class='btn btn-danger' data-dismiss='modal'>Hủy</button></div>
                                                </div>
                                            </div>
                                                </form>
                                        </div>
                                    </div>";
                                    // btn sua
                                    
                                    echo "<button type='button' data-toggle='modal' data-target='#suahtdn".$row3['id_cus']."'class='btn btn-sm btn-warning tooltipButton cls_btn' data-tooltip='Sửa'";
                                     if($row3['flag_status']!= NULL ){echo 'disabled';} echo "><i class='fa fa-pencil' aria-hidden='true'></i></button>";
                                    echo "<!-- Modal -->
                                    <div id='suahtdn".$row3['id_cus']."' class='modal fade' role='dialog'>
                                        <!-- Modal content-->
                                        <div class='modal-content modal_content1'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h3 class='modal-title text-center'>Sửa Thông Tin Lịch Điện Nước Đã Hoàn Thành</h3>
                                            </div>
                                            <div class='modal-body'>
                                                <form action='includes/logic/XL_thu_chi.php'   method='POST' class ='form-container'>
                                                    <input type='hidden' name ='id_work' value=".$row3['id_work']." >                                                   
                                                    <input type='hidden' name ='id_cus' value=".$row3['id_cus']." > 
                                                    <input type='hidden' name ='ki' value='6'>
                                                    <input type='hidden' name ='ac' value='2' >
                                                    <label for='ycKH'><b>Nội Dung CV</b></label>
                                                    <input type='text' class='form-control' name = 'ycKH' value='".$row3['yc_book']."'> 
                                                    <label for='telKH'><b>Địa Chỉ</b></label>
                                                    <input  class='form-control'type='text' name ='addKH' value='".$row3['add_cus']."  ".$row3['des_cus']."' readonly>
                                                    <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                    <input  class='form-control'type='text' name ='telKH' value=".$row3['phone_cus']." readonly>
                                                    
                                                    
                                                    <label for='note_book'><b>Ghi Chú Công Việc </b></label>
                                                    <textarea class='form-control' type='text' name='note_work' value='".$row3['note_work']."' ></textarea>
                                                    <div class= 'row'>
                                                        <div class= 'col-md-6'>
                                                            <label for='thochinh'><b>Thợ Chính</b></label>
                                                            <input  class='form-control'type='text' class='form-control' name = 'tentho' value='".$row3['name_worker']."'> 
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='thophu'><b>Thợ Phụ</b></label>
                                                            <input  class='form-control'type='text' class='form-control' name = 'phu' value='".$row3['phu']."'> 
                                                        </div>
                                                    </div> 
                                                    <div class= 'row3'>
                                                        <div class= 'col-md-6'>
                                                            <label for='thochinh'><b>Ngày Làm :</b></label>
                                                            <input  class='form-control'type='date' class='form-control' name='date_book' value=" ;echo $row3['date_book']." readonly>
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='thophu'><b>Thời Gian Bảo Hành:</b></label>
                                                            <input  class='form-control' type='text' class='form-control' name = 'bh' value='".$row3['operator_time']."'> 
                                                        </div>
                                                    </div> 
                                                    <div class= 'row' >
                                                        <div class= 'col-md-6'>
                                                            <label for='sumthu'><b>Tổng Thu  : </b></label>
                                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumthu' value=".$row3['sum_thu'].">
                                                        </div> 
                                                        <div class= 'col-md-6'>
                                                            <label for='sumchi'><b>Tổng Chi  : </b></label>
                                                            <input type='text' class='form-control' min='0.00' max='1000000000.00' step='0.01'  name='sumchi' value=".$row3['sum_chi']." >
                                                        </div>
                                                    </div>
                                                    <label for='date_book'><b>Tình trạng thanh toán  : </b></label>
                                                    <div class='row'  style='background-color: #f1f1f1;border-radius:5px;'>
                                                        <div class='col-md-6 text-center'>
                                                            <label class='check-container1'>Chưa thanh toán</label><input type='radio'";if($row3['thanh_toan']=='1'){echo" checked='checked'";} echo "name='thanh_toan' value='1'>
                                                        </div>
                                                        <div class='col-md-6 text-center'>
                                                            <label class='check-container1'>Đã thanh toán</label>
                                                            <input type='radio'";if($row3['thanh_toan']=='0'){echo "checked='checked'";}echo" name='thanh_toan' value='0'>
                                                        </div>
                                                    </div>
                                                    <label for='date_book'><b>Loại CV: </b></label>
                                                    <div class='row'  style='background-color: #f1f1f1;border-radius:5px;'>
                                                        <div class='col-sm-4 text-center'> 
                                                            <label class='check-container1' >Điện Lạnh</label>
                                                            <input type='radio'"; if($row3['kind_book']=='Điện Lạnh'){echo "checked='checked'";} echo "name='kind_book' value='Điện Lạnh'>
                                                        </div>
                                                        <div class='col-sm-4 text-center'>
                                                            <label class='check-container1'>Điện Nước</label>
                                                            <input type='radio'"; if($row3['kind_book']=='Điện Nước'){echo "checked='checked'";} echo" name='kind_book' value='Điện Nước'>
                                                        </div>
                                                        <div class='col-sm-4 text-center'>
                                                            <label class='check-container1'>Đồ Gỗ</label>
                                                            <input  type='radio'";if($row3['kind_book']=='Đồ Gỗ'){echo "checked='checked'";} echo" name='kind_book' value='Đồ Gỗ'>
                                                        </div> 
                                                    </div>
                                            </div>
                                            <div class='modal-footer modal_footer1'>
                                                <div class='row'>
                                                    <div class='col-md-6 text-center'>
                                                        <button type='submit' value='submit' class='btn btn-sm btn-success'>Thay Đổi Thông tin</button>
                                                    </div>
                                                    <div class='col-md-6 text-center'>
                                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Hủy</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>";
                                    // nhan doi lich 
                                    echo "<button type='button' data-toggle='modal' data-target='#x2htdn".$row3['id_cus']."'class='btn btn-sm btn-info tooltipButton cls_btn' data-tooltip='Nhân đôi lịch'><i class='fa fa-copy'></i></button>
                                    <!-- Modal -->
                                    <div id='x2htdn".$row3['id_cus']."' class='modal fade' role='dialog'>
                                        <!-- Modal content-->
                                        <div class='modal-content modal_content1'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h4 class='modal-title text-center'>Nhân Đôi Lịch Khách Hàng</h4>
                                            </div>
                                            <div class='modal-body'>
                                                <form action='includes/logic/up_tt_KH.php'   method='POST' class ='form-container'>
                                                    <input type='hidden' name ='id_cus' value=".$row3['id_cus']." >
                                                    <input type='hidden' name ='action' value='1' >
                                                    <input type='hidden'class='form-control' name ='nv' value='".$ruser['real_name']."'>
                                                    <label for='ycKH'><b>Tên Khách Hàng</b></label>
                                                    <input type='text' class='form-control' name = 'nameKH' value='".$row3['name_cus']."'> 
                                                    <label for='ycKH'><b>Nội Dung CV</b></label>
                                                    <input type='text' class='form-control' name = 'ycKH' value='".$row3['yc_book']."'> 
                                                    <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                    <input  class='form-control'type='text' name ='telKH' value=".$row3['phone_cus']." readonly>
                                                    <div class='row'>
                                                    <div class='col-sm-6 '> 
                                                        <label class='check-container1'>Địa Chỉ Nhà :
                                                        <input  class='form-control'type='text' name ='addKH' value='".$row3['add_cus']."' >
                                                        </label>
                                                    </div>
                                                    <div class='col-sm-6 >
                                                        <label class='check-container1'>Quận :
                                                        <input  class='form-control' type='text' name ='desKH' value='".$row3['des_cus']."'>
                                                        </label>
                                                    </div>
                                                    </div>
                                                    
                                                    <label for='note_book'><b>Ghi Chú Công Việc </b></label>
                                                    <input class='form-control' type='text' name='note_book' value='".$row3['note_book']."' ></input>
                                                    <label for='date_book'><b>Thời gian  : </b></label>
                                                    <input  class='form-control'type='date' class='form-control' name='date_book' value='".$timelive."'>
                                                    <label for='date_book'><b>Loại CV: </b></label>
                                                    <div class='row3'>
                                                        <div class='col-sm-4 text-center'> 
                                                            <label class='check-container1'>Điện Lạnh</label>
                                                            <input  type='radio'"; if($row3['kind_book']=='Điện Lạnh'){echo "checked='checked'";} echo "name='kind_book' value='Điện Lạnh'>
                                                        </div>
                                                        <div class='col-sm-4 text-center'>
                                                            <label class='check-container1'>Điện Nước</label>
                                                            <input  type='radio'"; if($row3['kind_book']=='Điện Nước'){echo "checked='checked'";} echo" name='kind_book' value='Điện Nước'>
                                                        </div>
                                                        <div class='col-sm-4 text-center'>
                                                            <label class='check-container1'>Đồ Gỗ</label> 
                                                            <input  type='radio'";if($row3['kind_book']=='Đồ Gỗ'){echo "checked='checked'";} echo" name='kind_book' value='Đồ Gỗ'>  
                                                        </div> 
                                                    </div>
                                            </div>
                                            <div class='modal-footer modal_footer1'>
                                                <div class='row'>
                                                    <div class='col-md-6 text-center'>
                                                        <button type='submit' value='submit' class='btn btn-sm btn-success'>Thay Đổi Thông tin
                                                        </button>
                                                    </div>
                                                    <div class='col-md-6 text-center'>
                                                        <button type='button' class='btn btn-danger'' data-dismiss='modal'>Hủy</button>
                                                    </div>
                                                </div>
                                            </div>
                                                </form>
                                            </div>
                                        </div>
                                     </div>";
                                    //  btn khao sat 
                                    echo"<a class='btn btn-sm btn-primary cls_btn tooltipButton' data-tooltip='Khảo Sát' "; if($row3['flag_status']=='Hủy'|| $row3['flag_status']=='Khảo Sát'|| $row3['sum_thu']  > 0 ){echo "disabled='disabled'";} echo  " href='".BASE_URL."includes/logic/deleteKH.php?hd=ks&id=".$row3['id_cus']."'><i class='fa fa-list-alt'></i></a>";
                                    // btn huy 
                                    echo"<button type='button' class='btn btn-sm btn-warning cls_btn tooltipButton' data-tooltip='Hủy Lịch' data-toggle='modal' data-target='#my5".$row3['id_cus']."'"; if($row3['flag_status']=='Hủy'||$row3['flag_status']=='Khảo Sát'|| $row3['sum_thu']  > 0 ){echo 'disabled';} echo "><i class='fa fa-trash' aria-hidden='true'></i></button>
                                    <!-- Modal -->
                                    <div id='my5".$row3['id_cus']."' class='modal fade' role='dialog'>
                                        <div class='modal-dialog'>
                                        <!-- Modal content-->
                                        <div class='modal-content'>
                                            <form action='includes/logic/deleteKH.php' method='GET'>
                                                <div class='modal-header'>
                                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                    <h4 class='modal-title'>Nguyên Nhân Hủy</h4>
                                                </div>
                                                <div class='modal-body'>
                                                    <input  class='form-control'type='hidden' name='hd' value='huy'>
                                                    <input  class='form-control'type='hidden' name='id_cus' value='".$row3['id_cus']."'>
                                                    <textarea style = 'width:100%' name='nnHuy'></textarea>
                                                </div>
                                                <div class='modal-footer'>
                                                    <input  class='form-control'type='submit' class='btn btn-default' value='Xác Nhận'/>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>               
                            </td>      
                        </tr>"; endwhile;
                    echo "</tbody>
                </table>";
}?>