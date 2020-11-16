<?php
include '../../config.php';



$id=$_POST['id_work'];
$tongthu=$_POST['sumthu'];
$tongchi= $_POST['sumchi'];
$note = $_POST['note_work'];
$tentho= $_POST['tentho'];
$ki = $_POST['ki'];
$time_search = $_POST['time_search'];
$thanh_toan = $_POST['thanh_toan'];
if(empty($note))
{
      $note ='';
}
try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$options);

       $sql = "UPDATE work_do SET sum_chi = '$tongchi', sum_thu = '$tongthu', date_done = '$timelive',note_work ='$note', thanh_toan = '$thanh_toan' where id_work like '%$id%'";

        $q = $pdo->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
       if($q){
		   if($time_seach != NULL){
       		header("location: " . BASE_URL . "index.php?action=".$ki."&tentho=".$tentho);}
		   else
			   header("location: " . BASE_URL . "index.php");
           
     }
} catch (PDOException $e) {
        die("Could not connect to the database $dbname :" . $e->getMessage());
      }
  
    