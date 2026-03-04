<?php
$xml = simplexml_load_file("contacts.xml");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Contact Book</h2>

<form id="contactForm" method="POST">
    <input type="text" name="name" id="name" placeholder="Name" required>
    <input type="text" 
        name="phone" 
        id="phone" 
        placeholder="Phone" 
        pattern="[0-9]+" 
        title="Only numbers allowed" 
        required>
    <input type="email" name="email" id="email" placeholder="Email" required>
    <button type="submit">Add Contact</button>
</form>

<br>

<input type="text" id="search" placeholder="Search Contact...">

<h3>Contact List</h3>

<div id="contactList">

<?php
$contacts = [];

foreach ($xml->contact as $contact) {
    $contacts[] = $contact;
}

usort($contacts, function($a, $b) {
    return strcasecmp($a->name, $b->name);
});

foreach ($contacts as $contact) {
    echo "<div class='card'>
            <b>".$contact->name."</b><br>
            ".$contact->phone."<br>
            ".$contact->email."<br>
            <a href='edit.php?phone=".$contact->phone."'>Edit</a> |
            <a href='delete.php?phone=".$contact->phone."'>Delete</a>
          </div>";
}
?>
</div>

<script src="script.js"></script>
</body>
</html>