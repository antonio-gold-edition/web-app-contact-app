<?php
$xml = simplexml_load_file("contacts.xml");

$phone = $_GET['phone'];

foreach ($xml->contact as $contact) {
    if ((string)$contact->phone === $phone) {
        $dom = dom_import_simplexml($contact);
        $dom->parentNode->removeChild($dom);
    }
}

$xml->asXML("contacts.xml");

header("Location: index.php");
?>