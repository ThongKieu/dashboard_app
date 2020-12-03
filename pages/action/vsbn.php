<?php 

echo"
 <!-- ket thuc container-fluid-->
<div class = 'container-fluid'>
<form action='includes/logic/XL_them_bn.php' id='hihi method='GET' class='form-container'>
    <h3>Thông tin thợ đi làm bể nước</h3>
    <div class='row'>
        <div class='col-md-6'>
            <label for='nameKH'><b>Tên Bể Nước</b></label>
            <input type='text' placeholder='Nhập Tên ' name='name_vsbn' required >
        </div>
        <div class='col-md-6'>
            <label for='addKH'><b>Địa Chỉ Bể Nước</b></label>
            <input type='text' placeholder='Nhập Địa Chỉ ' name='add_vsbn' required>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-12'>
            <label for='ycKH'><b>Đội Thợ</b></label>
 
            <input type='text' placeholder='Danh sách thợ ' name='team_vsbn' required>
        </div>
    </div>
    <div class='row '>
        <div class='col-md-auto'><br>
            <button type='submit' class='btn btn-success'>Thêm</button>
        </div>
    
        <div class='col-md-auto'>
                
            <button class='btn cancel' data-dismiss='modal' aria-label='Close'  > Đóng</button>
        </div>
    </div>
</form>
</div>

";
?>