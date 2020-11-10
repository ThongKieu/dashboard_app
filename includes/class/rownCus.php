<?php 
   
   class Count{
      // database pdoection and table name
    private $pdo;
    private $table_name = "info_cus";
    private $table2_name = "work_do";
     
    // object properties
    public $numDL;
    public $numDN;
    public $numHuy;
    public $numKS;
    public $numLC;
    
 
    // constructor
    public function __construct($db){
        $this->pdo = $db;
    } 
    function countLC($time_search){
          
          // query to select all user records
          $query = "SELECT id_cus FROM ". $this->table_name . "
           WHERE  date_book like '%$time_search%' and flag_book ='0' and flag_status is NULL";
     
          // prepare query statement
          $stmt = $this->pdo->prepare($query);
     
          // execute query
          $stmt->execute();
     
          // get number of rows
          $numLC = $stmt->rowCount();
          
          // return row count
          return $numLC;
     } 
     
     function countDL($time_search){
 
     // query to select all user records
    // $time_search = date('d/m/Y');
     // query to select all user records
     $query = "SELECT info_cus.id_cus FROM info_cus, work_do  WHERE  flag_book ='1' and flag_status is NULL and kind_book like '%Lanh%' and work_do.sum_thu = 0 and work_do.id_cus = info_cus.id_cus and date_book like '%$time_search%'";

     // prepare query statement
     $stmt = $this->pdo->prepare($query);

     // execute query
     $stmt->execute();

     // get number of rows
     $numLC = $stmt->rowCount();
     
     // return row count
     return $numLC;
     }
     function countDN($time_search){
 
          // query to select all user records
          // query to select all user records
     //$time_search = date('d/m/Y');
     // query to select all user records
     $query = "SELECT info_cus.id_cus FROM info_cus, work_do  WHERE  flag_book ='1' and flag_status is NULL and kind_book like '%nuoc%' and work_do.sum_thu = 0 and work_do.id_cus = info_cus.id_cus and date_book like '%$time_search%'";

     // prepare query statement
     $stmt = $this->pdo->prepare($query);

     // execute query
     $stmt->execute();

     // get number of rows
     $numdn = $stmt->rowCount();
     
     return $numdn;
          }
     function countDG($time_search){
 
               // query to select all user records
               // query to select all user records
          //$time_search = date('d/m/Y');
          // query to select all user records
          $query = "SELECT info_cus.id_cus FROM info_cus, work_do  WHERE  flag_book ='1' and flag_status is NULL and kind_book like '%go%' and work_do.sum_thu = 0 and work_do.id_cus = info_cus.id_cus and date_book like '%$time_search%' ";
     
          // prepare query statement
          $stmt = $this->pdo->prepare($query);
     
          // execute query
          $stmt->execute();
     
          // get number of rows
          $numLC = $stmt->rowCount();
          
          return $numLC;
               }
     function countHuy($time_search){
 
         // $time_search = date('d/m/Y');
          // query to select all user records
          $query = "SELECT id_cus FROM " . $this->table_name . " WHERE date_book like '%".$time_search."%' and flag_status like '%Huy%' ";
     
          // prepare query statement
          $stmt = $this->pdo->prepare($query);
     
          // execute query
          $stmt->execute();
     
          // get number of rows
          $numLC = $stmt->rowCount();
          
          // return row count
          return $numLC;
     }

     function countKS($time_search){
 
          //$time_search = date('d/m/Y');
          // query to select all user records
          $query = "SELECT id_cus FROM " . $this->table_name . " WHERE date_book like '%".$time_search."%' and flag_status like '%sat%' ";
     
          // prepare query statement
          $stmt = $this->pdo->prepare($query);
     
          // execute query
          $stmt->execute();
     
          // get number of rows
          $numLC = $stmt->rowCount();
          
          // return row count
          return $numLC;
                    }
          
}

 ?>
