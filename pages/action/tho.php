
<?php 


    $do= $_GET['do'];

try {

 $sql = "SELECT * FROM info_worker where status_worker = 0 
           ORDER BY name_worker ASC ";        
 $q = $conn->query($sql);
 $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
 die("Could not connect to the database $dbname :" . $e->getMessage());
}
if($do =='0'){
    echo "
    <table class='table table-bordered '>
    <thead>
        
            <tr >
            <th class='col-md-1'>Tên </th>
            <th class='col-md-1'>Họ</th>
            <th class='col-md-2'>Địa Chỉ</th>
            <th class='col-md-2'>Số Điện thoại Công Ty</th>
            <th class='col-md-2'>Số cá nhân</th>
            <th class='col-md-1'>Cấp thợ</th>
            <th class='col-md-1'>Nay Nghỉ/Làm</th>
            
            <th class='col-md-1'>Thao tác</th> 
            </tr>
       
    </thead>
    <tbody>";
       while ($row = $q->fetch()): 
        echo"
                    <tr>
                       <td>".$row['name_worker']." </td> 
                       <td>".$row['ho_worker']." </td> 
                       <td>".$row['add_worker']." </td> 
                       <td>".$row['phone_cty']." </td> 
                       <td>".$row['phone_worker']." </td> 
                       <td>".$row['cap_tho']." </td> 
                       <td> <button type='button' data-toggle='modal' data-target='#nhaphtdn".$row['id_worker']."' class='btn btn-sm btn-danger'";
                       if($row['today_off'] == 1 ){echo "disabled";} 
                      echo" >Nghỉ</button>
                      <!-- Modal -->
                      <div id='nhaphtdn".$row['id_worker']."' class='modal fade' role='dialog'>
                          <!-- Modal content-->
                          <div class='modal-content' style='position: fixed;top: 20px;left: 30%;text-align: left;width: 40%;'>
                              <div class='modal-header'>
                                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                  <h3 class='modal-title text-center'>Chọn thời gian nghỉ</h3>
                              </div>
                              <div class='modal-body'>
                                  <form action='includes/logic/XL_tho_nghi.php'   method='GET' class ='form-container'>
                                     <input type='hidden' name ='id_tho' value='".$row['id_worker']."'>
                                     <input type='hidden' name ='thonghi' value='1'>
                                        <div class= 'row'>
                                            <div class= 'col-md-3'>
                                                <label for='sumthu'><b>Nghỉ sáng  : </b> </label> 
                                                <input type='radio' checked='checked' name='time_off' value='1'>
                                            </div> 
                                            <div class= 'col-md-3'>
                                                <label for='sumthu'><b>Nghỉ chiều : </b> </label> 
                                                <input type='radio' name='time_off' value='2'>
                                            </div>
                                            <div class= 'col-md-3'>
                                                <label for='sumthu'><b>Cả Ngày : </b> </label> 
                                                <input type='radio' name='time_off' value='3'>
                                            </div>
                                            <div class= 'col-md-3'>
                                                <label for='sumthu'><b>Nghỉ phép : </b> </label> 
                                                <input type='radio' name='time_off' value='0'>
                                            </div>
                                        </div>
                                      
                              </div>
                              <div class='modal-footer'>
                                  <div class='row'>
                                      <div class='col-md-6 text-center'><button type='submit' value='submit' class='btn btn-sm btn-success' style='width:150px; font-size: 14px'>Xác nhận nghỉ</button></div>
                                      <div class='col-md-6 text-center'><button type='button' class='btn btn-danger' style='width:150px;' data-dismiss='modal'>Hủy</button></div>
                                  </div>
                              </div>
                                  </form>
                          </div>
                      </div>
                 <a href='".BASE_URL."includes/logic/XL_tho_nghi.php?id_tho=".$row['id_worker']."&thonghi=2' class='btn btn-sm btn-success'"; if($row['today_off']==0) {echo"disabled";} echo" >Làm</a>
					   
					   </td>  
                       
                       <td><a href='".BASE_URL."index.php?action=wk&do=sua&id_tho=".$row['id_worker']."' class='btn btn-sm btn-info'"; if($ruser['level']==0){echo "disabled";}echo ">Sửa</a> 
                       <a href='".BASE_URL."includes/logic/XL_tho_nghi.php?id_tho=".$row['id_worker']."&thonghi=0' class='btn btn-sm btn-danger' "; if($ruser['level']==0){echo "disabled";}echo ">Nghỉ Luôn</a> </td>
                    </tr>";
                 endwhile; 
       echo " 
    </tbody>
</table>	";

}
elseif($do == 'sua') 
{

    $tho = $_GET['id_tho'];

    try {

        $sql = "SELECT * FROM info_worker 
                WHERE id_worker = '$tho' ";        
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $row = $q -> fetch();
       } catch (PDOException $e) {
        die("Could not connect to the database $dbname :" . $e->getMessage());
       }
    
    echo "
    <form action='includes/logic/XL_sua_tho.php' method='POST' class='form-container'>
    <h2>Nhập thông tin thợ Mới</h2>
    <div class='row'>
    
    <label for='nameTho'><b>Tên Thợ</b></label>
    <input type='hidden' name='id' value='".$tho."'>
    <input type='text' name='nameTho' required  value='".$row['name_worker']."'>
    <label for='hoTho'><b>Họ Thợ</b></label>
    <input type='text'  name='hoTho'required value='".$row['ho_worker']."'>
 
    <label for='addTho'><b>Quận</b></label>
    <input type='text'  name='addTho'required value='".$row['add_worker']."'>
    <label for='telTho'><b>Số Điện Thoại Thợ</b></label>
    <input type='tel'  name='telTho' value='".$row['phone_worker']."'>
    <label for='telTho'><b>Số Điện Thoại Công Ty</b></label>
    <input type='tel'  name='telCty' value='".$row['phone_cty']."'>
    <label for='ycTho'><b>Cấp Bậc Thợ Việc</b></label>
    <input type='text'  name='cpTho' value='".$row['cap_tho']."'>
    <label for='ycTho'><b>Phân Loại Thợ</b></label>
    <input type='text'  name='kind_Tho' value='".$row['kind_worker']."'>
    <button type='submit' class='btn'>Sửa Thông tin</button>
    <input class='btn cancel btn-danger' onclick='goBack()'  value= 'Đóng'/>
    </div>
    </form>
    ";

}
elseif($do=='new')
{
echo "
    <form action='includes/logic/XL_them_tho.php?' method='POST' class='form-container'>
    <h2>Nhập thông tin thợ Mới</h2>
    <div class='row'>
    
    <label for='nameTho'><b>Tên Thợ</b></label>
    <input type='text'placeholder='Nhập Tên Thợ' name='nameTho' required >
    <label for='hoTho'><b>Họ Thợ</b></label>
    <input type='text' placeholder='Nhập Họ Thợ' name='hoTho' >
    
    <label for='addTho'><b>Quận</b></label>
    <select name='addTho'>
        <option>Quận 1</option>
        <option>Quận 2</option>
        <option>Quận 3</option>
        <option>Quận 4</option>
        <option>Quận 5</option>
        <option>Quận 6</option>
        <option>Quận 7</option>
        <option>Quận 8</option>
        <option>Quận 9</option>
        <option>Quận 10</option>
        <option>Quận 11</option>
        <option>Quận 12</option>
        <option>Bình Thạnh</option>
        <option>Thủ Đức</option>
        <option>Gò Vấp</option>
        <option>Phú Nhuận</option>
        <option>Tân Bình</option>
        <option>Tân Phú</option>
        <option>Bình Tân</option>
        <option>Bình Chánh</option>
        <option>Nhà Bè</option>
        <option>Hóc Môn</option>
        <option>Củ Chi</option>
        <option>Đồng Nai</option>

    </select> 
   
    <label for='telTho'><b>Số Điện Thoại Thợ</b></label>
    <input type='tel' placeholder='Số Điện Thoại Thợ' name='telTho' >
    <label for='telTho'><b>Số Điện Thoại Công Ty</b></label>
    <input type='tel' placeholder='Số Điện Thoại Công Ty' name='telCty' >
    <label for='ycTho'><b>Cấp Bậc Thợ Việc</b></label>
    <input type='text' placeholder='Cấp Thợ' name='cpTho'>
    

    
        <div class='col-sm-4'>
            
                <label class='check-container1'>Điện Lạnh
                <input type='radio' checked='checked' name='kind_Tho' value='Điện Lạnh'>
                
            </label>
        </div>
        <div class='col-sm-4'>
                    <label class='check-container1'>Điện Nước
                    <input type='radio' name='kind_Tho' value='Điện Nước'>
                    
                    </label>
        </div>
        <div class='col-sm-4'>
                <label class='check-container1'>Đồ Gỗ
                    <input type='radio' name='kind_Tho' value='Đồ Gỗ'>
                
                </label>   
        </div>  
        <button type='submit' class='btn'>Thêm</button>
        <input class='btn cancel btn-danger' onclick='goBack()'  value= 'Đóng'/>
        </div>
    </form>
    ";
}