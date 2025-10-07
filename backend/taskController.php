<?php

//Variabelen vullen
$action = $_POST['action'];
$id = $_POST['id'];
$title = $_POST['title'];
if (empty($title)) {
    $errors[] = "Vul de title in.";
}
$beschrijving= $_POST['beschrijving'];
if (empty($title)) {
    $errors[] = "Vul de beschrijving in.";
}
$afdeling= $_POST['afdeling'];
if (empty($title)) {
    $errors[] = "Vul de afdeling in.";
}
$status= $_POST['status'];

//1. Verbinding
require_once '../../../backend/conn.php';



//2. Query



//3. Prepare
?>