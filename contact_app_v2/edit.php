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
    
    <script>
if(localStorage.getItem("darkMode") === "enabled"){
    document.documentElement.classList.add("dark-mode");
}
</script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow-sm p-4 col-md-6 mx-auto">

        <h3 class="text-center mb-4">Edit Contact</h3>

        <form method="POST">

            <div class="mb-3">
                <input type="text" name="name" class="form-control"
                value="<?= $selected->name ?>" required>
            </div>

            <div class="mb-3">
                <input type="text" name="phone" class="form-control"
                value="<?= $selected->phone ?>" pattern="[0-9]+" required>
            </div>

            <div class="mb-3">
                <input type="email" name="email" class="form-control"
                value="<?= $selected->email ?>" required>
            </div>

            <button name="update" class="btn btn-success w-100">
                Update Contact
            </button>

        </form>

    </div>

</div>
<script>
if(localStorage.getItem("darkMode") === "enabled"){
    document.body.classList.add("dark-mode");
}
</script>
</body>
</html>