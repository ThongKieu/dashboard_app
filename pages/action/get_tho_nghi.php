<?php

    $get_tho = 'SELECT name_worker, time_off, add_worker, status_worker FROM info_worker where today_off = 1';
    $show_tho = $conn -> query($get_tho);
    $show_tho ->setFetchMode(PDO::FETCH_ASSOC);
    $show_tho->execute();

    echo "
    <table class='table table-bordered table-hover '>
        <thead>
            <th>Tên Thợ</th>
            <th> Quận</th>
            <th> Thời Gian Nghỉ</th>
        </thead>
        <tbody>
    ";
    while($r_tho = $show_tho->fetch())
    {
        if($r_tho['status_worker']== 0){
            echo  " 
       <tr> 
            <td>".$r_tho['name_worker']." &nbsp;&nbsp; </td>
            <td>".$r_tho['add_worker']." &nbsp;&nbsp; </td>
            <td>";
            switch($r_tho['time_off']) {
                case 1: echo" Nghỉ Sáng";
                        break;
                case 2: echo" Nghỉ Chiều";
                    break;  
                case 3: echo" Nghỉ Cả Ngày";
                    break;
                case 0: echo" Nghỉ Phép";
                    break;
            
            }
            echo " </td>
            
            
        </tr>
            
            
        
            ";
        }
        
    }
    echo "</tbody>
        </table>";
?>