<?php 
    
    
    try {

        // Đổ dữ liệu lịch
        $sqlc = "SELECT id_cus,name_cus, phone_cus, add_cus, des_cus, yc_book, note_book, kind_book, date_book , nv_add
        FROM info_cus where kind_book like '%gỗ%' and  flag_book = '0' and date_book like '%$time_search%' and flag_status is NULL order by id_cus DESC";  
        $qc = $conn->query($sqlc);
        $qc->setFetchMode(PDO::FETCH_ASSOC);
    
        // Dữ liệu thợ
        $tho= $conn->prepare("select * FROM info_worker where status_worker = 0 and today_off = 0  order by name_worker ASC ");
        $tho->setFetchMode(PDO::FETCH_ASSOC); // set kiểu mảng cho giá trị trả về
        $tho->execute();
        $rs = $tho->fetchAll();
        
        // đổ toàn bộ dự liệu thu về vào mảng
        $sql = "SELECT info_cus.id_cus,info_cus.name_cus, info_cus.phone_cus,info_cus.add_cus, info_cus.des_cus,info_cus.yc_book, info_cus.note_book,info_worker.name_worker,info_cus.date_book, work_do.id_work, nv_phan, phu, sum_thu, sum_chi, thongtinthem, note_work, thanh_toan FROM work_do,info_worker,info_cus WHERE  info_cus.date_book like '%$timelive%'and work_do.id_worker = info_worker.id_worker and work_do.id_cus = info_cus.id_cus and info_cus.kind_book like '%gỗ%'
        and info_cus.flag_book = '1' and  work_do.sum_thu = '0'and info_cus.flag_status is NULL ORDER BY info_worker.name_worker ASC ";
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if(empty($q))
        {
            $sql = "SELECT info_cus.id_cus,info_cus.name_cus, info_cus.phone_cus,info_cus.add_cus, info_cus.des_cus,info_cus.yc_book, info_cus.note_book,
                info_worker.name_worker,info_cus.date_book, work_do.id_work, nv_phan,phu FROM work_do,info_worker,info_cus 
                WHERE  work_do.sum_thu = 0 and work_do.id_worker = info_worker.id_worker and work_do.id_cus = info_cus.id_cus and info_cus.kind_book like '%gỗ%'
                and info_cus.flag_book = '1' order by info_worker.name_worker ASC";
                
            $q = $conn->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
        }
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
echo "
<div class='container-fluid>
    <div class='row'>
        <div class = 'col-xl-6 col-lg-6 col-md-6 col-sm-12 col_left'>
            <h3 id='lichDoGo' class='lichXL'>Lịch Đồ Gỗ Chưa Xử Lý</h3>
            <table class='table table-bordered table-hover'>
                <thead>
                    <tr>
                        <th class='col-md-2'>Thông Tin</th>
                        <th class='col-md-1'>Tên KH</th>
                        <th class='col-md-2'>Địa Chỉ</th>
                        <th class='col-md-1'>Quận</th>
                        <th class='col-md-1'>Số Điện Thoại</th>
                        <th class='col-md-1' >Ghi chú</th>
                        <th class='col-md-2'>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>";
                while ($row3 = $q3->fetch()):
                    echo "
                        <tr>
                            <td >".htmlspecialchars($row3['yc_book'])."</td>
                                <td >".htmlspecialchars($row3['name_cus'])."</td>
                                <td >".htmlspecialchars($row3['add_cus'])."</td>
                                <td >".htmlspecialchars($row3['des_cus'])."</td>
                                <td >".htmlspecialchars($row3['phone_cus'])."</td>
                                <td>"; if($row3['note_book']==null){
                                    // code 
                                }else{
                                    echo "<p class='tooltipButton text-center' data-width='ghi_Chu' data-tooltip='".$row3['note_book']."'>Xem Thêm</p>";
                                }
                            echo "</td>
                                <td>
                                    <button type='button' class='btn btn-info btn-sm tooltipButton cls_btn' data-tooltip='Phân Lịch' data-toggle='modal' data-target='#phantho".$row3['id_cus']."' ><i class='fa fa-plus'></i></button>
                                    <!-- Modal -->
                                    <div id='phantho".$row3['id_cus']."' class='modal fade' role='dialog'>
                                    <div class='row'>
                                        <div class='modal-dialog'>
                                            <!-- Modal content-->
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                    <h4 class='modal-title'>Chọn Thợ Bạn Muốn phân</h4>
                                                </div>
                                                <div class='modal-body'>
                                                    <form action='includes/logic/XL_phan_lich.php' method='POST' class='hop'>
                                                        <label>Chọn Thợ cần Phân :</label>
                                                        <input type='hidden' name='ac' value='phantho' />
                                                        <input type='hidden' name='ki' value='3' />
                                                        <input type='hidden' name='nv' value='".$ruser['real_name']."'/>
                                                        <input type='hidden' name='id_cus' value='".$row3['id_cus']."'/>
                                                        <input type='hidden' name='note' value='".htmlspecialchars($row3['note_book'])."'/>
                                                        <select name='name_worker'>";
                                                foreach ($rs as $row1) {
                                                    echo '<option>';
                                                    echo $row1['name_worker'] . ' ';
                                                    echo $row1['add_worker'] . ' ';
                                                    echo $row1['id_worker']." ";
                                                    echo '</option>';
                                                    }  
                                                echo "</select>
                                                        <br>
                                                        <label>Chọn Thợ phụ nếu cần  :</label>
                                                        <textarea style='width: 100%; hight:120px;' name='phu'></textarea>
                                                </div>
                                                <div class='modal-footer'>
                                                    <input type='submit' value='Xác Nhận' class='btn btn-success' /> <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                                    // Gap doi lich da dat 
                                echo"
                                <button type='button' data-toggle='modal' data-target='#my2".$row3['id_cus']."'class='btn btn-sm btn-info tooltipButton cls_btn' data-tooltip='Nhân đôi lịch'><i class='fa fa-copy'></i></button>
                                <!-- Modal -->
                                <div id='my2".$row3['id_cus']."' class='modal fade' role='dialog'>
                                    <!-- Modal content-->
                                    <div class='modal-content modal_content1' >
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h4 class='modal-title text-center'>Nhân Đôi Lịch Khách Hàng</h4>
                                            </div>
                                            <div class='modal-body'>
                                            <form action='includes/logic/up_tt_KH.php'   method='POST' class ='form-container'>
                                                <input type='hidden' class='form-control' name ='id_cus' value='".$row3['id_cus']."'>
                                                <input type='hidden'class='form-control' name ='nv' value='".$ruser['real_name']."'>
                                                <input type='hidden'class='form-control' name ='action' value='1'>
                                                <label for='nameKH'><b>Tên Khách Hàng</b></label>
                                                <input type='text' class='form-control' name ='nameKH' value='".$row3['name_cus']."' >
                                                <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
                                                <input type='text' class='form-control' name='addKH' value='".$row3['add_cus']."' >
                                                <label for='desKH'><b>Quận</b></label>
                                                <input type='text' class='form-control' name= 'desKH' value='".$row3['des_cus']."' >
                                                <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                <input type='text' class='form-control' name ='telKH' value='".$row3['phone_cus']."' >
                                                <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
                                                <input type='text' class='form-control' name = 'ycKH' value='".$row3['yc_book']."'>  
                                                <label for='note_book'><b>Ghi Chú Công Việc </b></label>
                                                <textarea class='form-control' type='text' name='note_book' value='".$row3['note_book']."' ></textarea>
                                                <label for='date_book'><b>Thời gian  : </b></label>
                                                <input type='date' class='form-control' name='date_book' value=" ;echo $row3['date_book']."><br>
                                                <label for='date_book'><b>Loại CV: </b></label>
                                                <div class='row'>
                                                    <div class='col-sm-4 text-center'> 
                                                        <label class='check-container1'>Điện Lạnh
                                                            <input type='radio'"; if($row3['kind_book']=='Điện Lạnh'){echo "checked='checked'";} echo "name='kind_book' value='Điện Lạnh'>
                                                        </label>
                                                    </div>
                                                    <div class='col-sm-4 text-center'>
                                                        <label class='check-container1'>Điện Nước
                                                            <input type='radio'"; if($row3['kind_book']=='Điện Nước'){echo "checked='checked'";} echo" name='kind_book' value='Điện Nước'>
                                                        </label>
                                                    </div>
                                                    <div class='col-sm-4 text-center'>
                                                        <label class='check-container1'>Đồ Gỗ
                                                            <input type='radio'";if($row3['kind_book']=='Đồ Gỗ'){echo "checked='checked'";} echo" name='kind_book' value='Đồ Gỗ'>
                                                        </label>   
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
                                </div>
                                "; 
                                // ket thuc gap doi lich da dat
                                // sua thong tin lich KH 
                                echo"
                                <button type='button' data-toggle='modal' data-target='#my1".$row3['id_cus']."'class='btn btn-sm btn-success tooltipButton cls_btn' data-tooltip='Sửa'><i class='fa fa-pencil' aria-hidden='true'></i></button>
                                <!-- Modal -->
                                <div id='my1".$row3['id_cus']."' class='modal fade' role='dialog'>
                                    <!-- Modal content-->
                                    <div class='modal-content modal_content1'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h4 class='modal-title text-center'>Sửa Thông Tin Lịch Khách Hàng</h4>
                                            </div>
                                            <div class='modal-body'>
                                            <form action='includes/logic/up_tt_KH.php'   method='POST' class ='form-container'>
                                                <input type='hidden' class='form-control' name ='id_cus' value='".$row3['id_cus']."'>
                                                <input type='hidden'class='form-control' name ='nv' value='".$ruser['real_name']."'>
                                                <input type='hidden'class='form-control' name ='action' value='0'>
                                                <label for='nameKH'><b>Tên Khách Hàng</b></label>
                                                <input type='text' class='form-control' name ='nameKH' value='".$row3['name_cus']."' >
                                                <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
                                                <input type='text' class='form-control' name='addKH' value='".$row3['add_cus']."' >
                                                <label for='desKH'><b>Quận</b></label>
                                                <input type='text' class='form-control' name= 'desKH' value='".$row3['des_cus']."' >
                                                <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                <input type='text' class='form-control' name ='telKH' value='".$row3['phone_cus']."' >
                                                <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
                                                <input type='text' class='form-control' name = 'ycKH' value='".$row3['yc_book']."'>  
                                                <label for='note_book'><b>Ghi Chú Công Việc </b></label>
                                                <textarea class='form-control' type='text' name='note_book' value='".$row3['note_book']."' ></textarea>
                                                <label for='date_book'><b>Thời gian  : </b></label>
                                                <input type='date' class='form-control' name='date_book' value=" ;echo $row3['date_book']."><br>
                                                <label for='date_book'><b>Loại CV: </b></label>
                                                <div class='row'>
                                                    <div class='col-sm-4 text-center'> 
                                                        <label class='check-container1'>Điện Lạnh
                                                            <input type='radio'"; if($row3['kind_book']=='Điện Lạnh'){echo "checked='checked'";} echo "name='kind_book' value='Điện Lạnh'>
                                                        </label>
                                                    </div>
                                                    <div class='col-sm-4 text-center'>
                                                        <label class='check-container1'>Điện Nước
                                                            <input type='radio'"; if($row3['kind_book']=='Điện Nước'){echo "checked='checked'";} echo" name='kind_book' value='Điện Nước'>
                                                        </label>
                                                    </div>
                                                    <div class='col-sm-4 text-center'>
                                                        <label class='check-container1'>Đồ Gỗ
                                                            <input type='radio'";if($row3['kind_book']=='Đồ Gỗ'){echo "checked='checked'";} echo" name='kind_book' value='Đồ Gỗ'>
                                                        </label>   
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class='modal-footer modal_content1'>
                                                <div class='row'>
                                                    <div class='col-md-6 text-center'><button type='submit' value='submit' class='btn btn-sm btn-success'>Thay Đổi Thông tin</button></div>
                                                    <div class='col-md-6 text-center'><button type='button' class='btn btn-danger' data-dismiss='modal'>Hủy</button></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                "; 
                                // ket thuc sua thong tin lich 
                                    echo"
                                    <button type='button' class='btn btn-sm btn-danger tooltipButton cls_btn' data-tooltip='Hủy Lịch' data-toggle='modal' data-target='#my".$row3['id_cus']."'><i class='fa fa-trash' aria-hidden='true'></i></button>
        
                                          <!-- Modal -->
                                          <div id='my".$row3['id_cus']."' class='modal fade' role='dialog'>
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
                                                      <input type='hidden' name='id_cus' value='".$row3['id_cus']."'>
                                                     <textarea style = 'width:100%' name='nnHuy' required></textarea>
                                                  </div>
        
                                                  <div class='modal-footer'>
                                                      <input type='submit' class='btn btn-default' value='Xác Nhận'/>
                                                  </div>
                                              </form>
                                              </div>
        
                                          </div>
                                          </div>
                          </td>
                   </tr>";
                           endwhile;
                echo "</tbody>
            </table>
        </div>";?>

