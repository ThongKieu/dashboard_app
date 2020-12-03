<?php
$database = new Getdatabase();
$conn = $database->getConnection();
include '../../config.php';	
$time_search = $timelive;
$output = '';
//mysqli_set_charset($connect,'UTF8');

	

	$result = $conn->prepare( "SELECT info_cus.id_cus,info_cus.name_cus, info_cus.phone_cus,info_cus.add_cus, info_cus.des_cus,info_cus.yc_book, info_cus.note_book,
    info_worker.name_worker,info_cus.date_book, work_do.id_work, nv_phan,phu, flag_status FROM work_do,info_worker,info_cus 
    WHERE  work_do.sum_thu = 0 and work_do.id_worker = info_worker.id_worker and work_do.id_cus = info_cus.id_cus and info_cus.kind_book like '%lanh%'
    and info_cus.flag_book = '1' order by info_worker.name_worker ASC limit 10
	");
	$result ->execute();


$num = $result->rowCount();

if($num > 0)
{
	$output .= '<div>
					<table class="table table-bordered table-hover">
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
				<td><a href="'.BASE_URL.'index.php?action=tt&id_cus='.$row['id_cus'].'"  class="btn btn-info">Thông tin chi tiết</a></td>
				

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