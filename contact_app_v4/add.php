<?php

include "db.php";

if(isset($_POST['name'], $_POST['phone'], $_POST['email'])){

$name = trim($_POST['name']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);

/* phone must contain only digits */
if(!ctype_digit($phone)){
echo "Phone number must contain only digits!";
exit;
}

/* phone must be exactly 10 digits */
if(!preg_match('/^[0-9]{10}$/', $phone)){
echo "Phone number must be exactly 10 digits!";
exit;
}

/* check if phone already exists */
$check = $conn->query("SELECT * FROM contacts WHERE phone='$phone'");

if($check->num_rows > 0){
echo "Phone number already exists!";
exit;
}

/* insert contact */
$sql = "INSERT INTO contacts(name,phone,email)
VALUES('$name','$phone','$email')";

if($conn->query($sql)){
echo "Contact Added Successfully!";
}else{
echo "Error: ".$conn->error;
}

}

?>