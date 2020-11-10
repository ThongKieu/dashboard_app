
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
        FROM info_cus where kind_book like '%nuoc%' and  flag_book = '0' and date_book like '%$time_search%' and flag_status is NULL order by des_cus DESC";
     $q = $conn->query($sql);
     $q->setFetchMode(PDO::FETCH_ASSOC);
     
     $sql2 = "SELECT id_cus,name_cus, phone_cus, add_cus, des_cus, yc_book, note_book, kind_book, date_book , nv_add
     FROM info_cus where kind_book like '%lanh%' and  flag_book = '0' and date_book like '%$time_search%' and flag_status is NULL order by des_cus DESC";
     $q2 = $conn->query($sql2);
     $q2->setFetchMode(PDO::FETCH_ASSOC);
     $sql3 = "SELECT id_cus,name_cus, phone_cus, add_cus, des_cus, yc_book, note_book, kind_book, date_book , nv_add
     FROM info_cus where kind_book like '%go%' and  flag_book = '0' and date_book like '%$time_search%' and flag_status is NULL order by des_cus DESC ";
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
 <div class='container-fluid'>
    <div class='row'> 
        <div class= 'col-xs-6'style='padding-left:10px;'>
            <h3 style='color: #00c0ef; padding:5px;text-align: center;border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 5px #d2d6de;'>Lịch Chưa Xử Lý</h3>
        </div>
        <div class= 'col-xs-6'style='padding:0; padding-right:10px;'>
            <h3 style='color: #00c0ef; padding:5px; text-align: center;border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 5px #d2d6de;'>Lịch Đã Xử Lý</h3>
        </div>
    </div>
    <h3 style='color: #00c0ef; padding:5px 10px 5px 10px;text-align: center;border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 5px #d2d6de;'>Lịch Điện Nước</h3>
    <div class='row'>
        <div class='col-xs-6' style='padding-right:10px'>
            <table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th class='col-md-2'>Thông Tin</th>
                    <th class='col-md-1'>Tên KH</th>
                    <th class='col-md-2'>Địa Chỉ</th>
                    <th class='col-md-1'>Quận</th>
                    <th class='col-md-1'>Số Điện Thoại</th>
                    <th class='col-md-1'>Ghi chú</th>
                    <th class='col-md-2'>Thao Tác</th>
                </tr>
            </thead>
            <tbody>"; while ($row = $q->fetch()): echo "
                <tr>
                    <th>".htmlspecialchars($row['yc_book'])."</th>
                    <td>".htmlspecialchars($row['name_cus'])."</td>
                    <td>".htmlspecialchars($row['add_cus'])."</td>
                    <td>".htmlspecialchars($row['des_cus'])."</td>
                    <td>".htmlspecialchars($row['phone_cus'])."</td>
                    <td>".htmlspecialchars($row['note_book'])."</td>
                    <td>
                    <button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#phantho".$row['id_cus']."'>Phân</button>
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
                                        <form action='includes/logic/XL_phan_lich.php' method='POST' class='modal-body'>
                                            <label>Chọn Thợ cần Phân :</label>
                                            <input type='hidden' name='ac' value='phantho' />
                                            <input type='hidden' name='nv' value='".$ruser['real_name']."'/>
                                            <input type='hidden' name='id_cus' value='".$row['id_cus']."'/>
                                            <input type='hidden' name='note' value='".$row['note_book']."'/>
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
                </div>
                    &nbsp"; echo "<a href='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row['id_cus']."&action=sua&nv=".$ruser['real_name']." 'class='btn btn-sm btn-success'> Sửa</a>"; echo "&nbsp"; echo "<a href='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row['id_cus']."&action=coppy&nv=".$ruser['real_name']." 'class='btn btn-sm btn-info'>x2</a>"; echo "&nbsp"; echo"<button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#my".$row['id_cus']."'>Hủy</button>
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
                                            <textarea style='width:100%' name='nnHuy'></textarea>
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='submit' class='btn btn-default' value='Xác Nhận' />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>"; endwhile; echo "</tbody>
            </table>
        </div> <!--ket thuc cot-->
        <div class='col-xs-6' style='padding-left:0px'>
            <table class='table table-bordered table-hover'>
                <thead>
                    <tr>
                        <th class='col-md-2'>Thông Tin</th>
                        <th class='col-md-1'>Tên KH</th>
                        <th class='col-md-2'>Địa Chỉ</th>
                        <th class='col-md-1'>Quận</th>
                        <th class='col-md-1'>Số Điện Thoại</th>
                        <th class='col-md-1'>Ghi chú</th>
                        <th class='col-md-2'>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>"; while ($row = $q->fetch()): echo "
                    <tr>
                        <th>".htmlspecialchars($row['yc_book'])."</th>
                        <td>".htmlspecialchars($row['name_cus'])."</td>
                        <td>".htmlspecialchars($row['add_cus'])."</td>
                        <td>".htmlspecialchars($row['des_cus'])."</td>
                        <td>".htmlspecialchars($row['phone_cus'])."</td>
                        <td>".htmlspecialchars($row['note_book'])."</td>
                        <td>
                            <button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#phantho".$row['id_cus']."'>Phân</button>
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
                                                <form action='includes/logic/XL_phan_lich.php' method='POST' class='hop'>
                                                    <label>Chọn Thợ cần Phân :</label>
                                                    <input type='hidden' name='ac' value='phantho' />
                                                    <input type='hidden' name='nv' value='".$ruser['real_name']."'/>
                                                    <input type='hidden' name='id_cus' value='".$row['id_cus']."'/>
                                                    <input type='hidden' name='note' value='".$row['note_book']."'/>
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
                                                    <textarea style='width: 100%; hight:120px;' name='phu'></textarea>
                                                </form>
                                            </div>
                                            <div class='modal-footer'>
                                                <input type='submit' value='Xác Nhận' class='btn btn-success' />
                                                <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            &nbsp"; echo "<a href='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row['id_cus']."&action=sua&nv=".$ruser['real_name ']." 'class='btn btn-sm btn-success'> Sửa</a>"; echo "&nbsp"; echo "<a href='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row['id_cus']."&action=coppy&nv=".$ruser['real_name ']." 'class='btn btn-sm btn-info'>x2</a>"; echo "&nbsp"; echo"<button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#my".$row['id_cus']."'>Hủy</button>
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
                                                <textarea style='width:100%' name='nnHuy'></textarea>
                                            </div>
                                            <div class='modal-footer'>
                                                <input type='submit' class='btn btn-default' value='Xác Nhận' />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>"; endwhile; 
                echo "</tbody>
            </table>
        </div> <!--ket thuc cot-->
    </div> <!--ket thuc dong-->";
    echo"
    <h3 style='color: #00c0ef; padding:5px 10px 5px 10px;text-align: center;border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 5px #d2d6de;'>Lịch Điện Lạnh</h3>
    <div class='row'>
        <div class='col-xs-6'style='padding-right:10px' >
            <table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th class='col-md-2'>Thông Tin</th>
                    <th class='col-md-1'>Tên KH</th>
                    <th class='col-md-2'>Địa Chỉ</th>
                    <th class='col-md-1'>Quận</th>
                    <th class='col-md-1'>Số Điện Thoại</th>
                    <th class='col-md-1'>Ghi chú</th>
                    <th class='col-md-2'>Thao Tác</th>
                </tr>
            </thead>
            <tbody>";
            while ($row2 = $q2->fetch()):
            echo "
                <tr>
                    <th >".htmlspecialchars($row2['yc_book'])."</th>
                    <td >".htmlspecialchars($row2['name_cus'])."</td>
                    <td >".htmlspecialchars($row2['add_cus'])."</td>
                    <td >".htmlspecialchars($row2['des_cus'])."</td>
                    <td >".htmlspecialchars($row2['phone_cus'])."</td>
                    <td>".htmlspecialchars($row2['note_book'])."</td>
                    <td>
                        <button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#phantho".$row2['id_cus']."'>Phân</button>
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
                                                <input type ='hidden' name='ac' value ='phantho'/>
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
                                                <textarea style='width: 100%; hight:120px;' name='phu'></textarea>
                                            </form>
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='submit' value='Xác Nhận' class='btn btn-success'/>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        &nbsp";
                        echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row2['id_cus']."&action=sua&nv=".$ruser['real_name']." 'class='btn btn-sm btn-success'> Sửa</a>";
                        echo "&nbsp";
                        echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row2['id_cus']."&action=coppy&nv=".$ruser['real_name']." 'class='btn btn-sm btn-info'>x2</a>";
                        echo "&nbsp";
                        echo"
                        <button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#my".$row2['id_cus']."'>Hủy</button>
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
                </tr>";
            endwhile;
            echo "</tbody>
            </table>
        </div><!--ket thuc cot-->
        <div class='col-xs-6' style='padding-left:0px'>
            <table class='table table-bordered table-hover'>
                <thead>
                    <tr>
                        <th class='col-md-2'>Thông Tin</th>
                        <th class='col-md-1'>Tên KH</th>
                        <th class='col-md-2'>Địa Chỉ</th>
                        <th class='col-md-1'>Quận</th>
                        <th class='col-md-1'>Số Điện Thoại</th>
                        <th class='col-md-1'>Ghi chú</th>
                        <th class='col-md-2'>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>";
                while ($row2 = $q2->fetch()):
                echo "
                    <tr>
                        <th >".htmlspecialchars($row2['yc_book'])."</th>
                        <td >".htmlspecialchars($row2['name_cus'])."</td>
                        <td >".htmlspecialchars($row2['add_cus'])."</td>
                        <td >".htmlspecialchars($row2['des_cus'])."</td>
                        <td >".htmlspecialchars($row2['phone_cus'])."</td>
                        <td>".htmlspecialchars($row2['note_book'])."</td>
                        <td>
                            <button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#phantho".$row2['id_cus']."'>Phân</button>
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
                                                    <input type ='hidden' name='ac' value ='phantho'/>
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
                                                    <textarea style='width: 100%; hight:120px;' name='phu'></textarea>
                                                </form>
                                            </div>
                                            <div class='modal-footer'>
                                                <input type='submit' value='Xác Nhận' class='btn btn-success'/>
                                                <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            &nbsp";
                            echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row2['id_cus']."&action=sua&nv=".$ruser['real_name']." 'class='btn btn-sm btn-success'> Sửa</a>";
                            echo "&nbsp";
                            echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row2['id_cus']."&action=coppy&nv=".$ruser['real_name']." 'class='btn btn-sm btn-info'>x2</a>";
                            echo "&nbsp";
                            echo"
                            <button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#my".$row2['id_cus']."'>Hủy</button>
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
                    </tr>";
                endwhile;
                echo "</tbody>
            </table>
        </div>
    </div><!--ket thuc dong-->
    ";
    
    echo "
    <h3 style='color: #00c0ef; padding:5px 10px 5px 10px;text-align: center;border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 5px #d2d6de;'>Lịch Đồ Gỗ</h3>
    <div class='row'>
        <div class='col-xs-6' style='padding-right:10px' >
            <table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th class='col-md-2'>Thông Tin</th>
                    <th class='col-md-1'>Tên KH</th>
                    <th class='col-md-2'>Địa Chỉ</th>
                    <th class='col-md-1'>Quận</th>
                    <th class='col-md-1'>Số Điện Thoại</th>
                    <th class='col-md-1'>Ghi chú</th>
                    <th class='col-md-2'>Thao Tác</th>
                </tr>
            </thead>
            <tbody>";
            while ($row3 = $q3->fetch()):
            echo "
            <tr>
                <th >".htmlspecialchars($row3['yc_book'])."</th>
                <td >".htmlspecialchars($row3['name_cus'])."</td>
                <td >".htmlspecialchars($row3['add_cus'])."</td>
                <td >".htmlspecialchars($row3['des_cus'])."</td>
                <td >".htmlspecialchars($row3['phone_cus'])."</td>
                <td>".htmlspecialchars($row3['note_book'])."</td>
                <td>
                    <button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#phantho".$row3['id_cus']."'>Phân</button>
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
                                            <input type ='hidden' name='ac' value ='phantho'/>
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
                                            <textarea style='width: 100%; hight:120px;' name='phu'></textarea>
                                        </form>
                                    </div>
                                    <div class='modal-footer'>
                                        <input type='submit' value='Xác Nhận' class='btn btn-success'/>
                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    &nbsp";
                    echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row3['id_cus']."&action=sua&nv=".$ruser['real_name']." 'class='btn btn-sm btn-success'> Sửa</a>";
                    echo "&nbsp";
                    echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row3['id_cus']."&action=coppy&nv=".$ruser['real_name']." 'class='btn btn-sm btn-info'>x2</a>";
                    echo "&nbsp";
                    echo"
                    <button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#my".$row3['id_cus']."'>Hủy</button>
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
        </div> <!--ket thuc cot-->
        <div class='col-xs-6' style='padding-left:0px'>
            <table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th class='col-md-2'>Thông Tin</th>
                    <th class='col-md-1'>Tên KH</th>
                    <th class='col-md-2'>Địa Chỉ</th>
                    <th class='col-md-1'>Quận</th>
                    <th class='col-md-1'>Số Điện Thoại</th>
                    <th class='col-md-1'>Ghi chú</th>
                    <th class='col-md-2'>Thao Tác</th>
                </tr>
            </thead>
            <tbody>";
            while ($row3 = $q3->fetch()):
            echo "
            <tr>
                <th >".htmlspecialchars($row3['yc_book'])."</th>
                <td >".htmlspecialchars($row3['name_cus'])."</td>
                <td >".htmlspecialchars($row3['add_cus'])."</td>
                <td >".htmlspecialchars($row3['des_cus'])."</td>
                <td >".htmlspecialchars($row3['phone_cus'])."</td>
                <td>".htmlspecialchars($row3['note_book'])."</td>
                <td>
                    <button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#phantho".$row3['id_cus']."'>Phân</button>
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
                                            <input type ='hidden' name='ac' value ='phantho'/>
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
                                            <textarea style='width: 100%; hight:120px;' name='phu'></textarea>
                                        </form>
                                    </div>
                                    <div class='modal-footer'>
                                        <input type='submit' value='Xác Nhận' class='btn btn-success'/>
                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    &nbsp";
                    echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row3['id_cus']."&action=sua&nv=".$ruser['real_name']." 'class='btn btn-sm btn-success'> Sửa</a>";
                    echo "&nbsp";
                    echo "<a href ='".BASE_URL."includes/logic/suaKH.php?id_cus=".$row3['id_cus']."&action=coppy&nv=".$ruser['real_name']." 'class='btn btn-sm btn-info'>x2</a>";
                    echo "&nbsp";
                    echo"
                    <button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#my".$row3['id_cus']."'>Hủy</button>
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
        </div><!--ket thuc cot-->
    </div><!--ket thuc dong-->
</div>";
// <!--ket thuc container-fluid-->
 }?>
 