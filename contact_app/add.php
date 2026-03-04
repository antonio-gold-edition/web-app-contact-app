<?php

if(isset($_POST['name'], $_POST['phone'], $_POST['email'])) {

    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);

        // Validate phone is only digits
    if (!ctype_digit($phone)) {
        echo "Phone number must contain only digits!";
        exit;
        }

    $xml = simplexml_load_file("contacts.xml");

    // to check if phone already exists
    foreach ($xml->contact as $contact) {
        if ((string)$contact->phone === $phone) {
            echo "Phone number already exists!";
            exit;
        }
    }

    // add num
    $newContact = $xml->addChild("contact");
    $newContact->addChild("name", $name);
    $newContact->addChild("phone", $phone);
    $newContact->addChild("email", $email);

    $xml->asXML("contacts.xml");

    echo "Contact Added Successfully!";
}


?>

