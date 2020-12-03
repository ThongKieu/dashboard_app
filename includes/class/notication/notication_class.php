<?php
 include "../../config.php";
        $datacon = new Getdatabase;
        $conn1 =  $datacon->getConnection();
    class Notication{
      
        public function show_notication(){

            $noti = "SELECT * FROM notication";
            $show = $conn1->query($noti);
        }
    }

?>