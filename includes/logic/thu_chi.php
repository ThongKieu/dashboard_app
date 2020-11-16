<html>
  <head>
    
    <link rel="stylesheet" type="text/css" href="../../css/min.css">
    <title> Sửa Thông Tin KH</title>
<head>
  <body>
<?php
include '../../config.php';



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

try {
    $id =$_GET['id_work'];
    $idq =$_GET['idq'];
	$ki =$_GET['ki'];
	if(isset($_GET['tentho'])){$tentho = $_GET['tentho'];}
	   else{$tentho= " ";}
	if(isset($_GET['time_search'])){$time_search = $_GET['time_search'];}
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
    $sql = "SELECT id_cus,id_work,sum_chi, sum_thu, note_work,thanh_toan, thongtinthem FROM work_do  WHERE id_work ='$id'";
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $rs = $q->fetch();
  if(isset($q))
    {
       
        $idc = $rs['id_cus'];
        
        $sql2 = "SELECT phone_cus, date_book, add_cus, des_cus FROM info_cus  WHERE id_cus ='$idc'";
        $q2 = $pdo->query($sql2);
        $q2->setFetchMode(PDO::FETCH_ASSOC);
        // header("location: " . BASE_URL . "index.php");
        $row = $q2->fetch();
        
        
    }
    } catch (PDOException $e) 
    {
        die("Could not connect to the database $dbname :" . $e->getMessage());
    }
    
 
?>
<style>
.hop input[type=currency]{
  width: 100%;
  padding: 5px;
  margin: 5px 0 1px 0;
  border: none;
  background: #f1f1f1;
}
.hop input[type=currency1]{
  width: 100%;
  padding: 5px;
  margin: 5px 0 1px 0;
  border: none;
  background: #f1f1f1;
}
</style>
<form action="XL_thu_chi.php"  method="POST" class="hop">
    <?php 
    if($idq==1){
      echo "<h2>Nhập thu Chi</h2>";}
    elseif($idq==2){
        echo " <h2>Sửa Thu Chi</h2>";}
    elseif($idq==3){
        echo " <h2>Phản hồi</h2>";}
      echo "
        <input type='hidden' name ='id_work' value=".$rs['id_work']." >
        <input type='hidden' name ='note_work' value=''>
        <input type='hidden' name ='ki' value='".$ki."'>
        <input type='hidden' name ='tentho' value='".$tentho."'>
        <input type='hidden' name = 'time_search' value= '".$time_search."'>
        <label for='telKH'><b>Địa Chỉ</b></label>
        <input type='text' name ='telKH' value='".$row['add_cus']."  ".$row['des_cus']."' readonly>
        <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
        <input type='text' name ='telKH' value=".$row['phone_cus']." readonly>
        <label for='date_book'><b>Thời gian  : </b></label>
        <input type='text'  name='date_book' value=".$timelive." readonly><br>
        <label for='sumthu'><b>Tổng Thu  : </b></label>
        <input type='currency1' min='0.00' max='1000000000.00' step='0.01'  name='sumthu' value=".$rs['sum_thu']." id='sumthu'>
        <label for='text'><b>Tổng Chi  : </b></label>
        <input type='text' min='0.00' max='1000000000.00' step='0.01'  name='sumchi' value=".$rs['sum_chi']." id='sumchi'>
		    <label for='note_work'><b>Thông tin Thêm : </b></label>
        <input type='text'  name='thongtinthem' value='".$rs['thongtinthem']."'><br>
        <label for='note_work'><b>Phản Hồi Của Khách Hàng : </b></label>
        <input type='text'  name='note_work' value='".$rs['note_work']."'>
        <label for='date_book'><b>Tình trạng thanh toán  : </b></label><br>
        <label class='check-container1'>Chưa thanh toán 
        <input type='radio'"; if($rs['thanh_toan']=='1'){echo "checked='checked'";} echo "name='thanh_toan' value='1'>
        <label class='check-container1'>Đã thanh toán
        <input type='radio'"; if($rs['thanh_toan']=='0'){echo "checked='checked'";} echo" name='thanh_toan' value='0'>";
      echo "<button type='submit' class='btn btn-sm btn-success'>Thay Đổi Thông tin</button>
          <button type='button' class='btn cancel' onclick='history.back()'>Hủy</button>
        <script src='https://code.jquery.com/jquery-latest.js'></script>
        </form>";
      ?>

<script>
$('input').on('input', function(e){        
    $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g,'')));
}).on('keypress',function(e){
    if(!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
}).on('paste', function(e){    
    var cb = e.originalEvent.clipboardData || window.clipboardData;      
    if(!$.isNumeric(cb.getData('text'))) e.preventDefault();
});
function formatCurrency(number){
    var n = number.split('').reverse().join("");
    var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");    
    return  n2.split('').reverse().join('') ;
}

 
</script>
    



