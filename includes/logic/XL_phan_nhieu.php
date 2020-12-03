<link rel="stylesheet" href="../../css/min.css">

<?php
include('../../config.php');
$database = new Getdatabase();
$conn = $database->getConnection();
$dump='';
if(isset($_GET['nv'])){ $nv_add= $_GET['nv'];}
if (isset($_GET['id'])) {
    foreach($_GET['id'] as $id) {
       //Xử lý các phần tử được chọn
       $dump =  $id . " ". $dump;

     }
}


    
try{
    $tho= $conn->prepare("select * FROM info_worker where status_worker = 0 and today_off = 0  order by name_worker ASC ");
        $tho->setFetchMode(PDO::FETCH_ASSOC); // set kiểu mảng cho giá trị trả về
        $tho->execute();
        $rs = $tho->fetchAll();// đổ toàn bộ dự liệu thu về vào mảng
}
catch (PDOException $e) 
     {
         die("Could not connect to the database $dbname :" . $e->getMessage());
     }
     
   echo"       
   <form action='phan_tho.php' method='GET' class ='hop'>
    <h2>Phân Lịch Cho Nhiều Thợ</h2>

   <label>Chọn Thợ cần Phân :</label>
   <input type='hidden' name='nv1' value='".$nv_add."'>
   <input type='hidden' name='man' value='".$dump."'>
   <select name='chinh'>";
   foreach ($rs as $row1) {
       echo '<option>';
       
       echo $row1['name_worker'] . ' ';
       echo $row1['add_worker'] . ' ';
       echo $row1['id_worker']." ";
       echo '</option>';
      
       }  
   
   
   echo "</select>
   <br>
   
   <label>Chọn Thợ phụ nếu cần  :</label>
   <select name='phu'>
       <option>Không có</option>
   ";
   foreach ($rs as $rowt) {
       echo '<option>';
       
       echo $rowt['name_worker'] . ' ';
       echo $rowt['add_worker'] . ' ';
       echo '</option>';
       }  
   
   
   echo "</select>
  



<input type='submit' value='Xác Nhận' class='btn btn-success'/>  
<button type='button' class='btn cancel'>Close</button>

</form>  ";    

