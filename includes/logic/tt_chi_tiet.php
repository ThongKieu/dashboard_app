
<?php


$id = $_GET["id_cus"];

try {
        
        // Lấy thông tin khách hàng
        $sql = "select * FROM info_cus WHERE id_cus = '$id'";
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $rs =$q->fetch();
         // lấy dữ liệu nếu lịch đã được phân
        $id_c= $rs['id_cus'];
        $sql_c = "SELECT  info_worker.name_worker, work_do.sum_chi, work_do.sum_thu, info_worker.add_worker
        from work_do, info_worker
        WHERE work_do.id_cus ='$id_c' and work_do.id_worker = info_worker.id_worker";
        $q_c =$conn->query($sql_c);
        $q_c->setFetchMode(PDO::FETCH_ASSOC);
        $rc = $q_c->fetch();
       
          //xl phan lich cho tho
        $tho= $conn->prepare("select * FROM info_worker where status_worker = 0 order by name_worker ASC ");
        $tho->setFetchMode(PDO::FETCH_ASSOC); // set kiểu mảng cho giá trị trả về
        $tho->execute();
        $rst = $tho->fetchAll();// đổ toàn bộ dự liệu thu về vào mảng
        

     
    } catch (PDOException $e) {
        die("Could not connect to the database $dbname :" . $e->getMessage());
      }
  

      if( $rs['flag_book'] == 0 )
      {
        
        //lịch chờ
        echo "

            
            <form action='".BASE_URL."includes/logic/XL_phan_lich.php' id='frm_sua_KH' method='POST' class='hop'>
            <h2 algin='center'>THÔNG TIN LỊCH CHỜ CỦA KHÁCH HÀNG</h2>
          
            <input type='hidden' name ='ac' value='phantho'>   
            <input type='hidden' name ='id_cus' value='".$rs['id_cus']."'>
            <label for='nameKH'><b>Tên Khách Hàng</b></label>
            <input type='text'  value='".$rs['name_cus']."' >
            <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
            <input type='text'  value='".$rs['add_cus']."' >
            <label for='desKH'><b>Quận</b></label>
            <input type='text'  value='".$rs['des_cus']."' >
            <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
            <input type='text'  value='".$rs['phone_cus']."' >
            <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
            <input type='text'  value='".$rs['yc_book']."'>  
            <label for='note_book'><b>Ghi Chú Công Việc </b></label>
            <input type='text'  value='". $rs['note_book']."' >
            <label for='date_book'><b>Thời gian  : </b></label>";
            echo " <input type='date'  name='date_book' value=" ;echo $rs['date_book']."><br>";
            echo " <h2> Lịch chưa được phân cho thơ</h2>
            <button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#phantho'>Phân</button>
            <!-- Modal -->


            <button type='button' class='btn cancel' onclick='history.back()'>Hủy</button>
            <form>
            <div id='phantho' class='modal fade' role='dialog'>
                            <div class='row'>
                            <div class='modal-dialog'>

                            <!-- Modal content-->
                            <div class='modal-content'>
                            <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                <h4 class='modal-title'>Chọn Thợ Bạn Muốn phân</h4>
                            </div>
                            <div class='modal-body'>
                            <form action='".BASE_URL."/XL_phan_lich.php' method='POST' class ='hop'>
                                <label>Chọn Thợ cần Phân :</label>
                                <input type ='hidden' name='action' value='phantho'/>
                                <input type ='hidden' name='nv' value='".$ruser['real_name']."'/>
                                <select name='name_worker'>";
                                foreach ($rst as $row1) {
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
                                foreach ($rst as $rowt) {
                                    echo '<option>';
                                    
                                    echo $rowt['name_worker'] . ' ';
                                    echo $rowt['add_worker'] . ' ';
                                    echo '</option>';
                                    }  
                                
                                
                                echo "</select>

                            </div>
                            <div class='modal-footer'>
                            <input type='submit' value='Xác Nhận' class='btn btn-success'/> 
                            </div>
                            </form>
                            </div>

                        </div>
                            </div>
                        
                        </div>";
           
            
      }
      else
      {
        if($rs['flag_status']== NULL  ){
          if($rc['sum_thu']>0){
            echo "<form  class='hop'>
            <h2 algin='center'>THÔNG TIN CHI TIẾT LỊCH ĐÃ HOÀN THÀNH</h2> 
            <input type='hidden'  value='".$rs['id_cus']."' readonly>
            <label for='nameKH'><b>Tên Khách Hàng</b></label>
            <input type='text'  value='".$rs['name_cus']."'  readonly>
            <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
            <input type='text'  value='".$rs['add_cus']."'  readonly>
            <label for='desKH'><b>Quận</b></label>
            <input type='text'  value='".$rs['des_cus']."'  readonly>
            <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
            <input type='text'  value='".$rs['phone_cus']."'  readonly>
            <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
            <input type='text'  value='".$rs['yc_book']."' readonly>  
            <label for='note_book'><b>Ghi Chú Công Việc </b></label>
            <input type='text'  value='". $rs['note_book']."'  readonly>
            <label for='date_book'><b>Thời gian  : </b></label>";
            echo " <input type='date'  name='date_book' value=" ;echo $rs['date_book']."><br>";
            echo " 
            <label for='date_book'><b>Nhan Vien lam  : </b></label>
            <input type='text'  name='namewk' value='".$rc['name_worker']."    ".$rc['add_worker']."' readonly>
            <label for='date_book'><b>Tong tien thu  : </b></label>
            <input type='text'  name='sumt' value='".$rc['sum_thu']."'>
            <label for='date_book'><b>tong tien chi  : </b></label>
            <input type='text'  name='sumc' value='".$rc['sum_chi']."'>";
            echo " <button type='submit' value='submit' class='btn btn-sm btn-success'>Thay Đổi Thông tin</button>
            
            <a href='includes/logic/XL_bao_hanh.php?id_cus=".$rs['id_cus']."&tho=".$rc['name_worker']."&nv=".$ruser['real_name']."' class='btn cancel  '>Yêu Cầu Bảo Hành</a>
            </form>
            ";
          }
          else {
            echo "<form  class='hop'>
            <h2 algin='center'>THÔNG TIN LỊCH ĐÃ PHÂN CỦA KHÁCH HÀNG</h2> 
            <input type='hidden'  value='".$rs['id_cus']."' readonly>
            <label for='nameKH'><b>Tên Khách Hàng</b></label>
            <input type='text'  value='".$rs['name_cus']."'  readonly>
            <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
            <input type='text'  value='".$rs['add_cus']."'  readonly>
            <label for='desKH'><b>Quận</b></label>
            <input type='text'  value='".$rs['des_cus']."'  readonly>
            <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
            <input type='text'  value='".$rs['phone_cus']."'  readonly>
            <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
            <input type='text'  value='".$rs['yc_book']."' readonly>  
            <label for='note_book'><b>Ghi Chú Công Việc </b></label>
            <input type='text'  value='". $rs['note_book']."'  readonly>
            <label for='date_book'><b>Thời gian  : </b></label>";
            echo " <input type='date'  name='date_book' value=" ;echo $rs['date_book']."><br>";
            echo " 
            <label for='date_book'><b>Nhan Vien lam  : </b></label>
            <input type='text'  name='namewk' value='".$rc['name_worker']."    ".$rc['add_worker']."' readonly>
            <label for='date_book'><b>Tong tien thu  : </b></label>
            <input type='text'  name='sumt' value='".$rc['sum_thu']."'>
            <label for='date_book'><b>tong tien chi  : </b></label>
            <input type='text'  name='sumc' value='".$rc['sum_chi']."'>";
            echo "
            <a href ='".BASE_URL."includes/logic/thuhoi.php?id_cus=".$rs['id_cus']." 'class='btn btn-sm btn-danger'>Trả Lịch</a>
            <button type='button' class='btn cancel' onclick='history.back()'>Hủy</button>
            </form>
            ";

          }
        }
        elseif($rs['flag_status']== 'Hủy')
        
        {
          echo "<form  class='hop'>
          <h2 algin='center'>THÔNG TIN CHI TIẾT CỦA KHÁCH HÀNG</h2> 
          <input type='hidden'  value='".$rs['id_cus']."' readonly>
          <label for='nameKH'><b>Tên Khách Hàng</b></label>
          <input type='text'  value='".$rs['name_cus']."'  readonly>
          <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
          <input type='text'  value='".$rs['add_cus']."'  readonly>
          <label for='desKH'><b>Quận</b></label>
          <input type='text'  value='".$rs['des_cus']."'  readonly>
          <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
          <input type='text'  value='".$rs['phone_cus']."'  readonly>
          <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
          <input type='text'  value='".$rs['yc_book']."' readonly>  
          <label for='note_book'><b>Ghi Chú Công Việc </b></label>
          <input type='text'  value='". $rs['note_book']."'  readonly>
          <label for='date_book'><b>Thời gian  : </b></label>";
          echo " <input type='date'  name='date_book' value=" ;echo $rs['date_book']."><br>";
          echo " <label for='date_book'><b>Trạng Thái Lịch  : </b></label>
          <input type='text'  name='namewk' value='".$rs['flag_status']."' readonly >
          ";
          echo "<a href ='".BASE_URL."includes/logic/XL_thu_huy.php?id_cus=".$rs['id_cus']." 'class='btn btn-danger btn-block'> Thu Hồi</a>
          <button type='button' class='btn cancel' onclick='history.back()'>Hủy</button>";
        }
        elseif($rs['flag_status']== 'Khảo Sát')
        {
          echo "<form action='".BASE_URL."includes/logic/XL_phan_lich.php' method='get' class='hop'>
          <input type='hidden' name='ac' value='ks'>
          <h2 algin='center'>THÔNG TIN CHI TIẾT CỦA KHÁCH HÀNG</h2> 
          <input type='hidden' name ='id_cus' value='".$rs['id_cus']."' readonly>
          <label for='nameKH'><b>Tên Khách Hàng</b></label>
          <input type='text'  value='".$rs['name_cus']."'  readonly>
          <label for='addKH'><b>Địa Chỉ Khách Hàng</b></label>
          <input type='text'  value='".$rs['add_cus']."'  readonly>
          <label for='desKH'><b>Quận</b></label>
          <input type='text'  value='".$rs['des_cus']."'  readonly>
          <label for='telKH'><b>Số Điện Thoại Khách Hàng</b></label>
          <input type='text'  value='".$rs['phone_cus']."'  readonly>
          <label for='ycKH'><b>Yêu Cầu Công Việc</b></label>
          <input type='text'  value='".$rs['yc_book']."' readonly>  
          <label for='note_book'><b>Ghi Chú Công Việc </b></label>
          <input type='text'  value='". $rs['note_book']."'  readonly>
          <label for='date_book'><b>Thời gian  : </b></label>";
          echo " <input type='date'  name='date_book' value=" ;echo $rs['date_book']."><br>";
          echo " <label for='date_book'><b>Trạng Thái Lịch  : </b></label>
          <input type='text'  name='namewk' value='".$rs['flag_status']."' readonly  >
          <label for='date_book'><b>Thợ Khảo sát  : </b></label>
          <input type='text'  name='namewk' value='".$rc['name_worker']."' readonly  >
          ";
          echo "<a href ='".BASE_URL."includes/logic/XL_thu_huy.php?id_cus=".$rs['id_cus']." 'class='btn btn-danger btn-block'> Thu Hồi</a>
          <button type='button' class='btn cancel' onclick='history.back()'>Hủy</button>";
        }
       
      }




      
?>

