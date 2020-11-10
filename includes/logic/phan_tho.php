<?php 
include('../../config.php');
if(isset($_GET['man']))
{   $nv_add1 = $_GET['nv1'];
    $man =$_GET['man'];  
    $chuoip = explode(' ',$man);

    $nustr = count($chuoip);

    $thochinh = $_GET['chinh'];
    $thophu=$_GET['phu'];
    $c1 = explode(' ',$thophu);
    $phu= array_pop($c1);
    $c = explode(' ', $thochinh);
    $id_worker = array_pop($c);
    echo $nustr;
    //echo $chuoip[2];
    echo $phu;
    echo $id_worker;
    $xoa = array_pop($chuoip);
    if($phu=='có')
      {
        $thophu = ' ';
      }
      else 
      {
        $thophu = '(Thợ Phụ '.$thophu.')';
      }
      $s = $thophu;
      echo " Thợ phụ : ". $thophu. "<br>";
  foreach($chuoip as $val){
    echo "Đây là kết quả ".$val."<br>";

      $sql_ud= "UPDATE info_cus SET flag_book ='1' WHERE id_cus= '$val'";
      $q_ud = $conn->query($sql_ud);
      $sql_pl= "INSERT INTO `work_do`( `id_cus`, `id_worker`,`sum_chi`,`sum_thu`,`date_done`,`nv_phan`,`thanh_toan`, `note_work`) 
      VALUES ('$val','$id_worker',0,0,'$timelive','$nv_add1','Chưa Thanh Toán','$s') ";
      $q_pl = $conn->query($sql_pl);


  }
  header("location:".BASE_URL."index.php?action=nhieu");

}