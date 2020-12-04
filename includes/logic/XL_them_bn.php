<?php
include('../../config.php');
$database = new Getdatabase();
$conn = $database->getConnection();

    if(isset($_POST['xl'])){
        $name_vsbn = $_GET['name_vsbn'];
        $add_vsbn = $_GET['add_vsbn'];
        $team_vsbn = $_GET['team_vsbn']; 
    
        try{
            $q = $conn ->prepare("INSERT INTO vsbn(`name_vsbn`,`add_vsbn`,`team_vsbn`) VALUE ('$name_vsbn','$add_vsbn','$team_vsbn')") ;
            $q->execute();
            if($q)
            {
                header("location:".BASE_URL."index.php");
            }
        }
        
        catch(PDOException $e)
        {
            echo $e->getMessage();
        } 
    }
    else{
        
        $id_vsbn = $_GET['id_bn'];
        
        try{
            $q = $conn ->prepare("UPDATE vsbn SET status_vsbn = 1 WHERE id_vsbn ='$id_vsbn'") ;
            $q->execute();
            if($q)
            {
                header("location:".BASE_URL."index.php");
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        } 

    }
    
    
?>
