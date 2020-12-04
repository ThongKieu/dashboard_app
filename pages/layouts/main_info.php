<?php include 'main_head.php';?>

<!-- /.row -->
<!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <?php if(!isset($_GET['action'])){
      echo "
      <section>
        <div class='box-body table-responsive no-padding'>"; 
          require 'pages/action/lich_cho.php'; 
        echo"</div>
      </section>"; 
  }else {
       $a = $_GET['action'];
       if($a == '4')
        {
          echo "
            <section >
              <div class='box-body table-responsive'>";
                require 'pages/action/lich_ks.php';
              echo"  </div>
            </section>"; 
        }elseif($a == '5')
        {
          echo "
            <section>
              <div class='box-body table-responsive'>";
                require 'pages/action/lich_huy.php';
              echo"  </div>
            </section>"; 
        }elseif($a == '6')
        {
          echo "
            <section >
              <!-- /.content --><ul class='smooth_scroll'>
              <li><a data-toggle='tooltip' data-placement='top' title='Lịch Điện Nước' href='#lichDienNuoc'><i class='fa fa-gg' style='width:15px; height:15px; color: white'></i></a></li>
              <li><a data-toggle='tooltip' data-placement='top' title='Lịch Điện Lạnh' href='#lichDienLanh'><i class='fa fa-gg' style='width:15px; height:15px; color: white'></i></a></li>
              <li><a data-toggle='tooltip' data-placement='top' title='Lịch Đồ Gỗ' href='#lichDoGo'><i class='fa fa-gg' style='width:15px; height:15px; color: white'></i></a></li>
            </ul>
              <div class='col-xs-12'>
                <form action='' method='get'>
                  <div class='box'>
                    <div class='box-header'>
                      <h3 class='box-title'>Lịch hoàn thành</h3>
                      <div class='box-tools'>
                      <input type='hidden' name='action' value='6'>
                      <div class='input-group input-group-sm' style='width: 150px;'>
                        <input type='date' name='time_search' class='form-control pull-right' >
                        <div class='input-group-btn'>
                          <button type='submit' class='btn btn-default'><i class='fa fa-search'></i></button>
                      </div>
                    </div>
                  </div>
                </form>
                <!-- /.box-header dien nuoc cho-->
                <div class='box-body table-responsive'>";
                  require 'pages/action/lich_hoan_thanh.php';
                echo"  </div>
                    <!-- /.box-body -->
                  </div>
              </div>
            </section>"; 
        }
  elseif($a == '7')
  {
    if($time_search==''){ $time_search= date('Y-m-d');}
    echo "
      <section >
        <!-- /.content -->
        <div class='col-xs-12'>
          <form action='' method='get'>
            <div class='box'>
              <div class='box-header'>
                <h2 class='box-title'style='color:red; font-size: 22px;' >Báo cáo ngày :". $time_search."</h2>
                <div class='box-tools'>
                <input type='hidden' name='action' value='7'>
                <div class='input-group input-group-sm' style='width: 150px;'>
                  <input type='date' name='time_search' class='form-control pull-right' >
                  <div class='input-group-btn'>
                    <button type='submit' class='btn btn-default'><i class='fa fa-search'></i></button>
                  </div>
                </div>
              </div>
          </form>
          <!-- /.box-header dien nuoc cho-->
          <div class='box-body table-responsive'>";
            require 'pages/action/lich_bc.php';
          echo"  </div>
          <!-- /.box-body -->
        </div>
      </section>   
    "; 
  }
  elseif($a=='search')//tìm kiếm 
  {echo "
    <section >
      <div class='box-body table-responsive' style='padding-bottom:50px'>";
        require 'pages/action/search.php';
      echo"  </div>
    </section>";
  }elseif($a=='cho_lanh')
  {
  echo "
    <section >
    <!-- /.content -->
    <section class='col-xs-12'>
          <div class='box'>
            <div class='box-header'>
            <h3 class='box-title'>Lịch Chờ Điện Lạnh</h3> 
            </div>
            <!-- /.box-header -->
            <div class='box-body table-responsive'>";
            require 'function/lich_cho_lanh.php';
  echo"    <!-- /.box-body -->
     </div>
        <!-- /.box -->
      </div>
    </section>";
}
elseif($a=='imp')
{
  echo "
    <section >
    <!-- /.content -->
    <div class='col-xs-12'>
          <div class='box'>
            <div class='box-header'>
            <h3 class='box-title'>Nhập Dữ liệu từ file Exel </h3> 
              
            </div>
            <!-- /.box-header -->
            <div class='box-body table-responsive'>";
    require 'includes/importfile.php';
  echo"    <!-- /.box-body -->
     </div>
        <!-- /.box -->
      </div>
    </div>
    </section>";
}elseif($a=='nhieu')
{
  echo "
  <section>
    <!-- /.content -->
    <div class='col-xs-12'>
      <div class='box'>
        <div class='box-body table-responsive'>";
          require 'pages/action/phan_nhieu.php';
        echo"    
        </div>
      <!-- /.box -->
      </div>
    </div>
  </section>";
}
elseif($a=='exp')
{
  echo "<div class='row'>
  <section >
  <!-- /.content -->
  <div class='col-xs-12'>
        <div class='box'>
          
          <!-- /.box-header -->
          <div class='box-body table-responsive'>";
  require 'includes/exportfile.php';
  echo"    <!-- /.box-body -->
     </div>
        <!-- /.box -->
      </div>
    </div>
	</section>
	</div>
	";
    
  
}
elseif($a=='tt')
{
  echo "<div class='row'>
  <section >
  <!-- /.content -->
  <div class='col-xs-12'>
        <div class='box'>
          
          <!-- /.box-header -->
          <div class='box-body table-responsive'>";
  require 'includes/logic/tt_chi_tiet.php';
  echo"    <!-- /.box-body -->
     </div>
        <!-- /.box -->
      </div>
    </div>
	</section>
	</div>
	";
    
  
}
elseif($a=='ktra')
{
  
  echo "<div class='row'>
    <section >
    <!-- /.content -->
    <div class='col-xs-12'>
     <form action='index.php' method='get'>
          <div class='box'>
          <div class='box-header'>
          <h3 class='box-title'>Kiểm Tra Lich Của Thợ :</h3>
           
                <div class='box-tools'>
                  <div class='input-group input-group-sm' style='width: 250px;'>
                  <input type='hidden' name ='action' value='ktra'>
                    <input type='text' name='tentho' class='form-control pull-right' placeholder='Nhập Tên Thợ'>

                    <div class='input-group-btn'>
                      <button type='submit' class='btn btn-default'><i class='fa fa-search'></i></button>
                  </div>
                </div>
              </div>
          </div>
        </form>
    
            <!-- /.box-header -->
          <div class='box-body table-responsive'>";
    require 'pages/action/kiemtratho.php';
    echo"    <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      
    </section>";
}
elseif($a=='thuchi')
{
  
  echo "
    <section >
    <!-- /.content -->
    <div class='container-fluid'>
     
          <div class='box'>
		  <form action='index.php' method='get'>
          <div class='box-header'>
          <h3 class='box-title'>Thông tin thu chi :</h3>
           
                <div class='box-tools'>
                    <div class='input-group input-group-sm' style='width: 250px;'>
                  <input type='hidden' name ='action' value='thuchi'>
                    <input type='text' name='tentho' class='form-control pull-right' placeholder='Nhập Tên Thợ'>

                    <div class='input-group-btn'>
                      <button type='submit' class='btn btn-default'><i class='fa fa-search'></i></button>
                  	</div>
                	</div>
            	</div>  
          	</div>
        </form>
    
            <!-- /.box-header -->
					  <div class='box-body table-responsive'>";
				require 'pages/action/checkthuchi.php';
				echo"    <!-- /.box-body -->
					  </div>
          <!-- /.box -->
        </div>
      </div>
      
    </section>
	";
}
elseif($a=='mai')
{
  
  echo "
    <section ><ul class='smooth_scroll'>
    <li><a data-toggle='tooltip' data-placement='top' title='Lịch Điện Nước' href='#lichDienNuoc'><i class='fa fa-gg' style='width:15px; height:15px; color: white'></i></a></li>
    <li><a data-toggle='tooltip' data-placement='top' title='Lịch Điện Lạnh' href='#lichDienLanh'><i class='fa fa-gg' style='width:15px; height:15px; color: white'></i></a></li>
    <li><a data-toggle='tooltip' data-placement='top' title='Lịch Đồ Gỗ' href='#lichDoGo'><i class='fa fa-gg' style='width:15px; height:15px; color: white'></i></a></li>
  </ul>
      <div class='container-fluid'>
        <div class='box'>
          <form action='index.php' method='GET'>
            <div class='box-header'>
              <div class='box-tools'>
                <input type='hidden' name ='action' value='mai'>
                <div class='input-group input-group-sm' style='width: 250px;'>
                  <input type='date' name='time_search' class='form-control pull-right'>
                  <div class='input-group-btn'>
                    <button type='submit' class='btn btn-default'><i class='fa fa-search'></i></button>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <!-- /.box-header -->
          <div class='box-body table-responsive'>";
    require 'pages/action/lichtuonglai.php';
    echo"    <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      
    </section>";
}
elseif($a=='allnoti')
{
  echo "
  <section >
  <!-- /.content -->
  <div class='container-fluid'>
        <div class='box'>
          <!-- /.box-header -->
          <div class='box-body table-responsive'>";
        require 'pages/action/notication.php';
        echo"<!-- /.box-body -->
          </div>
        <!-- /.box -->
        </div>
    </div>
  </section>
    ";
}
elseif($a=='newnoti')
{
  echo "
    <section >
    <!-- /.content -->
    <div class='container-fluid'>
    
          <div class='box'>
          
          <div class='box-header'>
          
                <div class='box-tools'>
                
                
                  <div class='input-group input-group-sm' style='width: 250px;'>
                   

                    <div class='input-group-btn'>
                     
                  </div>
                </div>
              
          </div>
      
    
            <!-- /.box-header -->
          <div class='box-body table-responsive'>
        <form action='includes/logic/newnoti.php' method = 'POST' class='hop'>
            <h2> Thông Báo Mới </h2>
            <input type='hidden' name= 'nv' value ='".$ruser['real_name']."'>
            <textarea name='info_noti' style='width:100%;height:150px;' placeholder='Nhập thông báo '></textarea>
       
        <br>
        <br>
        <button type='submit' class='btn'>Thêm</button>
        <input class='btn cancel btn-danger' onclick='goBack()' value= 'Hủy'/>
        </form>
      <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <script>
    function goBack() {
      window.history.back();
    }
    </script>
    </section>";
}

elseif($a=='add')
{
   include 'pages/action/vsbn.php';
}
elseif($a == 'wk')
  {
    echo "
      <div class='row'>
      <section >
      <!-- /.content -->
        <div class='col-xs-12'>
          <div class='box'>
         
          <div class='box-header'>
          <h3 class='box-title'></h3>
                <div class='box-tools'>
                  <div class='input-group input-group-sm' style='width: 50px;'>
                        
                  <a href='".BASE_URL."index.php?action=wk&do=new' class='btn btn-sm btn-success'>Thêm Thợ Mới</a> 
    
                 </div>       
            </div>
        </div>
              
              <!-- /.box-header dien nuoc cho-->
              <div class='box-body table-responsive'>";
            require 'pages/action/tho.php';

            echo"  </div>
              <!-- /.box-body -->
         
            
            </div>
        </div>
      </section>  
      </div>    
      "; 
  }
elseif ($a=='chat') {
    # code...
    require 'chat/index.php';
  }
  elseif ($a=='app') {
    # code...
    require 'pages/mobile/getData.php';
  }
}
?>
        <!-- right col -->
</div>
      <!-- /.row (main row) -->
