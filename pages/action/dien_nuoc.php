<style>
    .cls_btn{
        margin-top:5px; padding:5px 10px;
    }
</style>
<?php 
try {
    $sqlc = "SELECT id_cus,name_cus, phone_cus, add_cus, des_cus, yc_book, note_book, kind_book, date_book , nv_add
    FROM info_cus where kind_book like '%nuoc%' and  flag_book = '0' and date_book like '%$time_search%' and flag_status is NULL order by id_cus DESC";
    $qc = $conn->query($sqlc);
    $qc->setFetchMode(PDO::FETCH_ASSOC);
    $tho= $conn->prepare("select * FROM info_worker where status_worker = 0 and today_off = 0  order by name_worker ASC ");
    $tho->setFetchMode(PDO::FETCH_ASSOC); // set kiểu mảng cho giá trị trả về
    $tho->execute();
    $rs = $tho->fetchAll();// đổ toàn bộ dự liệu thu về vào mảng
    $sql = "SELECT info_cus.id_cus,info_cus.name_cus, info_cus.phone_cus,info_cus.add_cus, info_cus.des_cus,info_cus.yc_book, info_cus.note_book,info_worker.name_worker,info_cus.date_book, work_do.id_work, nv_phan, phu FROM work_do,info_worker,info_cus WHERE  info_cus.date_book like '%$timelive%'and work_do.id_worker = info_worker.id_worker and work_do.id_cus = info_cus.id_cus and info_cus.kind_book like '%nuoc%'
    and info_cus.flag_book = '1' and  work_do.sum_thu = '0'and info_cus.flag_status is NULL ORDER BY info_worker.name_worker ASC ";
    $q = $conn->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    if(empty($q))
    {
        $sql = "SELECT info_cus.id_cus,info_cus.name_cus, info_cus.phone_cus,info_cus.add_cus, info_cus.des_cus,info_cus.yc_book, info_cus.note_book,
            info_worker.name_worker,info_cus.date_book, work_do.id_work, nv_phan,phu FROM work_do,info_worker,info_cus 
            WHERE  work_do.sum_thu = 0 and work_do.id_worker = info_worker.id_worker and work_do.id_cus = info_cus.id_cus and info_cus.kind_book like '%nuoc%'
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
        <div class = 'col-xl-6 col-lg-6 col-md-6 col-sm-12' style='padding-right:7px;'>
            <h3 style='color: #00c0ef; padding:5px 10px 5px 10px;text-align: center;font-weight: 600;border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 5px #d2d6de;'>Lịch Điện Nước Chưa Xử Lý</h3>
            <table class='table table-bordered table-hover'>
                <thead>
                    <tr>
                        <th class='col-md-2'>Thông Tin</th>
                        <th class='col-md-1'>Tên KH</th>
                        <th class='col-md-2'>Địa Chỉ</th>
                        <th class='col-md-1'>Quận</th>
                        <th class='col-md-1'>SĐT</th>
                        <th class= 'col-md-1' >Ghi chú</th>
                        <th class='col-md-2'>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>";
                    while ($rowc = $qc->fetch()):
                        echo "
                        <tr>
                            <th >".htmlspecialchars($rowc['yc_book'])."</th>
                            <td >".htmlspecialchars($rowc['name_cus'])."</td>
                            <td >".htmlspecialchars($rowc['add_cus'])."</td>
                            <td >".htmlspecialchars($rowc['des_cus'])."</td>
                            <td >".htmlspecialchars($rowc['phone_cus'])."</td>
                            <td>"; if($rowc['note_book']==null){
                                // code 
                            }else{
                                echo "<p class='tooltipButton text-center' data-width='ghi_Chu' data-tooltip='".$rowc['note_book']."'>Xem</p>";
                            }
                        echo  "</td>

                            
                            <td >
                                <button type='button' class='btn btn-info btn-sm tooltipButton cls_btn' data-tooltip='Phân Lịch' data-toggle='modal' data-target='#phantho".$rowc['id_cus']."'><i class='fa fa-plus'></i></button>
                                <!-- Modal -->
                                <div id='phantho".$rowc['id_cus']."' class='modal fade' role='dialog'>
                                    <div class='row'>
                                        <div class='modal-dialog'>
                                            <!-- Modal content-->
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                    <h4 class='modal-title'>Chọn Thợ Bạn Muốn phân</h4>
                                                </div>
                                                <div class='modal-body'>
                                                    <form action='includes/logic/XL_phan_lich.php' method='POST' class='modal-body'>
                                                        <label>Chọn Thợ cần Phân :</label>
                                                        <input type ='hidden' name='ac' value ='phantho' />
                                                        <input type ='hidden' name='ki' value ='1' />
                                                        <input type ='hidden' name='nv' value='".$ruser['real_name']."'/>
                                                        <input type='hidden' name = 'id_cus' value='".$rowc['id_cus']."'/>
                                                        <input type='hidden' name = 'note' value='".$rowc['note_book']."'/>
                                                        <select name='name_worker'>";
                                                            foreach ($rs as $row1) {
                                                                echo '<option>';  
                                                                echo $row1['name_worker'] . ' ';
                                                                echo $row1['add_worker'] . ' ';
                                                                echo $row1['id_worker']." ";
                                                                echo '</option>';
                                                            }
                                                        echo "</select><br>
                                                        <label>Chọn Thợ phụ nếu cần:</label>
                                                        <textarea style='width: 100%; hight:120px;' name='phu'></textarea>
                                                        <div class='modal-footer'>
                                                            <input type='submit' value='Xác Nhận' class='btn btn-success' />
                                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                                // Gap doi lich da dat 
                                echo"
                                <button type='button' data-toggle='modal' data-target='#my2".$rowc['id_cus']."'class='btn btn-sm btn-info tooltipButton cls_btn' data-tooltip='Nhân đôi lịch'><i class='fa fa-copy'></i></button>
                                <!-- Modal -->
                                <div id='my2".$rowc['id_cus']."' class='modal fade' role='dialog'>
                                    <!-- Modal content-->
                                    <div class='modal-content' style='position: fixed;top: 20px;left: 35%;text-align: left;width: 30%;'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h4 class='modal-title text-center'>Nhân Đôi Lịch Khách Hàng</h4>
                                            </div>
                                            <div class='modal-body'>
                                            <form action='includes/logic/up_tt_KH.php' id='frm_sua_KH' method='POST' class ='form-container'>
                                                <input type='hidden' class='form-control' name ='id_cus' value='".$rowc['id_cus']."'>
                                                <input type='hidden'class='form-control' name ='nv' value='".$ruser['real_name']."'>
                                                <input type='hidden'class='form-control' name ='action' value='1'>
                                                <label for='nameKH'><b>Tên Khách Hàng</b></label>
                                                <input type='text' class='form-control' name ='nameKH' value='".$rowc['name_cus']."' >
                                                <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
                                                <input type='text' class='form-control' name='addKH' value='".$rowc['add_cus']."' >
                                                <label for='desKH'><b>Quận</b></label>
                                                <input type='text' class='form-control' name= 'desKH' value='".$rowc['des_cus']."' >
                                                <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                <input type='text' class='form-control' name ='telKH' value='".$rowc['phone_cus']."' >
                                                <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
                                                <input type='text' class='form-control' name = 'ycKH' value='".$rowc['yc_book']."'>  
                                                <label for='note_book'><b>Ghi Chú Công Việc </b></label>
                                                <textarea class='form-control' type='text' name='note_book' value='".$rowc['note_book']."' ></textarea>
                                                <label for='date_book'><b>Thời gian  : </b></label>
                                                <input type='date' class='form-control' name='date_book' value=" ;echo $rowc['date_book']."><br>
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
                                            <div class='modal-footer'>
                                                <div class='row'>
                                                    <div class='col-md-6 text-center'><button type='submit' value='submit' class='btn btn-sm btn-success' style='width:150px; font-size: 14px'>Thay Đổi Thông tin</button></div>
                                                    <div class='col-md-6 text-center'><button type='button' class='btn btn-danger' style='width:150px;' data-dismiss='modal'>Hủy</button></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                "; 
                                // ket thuc gap doi lich da dat
                                // sua thong tin lich KH 
                                echo"
                                <button type='button' data-toggle='modal' data-target='#my1".$rowc['id_cus']."'class='btn btn-sm btn-success tooltipButton cls_btn' data-tooltip='Sửa'><i class='fa fa-pencil' aria-hidden='true'></i></button>
                                <!-- Modal -->
                                <div id='my1".$rowc['id_cus']."' class='modal fade' role='dialog'>
                                    <!-- Modal content-->
                                    <div class='modal-content' style='position: fixed;top: 20px;left: 35%;text-align: left;width: 30%;'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h4 class='modal-title text-center'>Sửa Thông Tin Lịch Khách Hàng</h4>
                                            </div>
                                            <div class='modal-body'>
                                            <form action='includes/logic/up_tt_KH.php' id='frm_sua_KH' method='POST' class ='form-container'>
                                                <input type='hidden' class='form-control' name ='id_cus' value='".$rowc['id_cus']."'>
                                                <input type='hidden'class='form-control' name ='nv' value='".$ruser['real_name']."'>
                                                <input type='hidden'class='form-control' name ='action' value='0'>
                                                <label for='nameKH'><b>Tên Khách Hàng</b></label>
                                                <input type='text' class='form-control' name ='nameKH' value='".$rowc['name_cus']."' >
                                                <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
                                                <input type='text' class='form-control' name='addKH' value='".$rowc['add_cus']."' >
                                                <label for='desKH'><b>Quận</b></label>
                                                <input type='text' class='form-control' name= 'desKH' value='".$rowc['des_cus']."' >
                                                <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                <input type='text' class='form-control' name ='telKH' value='".$rowc['phone_cus']."' >
                                                <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
                                                <input type='text' class='form-control' name = 'ycKH' value='".$rowc['yc_book']."'>  
                                                <label for='note_book'><b>Ghi Chú Công Việc </b></label>
                                                <input class='form-control' type='text' name='note_book' value='".$rowc['note_book']."' ></input>
                                                <label for='date_book'><b>Thời gian  : </b></label>
                                                <input type='date' class='form-control' name='date_book' value=" ;echo $rowc['date_book']."><br>
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
                                            <div class='modal-footer'>
                                                <div class='row'>
                                                    <div class='col-md-6 text-center'><button type='submit' value='submit' class='btn btn-sm btn-success' style='width:150px; font-size: 14px'>Thay Đổi Thông tin</button></div>
                                                    <div class='col-md-6 text-center'><button type='button' class='btn btn-danger' style='width:150px;' data-dismiss='modal'>Hủy</button></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                "; 
                                // ket thuc sua thong tin lich 
                                echo"
                                <button type='button' class='btn btn-sm btn-danger tooltipButton cls_btn' data-tooltip='Hủy Lịch' data-toggle='modal' data-target='#my".$rowc['id_cus']."'><i class='fa fa-trash' aria-hidden='true'></i></button>
                                <!-- Modal -->
                                <div id='my".$rowc['id_cus']."' class='modal fade' role='dialog'>
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
                                                    <input type='hidden' name='id_cus' value='".$rowc['id_cus']."'>
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
                        </tr>";
                    endwhile;
                echo "</tbody>
            </table>
        </div>";?>
        <div class = 'col-xl-6 col-lg-6 col-md-6 col-sm-12' style='padding-left:7px;'>
            <h3 style='color: #00c0ef; padding:5px 10px 5px 10px;text-align: center;font-weight: 600;border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 5px #d2d6de;'>Lịch Điện Nước Đã Xử Lý</h3>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr >
                        <th class="col-md-1">Yêu Cầu</th>
                        <th class="col-md-1">Tên KH</th>
                        <th class="col-md-2">Địa Chỉ</th>
                        <th class="col-md-1">Quận</th>
                        <th class="col-md-1">SĐT</th>
                        <th class="col-md-1">Ghi chú</th>
                        <th class="col-md-1">Tên Thợ</th>
                        <th class="col-md-1">Phụ</th>
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
                                echo "<p class='tooltipButton text-center' data-width='ghi_Chu' data-tooltip='".$row['note_book']."'>Xem</p>";
                            }?></td>
                            <td><?php echo htmlspecialchars($row['name_worker']); ?></td>
                            <td><?php echo htmlspecialchars($row['phu']); ?></td>
                            <td class="text-center" style="padding-top:3px;">
                                <?php 
                                    echo "<a href ='".BASE_URL."includes/logic/thu_chi.php?id_work=".$row['id_work']."&idq=1&ki=1'class='btn btn-sm btn-success cls_btn'><i class='glyphicon glyphicon-open'></i></a>";
                                    echo " </td> <td style='padding-top:3px;padding-left: 1px; padding-right:1px; text-align:center;'>";
                                    // sua thong tin lich da phan 
                                    echo"
                                <button type='button' data-toggle='modal' data-target='#my1".$row['id_cus']."'class='btn btn-sm btn-warning tooltipButton cls_btn' data-tooltip='Sửa'><i class='fa fa-pencil' aria-hidden='true'></i></button>
                                <!-- Modal -->
                                <div id='my1".$row['id_cus']."' class='modal fade' role='dialog'>
                                    <!-- Modal content-->
                                    <div class='modal-content' style='position: fixed;top: 20px;left: 35%;text-align: left;width: 30%;'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                <h4 class='modal-title text-center'>Sửa Thông Tin Lịch Điện Nước Đã Phân</h4>
                                            </div>
                                            <div class='modal-body'>
                                            <form action='includes/logic/up_kh_da_phan.php' id='frm_sua_KH' method='POST' class ='form-container'>
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
                                            <div class='modal-footer'>
                                                <div class='row'>
                                                    <div class='col-md-6 text-center'><button type='submit' value='submit' class='btn btn-sm btn-success' style='width:150px; font-size: 14px'>Thay Đổi Thông tin</button></div>
                                                    <div class='col-md-6 text-center'><button type='button' class='btn btn-danger' style='width:150px;' data-dismiss='modal'>Hủy</button></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                "; // ket thuc sua thong tin lich da phan
                                echo"<a href ='".BASE_URL."includes/logic/deleteKH.php?hd=ks&id_cus=".$row['id_cus']."'class='btn btn-sm btn-primary cls_btn tooltipButton' data-tooltip='Khảo Sát' style=' margin-right: 4px;'><i class='fa fa-list-alt'></i></a>";
                                    echo"<button type='button' class='btn btn-sm btn-danger tooltipButton cls_btn' data-tooltip='Hủy Lịch' data-toggle='modal' data-target='#my".$row['id_cus']."'style='margin-right: 1px;'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                                    echo "
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
                                                            <input type ='hidden' name='ki' value ='1' />
                                                            <input type='hidden' name='id_cus' value='".$row['id_cus']."'>
                                                            <textarea style = 'width:100%' name='nnHuy'></textarea>
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <input type='submit' class='btn btn-default' value='Xác Nhận'/>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>";
                                    echo "<a href ='".BASE_URL."includes/logic/thuhoi.php?id_cus=".$row['id_cus']."&ki=1'class='btn btn-sm btn-warning tooltipButton cls_btn' data-tooltip='Trả Lịch'><i class='fa fa-rotate-left'></i></a>";
                                ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div><!--ket thuc cot-->
    </div><!-- ket thuc row-->
</div> <!-- ket thuc container-fluid-->
	