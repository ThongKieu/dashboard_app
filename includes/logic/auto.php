<?php
    

    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $timeupdate = mktime(00,00);
    $timeupdate1 = mktime(date('H'),date('i'));
    $yesterday = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
    $tomorrow  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
    $ti=  date('H:i',$timeupdate);
       
    $ti1=  date('H:i',$timeupdate1);
       
    $ti2 = date('Y-m-d',$tomorrow);
    
    if($ti < $ti1)
    {
        $timelive =  date("Y-m-d",$yesterday);
        
        try {
         
            
         $sql = "UPDATE info_cus set date_book= '$ti2 - Old' WHERE info_cus.flag_book = 0 and info_cus.date_book like '%$timelive%'";
 
         $q = $conn->query($sql);
         $q->setFetchMode(PDO::FETCH_ASSOC);
             
      
         
         } catch (PDOException $e) 
     {
         die("Could not connect to the database $dbname :" . $e->getMessage());
    
     }
        
    }else{
        try {
            $sql = "UPDATE info_cus set date_book= '$ti2 - Old' WHERE info_cus.flag_book = 0 ";
    
            $q = $conn->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }    
    
    ?>
