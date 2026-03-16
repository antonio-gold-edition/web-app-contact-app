<?php

$conn = new mysqli("localhost","root","","contactdb");

if($conn->connect_error){
    die("Connection failed");
}

?>