<?php

//group_chat.php

include('../config.php');

$database = new Getdatabase();
$conn = $database->getConnection();



if($_POST["action"] == "insert_data")
{
 $data = array(
  ':from_user_id'  => $_SESSION["user_id"],
  ':chat_message'  => $_POST['chat_message'],
  ':status'   => '1'
 );

 $query = "
 INSERT INTO chat_message 
 (from_user_id, chat_message, status) 
 VALUES (:from_user_id, :chat_message, :status)
 ";

 $statement = $conn->prepare($query);

 if($statement->execute($data))
 {
  echo fetch_group_chat_history($conn);
 }

}

if($_POST["action"] == "fetch_data")
{
 echo fetch_group_chat_history($conn);
}

?>
