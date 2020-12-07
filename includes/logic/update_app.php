<?php include '../../config.php';
    $database = new Getdatabase();
    $conn = $database->getConnection();
    $iduser = $_SESSION['username'];
    // $nv= $_GET['user'];
    $id= $_GET['id_kh'];

    $sql = "SELECT * FROM users where username like '$iduser'";
    $q= $conn->query($sql);
    $q ->setFetchMode(PDO::FETCH_ASSOC);
    $ruser=$q->fetch();
    $us = $ruser['username'];


    $upq = "UPDATE mobile_data SET nv_xem_noti ='$us' where id_kh ='$id'";
    $ql = $conn -> query($upq);
    $sql1 = "UPDATE `mobile_data` SET status_app = '1' where status_app = '0' and id_kh='$id'";
    $q = $conn->query($sql1);
    if($q && $ql )
    {
        header("location:".BASE_URL."index.php?action=app");
    }
?>
