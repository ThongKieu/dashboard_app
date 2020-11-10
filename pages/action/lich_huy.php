<?php 
    
    
   try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
    
    $sql = "SELECT id_cus,name_cus,phone_cus,add_cus,des_cus,yc_book, note_book,date_book,flag_status FROM info_cus 
             WHERE  date_book like '%$timelive%' and flag_book = '1'  and flag_status like '%huy%' ";
             
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    if(empty($q))
    {
        $sql = "SELECT id_cus, name_cus, phone_cus, add_cus, des_cus, yc_book, note_book, date_book,flag_status FROM info_cus 
        WHERE    flag_book = '1'  and flag_status like '%huy%' ";
             
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
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
                            
                            <td><?php echo "<a href ='".BASE_URL."includes/logic/XL_thu_huy.php?id_cus=".$row['id_cus']."&do=0 'class='btn btn-sm btn-danger'> Thu Hồi</a>";?></td>
							<td><?php if($ruser['level'] !=0) echo "<a href ='".BASE_URL."includes/logic/XL_thu_huy.php?id_cus=".$row['id_cus']."&do=1 'class='btn btn-sm btn-danger'> Xóa Vĩnh Viễn</a>";?></td>
                        </tr>
                    <?php endwhile; ?>
            
        </tbody>
    </table>	