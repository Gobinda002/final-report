<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "neptours";

    //create connection
    $con = mysqli_connect($servername, $username, $password, $dbname);

    //check connection
    if(!$con){
        die(mysqli_error($con));
    }

?>