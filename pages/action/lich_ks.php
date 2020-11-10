<?php 
    
    
   try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
    
    $sql = "SELECT id_cus,name_cus,phone_cus,add_cus,des_cus,yc_book, note_book,date_book,flag_status FROM info_cus 
             WHERE  date_book like '%$timelive%' and flag_book = '1'  and flag_status like '%Sat%' ";
             
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    if(empty($q))
    {
        $sql = "SELECT id_cus, name_cus, phone_cus, add_cus, des_cus, yc_book, note_book, date_book,flag_status FROM info_cus 
        WHERE    flag_book = '1'  and flag_status like '%Sat%' ";
             
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
	$tho= $conn->prepare("select * FROM info_worker where status_worker = 0 and today_off = 0  order by name_worker ASC ");
    $tho->setFetchMode(PDO::FETCH_ASSOC); // set kiểu mảng cho giá trị trả về
    $tho->execute();
    $rs = $tho->fetchAll();	
    }
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
    ?>

 
<table class="table table-bordered cart_summary">
        <thead>
            <tr>
                
                <th>Tên KH</th>
                
                <th>Địa Chỉ</th>
                <th>Quận</th>
                <th>Số Điện Thoại</th>
                <th>Yêu Cầu CV</th>
                <th>Ghi chú</th>
                <th>Trạng Thái</th>
                <th>Ngày Đặt Lich</th>
                <th>Thu Hồi</th>
            </tr> 
        </thead>
        <tbody>
            <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name_cus']); ?></td>
                            
                            <td><?php echo htmlspecialchars($row['add_cus']); ?></td>
                            <td><?php echo htmlspecialchars($row['des_cus']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone_cus']); ?></td>
                            <td><?php echo htmlspecialchars($row['yc_book']); ?></td>
                            <td><?php echo htmlspecialchars($row['note_book']); ?></td>
                            <td><?php echo htmlspecialchars($row['flag_status']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_book']); ?></td>
                            
                            <td><?php echo "<a href ='".BASE_URL."includes/logic/XL_thu_huy.php?id_cus=".$row['id_cus']." &do=0'class='btn btn-sm btn-danger'> Thu Hồi</a>";
								            echo "<button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#phantho".$row['id_cus']."'>Phân</button>

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
                                <input type ='hidden' name='ac' value ='phanthoKS' />
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
                        
                        </div>";?>
							</td>
                        </tr>
                    <?php endwhile; ?>
            
        </tbody>
        <tfoot>
          
        </tfoot>
    </table>	