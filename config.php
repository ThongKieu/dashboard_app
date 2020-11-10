<?php
// start session
session_start(); 
	// conn to database
      	$host = 'localhost';
        $dbname = 'dulieu';
        $username = 'root';
        $password = '';
        $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        $actionh='';
        $timelive = date('Y-m-d');
        $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
        $time_t = date('Y-m-d',$tomorrow);
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
          $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);
          }
          // Catch any errors
          catch (PDOException $e) {
          echo $e->getMessage();
          exit();
          }
  // define global constants
	define ('ROOT_PATH', realpath(dirname(__FILE__))); // path to the root folder
	define ('INCLUDE_PATH', realpath(dirname(__FILE__) . '/includes' )); // Path to includes folder
  define('BASE_URL', 'http://localhost:8080/whsapp/'); // the home url of the website
 
  function fetch_user_last_activity($user_id, $conn)
  {
   $query = "
   SELECT * FROM login_details 
   WHERE user_id = '$user_id' 
   ORDER BY last_activity DESC 
   LIMIT 1
   ";
   $statement = $conn->prepare($query);
   $statement->execute();
   $result = $statement->fetchAll();
   foreach($result as $row)
   {
    return $row['last_activity'];
   }
  }


function get_real_name($user_id, $conn)
{
 $query = "SELECT real_name FROM users WHERE id = '$user_id'";
 $statement = $conn->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['real_name'];
 }
}
function fetch_user_chat_history($from_user_id, $to_user_id, $conn)
{
  $query = "
  SELECT * FROM chat_message 
  WHERE (from_user_id = '".$from_user_id."' 
  AND to_user_id = '".$to_user_id."') 
  OR (from_user_id = '".$to_user_id."' 
  AND to_user_id = '".$from_user_id."') 
  ORDER BY timestamp ASC
  ";
  $statement = $conn->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $output = '<ul class="list-unstyled">';
  foreach($result as $row)
  {
   $user_name = '';
   $dynamic_background = '';
   $chat_message = '';
   if($row["from_user_id"] == $from_user_id)
   {
    if($row["status"] == '2')
    {
     $chat_message = '<em>This message has been removed</em>';
     $user_name = '<b class="text-success">You</b>';
    }
    else
    {
     $chat_message = $row['chat_message'];
     $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b class="text-success">You</b>';
    }
    
 
    $dynamic_background = 'background-color:#ffe6e6;';
   }
   else
   {
    if($row["status"] == '2')
    {
     $chat_message = '<em>This message has been removed</em>';
    }
    else
    {
     $chat_message = $row["chat_message"];
    }
    $user_name = '<b class="text-danger">'.get_real_name($row['from_user_id'], $conn).'</b>';
    $dynamic_background = 'background-color:#ffffe6;';
   }
   $output .= '
   <li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;'.$dynamic_background.'">
    <p>'.$user_name.' - '.$chat_message.'
     <div align="right">
      - <small><em>'.$row['timestamp'].'</em></small>
     </div>
    </p>
   </li>
   ';
  }
  $output .= '</ul>';
  $query = "
  UPDATE chat_message 
  SET status = '0' 
  WHERE from_user_id = '".$to_user_id."' 
  AND to_user_id = '".$from_user_id."' 
  AND status = '1'
  ";
  $statement = $conn->prepare($query);
  $statement->execute();
  return $output;
 }
 



function count_unseen_message($from_user_id, $to_user_id, $conn)
{
 $query = "
 SELECT * FROM chat_message 
 WHERE from_user_id = '$from_user_id' 
 AND to_user_id = '$to_user_id' 
 AND status = '1'
 ";
 $statement = $conn->prepare($query);
 $statement->execute();
 $count = $statement->rowCount();
 $output = '';
 if($count > 0)
 {
  $output = '<span class="label label-success">'.$count.'</span>';
 }
 return $output;
}
function fetch_is_type_status($user_id, $conn)
{
 $query = "
 SELECT is_type FROM login_details 
 WHERE user_id = '".$user_id."' 
 ORDER BY last_activity DESC 
 LIMIT 1
 "; 
 $statement = $conn->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '';
 foreach($result as $row)
 {
  if($row["is_type"] == 'yes')
  {
   $output = ' - <small><em><span class="text-muted">Đang Gõ...</span></em></small>';
  }
 }
 return $output;
}
function fetch_group_chat_history($conn)
{
 $query = "
 SELECT * FROM chat_message 
 WHERE to_user_id = '0'  
 ORDER BY timestamp ASC
 ";

 $statement = $conn->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();

 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  if($row["from_user_id"] == $_SESSION["user_id"])
  {
   $user_name = '<b class="text-success">You</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.get_real_name($row['from_user_id'], $conn).'</b>';
  }

  $output .= '

  <li style="border-bottom:1px dotted #ccc">
   <p>'.$user_name.' - '.$row['chat_message'].' 
    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
  </li>
  ';
 }
 $output .= '</ul>';
 return $output;
}


