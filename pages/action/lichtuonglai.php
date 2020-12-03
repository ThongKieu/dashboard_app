
<?php 
    if(!isset($_GET['time_search'])){
        $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
        $time_search = date('Y-m-d',$tomorrow);
     
    }
    else 
    {
        $time_search= $_GET['time_search'];
    }
    try {
     
     
     
     $sql = "SELECT id_cus, add_cus, des_cus, date_book, phone_cus, note_book,
                    flag_status, nv_add, yc_book,des_cus, kind_book FROM info_cus
            WHERE date_book like  '%$time_search%'  and kind_book like '%nuoc%' ";
     $q = $conn->query($sql);
     $q->setFetchMode(PDO::FETCH_ASSOC);
     
     $sql2 = "SELECT id_cus,add_cus,des_cus, date_book, phone_cus,note_book,
     flag_status,nv_add, yc_book,des_cus, kind_book FROM info_cus
    WHERE date_book like  '%$time_search%'  and kind_book like '%lanh%' ";
     $q2 = $conn->query($sql2);
     $q2->setFetchMode(PDO::FETCH_ASSOC);
     $sql3 = "SELECT id_cus,add_cus,des_cus, date_book, phone_cus,note_book,
     flag_status,nv_add, yc_book,des_cus, kind_book FROM info_cus
    WHERE date_book like  '%$time_search%'  and kind_book  like '%Go%' ";
     $q3 = $conn->query($sql3);
     $q3->setFetchMode(PDO::FETCH_ASSOC);

     $tho= $conn->prepare("select * FROM info_worker where status_worker =  0 order by name_worker ASC ");
        $tho->setFetchMode(PDO::FETCH_ASSOC); // set kiểu mảng cho giá trị trả về
        $tho->execute();
        $rs = $tho->fetchAll();
     } catch (PDOException $e) 
     {
         die("Could not connect to the database $dbname :" . $e->getMessage());
     }
     
    
 
 if(!isset($q))
     {
        echo "<h2> Không có dữ liệu</h2>";
     }
 
 else{   
 echo "
    <h3> Lịch Điện Nước</h3>
    <table class='table table-bordered '>
        <thead>
            <tr>
			    <th class='col-xs-1'>Yêu Cầu CV</th>
                <th class='col-xs-2'>Địa Chỉ </th>
				<th class='col-xs-1'>Quận </th>
                <th class='col-xs-1'>Số Điện Thoại</th>
                <th class='col-xs-1'>Thời Gian</th>
                <th class='col-xs-1'>Ghi Chú</th>
                <th class='col-xs-1'>Trạng Thái</th>
                <th class='col-xs-1'>Nhân ViênThêm</th>
                <th class='col-xs-2'>Thao Tác</th>
            </tr>
        </thead>
        <tbody>";
            while ($row = $q->fetch()):
                echo "<tr>
					<td>".htmlspecialchars($row['yc_book'])."</td> 
                    <td>".htmlspecialchars($row['add_cus'])."</td>
					<td>".htmlspecialchars($row['des_cus'])."</td> 
                    <td>".htmlspecialchars($row['phone_cus'])."</td> 
                    <td>".htmlspecialchars($row['date_book'])."</td> 
                    <td>".htmlspecialchars($row['note_book'])."</td> 
                    <td>".htmlspecialchars($row['flag_status'])."</td> 
                    <td>".htmlspecialchars($row['nv_add'])."</td>
                    <td><button type='button' class='btn btn-info btn-sm cls_btn tooltipButton' data-toggle='modal' data-tooltip='Phân Lịch' data-target='#phantho".$row['id_cus']."'><i class='fa fa-plus'></i></button>
                        <!-- Modal -->
                        <div id='phantho".$row['id_cus']."' class='modal fade' role='dialog'>
                            <div class='row'>
                                <div class='modal-dialog'>
                                    <!-- Modal content-->
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                            <h4 class='modal-title'>Chọn Thợ Bạn Muốn phân</h4>
                                        </div>
                                    <div class='modal-body'>
                                        <form action='includes/logic/XL_phan_lich.php' method='POST' class ='hop'>
                                        <label>Chọn Thợ cần Phân :</label>
                                        <input type ='hidden' name='ac' value='mai'/>
									    <input type='hidden' name='ki' value='mai'>
                                        <input type ='hidden' name='nv' value='".$ruser['real_name']."'/>
                                        <input type='hidden' name = 'id_cus' value='".$row['id_cus']."'/>
                                        <input type='hidden' name = 'note' value='".$row['note_book']."'/>
                                        <select name='name_worker'>";
                                            foreach ($rs as $row1) {
                                                echo '<option>';
                                                echo $row1['name_worker'] . ' ';
                                                echo $row1['add_worker'] . ' ';
                                                echo $row1['id_worker']." ";
                                                echo '</option>';
                                            }
                                         echo "</select><br>
                                         <label>Chọn Thợ phụ nếu cần  :</label>
                                         <select name='phu'>
                                         <option>Không có</option>
                                         ";
                                     foreach ($rs as $rowt) {
                                         echo '<option>';
                                         echo $rowt['name_worker'] . ' ';
                                         echo $rowt['add_worker'] . ' ';
                                         echo '</option>';
                                         }
                                     echo "</select>
                                 </div>
                                 <div class='modal-footer'>
                                 <input type='submit' value='Xác Nhận' class='btn btn-success'/>   <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                 </div>
                                 </form>
                                 </div>
     
                             </div>
                                 </div>
                             
                             </div>";
                      // sua thong tin lich KH 
                      echo"
                      <button type='button' data-toggle='modal' data-target='#my1".$row['id_cus']."'class='btn btn-sm btn-success tooltipButton cls_btn' data-tooltip='Sửa'><i class='fa fa-pencil' aria-hidden='true'></i></button>
                      <!-- Modal -->
                      <div id='my1".$row['id_cus']."' class='modal fade' role='dialog'>
                          <!-- Modal content-->
                          <div class='modal-content modal_content1'>
                                  <div class='modal-header'>
                                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                      <h4 class='modal-title text-center'>Sửa Thông Tin Lịch Khách Hàng</h4>
                                  </div>
                                  <div class='modal-body'>
                                      <form action='includes/logic/up_tt_KH.php'   method='POST' class ='form-container'>
                                      <input type='hidden' class='form-control' name ='id_cus' value='".$row['id_cus']."'>
                                      <input type='hidden'class='form-control' name ='nv' value='".$ruser['real_name']."'>
                                      <input type='hidden'class='form-control' name ='action' value='0'>
                                      <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
                                      <input type='text' class='form-control' name='addKH' value='".$row['add_cus']."' >
                                      <label for='desKH'><b>Quận</b></label>
                                      <input type='text' class='form-control' name= 'desKH' value='".$row['des_cus']."' >
                                      <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
                                      <input type='text' class='form-control' name ='telKH' value='".$row['phone_cus']."' >
                                      <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
                                      <input type='text' class='form-control' name = 'ycKH' value='".$row['yc_book']."'>  
                                      <label for='note_book'><b>Ghi Chú Công Việc </b></label>
                                      <input class='form-control' type='text' name='note_book' value='".$row['note_book']."' ></input>
                                      <label for='date_book'><b>Thời gian  : </b></label>
                                      <input type='date' class='form-control' name='date_book' value=" ;echo $row['date_book']."><br>
                                      <label for='date_book'><b>Loại CV: </b></label>
                                      <div class='row'>
                                          <div class='col-sm-4 text-center'> 
                                              <label class='check-container1'>Điện Lạnh
                                                  <input type='radio'"; if($row['kind_book']=='Điện Lạnh'){echo "checked='checked'";} echo "name='kind_book' value='Điện Lạnh'>
                                              </label>
                                          </div>
                                          <div class='col-sm-4 text-center'>
                                                  <label class='check-container1'>Điện Nước
                                                  <input type='radio'"; if($row['kind_book']=='Điện Nước'){echo "checked='checked'";} echo" name='kind_book' value='Điện Nước'>
                                              </label>
                                          </div>
                                          <div class='col-sm-4 text-center'>
                                              <label class='check-container1'>Đồ Gỗ
                                                  <input type='radio'";if($row['kind_book']=='Đồ Gỗ'){echo "checked='checked'";} echo" name='kind_book' value='Đồ Gỗ'>
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
                      // ket thuc sua thong tin kh
                      // Gap doi lich da dat 
                      echo"
                      <button type='button' data-toggle='modal' data-target='#my2".$row['id_cus']."'class='btn btn-sm btn-info tooltipButton cls_btn' data-tooltip='Nhân đôi lịch'><i class='fa fa-copy'></i></button>
                      <!-- Modal -->
                      <div id='my2".$row['id_cus']."' class='modal fade' role='dialog'>
                          <!-- Modal content-->
                          <div class='modal-content modal_content1'>
                              <div class='modal-header'>
                                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                  <h4 class='modal-title text-center'>Nhân Đôi Lịch Khách Hàng</h4>
                                  </div>
                               <div class='modal-body'>
                                  <form action='includes/logic/up_tt_KH.php'   method='POST' class ='form-container'>
                                      <input type='hidden' class='form-control' name ='id_cus' value='".$row['id_cus']."'>
                                      <input type='hidden'class='form-control' name ='nv' value='".$ruser['real_name']."'>
                                      <input type='hidden'class='form-control' name ='action' value='1'>
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
                                                  <input type='radio'"; if($row['kind_book']=='Điện Lạnh'){echo "checked='checked'";} echo "name='kind_book' value='Điện Lạnh'>
                                              </label>
                                          </div>
                                          <div class='col-sm-4 text-center'>
                                              <label class='check-container1'>Điện Nước
                                              <input type='radio'"; if($row['kind_book']=='Điện Nước'){echo "checked='checked'";} echo" name='kind_book' value='Điện Nước'>
                                              </label>
                                          </div>
                                          <div class='col-sm-4 text-center'>
                                              <label class='check-container1'>Đồ Gỗ
                                                  <input type='radio'";if($row['kind_book']=='Đồ Gỗ'){echo "checked='checked'";} echo" name='kind_book' value='Đồ Gỗ'>
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
                    //   khao sat 
                      echo"<a href ='".BASE_URL."includes/logic/deleteKH.php?hd=ks&id_cus=".$row['id_cus']."'class='btn btn-sm btn-primary cls_btn tooltipButton' data-tooltip='Khảo Sát' style='margin-right: 4px;'><i class='fa fa-list-alt'></i></a>";
                      //ket thuc khao sat
                      // huy lich
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
                      </div>
                    </td>
                </tr>";endwhile;
            echo "</tbody>
        </table>";
                                echo "
                                <h3> Lịch Điện Lạnh</h3>
                                <table class='table table-bordered '>
                                     <thead>
                                     <tr><th class='col-xs-1'>Yêu Cầu CV</th>
                                        <th class='col-xs-2'>Địa Chỉ </th>
										<th class='col-xs-1'>Quận</th>
                                        <th class='col-xs-1'>Số Điện Thoại</th>
                                        
                                        <th class='col-xs-1'>Thời Gian</th>
                                        <th class='col-xs-1'>Ghi Chú</th>
                                        <th class='col-xs-1'>Trạng Thái</th>
                                        <th class='col-xs-1'>Nhân Viên Thêm</th>

                                        <th class='col-xs-2'>Thao Tác</th>
                                        
                                    </tr>
                                     </thead>
                                     <tbody>";
                                         while ($row2 = $q2->fetch()):
                                                  echo "<tr>
												  <td>".htmlspecialchars($row2['yc_book'])."</td> 
                                                  <td>".htmlspecialchars($row2['add_cus'])."</td> 
												  <td>".htmlspecialchars($row2['des_cus'])."</td> 
                                                  <td>".htmlspecialchars($row2['phone_cus'])."</td> 
                                                  
                                                  <td>".htmlspecialchars($row2['date_book'])."</td> 
                                                  <td>".htmlspecialchars($row2['note_book'])."</td> 
                                                  <td>".htmlspecialchars($row2['flag_status'])."</td>
                                                  <td>".htmlspecialchars($row2['nv_add'])."</td>
                                                  
                                                         <td><button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#phantho".$row2['id_cus']."'>Phân</button>

                                                         <!-- Modal -->
                                                         <div id='phantho".$row2['id_cus']."' class='modal fade' role='dialog'>
                                                             <div class='row'>
                                                             <div class='modal-dialog'>
                                 
                                                             <!-- Modal content-->
                                                             <div class='modal-content'>
                                                             <div class='modal-header'>
                                                                 <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                                 <h4 class='modal-title'>Chọn Thợ Bạn Muốn phân</h4>
                                                             </div>
                                                             <div class='modal-body'>
                                                             <form action='includes/logic/XL_phan_lich.php' method='POST' class ='hop'>
                                                                 <label>Chọn Thợ cần Phân :</label>
                                                                 <input type ='hidden' name='ac' value='mai'/>
                                                                 <input type ='hidden' name='nv' value='".$ruser['real_name']."'/>
                                                                 <input type='hidden' name = 'id_cus' value='".$row2['id_cus']."'/>
                                                                 <input type='hidden' name = 'note' value='".$row2['note_book']."'/>
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
                                                                 <select name='phu'>
                                                                     <option>Không có</option>
                                                                 ";
                                                                 foreach ($rs as $rowt) {
                                                                     echo '<option>';
                                                                     
                                                                     echo $rowt['name_worker'] . ' ';
                                                                     echo $rowt['add_worker'] . ' ';
                                                                     echo '</option>';
                                                                     }  
                                                                 
                                                                 
                                                                 echo "</select>
                                                                
                                                             
                                                             </div>
                                                             <div class='modal-footer'>
                                                             <input type='submit' value='Xác Nhận' class='btn btn-success'/>   <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                                             </div>
                                                             </form>
                                                             </div>
                                 
                                                         </div>
                                                             </div>
                                                         
                                                         </div>";
                                                         echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row2['id_cus']."&action=sua&nv=".$ruser['real_name']." 'class='btn btn-sm btn-success'> Sửa</a>";
                                                         echo "&nbsp";
                                                         echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row2['id_cus']."&action=coppy 'class='btn btn-sm btn-info'>x2</a>";
                                                            echo "&nbsp";
                                                            echo"<a href ='".BASE_URL."includes/logic/deleteKH.php?hd=ks&id_cus=".$row2['id_cus']."'class='btn btn-sm btn-primary' >Khảo sát</a>";
                                                            echo "&nbsp";
                                                            echo"<button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='#my".$row2['id_cus']."'>Hủy</button>
  
                                                            <!-- Modal -->
                                                            <div id='my".$row2['id_cus']."' class='modal fade' role='dialog'>
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
																		<input type='hidden' name='ki' value='mai'>
                                                                        <input type='hidden' name='id_cus' value='".$row2['id_cus']."'>
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
                             
                                                            ";
                                                            
 echo "
    <h3> Lịch Thợ Mộc </h3>
    <table class='table table-bordered '>
        <thead>
        <tr><th class='col-xs-1'>Yêu Cầu CV</th>
        <th class='col-xs-2'>Địa Chỉ </th>
		<th class='col-xs-1'>Quận</th>
        <th class='col-xs-1'>Số Điện Thoại</th>
        
        <th class='col-xs-1'>Thời Gian</th>
        <th class='col-xs-1'>Ghi Chú</th>
        <th class='col-xs-1'>Trạng Thái</th>
        <th class='col-xs-1'>Nhân ViênThêm</th>
        
        <th class='col-xs-2'>Thao Tác</th>
       
 
                                                 
        </tr>
        </thead>
        <tbody>";
             while ($row3 = $q3->fetch()):
                      echo "<tr>
					  <td>".htmlspecialchars($row3['yc_book'])."</td> 
                      <td>".htmlspecialchars($row3['add_cus'])."</td> 
					  <td>".htmlspecialchars($row3['des_cus'])."</td> 
                      <td>".htmlspecialchars($row3['phone_cus'])."</td> 
                      
                      <td>".htmlspecialchars($row3['date_book'])."</td> 
                      <td>".htmlspecialchars($row3['note_book'])."</td> 
                      <td>".htmlspecialchars($row3['flag_status'])."</td> 
                      <td>".htmlspecialchars($row3['nv_add'])."</td> 
                      
                             <td><button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#phantho".$row3['id_cus']."'>Phân</button>

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
                                 <form action='includes/logic/XL_phan_lich.php' method='POST' class ='hop'>
                                     <label>Chọn Thợ cần Phân :</label>
                                     <input type ='hidden' name='ac' value='mai'/>
                                     <input type ='hidden' name='nv' value='".$ruser['real_name']."'/>
                                     <input type='hidden' name = 'id_cus' value='".$row3['id_cus']."'/>
                                     <input type='hidden' name = 'note' value='".$row3['note_book']."'/>
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
                                     <select name='phu'>
                                         <option>Không có</option>
                                     ";
                                     foreach ($rs as $rowt) {
                                         echo '<option>';
                                         
                                         echo $rowt['name_worker'] . ' ';
                                         echo $rowt['add_worker'] . ' ';
                                         echo '</option>';
                                         }  
                                     
                                     
                                     echo "</select>
                                    
                                 
                                 </div>
                                 <div class='modal-footer'>
                                 <input type='submit' value='Xác Nhận' class='btn btn-success'/>   <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                 </div>
                                 </form>
                                 </div>
     
                             </div>
                                 </div>
                             
                             </div>";
                            
                           
                           		echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row3['id_cus']."&action=sua&nv=".$ruser['real_name']." 'class='btn btn-sm btn-success'> Sửa</a>";
	 							echo "&nbsp";
                             	echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row3['id_cus']."&action=coppy 'class='btn btn-sm btn-info'>x2</a>";
                                echo "&nbsp";
                                echo"<a href ='".BASE_URL."includes/logic/deleteKH.php?hd=ks&id_cus=".$row3['id_cus']."'class='btn btn-sm btn-primary' >Khảo sát</a>";
                                echo "&nbsp";
                                echo"<button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='#my".$row3['id_cus']."'>Hủy</button>
  
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
";  }?>