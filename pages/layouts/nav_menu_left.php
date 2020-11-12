<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <ul class="sidebar-menu"  data-widget="tree">
        <li class="header">MENU CHÍNH</li>
        <li>
          <a href="<?php echo BASE_URL.'index.php';?>"><i class="fa fa-dashboard"></i> <span>Home</span>
          </a>
        </li>
        <li>
          <a href="<?php echo BASE_URL.'index.php?action=search';?>"><i class="fa fa-search"></i> <span>Tìm Thông Tin</span>
          </a>
        </li>
        <li>
          <a href="<?php echo BASE_URL.'index.php?action=add&do=0';?>"><i class="fa fa-user-plus"></i> <span>Thêm Lịch</span>
          </a>
        </li>
        <li>  <a href="<?php echo BASE_URL.'index.php?action=add&do=1'?>"><i class='fa fa-users'></i> <span>Vệ Sinh Bể Nước</span></a> </li> 
        <li><a href="<?php echo BASE_URL.'index.php?action=6';?>"><i class="glyphicon glyphicon-ok"></i> <span>Lịch Hoàn Thành</span></a></li>
        <li><a href="<?php echo BASE_URL.'index.php?action=7';?>"><i class="glyphicon glyphicon-file"></i> <span>Báo cáo ngày</span></a></li>
        <li><a href="<?php echo BASE_URL.'index.php?action=ktra';?>"><img src="dist/fa-worker.png" style="hight : 20px; width:20px;" > <span>Báo cáo Theo Thợ</span></a></li>
        <li><a href="<?php echo BASE_URL.'index.php?action=thuchi';?>"><i class="fa fa-dollar"></i> <span>Báo cáo Thu Chi</span></a></li>
        <li><a href="<?php echo BASE_URL.'index.php?action=mai&time_search='.$time_t;?>"><i class="glyphicon glyphicon-calendar"></i> <span>Lịch ngày mai</span></a></li>
        <li><a href="<?php echo BASE_URL.'index.php?action=imp';?>"><i class="fa fa-arrow-circle-o-right"></i> <span>Thêm Dữ Liệu Exel</span></a></li>
         <?php if($ruser['level'] == '1' ||$ruser['level'] == '2'){
	
      echo "  <li>  <a href='".BASE_URL."/includes/exportfile.php'><i class='fa fa-arrow-circle-o-left'></i> <span>Xuất Dữ Liệu KH</span></a> </li> ";
			}?>
              <li>  <a href="<?php echo BASE_URL.'index.php?action=wk&do=0'?>"><i class='fa fa-user'></i> <span>Thông tin thợ</span></a> </li> 
              <li>  <a href="<?php echo BASE_URL.'index.php?action=add&do=1'?>"><i class='fa fa-users'></i> <span>Thông tin thợ</span></a> </li> 
        
		  <li>
         <a href="<?php echo BASE_URL.'index.php?action=newnoti';?>"><i class="fa fa-bell"></i> <span>Thêm Thông báo mới</span></a>
        </li>   
        <li>  <a href='<?php echo BASE_URL.'index.php?action=chat';?>'><i class='fa fa-wechat'></i> <span>Chat</span></a> </li> 
      </ul>
    </section>
    <!-- <li><a href='<?php echo BASE_URL.'index.php?action=exp';?>'><i class='fa fa-arrow-circle-o-left'></i> <span>Xuất Dữ Liệu</span></a></li>/.sidebar -->
  </aside>
  <script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>