<?php
include "db.php";

$phone = $_GET['phone'];

$result = $conn->query("SELECT * FROM contacts WHERE phone='$phone'");

if(!$result || $result->num_rows == 0){
die("Contact not found");
}

$selected = $result->fetch_assoc();

if(isset($_POST['update'])){

$newName = trim($_POST['name']);
$newPhone = trim($_POST['phone']);
$newEmail = trim($_POST['email']);

if(!ctype_digit($newPhone)){
echo "Phone number must contain only digits!";
exit;
}

$check = $conn->query("SELECT * FROM contacts WHERE phone='$newPhone' AND phone!='$phone'");

if($check->num_rows > 0){
echo "Phone already exists!";
exit;
}

$conn->query("UPDATE contacts 
SET name='$newName', phone='$newPhone', email='$newEmail'
WHERE phone='$phone'");

header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Contact</title>
<script>
if(localStorage.getItem("darkMode") === "enabled"){
    document.documentElement.classList.add("dark-mode");
}
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container mt-5">

<div class="card p-4 col-md-6 mx-auto">

<h3 class="mb-4 text-center">Edit Contact</h3>

<form method="POST">

<div class="mb-3">
<input type="text" name="name" class="form-control"
value="<?= $selected['name'] ?>" required>
</div>

<div class="mb-3">
<input type="text" name="phone" class="form-control"
value="<?= $selected['phone'] ?>"
pattern="[0-9]{10}" maxlength="10" minlength="10" required>
</div>

<div class="mb-3">
<input type="email" name="email" class="form-control"
value="<?= $selected['email'] ?>" required>
</div>

<button name="update" class="btn btn-success w-100">
Update Contact
</button>

</form>

</div>

</div>

</body>
</html>