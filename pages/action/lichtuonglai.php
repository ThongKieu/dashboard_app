
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
                    flag_status, nv_add, yc_book,des_cus FROM info_cus
            WHERE date_book like  '%$time_search%'  and kind_book like '%nuoc%' ";
     $q = $conn->query($sql);
     $q->setFetchMode(PDO::FETCH_ASSOC);
     
     $sql2 = "SELECT id_cus,add_cus,des_cus, date_book, phone_cus,note_book,
     flag_status,nv_add, yc_book,des_cus FROM info_cus
    WHERE date_book like  '%$time_search%'  and kind_book like '%lanh%' ";
     $q2 = $conn->query($sql2);
     $q2->setFetchMode(PDO::FETCH_ASSOC);
     $sql3 = "SELECT id_cus,add_cus,des_cus, date_book, phone_cus,note_book,
     flag_status,nv_add, yc_book,des_cus FROM info_cus
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
                     
                      
                             <td><button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#phantho".$row['id_cus']."'>Phân</button>

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
                      echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row['id_cus']."&action=sua&nv=".$ruser['real_name']." 'class='btn btn-sm btn-success'> Sửa</a>";
                             echo "&nbsp";
                             echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row['id_cus']."&action=coppy 'class='btn btn-sm btn-info'>x2</a>";
                                echo "&nbsp";
                                echo"<a href ='".BASE_URL."includes/logic/deleteKH.php?hd=ks&id_cus=".$row['id_cus']."'class='btn btn-sm btn-primary' >Khảo sát</a>";
                                echo "&nbsp";
                                echo"<button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='#my".$row['id_cus']."'>Hủy</button>
  
                                <!-- Modal -->
                                <div id='my".$row['id_cus']."' class='modal fade' role='dialog'>
                                <div class='modal-dialog'>
     
                                    <!-- Modal content-->
                                    <div class='modal-content'>
                                        <form action='includes/logic/deleteKH.php' method='GET'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
											<input type='hidden' name='ki' value='mai'>
                                            <h4 class='modal-title'>Nguyên Nhân Hủy</h4>
                                        </div>
     
                                        <div class='modal-body'>
                                        <input type ='hidden' name='action' value='mai'/>
                                        <input type ='hidden' name='nv' value='".$ruser['real_name']."'/>
                                            <input type='hidden' name='hd' value='huy'>
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
                              
                         </tr>";
                     endwhile;
             
         echo "</tbody>
         
     </table>	
 
                                ";
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