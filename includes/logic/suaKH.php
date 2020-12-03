<?php include '../../config.php';
$database = new Getdatabase();
$conn = $database->getConnection();?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/min.css">
      <title> Phân Lịch Cho Thợ</title>
  <head>
  <body>
<?php
  $id = $_GET["id_cus"];
  $action=$_GET['action'];
  $nv = $_GET['nv'];
try {
        $sql = "select * FROM info_cus WHERE id_cus = '$id'";

        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if($q){
        //header("location: " . BASE_URL . "index.php");
            
        }
     
    } catch (PDOException $e) {
        die("Could not connect to the database $dbname :" . $e->getMessage());
    }
   
      if($action=='sua')
      {
        echo "<form action='up_tt_KH.php?action=0'   method='POST' class='hop'>
        <h2>Sửa Thông tin lịch Khách Hàng</h2>";
         $rs =$q->fetch();
    
        echo " <input type='hidden' name ='id_cus' value='".$rs['id_cus']."'>
          <input type='hidden' name ='tnv' value='".$nv."'>
          <input type='hidden' name ='action' value='0'>
          <label for='nameKH'><b>Tên Khách Hàng</b></label>
          <input type='text' name ='nameKH' value='".$rs['name_cus']."' >
          <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
          <input type='text' name='addKH' value='".$rs['add_cus']."' >
          <label for='desKH'><b>Quận</b></label>
          <input type='text' name= 'desKH' value='".$rs['des_cus']."' >
          <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
          <input type='text' name ='telKH' value='".$rs['phone_cus']."' >
          <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
          <input type='text' name = 'ycKH' value='".$rs['yc_book']."'>  
          <label for='note_book'><b>Ghi Chú Công Việc </b></label>
          <input type='text' name='note_book' value='".$rs['note_book']."' >
          <label for='date_book'><b>Thời gian  : </b></label>
          <input type='date'  name='date_book' value=" ;echo $rs['date_book']."><br>
          <label for='date_book'><b>Loại CV  : </b></label>
          
          <div class='row'>
                <div class='col-sm-3'> 
                    <label class='check-container1'>Điện Lạnh
                    <input type='radio'"; if($rs['kind_book']=='Điện Lạnh'){echo "checked='checked'";} echo "name='kind_book' value='Điện Lạnh'>
                    
                   </label>
            </div>
            <div class='col-sm-3'>
                      <label class='check-container1'>Điện Nước
                        <input type='radio'"; if($rs['kind_book']=='Điện Nước'){echo "checked='checked'";} echo" name='kind_book' value='Điện Nước'>
                        
                      </label>
            </div>
            <div class='col-sm-3'>
                  <label class='check-container1'>Đồ Gỗ
                      <input type='radio'";if($rs['kind_book']=='Đồ Gỗ'){echo "checked='checked'";} echo" name='kind_book' value='Đồ Gỗ'>
                  
                  </label>   
            </div> 
          </div>
     
          <button type='submit' value='submit' class='btn btn-sm btn-success'>Thay Đổi Thông tin</button>
          
          <button type='button' class='btn cancel' onclick='history.back()'>Hủy</button>
      </form>";
      }
      
      else
      {
        echo "<form action='up_tt_KH.php'   method='POST' class='hop'>
        <h2>Sao chép lịch Khách hàng</h2>";
         $rs =$q->fetch();
    
        echo " <input type='hidden' name ='id_cus' value='".$rs['id_cus']."'>
          <input type='hidden' name ='action' value='1'>
          <input type='hidden' name ='tnv' value='".$nv."'>
          <label for='nameKH'><b>Tên Khách Hàng</b></label>
          <input type='text' name ='nameKH' value='".$rs['name_cus']."' >
          <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
          <input type='text' name='addKH' value='".$rs['add_cus']."' >
          <label for='desKH'><b>Quận</b></label>
          <input type='text' name= 'desKH' value='".$rs['des_cus']."' >
          <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
          <input type='text' name ='telKH' value='".$rs['phone_cus']."' >
          <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
          <input type='text' name = 'ycKH' value='".$rs['yc_book']."'>  
          <label for='note_book'><b>Ghi Chú Công Việc </b></label>
          <input type='text' name='note_book' value='".$rs['note_book']."' >
          <label for='date_book'><b>Thời gian  : </b></label>
          <input type='date'  name='date_book' value=" ;echo $rs['date_book']."><br>
          <label for='date_book'><b>Loại CV  : </b></label>
          
          <div class='row'>
                <div class='col-sm-3'> 
                    <label class='check-container1'>Điện Lạnh
                    <input type='radio'"; if($rs['kind_book']=='Điện Lạnh'){echo "checked='checked'";} echo "name='kind_book' value='Điện Lạnh'>
                    
                   </label>
            </div>
            <div class='col-sm-3'>
                      <label class='check-container1'>Điện Nước
                        <input type='radio'"; if($rs['kind_book']=='Điện Nước'){echo "checked='checked'";} echo" name='kind_book' value='Điện Nước'>
                        
                      </label>
            </div>
            <div class='col-sm-3'>
                  <label class='check-container1'>Đồ Gỗ
                      <input type='radio'";if($rs['kind_book']=='Đồ Gỗ'){echo "checked='checked'";} echo" name='kind_book' value='Đồ Gỗ'>
                  
                  </label>   
            </div> 
          </div>
          
          <button type='submit' value='submit' class='btn btn-sm btn-success'>Thay Đổi Thông tin</button>
          
          <button type='button' class='btn cancel' onclick='history.back()'>Hủy</button>
      </form>";
      }
?>
</body>
</html>
