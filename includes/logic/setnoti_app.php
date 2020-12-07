<?php 
include '../../config.php';
  $database = new Getdatabase();
  $conn = $database->getConnection();
  
  $output = '';
  if(isset ($_POST['view'])){
    if($_POST['view']=''){
      $sql1 = "UPDATE `mobile_data` SET status_app = '1' where status_app=0";
      $q = $conn->query($sql1);
    }
    $query ="SELECT * FROM mobile_data where status_app = 0 ORDER BY id_kh DESC limit 5";
    $result = $conn->query($query);
    $numApp = $result->rowCount();
    $output = '';
    if($numApp > 0){

      while($row = $result->fetch(PDO::FETCH_ASSOC)){
 
        $output.='
          <li>
            <a href="includes/logic/update_app.php?id_kh='.$row["id_kh"].'">
              <strong>'.$row["tenkh"].'</strong><br />
              <small><em>'.$row["sdt"].'</em></small>
            </a>
          </li>
        ';


      }
    }else{
      $output .= '<li><a href="#" class="text-bold text-italic">Không có thông báo mới!</a></li>';
    }
    // // ket thuc else  
   
    $data = array(
      'notification' => $output,
      'unseen_notification'  => $numApp
   );
   echo json_encode($data,JSON_UNESCAPED_UNICODE);
  
  }
  // ket thuc if isset view 
    
  

?>