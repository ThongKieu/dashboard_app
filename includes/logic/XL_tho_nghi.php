<?php
	 include '../../config.php';
	 $database = new Getdatabase();
$conn = $database->getConnection();
        $id = $_GET['id_tho'];
		$thonghi = $_GET['thonghi'];
		if($thonghi == 0)
		{
        	$sql = "UPDATE `info_worker` SET status_worker = '1' where id_worker = '$id'";
       	 	$q = $conn->query($sql);
		}
		elseif($thonghi == 1)
		{
			$time_off= $_GET['time_off'];
			
			 $sql = "UPDATE `info_worker` SET today_off = '1', time_off = '$time_off' where id_worker = '$id'";
       	 	 $q = $conn->query($sql);
		}
		elseif($thonghi == 2)
		{
			$sql = "UPDATE `info_worker` SET today_off = '0', time_off = NULL where id_worker = '$id'";
       	 	$q = $conn->query($sql);
		}
        if($q)
        {
            header("location:".BASE_URL."index.php?action=wk&do=0");
        }
    //time_off : 1 nghỉ sáng ; 2 nghỉ chiều; 3: nghỉ cả ngày; 0: nghỉ dài hạn