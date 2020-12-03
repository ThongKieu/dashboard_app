<?php

//remove_chat.php

include('../config.php');
$database = new Getdatabase();
$conn = $database->getConnection();
if(isset($_POST["chat_message_id"]))
{
 $query = "
 UPDATE chat_message 
 SET status = '2' 
 WHERE chat_message_id = '".$_POST["chat_message_id"]."'
 ";

 $statement = $conn->prepare($query);

 $statement->execute();
}

?>
