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
        {   echo "<ul class='smooth_scroll'>
            <li><a data-toggle='tooltip' data-placement='top' title='Lịch Điện Nước' href='#lichDienNuoc'><i class='fa fa-gg' style='width:15px; height:15px; color: white'></i></a></li>
            <li><a data-toggle='tooltip' data-placement='top' title='Lịch Điện Lạnh' href='#lichDienLanh'><i class='fa fa-gg' style='width:15px; height:15px; color: white'></i></a></li>
            <li><a data-toggle='tooltip' data-placement='top' title='Lịch Đồ Gỗ' href='#lichDoGo'><i class='fa fa-gg' style='width:15px; height:15px; color: white'></i></a></li>
          </ul>";
            echo "<div class='container-fluid'>";
                echo"<div class='row'>";
                        include 'dien_nuoc.php';
                echo" </div> <!--ket thuc dong-->";
            echo "</div>";
                    
            echo "<div class='container-fluid'>";
                echo"<div class='row'>";
                            include 'dien_lanh.php';
                echo" </div> <!--ket thuc dong-->";
                    echo "</div>";
            echo "<div class='container-fluid'>"; 
                echo "<div class='row'>";
                        include 'do_go.php';
                echo" </div> <!--ket thuc dong-->";
            echo "</div>";
                // ket thuc container-fluid
        }
?>


 