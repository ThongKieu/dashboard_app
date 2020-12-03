
<?php
    $database = new Getdatabase();
    $conn = $database->getConnection();

    $sqlc = "SELECT `id_kh`, `tenkh`, `sdt`, `diachi`, `yccv`, `quan_huyen` FROM `mobile_data` WHERE 1";  
    $qc = $conn->query($sqlc);
    $qc->setFetchMode(PDO::FETCH_ASSOC);
    $qc ->execute();
    $row = $qc->fetch();
   
?>
<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col_left'>
    <div class="row">
        <div class="col-sm-6"> 
            <h3 class="lichXL">Lịch Điện Lạnh Đã Xử Lý</h3>                
        </div>
        <div class="col-sm-6"> 
            <input type="text" class="form-control" id="dlInput" onkeyup="myFunctionLanh()" placeholder="Search for names.." title="Type in a name">
        </div>
    </div>
    <table class="table table-bordered table-hover " id="dlTable">
        <thead>
            <tr>
                <th class="col-md-1">Yêu Cầu</th>
                <th class="col-md-1">Tên KH</th>
                <th class="col-md-2">Địa Chỉ</th>
                <th class="col-md-1">Quận</th>
                <th class="col-md-1">SĐT</th>
                <th class="col-md-1">Trạng Thái</th>
                <th class="col-md-1">Nhân Viên</th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $qc->fetch()): ?>
            <tr>
                <td>
                    <?php echo  ($row['yccv']); ?>
                </td>
                <td>
                    <?php echo  ($row['tenkh']); ?>
                </td>

                <td>
                    <?php echo  ($row['diachi']); ?>
                </td>
                <td>
                    <?php echo  ($row['quan_huyen']) ;?>
                </td>
                <td>
                    <?php echo  ($row['sdt']); ?>
                </td>
                <td>
                    <?php echo  ($row['yccv']); ?>
                </td>
                <td>
                    <?php echo  ($row['yccv']); ?>
                </td>

                <!-- <td>
                    <php if($row['note_book']==null){
                                // code 
                            }else{
                                echo "<p class='tooltipButton text-center' data-width='ghi_Chu' data-tooltip='".$row['note_book']."'>Xem Thêm</p>";
                            } >
                </td> -->
                
                 
              
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div><!--ket thuc cot-->