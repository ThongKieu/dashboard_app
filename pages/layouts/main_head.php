<?php 
  $database = new Getdatabase();
  $db = $database->getConnection();
  
   try{
    $vsbn = $conn -> prepare('SELECT * FROM notication where status_ad = 0');
    $vsbn->execute();
    $nvsbn = $vsbn->rowCount();  }
  catch (PDOException $e) {
    echo $e->getMessage();
    } 
 
?>
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    }
  )
  function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content my-custom-scrollbar" style="background-color: white">
      <!-- Small boxes (Stat box) -->
      <div class="row " >
        
        
        <div id ="lichDienNuoc" class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner" style="font-size: 22px; text-align:center;">
            <span  > <b> <?php $rowt = new Count($db);
                        $numLC = $rowt ->countLC($time_search);
                        echo $numLC; ?> </b> </span> <span>Lịch: Chưa Xử Lý</span>
              </div>
           
          <a href="index.php" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner"  style="font-size: 22px; text-align:center;">
            <span > <b> <?php $rowt = new Count($db);
                        $numDN = $rowt ->countDN($time_search);
                        echo $numDN;  ?> </b> </span> <span>Lịch: Điện Nước</span>
            </div>
            
            <a href="index.php#lichDienNuoc" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner"  style="font-size: 22px; text-align:center;">
            <span> <b> <?php $rowt = new Count($db);
                        $numDL = $rowt ->countDL($time_search);
                        echo $numDL;  ?> </b> </span> <span>Lịch: Điện Lạnh</span>
             
            </div>
            
            <a href="index.php#lichDienLanh" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner"  style="font-size: 22px; text-align:center;">
              <span > <b> <?php $rowt = new Count($db);
                        $numLC = $rowt ->countDG($time_search);
                        echo $numLC;  ?> </b> </span> <span>Lịch: Đồ Gỗ</span>
            </div>
            
            <a href="index.php#lichDoGo" class="small-box-footer">Xem chi tiết<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
         <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner"  style="font-size: 22px; text-align:center;">
              <span>
                <b>
                  <?php $rowt = new Count($db);
                        $numLC = $rowt ->countKS($time_search);
                        echo $numLC;
                  ?>
                </b>
              </span>
              <span>Lịch: Khảo Sát</span>
            </div>
            <a href="index.php?action=4" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner"  style="font-size: 22px; text-align:center;">
              <span>
                <b>
                  <?php $rowt = new Count($db);
                        $numLC = $rowt ->countHuy($time_search);
                        echo $numLC;  
                  ?> 
                </b> 
              </span>
              <span>Lịch: Hủy</span> 
            </div>
           <a href="index.php?action=5" class="small-box-footer">Xem chi tiết<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      
        <!-- ./col -->
      </div>
      <!-- bat dau  -->
      <button type='button' class='btn btn-info btnThemKH tooltipButton' data-tooltip='Đặt Lịch' data-toggle='modal' data-target='#hihi'><i class='fa fa-plus'></i></button>
      <!-- Modal -->
      <div class='modal fade' id='hihi' role='dialog'>
          <div class='modal-dialog'>
              <!-- Modal content-->
              <div class='modal-content'>
                  <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h3 class='modal-title'>Nhập Thông Tin Khách Hàng Mới</h3>
                  </div>
                  <div class='modal-body'>
                      <div class='row'>
                          <form action='includes/logic/XL_them_kh.php' method='POST' class='form-container'>
                              <label for='note_book'><b>Yêu Cầu Công Việc </b></label>
                              <input type='text' placeholder='Yêu Cầu Công Việc' name='ycKH' required>
                              <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
                              <input type='text' placeholder='Nhập Địa Chỉ Khách Hàng' name='addKH' required>
                              <label for='desKH'><b>Quận</b></label>
                              <select name='desKH'>
                                  <option>Quận 1</option>
                                  <option>Quận 2</option>
                                  <option>Quận 3</option>
                                  <option>Quận 4</option>
                                  <option>Quận 5</option>
                                  <option>Quận 6</option>
                                  <option>Quận 7</option>
                                  <option>Quận 8</option>
                                  <option>Quận 9</option>
                                  <option>Quận 10</option>
                                  <option>Quận 11</option>
                                  <option>Quận 12</option>
                                  <option>Bình Thạnh</option>
                                  <option>Thủ Đức</option>
                                  <option>Gò Vấp</option>
                                  <option>Phú Nhuận</option>
                                  <option>Tân Bình</option>
                                  <option>Tân Phú</option>
                                  <option>Bình Tân</option>
                                  <option>Bình Chánh</option>
                                  <option>Nhà Bè</option>
                                  <option>Hóc Môn</option>
                                  <option>Củ Chi</option>
                                  <option>Đồng Nai</option>
                              </select>
                              <?php echo "<input type='hidden' value='".$ruser['real_name']."' name='nv_add'>"?>
                              <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                              <input type='text' placeholder='Số Điện Thoại Khách Hàng' name='telKH' maxlength="12"  onkeypress='validate(event)' required/>
                              <label for='nameKH'><b>Tên Khách Hàng</b></label>
                              <input type='text' placeholder='Tên Khách Hàng' name='nameKH' required>
                              <label for='ycKH'><b>Ghi Chú Công Việc</b></label>
                              <textarea type='text' class="form-control"  placeholder='Ghi chú' name='note_book' rows="3"></textarea>
                              <label for='date_book'><b>Thời gian: </b></label>
                              <div class='row'>
                                  <div class='col-sm-6'>
                                      <?php echo "<input type='date' class='form-control' name='date_book' value="; echo date('Y-m-d').">"?>
                                  </div>
                                  <div class='col-sm-6'></div>
                              </div>
                              <div class='row'>
                                  <div class='col-sm-4'>
                                      <label class='check-container1'>Điện Lạnh
                                          <input type='radio' checked='checked' name='kind_book' value='Điện Lạnh'>
                                      </label>
                                  </div>
                                  <div class='col-sm-4'>
                                      <label class='check-container1'>Điện Nước
                                          <input type='radio' name='kind_book' value='Điện Nước'>
                                      </label>
                                  </div>
                                  <div class='col-sm-4'>
                                      <label class='check-container1'>Đồ Gỗ
                                          <input type='radio' name='kind_book' value='Đồ Gỗ'>
                                      </label>
                                  </div>
                              </div>
                              <div class='modal-footer'>
                                  <div class='row'>
                                      <div class='col-md-6'>
                                          <button type='submit' class='btn btn-success' style='width:100%'>Thêm</button>
                                      </div>
                                      <div class='col-md-6'>
                                          <button class='btn cancel' data-dismiss='modal' aria-label='Close' style='width:100%'>Đóng</button>
                                      </div>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- ket thuc  -->
      <?php
      $nvsbn = null;
      if($nvsbn > 0){
      echo"
      <div class='row'>
        <div class='col-sm-12'>
          <!-- small box -->
          <div class='box bg-white'>
              <table class='table table-bordered '>
                <thead>
                  <tr>
                    <th class='col-sm-8'> Thông báo</th>
                    <th class='col-sm-1'> Người Viết</th>
                    <th class='col-sm-1'> Ngày </th>
                    <th class='col-sm-2'> Hoàn Thành</th>
                  </tr>
                </thead>
              <tbody>";
              while($vs=$vsbn->fetch(PDO::FETCH_ASSOC)):
              echo"
                <tr>
                  <td>".$vs['thuoc_tinh']."</td>
                  <td>".$vs['ng_them']."</td>
                  <td>".$vs['ngay_them']."</td>
                  <td>
                  <button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#phantho".$vs['id_thongbao']."'>Sửa</button>
                  <!-- Modal -->
                  <div id='phantho".$vs['id_thongbao']."' class='modal fade' role='dialog'>
                    <div class='row'>
                    <div class='modal-dialog'>
                      <!-- Modal content-->
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <button type='button' class='close' data-dismiss='modal'>&times;</button>
                          <h2>Chọn Thợ cần Phân :</h2>
                        </div>
                        <div class='modal-body'>
                          <form action='includes/logic/Xl_add_thongbao.php' method='POST' class ='container'>
                            <input type ='hidden' name='ac' value='1'/>
                            <input type ='hidden' name='nv' value='".$ruser['real_name']."'/>
                            <input type ='hidden' name='id_thongbao' value='".$vs['id_thongbao']."'/>
                            <textarea style='width:524px; height:120px;'name = 'thongtin'>".$vs['thuoc_tinh']."'</textarea>
                        </div>
                        <div class='modal-footer'>
                          <input type='submit' value='Xác Nhận' class='btn btn-success'/>   <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                        </div>
                      </form>
                      </div>
                  </div>
                </div>
                  
                  </div>
             

                    <a href = '".BASE_URL."includes/logic/Xl_add_thongbao.php?ac=3&id=".$vs['id_thongbao']."'class='btn btn-sm btn-success'>Xong</a>

                    <button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#newadd'>Thêm Thông báo Mới</button>

                  <!-- Modal -->
                  <div id='newadd' class='modal fade' role='dialog'>
                      <div class='row'>
                      <div class='modal-dialog'>

                      <!-- Modal content-->
                      <div class='modal-content'>
                      <div class='modal-header'>
                          <button type='button' class='close' data-dismiss='modal'>&times;</button>
                           <h3>Thêm Thông báo mới :</h3></br>
                      </div>
                      <div class='modal-body'>
                      <form action='includes/logic/Xl_add_thongbao.php' method='POST' class ='container'>
                         
                          <input type ='hidden' name='ac' value='2'/>
                          <input type ='hidden' name='nv' value='".$ruser['real_name']."'/>
                          <textarea style='width:524px; height:120px;'name = 'thongtin' > </textarea>

                      </div>
                      <div class='modal-footer'>
                      <input type='submit' value='Xác Nhận' class='btn btn-success'/>   <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                      </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
             
                  </td>
                </tr>";
              endwhile;
              echo "
              </tbody>
              </table>
            
          
         </div>
      </div>
      </div>";}
      ?>

      
      <!-- /.row -->
    
      <!-- Main row -->
     