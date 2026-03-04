<?php
$xml = simplexml_load_file("contacts.xml");
?>

<!DOCTYPE html>
<html>
<head>
<title>Contact Book</title>

<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container mt-4">

<div class="d-flex justify-content-between align-items-center mb-3">
<h2>Contact Book</h2>

<button id="darkToggle" class="btn btn-secondary">
🌙 Dark Mode
</button>
</div>

<form id="contactForm">

<div class="row g-2 align-items-center mb-3">

<div class="col-md-4">
<input type="text" name="name" class="form-control" placeholder="Name" required>
</div>

<div class="col-md-3">
<input 
type="text" 
name="phone" 
class="form-control" 
placeholder="Phone" 
pattern="[0-9]{10}" 
maxlength="10"
minlength="10"
title="Phone number must be exactly 10 digits"
required>
</div>

<div class="col-md-3">
<input type="email" name="email" class="form-control" placeholder="Email" required>
</div>

<div class="col-md-2">
<button type="submit" class="btn btn-primary w-100">Add</button>
</div>

</div>

</form>

<input type="text" id="search" class="form-control mb-3" placeholder="🔍 Search contact...">

<div class="row" id="contactsContainer">

<?php
    $contacts = [];

    foreach ($xml->contact as $contact) {
        $contacts[] = $contact;
    }

    usort($contacts, function($a, $b) {
        return strcasecmp($a->name, $b->name);
    });

    foreach ($contacts as $contact) {
    echo '
    <div class="col-md-4 mb-3 contact-card">
    <div class="card shadow-sm">
    <div class="card-body">

    <h5 class="card-title">'.$contact->name.'</h5>

    <p class="card-text">
    📱+91 '.$contact->phone.' <br>
    ✉ '.$contact->email.'
    </p>

    <a href="edit.php?phone='.$contact->phone.'" class="btn btn-warning btn-sm">Edit</a>
    <a href="delete.php?phone='.$contact->phone.'" 
    class="btn btn-danger btn-sm" 
    onclick="return confirm(\'Delete '.$contact->name.' from contacts?\')">
    Delete
    </a>
    </div>
    </div>
    </div>';
    }
?>

</div>

</div>

<script src="script.js"></script>

</body>
</html>