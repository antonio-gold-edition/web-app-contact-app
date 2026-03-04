<?php
$xml = simplexml_load_file("contacts.xml");
$phone = $_GET['phone'];

$selected = null;

foreach ($xml->contact as $contact) {
    if ((string)$contact->phone === $phone) {
        $selected = $contact;
        break;
    }
}

if(isset($_POST['update'])) {

    $newName = trim($_POST['name']);
    $newPhone = trim($_POST['phone']);
    $newEmail = trim($_POST['email']);

    if (!ctype_digit($newPhone)) {
        echo "Phone number must contain only digits!";
        exit;
    }
    foreach ($xml->contact as $contact) {
        if ((string)$contact->phone === $newPhone && 
            (string)$contact->phone !== $phone) {
            echo "Phone number already exists!";
            exit;
        }
    }

    $selected->name = $newName;
    $selected->phone = $newPhone;
    $selected->email = $newEmail;

    $xml->asXML("contacts.xml");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Edit Contact</h2>

<form method="POST">
    <input type="text" name="name" value="<?= $selected->name ?>" required>
    <input type="text" 
       name="phone" 
       value="<?= $selected->phone ?>" 
       pattern="[0-9]+" 
       title="Only numbers allowed" 
       required>
    <input type="email" name="email" value="<?= $selected->email ?>" required>
    <button type="submit" name="update">Update</button>
</form>

</body>
</html>