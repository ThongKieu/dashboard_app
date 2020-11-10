<?php 

  include 'includes/class/db_co.php';
  include 'includes/class/rownCus.php';

  $database = new Getdatabase();
  $db = $database->getConnection();
  if(isset($_GET['time_search']))
  {
    $time_search= $_GET['time_search'];
  }
  else{
    $time_search = date('Y-m-d');
  }
   try{
    $vsbn = $conn -> prepare('SELECT * FROM notication where status_ad = 0');
    $vsbn->execute();
    $nvsbn = $vsbn->rowCount();  }
  catch (PDOException $e) {
    echo $e->getMessage();
    } 
 
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content" style="background-color: white">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php $rowt = new Count($db);
                        $numLC = $rowt ->countLC($time_search);
                        echo $numLC;  ?></h3>

              <p>Lịch Chưa Phân</p>
            </div>
            <div class="icon">
              <i class="fa fa-fw fa-clock-o"></i>
            </div>
          <a href="index.php" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php $rowt = new Count($db);
                        $numLC = $rowt ->countDN($time_search);
                        echo $numLC;  ?></h3>

              <p>Điện Nước</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="index.php?action=1" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php 
                        $numDL = $rowt ->countDL($time_search);
                        echo $numDL;  ?></h3>

              <p>Điện Lạnh</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="index.php?action=2" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php $rowt = new Count($db);
                        $numLC = $rowt ->countDG($time_search);
                        echo $numLC;  ?></h3>

              <p>Thợ Mộc</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="index.php?action=3" class="small-box-footer">Xem chi tiết<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
         <!-- ./col -->
         <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php $rowt = new Count($db);
                        $numLC = $rowt ->countKS($time_search);
                        echo $numLC;  ?></h3>

              <p>Khảo Sát Báo Giá</p>
            </div>
            <div class="icon">
              <i class="fa fa-fw fa-hourglass-2"></i>
            </div>
            <a href="index.php?action=4" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php $rowt = new Count($db);
                        $numLC = $rowt ->countHuy($time_search);
                        echo $numLC;  ?> </h3>

              <p>Lịch Hủy</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert"></i>
            </div>
           <a href="index.php?action=5" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      
        <!-- ./col -->
      </div>
      <?php
      $nvsbn = null;
      if($nvsbn > 0){
      echo"
      <div class='row'>
        <div class='col-sm-12'>
          <!-- small box -->
          <div class='box bg-white'>
            
          
              <table class='table table-bordered '>
              <thead>
                <tr>
                  <th class='col-sm-8'> Thông báo</th>
                  <th class='col-sm-1'> Người Viết</th>
                  <th class='col-sm-1'> Ngày </th>
                  <th class='col-sm-2'> Hoàn Thành</th>
                </tr>
              </thead>

              <tbody>";
              while($vs=$vsbn->fetch(PDO::FETCH_ASSOC)):
              echo"  <tr>
              <td>
               ".$vs['thuoc_tinh']."
                </td>
                  <td>".$vs['ng_them']."</td>
                  <td>".$vs['ngay_them']."</td>
                  <td>
                  <button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#phantho".$vs['id_thongbao']."'>Sửa</button>

                  <!-- Modal -->
                  <div id='phantho".$vs['id_thongbao']."' class='modal fade' role='dialog'>
                      <div class='row'>
                      <div class='modal-dialog'>

                      <!-- Modal content-->
                      <div class='modal-content'>
                      <div class='modal-header'>
                          <button type='button' class='close' data-dismiss='modal'>&times;</button>
                          <h2>Chọn Thợ cần Phân :</h2>
                      </div>
                      <div class='modal-body'>
                      <form action='includes/logic/Xl_add_thongbao.php' method='POST' class ='container'>
                          
                          <input type ='hidden' name='ac' value='1'/>
                          <input type ='hidden' name='nv' value='".$ruser['real_name']."'/>
                          <input type ='hidden' name='id_thongbao' value='".$vs['id_thongbao']."'/>
                          <textarea style='width:524px; height:120px;'name = 'thongtin'>".$vs['thuoc_tinh']."'</textarea>

                      </div>
                      <div class='modal-footer'>
                      <input type='submit' value='Xác Nhận' class='btn btn-success'/>   <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                      </div>
                      </form>
                      </div>

                  </div>
                      </div>
                  
                  </div>
             

                    <a href = '".BASE_URL."includes/logic/Xl_add_thongbao.php?ac=3&id=".$vs['id_thongbao']."'class='btn btn-sm btn-success'>Xong</a>

                    <button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#newadd'>Thêm Thông báo Mới</button>

                  <!-- Modal -->
                  <div id='newadd' class='modal fade' role='dialog'>
                      <div class='row'>
                      <div class='modal-dialog'>

                      <!-- Modal content-->
                      <div class='modal-content'>
                      <div class='modal-header'>
                          <button type='button' class='close' data-dismiss='modal'>&times;</button>
                           <h3>Thêm Thông báo mới :</h3></br>
                      </div>
                      <div class='modal-body'>
                      <form action='includes/logic/Xl_add_thongbao.php' method='POST' class ='container'>
                         
                          <input type ='hidden' name='ac' value='2'/>
                          <input type ='hidden' name='nv' value='".$ruser['real_name']."'/>
                          <textarea style='width:524px; height:120px;'name = 'thongtin' > </textarea>

                      </div>
                      <div class='modal-footer'>
                      <input type='submit' value='Xác Nhận' class='btn btn-success'/>   <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                      </div>
                      </form>
                      </div>

                  </div>
                      </div>
                  
                  </div>
             
                  </td>
                </tr>";
              endwhile;
              echo "
              </tbody>
              </table>
            
          
         </div>
      </div>
      </div>";}
      ?>
      
      <!-- /.row -->
    
      <!-- Main row -->
     