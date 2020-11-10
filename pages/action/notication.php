<?php
$output = '';
//mysqli_set_charset($connect,'UTF8');

	
	$sql = ( "
			SELECT * 
			FROM notication  
            ORDER BY id_noti DESC LIMIT 20
	");
	    $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
	
       echo "

        <table class='table table-bordered '>
             <thead>
                 <tr>
                     <th class='col-md-6'>Nội Dung Thông Báo </th>
                     <th class='col-md-2'>Ngày Thêm </th>
                     <th class='col-md-2'>Nhân Viên Viết</th>
                     <th class='col-md-1'>Thao Tác</th>
                     
                    </tr>
                     
             </thead>
             <tbody>";
                 while ($row = $q->fetch()):
                          echo "<tr>
                          <td>".htmlspecialchars($row['info_noti'])."</td> 
                          <td>".htmlspecialchars($row['date_noti'])."</td> 
                          <td>".htmlspecialchars($row['nv_add'])."</td>
                          
                          
                          <td><a href='".BASE_URL."includes/logic/delnoti.php?id=".$row['id_noti']."' class ='btn btn-sm btn-danger' ";if($ruser['level']==0) {echo "disabled";} echo ">Xóa</a></td>
                                      
                           
                             </tr>";
                         endwhile;
                 
             echo "</tbody>
             
         </table>	
       
                                    ";
	
?>