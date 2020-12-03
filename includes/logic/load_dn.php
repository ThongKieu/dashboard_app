<?php
include '../../config.php';
$database = new Getdatabase();
$conn = $database->getConnection();
$time_search = $timelive;
$output = '';
//mysqli_set_charset($connect,'UTF8');

	

	$result = $conn->prepare( "SELECT info_cus.id_cus,info_cus.name_cus, info_cus.phone_cus,info_cus.add_cus, info_cus.des_cus,info_cus.yc_book, info_cus.note_book,
    info_worker.name_worker,info_cus.date_book, work_do.id_work, nv_phan,phu, flag_status FROM work_do,info_worker,info_cus 
    WHERE  work_do.sum_thu = 0 and work_do.id_worker = info_worker.id_worker and work_do.id_cus = info_cus.id_cus and info_cus.kind_book like '%nuoc%'
    and info_cus.flag_book = '1' order by info_worker.name_worker ASC LIMIT 10
	");
	$result ->execute();


$num = $result->rowCount();

if($num > 0)
{
	$output .= '<div class="table-responsive table-bordered">
					<table class="table table bordered">
						<tr>
							<th>Tên Khách Hàng</th>
							<th>Địa Chỉ</th>
							<th>Quận </th>
							<th>Yêu Cầu Công Việc</th>
              				<th>Số Điện thoại</th>
							<th>Ngày Đặt Lịch</th>
							<th>Trạng Thái</th>
							<th>Thông tin chi tiết<th>
							
						</tr>';
	while($row = $result->fetch(PDO::FETCH_ASSOC))
	{
		$output .= '
			<tr>
				<td>'.$row["name_cus"].'</td>
				<td>'.$row["add_cus"].'</td>
				<td>'.$row["des_cus"].'</td>
				<td>'.$row["yc_book"].'</td>
        		<td>'.$row["phone_cus"].'</td>
				<td>'.$row["date_book"].'</td>
				<td>'.$row["flag_status"].'</td>
                <td>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#phantho'.$row["id_cus"].'">Phân</button>
                <!-- Modal -->
                    <div id="phantho'.$row["id_cus"].'" class="modal fade" role="dialog">
                        <div class="row">
                        <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Chọn Thợ Bạn Muốn phân</h4>
                        </div>
                        <div class="modal-body">
                        <form action="includes/logic/XL_phan_lich.php" method="POST" class ="hop">
                            <label>Chọn Thợ cần Phân :</label>
                            <input type ="hidden" name="ac" value ="phantho" />
                            <input type ="hidden" name="ki"value ="1"/>
                            <input type="hidden" name = "id_cus" value="'.$row["id_cus"].'"/>
                            <input type="hidden" name = "note" value="'.$row["note_book"].'"/>
                            <select name="name_worker">
                            
                            
                            </select>
                            <br>
                            
                            <label>Chọn Thợ phụ nếu cần  :</label>
                            <textarea style="width: 100%; hight:120px;" name="phu"></textarea>
                        
                        </div>
                        <div class="modal-footer">
                        <input type="submit" value="Xác Nhận" class="btn btn-success"/>   <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                        </div>

                    </div>
                        </div>
                    
                    </div>

               
                </td>
				

			</tr>
		';
	}
	echo $output;
}
else
{
	echo '<h2>Không có dữ liệu nào trong hệ thống</h2>';
}
?>