
<?php 
    if(!isset($_GET['time_search'])){
    
    $time_search = date('Y-m-d');
    }
    else 
    {
        $time_search= $_GET['time_search'];
    }
    try {
     
     $sql = "SELECT id_cus,name_cus, phone_cus, add_cus, des_cus, yc_book, note_book, kind_book, date_book , nv_add
        FROM info_cus where kind_book like '%nuoc%' and  flag_book = '0' and date_book like '%$time_search%' and flag_status is NULL order by des_cus ASC";
     $q = $conn->query($sql);
     $q->setFetchMode(PDO::FETCH_ASSOC);
     
     $sql2 = "SELECT id_cus,name_cus, phone_cus, add_cus, des_cus, yc_book, note_book, kind_book, date_book , nv_add
     FROM info_cus where kind_book like '%lanh%' and  flag_book = '0' and date_book like '%$time_search%' and flag_status is NULL order by des_cus ASC";
     $q2 = $conn->query($sql2);
     $q2->setFetchMode(PDO::FETCH_ASSOC);
     $sql3 = "SELECT id_cus,name_cus, phone_cus, add_cus, des_cus, yc_book, note_book, kind_book, date_book , nv_add
     FROM info_cus where kind_book like '%go%' and  flag_book = '0' and date_book like '%$time_search%' and flag_status is NULL order by des_cus ASC ";
     $q3 = $conn->query($sql3);
     $q3->setFetchMode(PDO::FETCH_ASSOC);

    
     $tho= $conn->prepare("select * FROM info_worker where status_worker = 0 and today_off = 0  order by name_worker ASC ");
        $tho->setFetchMode(PDO::FETCH_ASSOC); // set kiểu mảng cho giá trị trả về
        $tho->execute();
        $rs = $tho->fetchAll();// đổ toàn bộ dự liệu thu về vào mảng
        
       

        
        
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
    <form action='includes/logic/XL_phan_nhieu.php' methot='POST'>
    <input type= 'hidden' name='action' value='nhieu'>
    <table class='table table-bordered '>
   
    <thead>
            
                <tr>
                <th class='col-md-2'>Thông Tin</th>
                <th class='col-md-1'>Tên KH</th>
                <th class='col-md-2'>Địa Chỉ</th>
                <th class='col-md-1'>Quận</th>
                <th class='col-md-1'>Số Điện Thoại</th>
                <th class='col-md-1'>Thời Gian</th>
                <th class='col-md-1' >Ghi chú</th>
                <th class='col-md-1' >Người Thêm</th>
                <th class='col-md-1'>Chọn</th>
                <th class='col-md-1'>Phân</th>
  
                </tr>

            </thead>

         <tbody>";
             while ($row = $q->fetch()):
                      echo "
                      <tr>
                      <td >".htmlspecialchars($row['yc_book'])."</td>
                      <td >".htmlspecialchars($row['name_cus'])."</td>
                      
                      <td >".htmlspecialchars($row['add_cus'])."</td>
                      <td >".htmlspecialchars($row['des_cus'])."</td>
                      <td >".htmlspecialchars($row['phone_cus'])."</td>
                      <td >".htmlspecialchars($row['date_book'])."</td>
                      <td>".htmlspecialchars($row['note_book'])."</td>
                      <td >".htmlspecialchars($row['nv_add'])."</td>
                      <td>
                      
                      <input type = 'checkbox'  name='id[]' value = '".$row['id_cus']."' >
                            
                    </td>
                    <td>  <button type='submit' class = 'btn btn-success btn-block' >Phân Nhiều Lịch</button></td>
                    
             </tr>";
                     endwhile;
                
         echo "</tbody>
         <input type ='hidden' name='nv' value='".$ruser['real_name']."'/>
         
        
        <tfooter>
        
        </tfooter>
     </table>	
     </form> 
   ";
   echo "
    <h3> Lịch Điện Lạnh</h3>
    <form action='includes/logic/XL_phan_nhieu.php' methot='POST'>
    <input type= 'hidden' name='action' value='nhieu'>
    <table class='table table-bordered '>
   
    <thead>
            
                <tr>
                <th class='col-md-2'>Thông Tin</th>
                <th class='col-md-1'>Tên KH</th>
                <th class='col-md-2'>Địa Chỉ</th>
                <th class='col-md-1'>Quận</th>
                <th class='col-md-1'>Số Điện Thoại</th>
                <th class='col-md-1'>Thời Gian</th>
                <th class='col-md-1' >Ghi chú</th>
                <th class='col-md-1' >Người Thêm</th>
                < <th class='col-md-1'>Chọn</th>
                <th class='col-md-1'>Phân</th>
  
                </tr>

            </thead>

         <tbody>";
             while ($row2 = $q2->fetch()):
                      echo "
                      <tr>
                      <td >".htmlspecialchars($row2['yc_book'])."</td>
                      <td >".htmlspecialchars($row2['name_cus'])."</td>
                      
                      <td >".htmlspecialchars($row2['add_cus'])."</td>
                      <td >".htmlspecialchars($row2['des_cus'])."</td>
                      <td >".htmlspecialchars($row2['phone_cus'])."</td>
                      <td >".htmlspecialchars($row2['date_book'])."</td>
                      <td>".htmlspecialchars($row2['note_book'])."</td>
                      <td >".htmlspecialchars($row2['nv_add'])."</td>
                      <td>
                      
                      <input type = 'checkbox'  name='id[]' value = '".$row2['id_cus']."' >
                            
                    </td>
                    <td>  <button type='submit' class = 'btn btn-success btn-block' >Phân Nhiều Lịch</button></td>
                    
             </tr>";
                     endwhile;
                
         echo "</tbody>
         <input type ='hidden' name='nv' value='".$ruser['real_name']."'/>
         
        
        <tfooter>
        
        </tfooter>
     </table>	
     </form> 
   ";
  
 echo "
 <h3> Lịch Điện Nước</h3>
 <form action='includes/logic/XL_phan_nhieu.php' methot='POST'>
 <input type= 'hidden' name='action' value='nhieu'>
 <table class='table table-bordered '>

 <thead>
         
             <tr>
             <th class='col-md-2'>Thông Tin</th>
             <th class='col-md-1'>Tên KH</th>
             <th class='col-md-2'>Địa Chỉ</th>
             <th class='col-md-1'>Quận</th>
             <th class='col-md-1'>Số Điện Thoại</th>
             <th class='col-md-1'>Thời Gian</th>
             <th class='col-md-1' >Ghi chú</th>
             <th class='col-md-1' >Người Thêm</th>
             <th class='col-md-1'>Chọn</th>
             <th class='col-md-1'>Phân</th>

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
                   <td >".htmlspecialchars($row3['date_book'])."</td>
                   <td>".htmlspecialchars($row3['note_book'])."</td>
                   <td >".htmlspecialchars($row3['nv_add'])."</td>
                   <td>
                   
                   <input type = 'checkbox'  name='id[]' value = '".$row3['id_cus']."' >
                         
                 </td>
                 <td>  <button type='submit' class = 'btn btn-success btn-block' >Phân Nhiều Lịch</button></td>
                 
          </tr>";
                  endwhile;
             
      echo "</tbody>
      <input type ='hidden' name='nv' value='".$ruser['real_name']."'/>
      
     
     <tfooter>
     
     </tfooter>
  </table>	
  </form> 
";}?>
 