<div class = 'col-xl-6 col-lg-6 col-md-6 col-sm-12 col_left'>
    <div class="row">
        <div class="col-sm-8"> 
            <h3 class="lichXL">Lịch Đồ Gỗ Đã Xử Lý</h3>                
            </div>
        <div class="col-sm-4"> 
            <input type="text" class="form-control" id="goInput" onkeyup="myFunctionGo()" placeholder="Search for names.." title="Type in a name">
        </div>
    </div>
    <table class="table table-bordered table-hover " id="goTable">
        <thead>
            <tr>
                <th class="col-md-1">Yêu Cầu CV</th>
                <th class="col-md-1">Tên KH</th>
                <th class="col-md-2">Địa Chỉ</th>
                <th class="col-md-1">Quận</th>
                <th class="col-md-1">Số Điện Thoại</th>
                <th class="col-md-1">Ghi chú</th>
                <th class="col-md-1">Tên Thợ</th>
                <th class="col-md-1">Thu Chi</th>
                <th class="col-md-2">Thay đổi</th>
            </tr>   
        </thead>
        <tbody>
            <?php while ($row = $q->fetch()): ?>
                <tr>
				    <td><?php echo htmlspecialchars($row['yc_book']); ?></td>
                    <td><?php echo htmlspecialchars($row['name_cus']); ?></td>
                    <td><?php echo htmlspecialchars($row['add_cus']); ?></td>
                    <td><?php echo htmlspecialchars($row['des_cus']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone_cus']); ?></td>
                    <td><?php if($row['note_book']==null){
                                // code 
                            }else{
                                echo "<p class='tooltipButton text-center' data-width='ghi_Chu' data-tooltip='".$row['note_book']."'>Xem Thêm</p>";
                            }?></td>
                    <td><?php echo htmlspecialchars($row['name_worker']); ?></td>
                    <td class="text-center" style="padding-top:3px;"><?php 
                            // thu chi
                            echo "<button type='button' data-toggle='modal' data-target='#my3".$row['id_cus']."'class='btn btn-sm btn-success tooltipButton cls_btn' data-tooltip='Nhập'><i class='glyphicon glyphicon-open'></i></button>
                            <!-- Modal -->
                            <div id='my3".$row['id_cus']."' class='modal fade' role='dialog'>
                                <!-- Modal content-->
                                <div class='modal-content modal_content1'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                            <h3 class='modal-title text-center'>Nhập Thông Tin Thu Chi</h3>
                                        </div>
                                        <div class='modal-body'>
                                        <form action='includes/logic/XL_thu_chi.php'   method='POST' class ='form-container'>
                                        <input type='hidden' name ='id_work' value=".$row['id_work']." >
                                            <input type='hidden' name ='note_work' value=''>
                                            <input type='hidden'class='form-control' name ='nv' value='".$ruser['real_name']."'>
                                            <input type='hidden' name ='tentho' value='".$row['name_worker']."'>
                                            <label for='telKH'><b>Địa Chỉ</b></label>
                                            <input type='text' name ='telKH' value='".$row['add_cus']."  ".$row['des_cus']."' readonly>
                                            <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                            <input type='text' name ='telKH' value=".$row['phone_cus']." readonly>
                                            <label for='date_book'><b>Thời gian  : </b></label>
                                            <input type='text'  name='date_book' value=".$timelive." readonly><br>
                                            <label for='sumthu'><b>Tổng Thu  : </b></label>
                                            <input type='text' min='0.00' max='1000000000.00' step='0.01'  name='sumthu' value=".$row['sum_thu']." id='sumthu'/>
                                            <label for='text'><b>Tổng Chi  : </b></label>
                                            <input type='text' min='0.00' max='1000000000.00' step='0.01'  name='sumchi' value=".$row['sum_chi']." id='sumchi'>
                                            <label for='note_work'><b>Thông tin Thêm : </b></label>
                                            <input type='text'  name='thongtinthem' value='".$row['thongtinthem']."'><br>
                                            <label for='note_work'><b>Phản Hồi Của Khách Hàng : </b></label>
                                            <input type='text'  name='note_work' value='".$row['note_work']."'>
                                            <label for='date_book'><b>Tình trạng thanh toán  : </b></label><br>
                                             
                                            <div class='row'>
                                                <div class='col-md-6 text-center'>
                                                    <label class='check-container1'>Chưa thanh toán<input type='radio'";
                                                    if($row['thanh_toan']=='1')
                                                    {
                                                        echo "checked='checked'";
                                                    } echo "name='thanh_toan' value='1'>
                                                 </div>
                                                <div class='col-md-6 text-center'>
                                                    <label class='check-container1'>Đã thanh toán
                                                    <input type='radio'"; 
                                                    if($row['thanh_toan']=='0'){
                                                        echo "checked='checked'";
                                                    } 
                                                    echo" name='thanh_toan' value='0'>
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
                            // ket thuc nhap thu chi";
                            echo " </td> <td class='td_thaydoi'>";
							// sua thong tin lich da phan 
                            echo"
                            <button type='button' data-toggle='modal' data-target='#my1".$row['id_cus']."'class='btn btn-sm btn-warning tooltipButton cls_btn' data-tooltip='Sửa'><i class='fa fa-pencil' aria-hidden='true'></i></button>
                            <!-- Modal -->
                            <div id='my1".$row['id_cus']."' class='modal fade' role='dialog'>
                                <!-- Modal content-->
                                <div class='modal-content modal_content1'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                            <h4 class='modal-title text-center'>Sửa Thông Tin Lịch Đồ Gỗ Đã Phân</h4>
                                        </div>
                                        <div class='modal-body'>
                                        <form action='includes/logic/up_kh_da_phan.php'   method='POST' class ='form-container'>
                                            <input type='hidden' class='form-control' name ='id_cus' value='".$row['id_cus']."'>
                                            <input type='hidden'class='form-control' name ='nv' value='".$ruser['real_name']."'>
                                            <input type='hidden'class='form-control' name ='action' value='0'>
                                            <label for='nameKH'><b>Tên Khách Hàng</b></label>
                                            <input type='text' class='form-control' name ='nameKH' value='".$row['name_cus']."' >
                                            <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
                                            <input type='text' class='form-control' name='addKH' value='".$row['add_cus']."' >
                                            <label for='desKH'><b>Quận</b></label>
                                            <input type='text' class='form-control' name= 'desKH' value='".$row['des_cus']."' >
                                            <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                            <input type='text' class='form-control' name ='telKH' value='".$row['phone_cus']."' >
                                            <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
                                            <input type='text' class='form-control' name = 'ycKH' value='".$row['yc_book']."'>  
                                            <label for='note_book'><b>Ghi Chú Công Việc </b></label>
                                            <textarea class='form-control' type='text' name='note_book' value='".$row['note_book']."' ></textarea>
                                            <label for='date_book'><b>Thời gian  : </b></label>
                                            <input type='date' class='form-control' name='date_book' value=" ;echo $row['date_book']."><br>
                                            <label for='date_book'><b>Loại CV: </b></label>
                                            <div class='row'>
                                                <div class='col-sm-4 text-center'> 
                                                    <label class='check-container1'>Điện Lạnh
                                                        <input type='radio'"; if($rowc['kind_book']=='Điện Lạnh'){echo "checked='checked'";} echo "name='kind_book' value='Điện Lạnh'>
                                                    </label>
                                                </div>
                                                <div class='col-sm-4 text-center'>
                                                    <label class='check-container1'>Điện Nước
                                                        <input type='radio'"; if($rowc['kind_book']=='Điện Nước'){echo "checked='checked'";} echo" name='kind_book' value='Điện Nước'>
                                                    </label>
                                                </div>
                                                <div class='col-sm-4 text-center'>
                                                    <label class='check-container1'>Đồ Gỗ
                                                        <input type='radio'";if($rowc['kind_book']=='Đồ Gỗ'){echo "checked='checked'";} echo" name='kind_book' value='Đồ Gỗ'>
                                                    </label>   
                                                </div> 
                                            </div>
                                        </div>
                                        <div class='modal-footer modal_footer1'>
                                            <div class='row'>
                                                <div class='col-md-6 text-center'><button type='submit' value='submit' class='btn btn-sm btn-success'>Thay Đổi Thông tin</button></div>
                                                <div class='col-md-6 text-center'><button type='button' class='btn btn-danger'  data-dismiss='modal'>Hủy</button></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            "; // ket thuc sua thong tin lich da phan
                            echo"<a href ='".BASE_URL."includes/logic/deleteKH.php?hd=ks&id_cus=".$row['id_cus']."'class='btn btn-sm btn-primary tooltipButton cls_btn' style='margin-right: 3px;' data-tooltip='Khảo Sát'><i class='fa fa-list-alt'></i></a>";
                            echo"<button type='button' class='btn btn-sm btn-danger tooltipButton cls_btn' data-tooltip='Hủy Lịch' data-toggle='modal' data-target='#my".$row['id_cus']."''><i class='fa fa-trash' aria-hidden='true'></i></button>
                                <!-- Modal -->
                                <div id='my".$row['id_cus']."' class='modal fade' role='dialog'>
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
                                                <input type ='hidden' name='ki' value ='3' />
                                                <input type='hidden' name='id_cus' value='".$row['id_cus']."'>
                                            <textarea style = 'width:100%' name='nnHuy' required></textarea>
                                            </div>
                                            <div class='modal-footer'>
                                                <input type='submit' class='btn btn-default' value='Xác Nhận'/>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                </div>";
                                echo "<a href ='".BASE_URL."includes/logic/thuhoi.php?id_cus=".$row['id_cus']."&ki=3 'class='btn btn-sm btn-warning tooltipButton cls_btn' data-tooltip='Trả Lịch' ><i class='fa fa-rotate-left'></i></a>";
                            ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
        </tbody>
    </table>
    </div><!--ket thuc cot-->
    </div><!-- ket thuc row-->
</div> <!-- ket thuc container-fluid-->