<?php

$conn = new mysqli("localhost","root","student","contactdb");

if($conn->connect_error){
    die("Connection failed");
}

?>