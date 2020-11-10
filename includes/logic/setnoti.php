<?php include '../../config.php';
$nv= $_GET['user'];
$id_noti = $_GET['id_noti'];


$sql = "SELECT nv_noti from notication where id_noti = '$id_noti'";
$q= $conn->query($sql);
$r=$q->fetch();


$nvr = $r['nv_noti'] ."  ".$nv;

$upq = "UPDATE notication SET nv_noti ='$nvr' where id_noti ='$id_noti'";

$ql = $conn -> query($upq);

if($ql)
{
    header("location: " . BASE_URL . "index.php");
}


