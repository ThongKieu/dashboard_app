<?php
     include '../../config.php';
        $id = $_GET['id'];
		$thonghi = $_GET['thonghi'];
		if($thonghi == 0)
		{
        	$sql = "UPDATE `info_worker` SET status_worker = '1' where id_worker = '$id'";
       	 	$q = $conn->query($sql);
		}
		elseif($thonghi == 1)
		{
			$sql = "UPDATE `info_worker` SET today_off = '1' where id_worker = '$id'";
       	 	$q = $conn->query($sql);
		}
		elseif($thonghi == 2)
		{
			$sql = "UPDATE `info_worker` SET today_off = '0' where id_worker = '$id'";
       	 	$q = $conn->query($sql);
		}
        if($q)
        {
            header("location:".BASE_URL."index.php?action=wk&do=0");
        }
    