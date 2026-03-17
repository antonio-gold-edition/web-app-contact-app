<?php

include "db.php";

if(isset($_GET['phone'])){

$phone = $_GET['phone'];

$conn->query("DELETE FROM contacts WHERE phone='$phone'");

}

header("Location: index.php");

?>