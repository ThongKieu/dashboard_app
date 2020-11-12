<?php 
    if(!isset($_GET['time_search'])){
    
    $time_search = date('Y-m-d');
    }
    else 
    {
        $time_search= $_GET['time_search'];
    }
    try {
    $sql = "SELECT id_cus,name_cus, phone_cus, add_cus, des_cus, yc_book, note_book, kind_book, date_book , nv_add FROM info_cus where kind_book like '%nuoc%' and  flag_book = '0' and date_book like '%$time_search%' and flag_status is NULL order by des_cus DESC";
    $q = $conn->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $sql2 = "SELECT id_cus,name_cus, phone_cus, add_cus, des_cus, yc_book, note_book, kind_book, date_book , nv_add FROM info_cus where kind_book like '%lanh%' and  flag_book = '0' and date_book like '%$time_search%' and flag_status is NULL order by des_cus DESC";
    $q2 = $conn->query($sql2);
    $q2->setFetchMode(PDO::FETCH_ASSOC);
    $sql3 = "SELECT id_cus,name_cus, phone_cus, add_cus, des_cus, yc_book, note_book, kind_book, date_book , nv_add FROM info_cus where kind_book like '%go%' and  flag_book = '0' and date_book like '%$time_search%'and flag_status is NULL order by des_cus DESC ";
    $q3 = $conn->query($sql3);
    $q3->setFetchMode(PDO::FETCH_ASSOC);
    $tho= $conn->prepare("select * FROM info_worker where status_worker = 0 and today_off = 0  order by name_worker ASC ");
    $tho->setFetchMode(PDO::FETCH_ASSOC); // set kiểu mảng cho giá trị trả về
    $tho->execute();
    $rs = $tho->fetchAll();// đổ toàn bộ dự liệu thu về vào mảng
        
     } catch (PDOException $e) 
     {
         die("Could not connect to the database $dbname :" . $e->getMessage());
     }
     
    
 ?>
 <?php
    if(!isset($q))
        {
            echo "<h2> Không có dữ liệu</h2>";
        }
    
    else
        {   
            echo "
                <div class='container-fluid'>";
                echo "
                    <h3 id='lichDienNuoc' style='color: #00c0ef; padding:5px 10px 5px 10px;text-align: center;border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 5px #d2d6de;'>Lịch Điện Nước</h3>";
                    echo"<div class='row'>";
                            include 'dien_nuoc.php';
                    echo" </div> <!--ket thuc dong-->";
                    echo "</div>";
                    
            echo "
            <div class='container-fluid'>";
                echo"
                    <h3 id='lichDienLanh' style='color: #00c0ef; padding:5px 10px 5px 10px;text-align: center;border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 5px #d2d6de;'>Lịch Điện Lạnh</h3>";
                    echo"<div class='row'>";
                            include 'dien_lanh.php';
                    echo" </div> <!--ket thuc dong-->";
                    echo "</div>";
                    
            echo "
            <div class='container-fluid'>"; 
                echo "
                    <h3 id='lichDoGo' style='color: #00c0ef; padding:5px 10px 5px 10px;text-align: center;border: 1px solid #d2d6de; border-radius:5px; margin-top:5px; box-shadow: 5px 5px #d2d6de;'>Lịch Đồ Gỗ</h3>";
                    echo "<div class='row'>";
                            include 'do_go.php';
                    echo" </div> <!--ket thuc dong-->";
                    echo "</div>";
            
                // ket thuc container-fluid
        }
?>


 