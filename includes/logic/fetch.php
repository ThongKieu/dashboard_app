<?php


include '../../config.php';
	

$output = '';
//mysqli_set_charset($connect,'UTF8');
if(isset($_POST["query"]))
{
	
	$search =$_POST["query"];
	$result = $conn->prepare( "
			SELECT id_cus,name_cus,phone_cus,add_cus, des_cus,yc_book, flag_status, date_book 
			FROM info_cus 
            WHERE    
            info_cus.phone_cus like '%$search%'
            or info_cus.add_cus like '%$search%'
            ORDER BY id_cus ASC LIMIT 10
	");
	$result ->execute();
	
}
else
{
	$result = $conn->prepare("
			SELECT id_cus,name_cus,phone_cus,add_cus, des_cus,yc_book, flag_status, date_book 
			FROM info_cus 
            WHERE  info_cus.id_cus 
            LIMIT 10");
	$result ->execute();
}
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