<?php include 'main_head.php';?>
<!-- /.row -->
<!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <?php if(!isset($_GET['action'])){
      echo "
      <section>
        <!-- /.content -->
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header' style ='border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 10px #d2d6de;'>
                    <h3 class='box-title'>Thêm Khách Hàng</h3>
                    <div class='box-tools'>
                        <div class='input-group input-group-sm'>
                            <button type='button' class='btn btn-block btn-info' data-toggle='modal' data-target='#hihi'><i class='fa fa-user-plus'></i></button>
                            <!-- Modal -->
                            <div class='modal fade' id='hihi' role='dialog'>
                                <div class='modal-dialog'>
                                    <!-- Modal content-->
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                            <h4 class='modal-title'>Thêm Khách Hàng mới</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <form action='includes/logic/XL_them_kh.php' method='POST' class='form-container'>
                                                <h3>Thông tin Khách Hàng</h3>
                                                <div class='row'>
                                                    <label for='note_book'><b>Yêu Cầu Công Việc </b></label>
                                                    <input type='text' placeholder='Yêu Cầu Công Việc' name='ycKH' required>
                                                    <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
                                                    <input type='text' placeholder='Nhập Địa Chỉ Khách Hàng' name='addKH' required>
                                                    <label for='desKH'><b>Quận</b></label>\
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
                                                    <input type='hidden' value='".$ruser['real_name']."' name='nv_add'>
                                                    <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                    <input type='tel' placeholder='Số Điện Thoại Khách Hàng' name='telKH' required>
                                                    <label for='nameKH'><b>Tên Khách Hàng</b></label>
                                                    <label for='ycKH'><b>Ghi Chú Công Việc</b></label>
                                                    <input type='text' placeholder='Ghi chú' name='note_book'>
                                                    <label for='date_book'><b>Thời gian  : </b></label>
                                                    <div class='row'>
                                                        <div class='col-sm-6'>
                                                            <input type='date' name='date_book' value="; echo date('Y-m-d').">
                                                        </div>
                                                        <div class='col-sm-6'></div>
                                                    </div>
                                                    <br>
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
                                                    <button type='submit' class='btn'>Thêm</button>
                                                    <button class='btn cancel btn-danger' data-dismiss='modal' aria-label='Close'>Đóng</button>
                                                </div>
                                            
                                        </div>
                                        <div class='modal-footer'></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header dien nuoc cho-->
            <div class='box-body table-responsive no-padding'>"; require 'pages/action/lich_cho.php'; echo"</div>
            <!-- /.box-body -->
            
              
        </div>
  </section>"; 
  }else {
       $a = $_GET['action'];
       if($a=='1')
       { 
        echo "
        <section>
        <!-- /.content -->
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header' style ='border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 10px #d2d6de;'>
                    <h3 class='box-title'>Lịch Điện Nước</h3>
                    <div class='box-tools'>
                        <div class='input-group input-group-sm'>
                            <button type='button' class='btn btn-block btn-info' data-toggle='modal' data-target='#hihi'><i class='fa fa-user-plus'></i></button>
                            <!-- Modal -->
                            <div class='modal fade' id='hihi' role='dialog'>
                                <div class='modal-dialog'>
                                    <!-- Modal content-->
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                            <h4 class='modal-title'>Thêm Khách Hàng mới</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <form action='includes/logic/XL_them_kh.php' method='POST' class='form-container'>
                                                <h3>Thông tin Khách Hàng</h3>
                                                <div class='row'>
                                                    <label for='note_book'><b>Yêu Cầu Công Việc </b></label>
                                                    <input type='text' placeholder='Yêu Cầu Công Việc' name='ycKH' required>
                                                    <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
                                                    <input type='text' placeholder='Nhập Địa Chỉ Khách Hàng' name='addKH' required>
                                                    <label for='desKH'><b>Quận</b></label>\
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
                                                    <input type='hidden' value='".$ruser['real_name']."' name='nv_add'>
                                                    <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                                    <input type='tel' placeholder='Số Điện Thoại Khách Hàng' name='telKH' required>
                                                    <label for='nameKH'><b>Tên Khách Hàng</b></label>
                                                    <label for='ycKH'><b>Ghi Chú Công Việc</b></label>
                                                    <input type='text' placeholder='Ghi chú' name='note_book'>
                                                    <label for='date_book'><b>Thời gian  : </b></label>
                                                    <div class='row'>
                                                        <div class='col-sm-6'>
                                                            <input type='date' name='date_book' value="; echo date('Y-m-d').">
                                                        </div>
                                                        <div class='col-sm-6'></div>
                                                    </div>
                                                    <br>
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
                                                    <button type='submit' class='btn'>Thêm</button>
                                                    <button class='btn cancel btn-danger' data-dismiss='modal' aria-label='Close'>Đóng</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class='modal-footer'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header dien nuoc cho-->
            <div class='box-body table-responsive no-padding'>";
            require 'pages/action/dien_nuoc.php'; 
            echo"</div>
                 <!-- /.box-body -->
            
            <!--end row-->
        </div>
  </section>";  }
       elseif($a=='2')
       { echo "
        
          <section >
        <!-- /.content -->
          <div class='col-xs-12'>
            <div class='box'>
              <div class='box-header' style ='border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 10px #d2d6de;'>
                <h3 class='box-title'>Lịch Điện Lạnh</h3>
                  <div class='box-tools'>
                    <div class='input-group input-group-sm'>
                      <button type='button' class='btn btn-block btn-info' data-toggle='modal' data-target='#hihi'><i class='fa fa-user-plus'></i></button>
  
                          <!-- Modal -->
                          <div class='modal fade' id='hihi' role='dialog'>
                            <div class='modal-dialog'>
                            
                              <!-- Modal content-->
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                  <h4 class='modal-title'>Thêm Khách Hàng mới</h4>
                                </div>
                                <div class='modal-body'>
                                <form action='includes/logic/XL_them_kh.php' method='POST' class='form-container'>
                                        <h3>Thông tin Khách Hàng</h3>
                                        <div class='row'>
                                        <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
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
                                        <input type='hidden' value='".$ruser['real_name']."' name='nv_add'>
                                        <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                        <input type='tel' placeholder='Số Điện Thoại Khách Hàng' name='telKH' required>
										                      <label for='nameKH'><b>Tên Khách Hàng</b></label>
                                        <input type='text' placeholder='Nhập Tên Khách Hàng' name='nameKH' >
                                        
                                        <label for='note_book'><b>Ghi Chú Công Việc </b></label>
                                        <input type='text' placeholder='Ghi chú' name='note_book'>
                                        
                                        <label for='date_book'><b>Thời gian  : </b></label>
                                            <div class='row'>
                                                <div class='col-sm-6'>
                                                <input type='date'  name='date_book' value="; echo date('Y-m-d').">
                                                </div>
                                                <div class='col-sm-6'>
                                                
                                                </div>
                                            </div>
                                        <br>
                                        
                                        
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
                                            <button type='submit' class='btn'>Thêm</button>
                                            <input class='btn cancel btn-danger' data-dismiss='modal' aria-label='Close' value= 'Đóng'/>
                                            </div>
                                        </form>
                                </div>
                                <div class='modal-footer'>
                                  
                                </div>
                              </div>
                              
                            </div>
                          </div>
                    </div>
              </div>
          </div>
                
                <!-- /.box-header dien nuoc cho-->
                <div class='box-body table-responsive'>";
              require 'pages/action/dien_lanh.php';
  
              echo"  </div>
                <!-- /.box-body -->
           
              
              </div>
          </div>
        </section>  
       
        "; }
     

  elseif($a == '3')
  {
    echo "
    <section >
      <!-- /.content -->
        <div class='col-xs-12'>
          <div class='box'>
          <div class='box-header' style ='border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 10px #d2d6de;'>
                <h3 class='box-title'>Lịch Đồ Gỗ</h3>
                <div class='box-tools'>
                  <div class='input-group input-group-sm' style='width: 50px;'>
                        <button type='button' class='btn btn-block btn-info' data-toggle='modal' data-target='#hihi'><i class='fa fa-user-plus'></i></button>

                        <!-- Modal -->
                        <div class='modal fade' id='hihi' role='dialog'>
                          <div class='modal-dialog'>
                          
                            <!-- Modal content-->
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                <h4 class='modal-title'>Thêm Khách Hàng mới</h4>
                              </div>
                              <div class='modal-body'>
                              <form action='includes/logic/XL_them_kh.php' method='POST' class='form-container'>
                                      <h3>Thông tin Khách Hàng</h3>
                                      <div class='row'>
									 <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
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
                                      <input type='hidden' value='".$ruser['real_name']."' name='nv_add'>
                                      <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                      <input type='tel' placeholder='Số Điện Thoại Khách Hàng' name='telKH' required>
                                      <label for='nameKH'><b>Tên Khách Hàng</b></label>
                                      <input type='text' placeholder='Nhập Tên Khách Hàng' name='nameKH' >
									   <label for='nameKH'><b>Ghi Chú</b></label>
                                      <input type='text' placeholder='Ghi chú' name='note_book'>
                                      
                                      <label for='date_book'><b>Thời gian  : </b></label>
                                          <div class='row'>
                                              <div class='col-sm-6'>
                                              <input type='date'  name='date_book' value="; echo date('Y-m-d').">
                                              </div>
                                              <div class='col-sm-6'>
                                              
                                              </div>
                                          </div>
                                      <br>
                                      
                                      
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
                                          <button type='submit' class='btn'>Thêm</button>
                                          <input class='btn cancel btn-danger' data-dismiss='modal' aria-label='Close' value= 'Đóng'/>
                                          </div>
                                      </form>
                              </div>
                              <div class='modal-footer'>
                                
                              </div>
                            </div>
                           </div> 
                          </div>
                        </div>
            </div>
        </div>
              
              <!-- /.box-header dien nuoc cho-->
              <div class='box-body table-responsive'>";
            require 'pages/action/do_go.php';

            echo"  </div>
              <!-- /.box-body -->
         
            
            </div>
        </div>
      </section>   
      "; 
  }
  elseif($a == '4')
  {
    echo "
      <section >
      <!-- /.content -->
        <div class='col-xs-12'>
          <div class='box'>
            <div class='box-header' style ='border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 10px #d2d6de;'>
              <h3 class='box-title'>Khảo Sát Báo Giá</h3>
                <div class='box-tools'>
                  <div class='input-group input-group-sm' style='width: 50px;'>
                        <button type='button' class='btn btn-block btn-info' data-toggle='modal' data-target='#hihi'><i class='fa fa-user-plus'></i></button>

                        <!-- Modal -->
                        <div class='modal fade' id='hihi' role='dialog'>
                          <div class='modal-dialog'>
                          
                            <!-- Modal content-->
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                <h4 class='modal-title'>Thêm Khách Hàng mới</h4>
                              </div>
                              <div class='modal-body'>
                              <form action='includes/logic/XL_them_kh.php' method='POST' class='form-container'>
                                      <h3>Thông tin Khách Hàng</h3>
                                      <div class='row'>
									  <label for='note_book'><b>Yêu Cầu Công Việc </b></label>
									  <input type='text' placeholder='Yêu Cầu Công Việc' name='ycKH' required>
                                      <label for='note_book'><b>Ghi Chú Công Việc </b></label>
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
                                      <input type='hidden' value='".$ruser['real_name']."' name='nv_add'>
                                      <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                      <input type='tel' placeholder='Số Điện Thoại Khách Hàng' name='telKH' required>
									   <label for='nameKH'><b>Tên Khách Hàng</b></label>
                                      <input type='text' placeholder='Nhập Tên Khách Hàng' name='nameKH' >
                                      <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
                                      
                                      <input type='text' placeholder='Ghi chú' name='note_book'>
                                      
                                      <label for='date_book'><b>Thời gian  : </b></label>
                                          <div class='row'>
                                              <div class='col-sm-6'>
                                              <input type='date'  name='date_book' value="; echo date('Y-m-d').">
                                              </div>
                                              <div class='col-sm-6'>
                                              
                                              </div>
                                          </div>
                                      <br>
                                      
                                      
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
                                          <button type='submit' class='btn'>Thêm</button>
                                          <input class='btn cancel btn-danger' data-dismiss='modal' aria-label='Close' value= 'Đóng'/>
                                          </div>
                                      </form>
                              </div>
                              <div class='modal-footer'>
                                
                              </div>
                            </div>
                           </div> 
                          </div>
                        </div>
            </div>
        </div>
              
              <!-- /.box-header dien nuoc cho-->
              <div class='box-body table-responsive'>";
            require 'pages/action/lich_ks.php';

            echo"  </div>
              <!-- /.box-body -->
         
            
            </div>
        </div>
      </section>   
      "; 
  }
  elseif($a == '5')
  {
    echo "
      <section >
      <!-- /.content -->
        <div class='col-xs-12'>
          <div class='box'>
          <div class='box-header' style ='border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 10px #d2d6de;'>
          <h3 class='box-title' style='color:red'>Lịch Hủy</h3>
                <div class='box-tools'>
                  <div class='input-group input-group-sm' style='width: 50px;'>
                        <button type='button' class='btn btn-block btn-info' data-toggle='modal' data-target='#hihi'><i class='fa fa-user-plus'></i></button>

                        <!-- Modal -->
                        <div class='modal fade' id='hihi' role='dialog'>
                          <div class='modal-dialog'>
                          
                            <!-- Modal content-->
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                <h4 class='modal-title'>Thêm Khách Hàng mới</h4>
                              </div>
                              <div class='modal-body'>
                              <form action='includes/logic/XL_them_kh.php' method='POST' class='form-container'>
                                      <h3>Thông tin Khách Hàng</h3>
                                      <div class='row'>
									  <label for='nameKH'><b>Yêu Cầu Công Việc</b></label>
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
                                      <input type='hidden' value='".$ruser['real_name']."' name='nv_add'>
                                      <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                      <input type='tel' placeholder='Số Điện Thoại Khách Hàng' name='telKH' required>
                                      <label for='nameKH'><b>Tên Khách Hàng</b></label>
                                      <input type='text' placeholder='Nhập Tên Khách Hàng' name='nameKH' >
                                      <label for='note_book'><b>Ghi Chú Công Việc </b></label>
                                      <input type='text' placeholder='Ghi chú' name='note_book'>
                                      
                                      <label for='date_book'><b>Thời gian  : </b></label>
                                          <div class='row'>
                                              <div class='col-sm-6'>
                                              <input type='date'  name='date_book' value="; echo date('Y-m-d').">
                                              </div>
                                              <div class='col-sm-6'>
                                              
                                              </div>
                                          </div>
                                      <br>
                                      
                                      
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
                                          <button type='submit' class='btn'>Thêm</button>
                                          <input class='btn cancel btn-danger' data-dismiss='modal' aria-label='Close' value= 'Đóng'/>
                                          </div>
                                      </form>
                              </div>
                              <div class='modal-footer'>
                                
                              </div>
                            </div>
                            
                          </div>
                        </div>
                     
                 </div>       



               
            </div>
        </div>
              
              <!-- /.box-header dien nuoc cho-->
              <div class='box-body table-responsive'>";
            require 'pages/action/lich_huy.php';

            echo"  </div>
              <!-- /.box-body -->
         
            
            </div>
        </div>
      </section>  
      "; 
  }
  elseif($a == '6')
  {
    echo "
      <section >
        <!-- /.content -->
        <div class='col-xs-12'>
          <form action='' method='get'>
            <div class='box'>
              <div class='box-header'>
                <h3 class='box-title'>Lịch hoàn thành</h3>
                <div class='box-tools'>
                <input type='hidden' name='action' value='6'>
                <div class='input-group input-group-sm' style='width: 150px;'>
                  <input type='date' name='time_search' class='form-control pull-right' >
                  <div class='input-group-btn'>
                    <button type='submit' class='btn btn-default'><i class='fa fa-search'></i></button>
                </div>
              </div>
            </div>
          </form>
          <!-- /.box-header dien nuoc cho-->
          <div class='box-body table-responsive'>";
            require 'pages/action/lich_hoan_thanh.php';
            echo"  </div>
              <!-- /.box-body -->
            </div>
        </div>
      </section>
    "; 
  }
  elseif($a == '7')
  {
    if($time_search==''){ $time_search= date('Y-m-d');}
    echo "
      <section >
        <!-- /.content -->
        <div class='col-xs-12'>
          <form action='' method='get'>
            <div class='box'>
              <div class='box-header'>
                <h2 class='box-title'style='color:red; font-size: 22px;' >Báo cáo ngày :". $time_search."</h2>
                <div class='box-tools'>
                <input type='hidden' name='action' value='7'>
                <div class='input-group input-group-sm' style='width: 150px;'>
                  <input type='date' name='time_search' class='form-control pull-right' >
                  <div class='input-group-btn'>
                    <button type='submit' class='btn btn-default'><i class='fa fa-search'></i></button>
                  </div>
                </div>
              </div>
          </form>
          <!-- /.box-header dien nuoc cho-->
          <div class='box-body table-responsive'>";
            require 'pages/action/lich_bc.php';
          echo"  </div>
          <!-- /.box-body -->
        </div>
      </section>   
    "; 
  }
  elseif($a=='search')//tìm kiếm 
{echo "
  <section >
  <!-- /.content -->
    <div class='col-xs-12'>
    <div class='box'>
          <!-- /.box-header dien nuoc cho-->
          <div class='box-body table-responsive'>";
        require 'pages/action/search.php';
        echo"  </div>
          <!-- /.box-body -->
        </div>
    </div>
  </section>   
  "; 
  
}


elseif($a=='cho_lanh')
{
  echo "
  <section >
  <!-- /.content -->
  <section class='col-xs-12'>
        <div class='box'>
          <div class='box-header'>
          <h3 class='box-title'>Lịch Chờ Điện Lạnh</h3> 
          </div>
          <!-- /.box-header -->
          <div class='box-body table-responsive'>";
  require 'function/lich_cho_lanh.php';
  echo"    <!-- /.box-body -->
     </div>
        <!-- /.box -->
      </div>
    </section>";
}
elseif($a=='imp')
{
  echo "
  <section >
  <!-- /.content -->
  <div class='col-xs-12'>
        <div class='box'>
          <div class='box-header'>
          <h3 class='box-title'>Nhập Dữ liệu từ file Exel </h3> 
            
          </div>
          <!-- /.box-header -->
          <div class='box-body table-responsive'>";
  require 'includes/importfile.php';
  echo"    <!-- /.box-body -->
     </div>
        <!-- /.box -->
      </div>
    </div>
    </section>";
}elseif($a=='nhieu')
{
  echo "
  <section>
    <!-- /.content -->
    <div class='col-xs-12'>
      <div class='box'>
        <div class='box-body table-responsive'>";
          require 'pages/action/phan_nhieu.php';
        echo"    
        </div>
      <!-- /.box -->
      </div>
    </div>
  </section>";
}
elseif($a=='exp')
{
  echo "<div class='row'>
  <section >
  <!-- /.content -->
  <div class='col-xs-12'>
        <div class='box'>
          
          <!-- /.box-header -->
          <div class='box-body table-responsive'>";
  require 'includes/exportfile.php';
  echo"    <!-- /.box-body -->
     </div>
        <!-- /.box -->
      </div>
    </div>
	</section>
	</div>
	";
    
  
}
elseif($a=='tt')
{
  echo "<div class='row'>
  <section >
  <!-- /.content -->
  <div class='col-xs-12'>
        <div class='box'>
          
          <!-- /.box-header -->
          <div class='box-body table-responsive'>";
  require 'includes/logic/tt_chi_tiet.php';
  echo"    <!-- /.box-body -->
     </div>
        <!-- /.box -->
      </div>
    </div>
	</section>
	</div>
	";
    
  
}
elseif($a=='ktra')
{
  
  echo "<div class='row'>
    <section >
    <!-- /.content -->
    <div class='col-xs-12'>
     <form action='index.php' method='get'>
          <div class='box'>
          <div class='box-header'>
          <h3 class='box-title'>Kiểm Tra Lich Của Thợ :</h3>
           
                <div class='box-tools'>
                  <div class='input-group input-group-sm' style='width: 250px;'>
                  <input type='hidden' name ='action' value='ktra'>
                    <input type='text' name='tentho' class='form-control pull-right' placeholder='Nhập Tên Thợ'>

                    <div class='input-group-btn'>
                      <button type='submit' class='btn btn-default'><i class='fa fa-search'></i></button>
                  </div>
                </div>
              </div>
          </div>
        </form>
    
            <!-- /.box-header -->
          <div class='box-body table-responsive'>";
    require 'pages/action/kiemtratho.php';
    echo"    <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      
    </section>";
}
elseif($a=='thuchi')
{
  
  echo "<div class='row'>
    <section >
    <!-- /.content -->
    <div class='col-xs-12'>
     
          <div class='box'>
		  <form action='index.php' method='get'>
          <div class='box-header'>
          <h3 class='box-title'>Thông tin thu chi :</h3>
           
                <div class='box-tools'>
                    <div class='input-group input-group-sm' style='width: 250px;'>
                  <input type='hidden' name ='action' value='thuchi'>
                    <input type='text' name='tentho' class='form-control pull-right' placeholder='Nhập Tên Thợ'>

                    <div class='input-group-btn'>
                      <button type='submit' class='btn btn-default'><i class='fa fa-search'></i></button>
                  	</div>
                	</div>
            	</div>  
          	</div>
        </form>
    
            <!-- /.box-header -->
					  <div class='box-body table-responsive'>";
				require 'pages/action/checkthuchi.php';
				echo"    <!-- /.box-body -->
					  </div>
          <!-- /.box -->
        </div>
      </div>
      
    </section>
	</div>";
}
elseif($a=='mai')
{
  
  echo "<div class='row'>
    <section >
    <!-- /.content -->
    <div class='col-xs-12'>
     <form action='index.php' method='GET'>
          <div class='box'>
          <div class='box-header'>
          
                <div class='box-tools'>
                <input type='hidden' name ='action' value='mai'>
                  <div class='input-group input-group-sm' style='width: 250px;'>
                    <input type='date' name='time_search' class='form-control pull-right'>

                    <div class='input-group-btn'>
                      <button type='submit' class='btn btn-default'><i class='fa fa-search'></i></button>
                  </div>
                </div>
              
          </div>
        </form>
    
            <!-- /.box-header -->
          <div class='box-body table-responsive'>";
    require 'pages/action/lichtuonglai.php';
    echo"    <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      
    </section>";
}
elseif($a=='allnoti')
{
  
  echo "<div class='row'>
  <section >
  <!-- /.content -->
  <div class='col-xs-12'>
        <div class='box'>
          <div class='box-header'>
           
            
          </div>
          <!-- /.box-header -->
          <div class='box-body table-responsive'>";
  require 'pages/action/notication.php';
  echo"    <!-- /.box-body -->
     </div>
        <!-- /.box -->
      </div>
    </div>
    </section>
    ";
}
elseif($a=='newnoti')
{
  echo "<div class='row'>
    <section >
    <!-- /.content -->
    <div class='col-xs-12'>
    
          <div class='box'>
          
          <div class='box-header'>
          
                <div class='box-tools'>
                
                
                  <div class='input-group input-group-sm' style='width: 250px;'>
                   

                    <div class='input-group-btn'>
                     
                  </div>
                </div>
              
          </div>
      
    
            <!-- /.box-header -->
          <div class='box-body table-responsive'>
        <form action='includes/logic/newnoti.php' method = 'POST' class='hop'>
            <h2> Thông Báo Mới </h2>
            <input type='hidden' name= 'nv' value ='".$ruser['real_name']."'>
            <textarea name='info_noti' style='width:100%;height:150px;' placeholder='Nhập thông báo '></textarea>
       
        <br>
        <br>
        <button type='submit' class='btn'>Thêm</button>
        <input class='btn cancel btn-danger' onclick='goBack()' value= 'Hủy'/>
        </form>
      <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <script>
    function goBack() {
      window.history.back();
    }
    </script>
    </section>";
}
elseif($a=='add')
{ $do = $_GET['do'];
  if($do =='0'){
  echo"<form action='includes/logic/XL_them_kh.php' method='POST' class='form-container'>
  <h3>Thông tin Khách Hàng</h3>
  <div class='row'>
  
  <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
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
  <input type='hidden' value='".$ruser['real_name']."' name='nv_add'>
  <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
  <input type='tel' placeholder='Số Điện Thoại Khách Hàng' name='telKH' required>
  <label for='nameKH'><b>Tên Khách Hàng</b></label>
  <input type='text' placeholder='Nhập Tên Khách Hàng' name='nameKH' >
  
  <label for='note_book'><b>Ghi Chú Công Việc </b></label>
  <input type='text' placeholder='Ghi chú' name='note_book'>
  
  <label for='date_book'><b>Thời gian  : </b></label>
      <div class='row'>
          <div class='col-sm-6'>
          <input type='date'  name='date_book' value="; echo date('Y-m-d').">
          </div>
          <div class='col-sm-6'>
          
          </div>
      </div>
  <br>
  
  
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
      <button type='submit' class='btn'>Thêm</button>
      <span class='btn cancel btn-danger' data-dismiss='modal' aria-label='Close' >Đóng</span>
      </div>
  </form>";}
  else {
    echo"<form action='includes/logic/XL_them_bn.php' method='GET' class='form-container'>
    <h3>Thông tin Khách Hàng</h3>
    <div class='row'>
    <label for='nameKH'><b>Tên Bể Nước</b></label>
    <input type='text' placeholder='Nhập Tên ' name='nameBN' >
    <label for='addKH'><b>Địa Chỉ Bể Nước</b></label>
    <input type='text' placeholder='Nhập Địa Chỉ ' name='addBN' required>
    <input type='hidden' value='them' name='ac'>
    
    <label for='ycKH'><b>Đội Thợ</b></label>
    <input type='text' placeholder='Danh sách thợ ' name='grBN' required>

        <button type='submit' class='btn'>Thêm</button>
        <span class='btn cancel btn-danger' data-dismiss='modal' aria-label='Close'  > Đóng</span>
        </div>
    </form>";}
}
elseif($a == 'wk')
  {
    echo "
      <div class='row'>
      <section >
      <!-- /.content -->
        <div class='col-xs-12'>
          <div class='box'>
         
          <div class='box-header'>
          <h3 class='box-title'></h3>
                <div class='box-tools'>
                  <div class='input-group input-group-sm' style='width: 50px;'>
                        
                  <a href='".BASE_URL."index.php?action=wk&do=new' class='btn btn-sm btn-success'>Thêm Thợ Mới</a> 
    
                 </div>       
            </div>
        </div>
              
              <!-- /.box-header dien nuoc cho-->
              <div class='box-body table-responsive'>";
            require 'pages/action/tho.php';

            echo"  </div>
              <!-- /.box-body -->
         
            
            </div>
        </div>
      </section>  
      </div>    
      "; 
  }
elseif ($a=='chat') {
    # code...
    require 'chat/index.php';
  }
}
?>
        <!-- right col -->
</div>
      <!-- /.row (main row) -->
