
  <?php include('../../config.php');?>    
      
      <html>
        <head>
          
          <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/min.css">
          <title> Phân Lịch Cho Thợ</title>
      <head>
        <body>
<?php

$id = $_GET["id_work"];




try {
       

        $sql1 = "select * FROM work_do WHERE id_work = '$id'";

        $q1 = $conn->query($sql1);
        $q1->setFetchMode(PDO::FETCH_ASSOC);
        $rq = $q1->fetch();

        $id_cus = $rq['id_cus'];
        $id_worker = $rq['id_worker'];
       
        $sql = "select * FROM info_cus WHERE id_cus = '$id_cus'";
        $q = $conn->query($sql);
        $q ->setFetchMode(PDO::FETCH_ASSOC);
         
        
        if($q){
        //header("location: " . BASE_URL . "index.php");
            
        }
     
    } catch (PDOException $e) {
        die("Could not connect to the database $dbname :" . $e->getMessage());
    }
   
     
        echo "<form action='up_kh_da_phan.php' id='frm_sua_KH' method='POST' class='hop'>
        <h2>Câp Nhật Thông Tin Khách hàng</h2>";
         $rs =$q->fetch();
    
        echo " 
          <input type='hidden' name ='id_cus' value='".$rs['id_cus']."'>
          
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
      
      
      
?>

 