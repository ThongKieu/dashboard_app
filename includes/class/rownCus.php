<?php 
   
   class Count{
      // database pdoection and table name
    private $pdo;
    private $table_name = "info_cus";
    private $table2_name = "work_do";
    private $table3_name = "vsbn";
    private $table4_name = "info_worker";

    // object properties
    public $numDL;
    public $numDN;
    public $numHuy;
    public $numKS;
    public $numLC;
    public $numVSBN;
    
    
 
    // constructor
    public function __construct($db){
        $this->pdo = $db;
    } 
    function countLC($timelive){
          
          // query to select all user records
          $query = "SELECT id_cus FROM ". $this->table_name . "
           WHERE  date_book like '%$timelive%' and flag_book ='0' and flag_status is NULL";
     
          // prepare query statement
          $stmt = $this->pdo->prepare($query);
     
          // execute query
          $stmt->execute();
     
          // get number of rows
          $numLC = $stmt->rowCount();
          
          // return row count
          return $numLC;
     } 
     
     function countDL($timelive){
 
     // query to select all user records
    // $timelive = date('d/m/Y');
     // query to select all user records
          $query = "SELECT info_cus.id_cus FROM info_cus, work_do  WHERE  flag_book ='1' and flag_status is NULL and kind_book like '%Lanh%' and work_do.sum_thu = 0 and work_do.id_cus = info_cus.id_cus and date_book like '%$timelive%'";

          // prepare query statement
          $stmt = $this->pdo->prepare($query);

          // execute query
          $stmt->execute();

          // get number of rows
          $numLC = $stmt->rowCount();
          
          // return row count
          return $numLC;
     }
     function countDN($timelive){
 
          // query to select all user records
          // query to select all user records
     //$timelive = date('d/m/Y');
     // query to select all user records
          $query = "SELECT info_cus.id_cus FROM info_cus, work_do  WHERE  flag_book ='1' and flag_status is NULL and kind_book like '%nuoc%' and work_do.sum_thu = 0 and work_do.id_cus = info_cus.id_cus and date_book like '%$timelive%'";

          // prepare query statement
          $stmt = $this->pdo->prepare($query);

          // execute query
          $stmt->execute();

          // get number of rows
          $numdn = $stmt->rowCount();
          
          return $numdn;
          }
     function countDG($timelive){
 
               // query to select all user records
               // query to select all user records
          //$timelive = date('d/m/Y');
          // query to select all user records
          $query = "SELECT info_cus.id_cus FROM info_cus, work_do  WHERE  flag_book ='1' and flag_status is NULL and kind_book like '%go%' and work_do.sum_thu = 0 and work_do.id_cus = info_cus.id_cus and date_book like '%$timelive%' ";
     
          // prepare query statement
          $stmt = $this->pdo->prepare($query);
     
          // execute query
          $stmt->execute();
     
          // get number of rows
          $numLC = $stmt->rowCount();
          
          return $numLC;
               }
     function countHuy($timelive){
 
         // $timelive = date('d/m/Y');
          // query to select all user records
          $query = "SELECT id_cus FROM " . $this->table_name . " WHERE date_book like '%".$timelive."%' and flag_status like '%Huy%' ";
     
          // prepare query statement
          $stmt = $this->pdo->prepare($query);
     
          // execute query
          $stmt->execute();
     
          // get number of rows
          $numLC = $stmt->rowCount();
          
          // return row count
          return $numLC;
     }

     function countKS($timelive){
 
          //$timelive = date('d/m/Y');
          // query to select all user records
          $query = "SELECT id_cus FROM " . $this->table_name . " WHERE date_book like '%".$timelive."%' and flag_status like '%sat%' ";
     
          // prepare query statement
          $stmt = $this->pdo->prepare($query);
     
          // execute query
          $stmt->execute();
     
          // get number of rows
          $numLC = $stmt->rowCount();
          
          // return row count
          return $numLC;
                    }

     function countNotiVSBN($timelive)
     {
          $query = "SELECT id_vsbn FROM " . $this->table3_name . " WHERE status_vsbn = 0 ";
          $stmt = $this->pdo->prepare($query);
          $stmt->execute();
          $numVSBN = $stmt->rowCount();
          return $numVSBN;

     }
     
     function countWorkerOff($timelive)
     {
          $query = "SELECT id_worker FROM " . $this->table4_name . " WHERE today_off = 1 ";
          $stmt = $this->pdo->prepare($query);
          $stmt->execute();
          $numWorker = $stmt->rowCount();
          return $numWorker;

     }
     
          
}

 ?> 
