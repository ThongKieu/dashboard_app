<?php  

include 'config.php';
    
 //include('class\config.php');
 $database = new Getdatabase();
 $conn = $database->getConnection();

 if(isset($_SESSION['user_id']))
    {
     header('location:index.php');
    }
    
    if(isset($_POST["login"]))
    {
      if(empty($_POST["taikhoan"]) || empty($_POST["mk"]))
            {  
                 $message = '<label>Thông tin chưa được nhập!!!!!</label>';  
           }  
      else  
      { 
          $query = "
          SELECT * FROM users 
          WHERE username = :username
        ";
        $statement = $conn->prepare($query);
        $statement->execute(
          array(
            ':username' => $_POST["taikhoan"]
            )
        );
        $count = $statement->rowCount();
        if($count > 0)
        {
          $result = $statement->fetchAll();
            foreach($result as $row)
            {
                if(password_verify($_POST["mk"], $row["password"]))
                {
                  $_SESSION['user_id'] = $row['id'];
                  $_SESSION['username'] = $row['username'];
                  $sub_query = "
                  INSERT INTO login_details 
                  (user_id) 
                  VALUES ('".$row['id']."')
                  ";
                  $statement = $conn->prepare($sub_query);
                  $statement->execute();
                  $_SESSION['login_details_id'] = $conn->lastInsertId();
                  header("location:index.php");
                }
                else
                {
                  $message = "<label>Sai mật Khẩu</label>";
                }
            }
        }
        else
        {
        $message = "<label>Sai Tài Khoản</labe>";
        }

        }
    
    }

 ?>  

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Thông tin khách hàng</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="dist/fa-worker.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">


	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('dist/img/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
            <div class="container" style="width:500px;">  
                
                <form class="login100-form validate-form flex-sb flex-w" method="POST">  
                  
                <span class="login100-form-title p-b-33">
						Đăng Nhập Quản Trị
                    </span>
                    <?php  
                    if(isset($message))  
                    {  
                        echo '<div class="p-t-10 p-b-9">
						<span class="txt3">'.$message.' </span> </div>';  
                    }  
                    ?>  
                    
                    <div class="wrap-input100 validate-input" data-validate = "Tài Khoản Trống">
						<input class="input100" type="text" name="taikhoan" placeholder="Tài Khoản" >
						<span class="focus-input100"></span>
                    </div>
                     <div class="p-t-10 p-b-9">
						<span class="txt1">
							  &nbsp;
						</span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Mật khẩu trống">
						<input class="input100" type="password" name="mk" placeholder="Mật Khẩu" >
						<span class="focus-input100"></span>
					</div>
                                        
					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn" type="submit" name="login" >
							Đăng Nhập
						</button>
					</div>
                    <!-- <input type="submit" name="login" class="btn btn-info" value="Login" />  -->
                </form>  
           </div>  
           <br />
			</div>
		</div>
	</div>



   