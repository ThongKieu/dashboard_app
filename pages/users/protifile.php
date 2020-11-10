
<?php include '../../config.php';
       
?>
      <html>
        <head>
          <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/min.css">
          <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>/css/min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
          <title> Phân Lịch Cho Thợ</title>
          
      <head>
        <body>
<?php 
$iduser = $_SESSION['username'];
try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
    $sql = "SELECT * FROM users where username like '$iduser'";
    $q= $pdo->query($sql);
    $q ->setFetchMode(PDO::FETCH_ASSOC);

}
catch (PDOException $e)
{
    die("Could not connect to the database $dbname :" . $e->getMessage());
}


?>
<style>
.hop input[type=password] {
  width: 100%;
  padding: 5px;
  margin: 5px 0 1px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.hop input[type=password] {
  background-color: #ddd;
  outline: none;
}
</style>

 
<form action="updateTT.php"  method="POST" class="hop"  enctype="multipart/form-data">
    <h2>Thông tin Nhân Viên</h2>
    <?php $rs =$q->fetch()?>
    <hr>
            <input type="hidden" name ='id' value="<?php echo $rs['id']; ?>">
              <div  style="text-align: center;">
                  <?php if (isset($rs['ava_img'])): ?>
                    <img src="<?php echo BASE_URL . '/dist/img/' . $rs['ava_img']; ?>" id="profile_img" style="height: 150px; border-radius: 50%" alt="">
                  <?php else: ?>
                    <img src="http://via.placeholder.com/150x150" id="profile_img" style="height: 150px; border-radius: 50%" alt="">
                  <?php endif; ?>
                  <h3>Thay đổi hình đại diện</h3>
                  
    <!-- Content Header (Page header) -->
                   
                      <section  >
                      <div class="row"  >  
                          <!-- Small boxes (Stat box) -->
                          
                            <div class="col-sm-6">
                              <!-- small box -->
                              <div class="small-box ">
                                <div class="inner">
                                  <h3>
                                    <img src="<?php echo BASE_URL; ?>dist/img/avatar.png" style="height: 80px; border-radius: 50%" alt=""/>
                                  </h3>
                                </div>
                               
                             <input type="radio" name="ava_img" checked value="avatar.png">
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <!-- small box -->
                              <div class="small-box ">
                                <div class="inner">
                                  <h3>
                                    <img src="<?php echo BASE_URL; ?>dist/img/avatar3.png" style="height: 80px; border-radius: 50%" alt=""/>
                                  </h3>
                                </div>
                               
                             <input type="radio" name="ava_img" value="avatar3.png">
                              </div>
                            </div>
                            </div>
                        </section>
                    
                  
  <!-- /.content-wrapper -->
                  <label for="nameNV"><b>Họ và Tên </b></label>
                  <input type="text" name="nameNV" value="<?php echo $rs['real_name']; ?>" class="form-control"/>
                
                  <label for="addNV"><b>Địa Chỉ </b></label>
                  <input type="text" name="addNV" value="<?php echo $rs['addressNV']; ?>" class="form-control"/>
               
                  <label for="telNV"><b>Số Điện Thoại Công Ty </b></label>
                  <input type="text" name="telNV" value="<?php echo $rs['contact_number']; ?>" class="form-control"/>
              
                
                  <label for="accNV"><b>Quyền Hạn </b></label>
                  <input type="text" name="accNV" value="<?php if($rs['level']==1){echo "Admin";} else echo 'Tài khoản Nhân Viên'; ?>" class="form-control" readonly/>
                
                
                <label for="accNV"><b>Nhập Mật Khẩu Mới </b></label>
                <input type="password" name="mkMoi"placeholder="Mật Khẩu Mới" id="password" />
                <label for="accNV"><b>Xác Nhận Mật Khẩu </b></label>
                <input type="password" placeholder="Xác Nhận Lại" id="confirm_password" />

          
                
    

                <input type="submit" name="uploadclick" value="Upload" class ="btn btn-sm btm-success"/>
     
    <button type="button" class="btn cancel" onclick="history.back()">Hủy</button>
</form>
<script>
var password = document.getElementById("password"),
  confirm_password = document.getElementById("confirm_password");

function validatePassword() {
  if (password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Mật Khẩu Mới Không trùng!");
  } else {
    confirm_password.setCustomValidity("");
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

</script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });
</script>
