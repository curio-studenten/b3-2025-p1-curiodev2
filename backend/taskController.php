<?php

//Variabelen vullen
$action = $_POST['action'] ?? 'create';
$titel = $_POST['titel'] ?? null;
if (empty($title)) {
    $errors[] = "Vul de title in.";
}
$beschrijving = $_POST['beschrijving'] ?? null;
if (empty($title)) {
    $errors[] = "Vul de beschrijving in.";
}
$afdeling = $_POST['afdeling'] ?? null;
$geldige_afdelingen = ['personeel', 'horeca', 'techniek', 'inkoop', 'klantenservice', 'groen', 'kantoor'];
if (empty($afdeling) || !in_array($afdeling, $geldige_afdelingen)) {
    $errors[] = "Selecteer een geldige afdeling.";
}
$status = !empty($_POST['status']) ? $_POST['status'] : 'todo';
$geldige_statussen = ['todo', 'in-progress', 'done'];
if (!in_array($status, $geldige_statussen)) {
    $status = 'todo';
}
//1. Verbinding

require_once __DIR__ . '/conn.php';

// Functie om alle taken op te halen waarvan de status NIET 'done' is
function getIncompleteTasks() {
    global $conn;
    $sql = "SELECT * FROM taken WHERE status <> :done";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':done' => 'done']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//2. Query
$query = "INSERT INTO taken (titel, beschrijving, afdeling, status)
VALUES (:titel, :beschrijving, :afdeling, :status)";

//3. Prepare
$statement = $conn->prepare($query);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $statement->execute([
    ":titel" => $titel,
    ":beschrijving" => $beschrijving,
    ":afdeling" => $afdeling,
    ":status" => $status,
]);
}


// header('Location: ../../../task/create.php?msg=Taak aangemaakt')
?>