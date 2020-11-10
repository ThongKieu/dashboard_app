<?php
require "../../config.php";
class Admin 
{
    private $sql;
    public $uname;
    public $q;
    $uname = $_SESSION['username']
    $sql = "SELECT * from users where username='$uname'";

    $q= $conn -> prepare($sql);
    $q-> execute()

    function isAdmin(){
        
    }
}