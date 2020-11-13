<?php 
    if(!isset($_GET['time_search'])){
    
        $time_search = date('Y-m-d');
        }
        else 
        {
            $time_search= $_GET['time_search'];
        }
    try {
     
     
     
     $sql = "SELECT work_do.id_cus, work_do.id_work,info_cus.add_cus,info_cus.des_cus,info_cus.date_book, info_cus.phone_cus,info_worker.name_worker,info_cus.note_book,
             work_do.sum_chi, work_do.sum_thu,work_do.note_work, info_cus.flag_status, work_do.nv_phan FROM work_do , info_cus, info_worker 
             WHERE  info_cus.flag_book = 1 and work_do.id_cus = info_cus.id_cus and work_do.id_worker = info_worker.id_worker and info_cus.date_book like '%$time_search%'  and info_cus.kind_book like '%nuoc%' ";
     $q = $conn->query($sql);
     $q->setFetchMode(PDO::FETCH_ASSOC);
     
     $sql2 = "SELECT work_do.id_cus, work_do.id_work,info_cus.add_cus,info_cus.des_cus,info_cus.date_book, info_cus.phone_cus,info_worker.name_worker,info_cus.note_book,
             work_do.sum_chi, work_do.sum_thu,work_do.note_work, info_cus.flag_status, nv_phan FROM work_do , info_cus, info_worker 
             WHERE  info_cus.flag_book = 1 and work_do.id_cus = info_cus.id_cus and work_do.id_worker = info_worker.id_worker and info_cus.date_book like '%$time_search%'  and info_cus.kind_book like '%lanh%' ";
     $q2 = $conn->query($sql2);
     $q2->setFetchMode(PDO::FETCH_ASSOC);
     $sql3 = "SELECT work_do.id_cus, work_do.id_work,info_cus.add_cus,info_cus.des_cus,info_cus.date_book, info_cus.phone_cus,info_worker.name_worker,info_cus.note_book,
             work_do.sum_chi, work_do.sum_thu,work_do.note_work, info_cus.flag_status, nv_phan FROM work_do , info_cus, info_worker 
             WHERE  info_cus.flag_book = 1 and work_do.id_cus = info_cus.id_cus and work_do.id_worker = info_worker.id_worker and info_cus.date_book like '%$time_search%'  and info_cus.kind_book like '%go%' ";
     $q3 = $conn->query($sql3);
     $q3->setFetchMode(PDO::FETCH_ASSOC);
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
                 <th class='col-xs-2'>Địa Chỉ </th>
                 <th class='col-xs-1'>Số Điện Thoại</th>
                 <th class='col-xs-0.5'>Thợ Làm</th>
                 <th class='col-xs-1'>Thời Gian</th>
                 <th class='col-xs-1'>Ghi Chú</th>
                 <th class='col-xs-1'>Trạng Thái</th>
                 <th class='col-xs-1'>Nhân Viên Phân</th>
                 <th class='col-xs-1'>Tổng Thu</th>
                 <th class='col-xs-1'>Tổng Chi</th>
                 <th class='col-xs-2'>Thao Tác</th>
                 <th class='col-xs-1'>Phản Hồi</th>
                </tr>
                 
         </thead>
         <tbody>";
             while ($row = $q->fetch()):
                      echo "<tr>
                      <td>".htmlspecialchars($row['add_cus'])."</td> 
                      <td>".htmlspecialchars($row['phone_cus'])."</td> 
                      <td>".htmlspecialchars($row['name_worker'])."</td>
                      <td>".htmlspecialchars($row['date_book'])."</td> 
                      <td>".htmlspecialchars($row['note_book'])."</td> 
                      <td>".htmlspecialchars($row['flag_status'])."</td> 
                      <td>".htmlspecialchars($row['nv_phan'])."</td>  
                      <td>".htmlspecialchars($row['sum_thu'])."</td>
                      <td>".htmlspecialchars($row['sum_chi'])."</td>
                      <td>";
                      echo "<a href ='".BASE_URL."includes/logic/thu_chi.php?id_work=".$row['id_work']."&idq=1&ation=7&time_search=".$time_search." 'class='btn btn-sm btn-success'"; if($row['flag_status'] == 'Hủy'|| $row['flag_status']=='Khảo Sát'|| $row['sum_thu']  > 0 ){
                          echo "disabled";
                      } echo" >Nhập</a>";
                      echo "&nbsp";
                      echo "<a href ='".BASE_URL."includes/logic/thu_chi.php?id_work=".$row['id_work']."&idq=2'class='btn btn-sm btn-info'"; if($row['flag_status']=='Khảo sát'||$row['flag_status']=='Hủy' ){echo 'disabled';} echo ">Sửa</a>";
                      echo "&nbsp";
                      echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row['id_cus']."&action=coppy&nv=".$ruser['real_name']." 'class='btn btn-sm btn-info'>x2</a>";
                        echo "&nbsp";
                        echo"<a href ='".BASE_URL."includes/logic/deleteKH.php?hd=ks&id_cus=".$row['id_cus']."'class='btn btn-sm btn-primary' "; if($row['flag_status']=='Hủy'||$row['flag_status']=='Khảo Sát'|| $row['sum_thu']  > 0 ){echo 'disabled';} echo ">Khảo sát</a>";
                        echo "&nbsp";
                        echo"<button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='#my".$row['id_cus']."'>Hủy Lịch</button>
  
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
                             <td>"; if($row['note_work']==NULL) 
                                    {
                                        echo "<a href ='".BASE_URL."includes/logic/thu_chi.php?id_work=".$row['id_work']."&idq=3'class='btn btn-sm btn-danger'>Chăm Sóc</a>";
                                    
                                    }
                                    else{
                                        echo $row['note_work'];
                                    }
                             echo "</td>   
                         </tr>";
                     endwhile;
             
         echo "</tbody>
         
     </table>	
 
                                ";
                                echo "
                                <h3> Lịch Điện Lạnh</h3>
                                <table class='table table-bordered '>
                                     <thead>
                                     <tr>
                                        <th class='col-xs-2'>Địa Chỉ </th>
                                        <th class='col-xs-1'>Số Điện Thoại</th>
                                        <th class='col-xs-0.5'>Thợ Làm</th>
                                        <th class='col-xs-1'>Thời Gian</th>
                                        <th class='col-xs-1'>Ghi Chú</th>
                                        <th class='col-xs-1'>Trạng Thái</th>
                                        <th class='col-xs-1'>Nhân Viên Phân</th>
                                        <th class='col-xs-1'>Tổng Thu</th>
                                        <th class='col-xs-1'>Tổng Chi</th>
                                        <th class='col-xs-2'>Thao Tác</th>
                                        <th class='col-xs-1'>Phản Hồi</th>
                                    </tr>
                                     </thead>
                                     <tbody>";
                                         while ($row2 = $q2->fetch()):
                                                  echo "<tr>
                                                  <td>".htmlspecialchars($row2['add_cus'])."</td> 
                                                  <td>".htmlspecialchars($row2['phone_cus'])."</td> 
                                                  <td>".htmlspecialchars($row2['name_worker'])."</td>
                                                  <td>".htmlspecialchars($row2['date_book'])."</td> 
                                                  <td>".htmlspecialchars($row['note_book'])."</td> 
                                                  <td>".htmlspecialchars($row2['flag_status'])."</td>
                                                  <td>".htmlspecialchars($row2['nv_phan'])."</td>  
                                                
                                                         <td>".htmlspecialchars($row2['sum_thu'])."</td>
                                                         <td>". htmlspecialchars($row2['sum_chi'])."</td>
                                                         <td>";
                           
                                                         echo "<a href ='".BASE_URL."includes/logic/thu_chi.php?id_work=".$row2['id_work']."&idq=1 'class='btn btn-sm btn-success'"; if($row2['flag_status'] == 'Hủy'|| $row2['flag_status']=='Khảo Sát'|| $row2['sum_thu']  > 0 ){
                                                            echo "disabled";
                                                        } echo" >Nhập</a>";
                                                        echo "&nbsp";
                                                        echo "<a href ='".BASE_URL."includes/logic/thu_chi.php?id_work=".$row2['id_work']."&idq=2'class='btn btn-sm btn-info'"; if($row2['flag_status']=='Khảo sát'||$row2['flag_status']=='Hủy' ){echo 'disabled';} echo ">Sửa</a>";
                                                        echo "&nbsp";
                                                        echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row2['id_cus']."&action=coppy&nv=".$ruser['real_name']." 'class='btn btn-sm btn-info'>x2</a>";
                                                          echo "&nbsp";
                                                          echo"<a href ='".BASE_URL."includes/logic/deleteKH.php?hd=ks&id_cus=".$row2['id_cus']."'class='btn btn-sm btn-primary' "; if($row2['flag_status']=='Hủy'||$row2['flag_status']=='Khảo Sát'|| $row2['sum_thu']  > 0 ){echo 'disabled';} echo ">Khảo sát</a>";
                                                          echo "&nbsp";
                                                          echo"<button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='#my".$row2['id_cus']."'>Hủy Lịch</button>
  
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
                                                         <td>"; if($row2['note_work']==NULL) 
                                                                {
                                                                    echo "<a href ='".BASE_URL."includes/logic/thu_chi.php?id_work=".$row2['id_work']."&idq=3'class='btn btn-sm btn-danger'>Chăm Sóc</a>";
                                                                
                                                                }
                                                                else{
                                                                    echo $row2['note_work'];
                                                                }
                                                         echo "</td>   
                                                     </tr>";
                                                 endwhile;
                                         
                                     echo "</tbody>
                                     
                                 </table>	
                             
                                                            ";
                                                            
 echo "
    <h3> Lịch Thợ Mộc </h3>
    <table class='table table-bordered '>
        <thead>
        <tr>
            <th class='col-xs-2'>Địa Chỉ </th>
            <th class='col-xs-1'>Số Điện Thoại</th>
            <th class='col-xs-0.5'>Thợ Làm</th>
            <th class='col-xs-1'>Thời Gian</th>
            <th class='col-xs-1'>Ghi Chú</th>
            <th class='col-xs-1'>Trạng Thái</th>
            <th class='col-xs-1'>Nhân Viên Phân</th>
            <th class='col-xs-1'>Tổng Thu</th>
            <th class='col-xs-1'>Tổng Chi</th>
            <th class='col-xs-2'>Thao Tác</th>
            <th class='col-xs-1'>Phản Hồi</th>
        </tr>
        </thead>
        <tbody>";
             while ($row3 = $q3->fetch()):
                      echo "<tr>
                      <td>".htmlspecialchars($row3['add_cus'])."</td> 
                      <td>".htmlspecialchars($row3['phone_cus'])."</td> 
                      <td>".htmlspecialchars($row3['name_worker'])."</td>
                      <td>".htmlspecialchars($row3['date_book'])."</td> 
                      <td>".htmlspecialchars($row['note_book'])."</td> 
                      <td>".htmlspecialchars($row3['flag_status'])."</td> 
                      <td>".htmlspecialchars($row3['nv_phan'])."</td> 
                      
                             <td>".htmlspecialchars($row3['sum_thu'])."</td>
                             <td>". htmlspecialchars($row3['sum_chi'])."</td>
                             <td>";
                           
                             echo "<a href ='".BASE_URL."includes/logic/thu_chi.php?id_work=".$row3['id_work']."&idq=1 'class='btn btn-sm btn-success'"; if($row3['flag_status'] == 'Hủy'|| $row3['flag_status']=='Khảo Sát'|| $row3['sum_thu']  > 0 ){
                                echo "disabled";
                            } echo" >Nhập</a>";
                            echo "&nbsp";
                            echo "<a href ='".BASE_URL."includes/logic/thu_chi.php?id_work=".$row3['id_work']."&idq=2'class='btn btn-sm btn-info'"; if($row3['flag_status']=='Khảo sát'||$row3['flag_status']=='Hủy' ){echo 'disabled';} echo ">Sửa</a>";
                            echo "&nbsp";
                            echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row3['id_cus']."&action=coppy&nv=".$ruser['real_name']." 'class='btn btn-sm btn-info'>x2</a>";
                              echo "&nbsp";
                              echo"<a href ='".BASE_URL."includes/logic/deleteKH.php?hd=ks&id_cus=".$row3['id_cus']."'class='btn btn-sm btn-primary' "; if($row3['flag_status']=='Hủy'||$row3['flag_status']=='Khảo Sát'|| $row3['sum_thu']  > 0 ){echo 'disabled';} echo ">Khảo sát</a>";
                              echo "&nbsp";
                              echo"<button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='#my".$row3['id_cus']."'>Hủy Lịch</button>
  
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
                             <td>"; if($row3['note_work']==NULL) 
                                    {
                                        echo "<a href ='".BASE_URL."includes/logic/thu_chi.php?id_work=".$row3['id_work']."&idq=3'class='btn btn-sm btn-danger'>Chăm Sóc</a>";
                                    
                                    }
                                    else{
                                        echo $row3['note_work'];
                                    }
                             echo "</td>   
                         </tr>";
                     endwhile;
             
         echo "</tbody>
         
     </table>	
";  }?>