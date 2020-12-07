<?php include '../../config.php';
    $database = new Getdatabase();
    $conn = $database->getConnection();
    $nv= $_GET['user'];
    $id= $_GET['id_kh'];

    $sql = "SELECT nv_xem_noti from mobile_data where id_kh ='$id'";
    $q= $conn->query($sql);
    $r=$q->fetch();

    $nvr = $r['nv_xem_noti'] ."  ".$nv;

    $upq = "UPDATE mobile_data SET nv_xem_noti ='$nvr' where id_kh ='$id'";
    $ql = $conn -> query($upq);
    $sql1 = "UPDATE `mobile_data` SET status_app = '1' where status_app = '0' and id_kh='$id'";
    $q = $conn->query($sql1);
    if($q && $ql )
    {
        header("location:".BASE_URL."index.php?action=app");
    }
?>
