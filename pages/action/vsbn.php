<?php
    $get_vsbn = 'SELECT * FROM vsbn where status_vsbn = 1';
    $show_vsbn = $conn -> query($get_vsbn);
    $show_vsbn ->setFetchMode(PDO::FETCH_ASSOC);
    $show_vsbn->execute();
?>
 <!-- ket thuc container-fluid-->
<div class = 'container-fluid'>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link show active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Thêm bể nước</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Bể nước hoàn thành</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
        <form action='includes/logic/XL_them_bn.php' method='POST' class='form-container'>
            <h3>Thông tin thợ đi làm bể nước</h3>
            <div class='row'>
                <div class='col-md-6'>
                    <input type="hidden" name='xl'>
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
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-6"> 
                    <h3 class="lichXL">Lịch Bể Nước Đã Hoàn Thành</h3>                
                </div>
                <div class="col-sm-6"> 
                    <input type="text" class="form-control" id="dlInput" onkeyup="myFunctionLanh()" placeholder="Search for names.." title="Type in a name">
                </div>
            </div>
            <table class="table table-bordered table-hover " id="dlTable">
                <thead>
                    <tr>
                        <th class="col-md-1">Tên Bể</th>
                        <th class="col-md-1">Địa chỉ</th>
                        <th class="col-md-2">Đội Thợ Làm </th>          
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r_vsbn = $show_vsbn->fetch()): ?>
                        <tr>
                            <td> 
                                <?php echo  ($r_vsbn['name_vsbn']); ?>
                            </td>
                            <td> 
                                <?php echo  ($r_vsbn['add_vsbn']); ?>
                            </td>
                            <td>
                                <?php echo  ($r_vsbn['team_vsbn']); ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>