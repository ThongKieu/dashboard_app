<?php
include '../../config.php';
$database = new Getdatabase();
$conn = $database->getConnection();
$ac = $_POST['ac'];
//$ki = $_POST['ki'];
if($ac == 'phantho'){
    $id = $_POST['id_cus'];
    $name =$_POST['name_worker'];
    $thophu=$_POST['phu'];
    $chuoi = explode(' ', $name);
    $id_worker = array_pop($chuoi);
    $nv_add = $_POST['nv'];
    if($thophu == NULL)
      {
        $thophu = NULL;
      }
      else 
      {
        $thophu = 'Thợ Phụ '.$thophu;
      }
      
  try{
      $sql_ud= "UPDATE info_cus SET flag_book ='1', phu ='$thophu' WHERE id_cus= '$id'";
      $q_ud = $conn->query($sql_ud);

      $sql_pl= "INSERT INTO `work_do`( `id_cus`, `id_worker`,`sum_chi`,`sum_thu`,`date_done`,`nv_phan`,`thanh_toan`) 
          VALUES ('$id','$id_worker',0,0,'$timelive','$nv_add',0) ";
          $q_pl = $conn->query($sql_pl);

      if($q_pl){
        clearstatcache();
        header("location: " . BASE_URL . "index.php");
        }
      
      
    } catch (PDOException $e) {
      die("Could not connect to the database $dbname :" . $e->getMessage());
    }
}

elseif($ac='mai'){
    $id = $_POST['id_cus'];
    $name =$_POST['name_worker'];
    $thophu=$_POST['phu'];
	 

    $chuoi = explode(' ', $name);
    $id_worker = array_pop($chuoi);
    $nv_add = $_POST['nv'];
    if($thophu == NULL)
      {
        $thophu = NULL;
      }
      else 
      {
        $thophu = "Thợ Phụ ".$thophu;
      }
      
  try{
      $sql_ud= "UPDATE info_cus SET flag_book ='1', phu ='$thophu' WHERE id_cus= '$id'";
      $q_ud = $conn->query($sql_ud);
      $sql_pl= "INSERT INTO `work_do`( `id_cus`, `id_worker`,`sum_chi`,`sum_thu`,`date_done`,`nv_phan`,`thanh_toan`) 
          VALUES ('$id','$id_worker',0,0,'$timelive','$nv_add',0) ";
          $q_pl = $conn->query($sql_pl);

      if($q_pl){
        header("location: " . BASE_URL . "index.php");
        }
      
      
    } catch (PDOException $e) {
      die("Could not connect to the database $dbname :" . $e->getMessage());
    }

}
elseif($ac == 'phanthoKS'){
    $name =$_POST['name_worker'];
    $thophu = $_POST['phu'];
    $chuoi = explode(' ', $name);
    $id_worker = array_pop($chuoi);
    $nv_add = $_POST['nv'];
    if($thophu == NULL)
      {
        $thophu = NULL;
      }
      else 
      {
        $thophu = "Thợ Phụ ".$thophu;
      }

    try{
      $sql_ud= "UPDATE info_cus SET flag_book ='1', phu ='$thophu' WHERE id_cus= '$id'";
      $q_ud = $conn->query($sql_ud);
      
      $sql_pl= "INSERT INTO `work_do`( `id_cus`, `id_worker`,`sum_chi`,`sum_thu`,`date_done`,`nv_phan`,`thanh_toan`) 
          VALUES ('$id','$id_worker',0,0,'$timelive','$nv_add',0) ";
          $q_pl = $conn->query($sql_pl);

      if($q_pl){
        header("location: " . BASE_URL . "index.php");
        }
      
      
    } catch (PDOException $e) {
      die("Could not connect to the database $dbname :" . $e->getMessage());
    }
}
  
?>

  
