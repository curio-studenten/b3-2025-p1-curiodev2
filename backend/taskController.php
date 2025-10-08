<?php

//Variabelen vullen
$action = $_POST['action'];
$title = $_POST['title'];
if (empty($title)) {
    $errors[] = "Vul de title in.";
}
$beschrijving= $_POST['beschrijving'];
if (empty($title)) {
    $errors[] = "Vul de beschrijving in.";
}
$afdeling= $_POST['afdeling'];
$geldige_afdelingen = ['personeel', 'horeca', 'techniek', 'inkoop', 'klantenservice', 'groen', 'kantoor'];
if (empty($afdeling) || !in_array($afdeling, $geldige_afdelingen)) {
    $errors[] = "Selecteer een geldige afdeling.";
}
$status = !empty($_POST['status']) ? $_POST['status'] : 'todo';
$geldige_statussen = ['todo', 'doing', 'done'];
if (!in_array($status, $geldige_statussen)) {
    $status = 'todo';
}
//1. Verbinding
require_once '../../../backend/conn.php';



//2. Query
$query = "INSERT INTO taken (title, beschrijving, afdeling, status)
VALUES (:title, :beschrijving, :afdeling, :status)";

//3. Prepare
$statement = $conn->prepare($query);
$statement->execute([
    ":title" => $title,
    ":beschrijving" => $beschrijving,
    ":afdeling" => $afdeling,
    ":status" => $status,
]);

header('Location: ../../../task/create.php?msg=Taak aangemaakt')
?>