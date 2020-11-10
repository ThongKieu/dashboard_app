<?php

//fetch_user_chat_history.php

include('../config.php');



echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $conn);

?>
