<?php
    include('../config.php');
    $database = new Getdatabase();
    $conn = $database->getConnection();
    $query = "
        SELECT * FROM users 
        WHERE id != '".$_SESSION['user_id']."' 
    ";
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = 
    '<table class="table table-bordered table-striped">
        <tr>
            <th width="70%">Người Dùng</td>
            <th width="20%">Trạng Thái</td>
            <th width="10%">Trò Chuyện</td>
        </tr>';

        foreach($result as $row){
            $status = '';
            $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
            $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
            $user_last_activity = fetch_user_last_activity($row['id'], $conn);
        if($user_last_activity > $current_timestamp){
            $status = '<span class="label label-success">Trực tuyến</span>';
        }else{
            $status = '<span class="label label-danger">Offline</span>';
        }
        $output .= '
        <tr>
            <td>'.$row['real_name'].' '.count_unseen_message($row['id'], $_SESSION['user_id'], $conn).' '.fetch_is_type_status($row['id'], $conn).'</td>
            <td>'.$status.'</td>
            <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['id'].'" data-tousername="'.$row['real_name'].'">Nói chuyện</button></td>
        </tr>';
        }
    $output .= '</table>';
    echo $output;
?>
