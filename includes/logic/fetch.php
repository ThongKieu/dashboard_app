<?php
include '../../config.php';
$output = '';
//mysqli_set_charset($connect,'UTF8');
if(isset($_POST["query"]))
{
	$search =$_POST["query"];
	$result = $conn->prepare( "
			SELECT id_cus,name_cus,phone_cus,add_cus, des_cus,yc_book, flag_status, date_book,operator_time , note_book 
			FROM info_cus 
            WHERE    
            info_cus.phone_cus like '%$search%'
            or info_cus.add_cus like '%$search%'
            ORDER BY id_cus ASC LIMIT 40
	");
	$result ->execute();
}
else
{
	$result = $conn->prepare("
		SELECT id_cus,name_cus,phone_cus,add_cus, des_cus,yc_book, flag_status, date_book ,note_book, operator_time
		FROM info_cus 
        WHERE  info_cus.id_cus 
        LIMIT 20");
	$result ->execute();
}
$num = $result->rowCount();

if($num > 0)
{
	$output .= '<div class="table-responsive table-bordered">
					<table class="table table bordered">
						<tr>
							<th>Yêu Cầu Công Việc</th>
							<th>Ngày Đặt Lịch</th>
							<th>Thời Gian BH</th>
							<th>Tên Khách Hàng</th>
							<th>Địa Chỉ</th>
							<th>Quận </th>
              				<th>Số Điện thoại</th>
							<th>Ghi Chú</th>
							<th>Thợ Làm</th>
							<th>Tiền Chi</th>
							<th>Tiền Thu</th>
							<th>Sửa<th>
						</tr>';
	while($row = $result->fetch(PDO::FETCH_ASSOC))
	{
		$output .= '
			<tr>
				<td>'.$row["yc_book"].'</td> 
				<td>'.$row["date_book"].'</td> 
				<td>'.$row["operator_time"].'</td> 
				<td>'.$row["name_cus"].'</td>
				<td>'.$row["add_cus"].'</td> 
				<td>'.$row["des_cus"].'</td> 
				<td>'.$row["phone_cus"].'</td> 
				<td>'.$row["note_book"].'</td>  
				<td>'.$row["flag_status"].'</td> 
				<td>'.$row["flag_status"].'</td> 
				<td>'.$row["flag_status"].'</td> 
				<td> 
					<button type="button" data-toggle="modal" data-target="#my1'.$row['id_cus'].'"class="btn btn-sm btn-success tooltipButton cls_btn" data-tooltip="Sửa"><i class="fa fa-pencil" aria-hidden="true"></i></button>
					<div id="my1'.$row['id_cus'].'" class="modal fade" role="dialog">
						<div class="modal-content" style="position: fixed;top: 20px;left: 35%;text-align: left;width: 30%;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center">Sửa Thông Tin Lịch Khách Hàng</h4>
							</div>
							<form action="includes/logic/up_tt_KH.php" id="frm_sua_KH" method="POST" class ="form-container">
                            	<div class="modal-body">
                                	<input type="hidden" class="form-control" name ="id_cus" value="'.$row['id_cus'].'">
									<input type="hidden" class="form-control" name ="action" value="0">
									<label for="ycKH"><b>Yêu Cầu Công Việc</b></label>
									<input type="text" class="form-control" name = "ycKH" value="'.$row['yc_book'].'">  
									<label for="date_book"><b>Thời gian: </b></label>
									<input type="date" class="form-control" name="date_book" value="'.$row['date_book'].'" disabled>
									<label for="ycKH"><b>TT bảo hành:</b></label>
									<input type="text" class="form-control" name = "operator_time" value="'.$row['operator_time'].'">  
                                    <label for="nameKH"><b>Tên Khách Hàng</b></label>
									<input type="text" class="form-control" name ="nameKH" value="'.$row['name_cus'].'" >
                                    <label for="addKH"><b>Địa Chỉ Khách Hàng</b></label>
                                    <input type="text" class="form-control" name="addKH" value="'.$row['add_cus'].'" >
                                    <label for="desKH"><b>Quận</b></label>
                                    <input type="text" class="form-control" name= "desKH" value="'.$row['des_cus'].'" >
                                    <label for="telKH"><b>Số Điện Thoại Khách Hàng</b></label>
                                    <input type="text" class="form-control" name ="telKH" value="'.$row['phone_cus'].'" >
                                    <label for="note_book"><b>Ghi Chú Công Việc </b></label>
									<input class="form-control" type="text" name="note_book" value="'.$row['note_book'].'" ></input>
									<label for="note_book"><b>Thợ Làm</b></label>
									<input class="form-control" type="text" name="flag_status" value="'.$row['flag_status'].'" disabled></input>
									<label for="note_book"><b>Tiền Thu</b></label>
									<input class="form-control" type="text" name="flag_status" value="'.$row['flag_status'].'" disabled></input>
									<label for="note_book"><b>Tiền Chi</b></label>
                                    <input class="form-control" type="text" name="flag_status" value="'.$row['flag_status'].'" disabled></input>
								</div>
							<div class="modal-footer">
								<div class="row">
									<div class="col-md-6 text-center"><button type="submit" value="submit" class="btn btn-sm btn-success" style="width:150px; font-size: 14px">Thay Đổi Thông tin</button></div>
									<div class="col-md-6 text-center"><button type="button" class="btn cancel" style="width:150px;" data-dismiss="modal">Hủy</button></div>
								</div>
							</div>
								</form>
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