<?php


    $sqlc = "SELECT `id_kh`, `tenkh`, `sdt`, `diachi`, `yccv`, `quan_huyen`,`status_app` FROM `mobile_data` WHERE 1";  
    $qc = $conn->query($sqlc);
    $qc->setFetchMode(PDO::FETCH_ASSOC);
    $qc ->execute();
   
?>
<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col_left'>
    <div class="row">
        <div class="col-sm-6"> 
            <h3 class="lichXL">Lịch App Đang Chờ Xử Lý</h3>                
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
                <th class="col-md-1">Trang Thái</th>              
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
                <td style="text-align: center;">
                    <?php echo  "<button type='button' data-toggle='modal' data-target='#my3".$row['sdt']."'class='btn btn-sm btn-warning tooltipButton cls_btn' data-tooltip='Xem' style='margin-right:5px'><i class='fa fa-eye'></i></button>";
                    echo  "<button type='button' data-toggle='modal' data-target='#my3".$row['sdt']."'class='btn btn-sm btn-info tooltipButton cls_btn' data-tooltip='Phân Lịch'><i class='fa fa-plus'></i></button>";
                    ?>
                </td>
                <td>
                    <?php echo  $ruser['real_name'] ?>
                </td>
                <td>
                    <?php echo  $row['status_app'] ?>
                </td>
            
            <?php endwhile; ?>
            </tr>
        </tbody>
    </table>
</div><!--ket thuc cot-->