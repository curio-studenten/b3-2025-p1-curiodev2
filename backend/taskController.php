<?php
// 1. Verbinding
require_once __DIR__ . '/conn.php';

// Functie om alle taken op te halen
function getAllTasks()
{
    global $conn;
    $sql = "SELECT * FROM taken ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Functie om alle taken op te halen waarvan de status NIET 'done' is
function getIncompleteTasks()
{
    global $conn;
    $sql = "SELECT * FROM taken WHERE status <> :done ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':done' => 'done']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Functie om taken te groeperen op status
function getTasksByStatus()
{
    global $conn;
    $sql = "SELECT * FROM taken ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $groupedTasks = [
        'todo' => [],
        'in-progress' => [],
        'done' => []
    ];

    foreach ($tasks as $task) {
        if (isset($groupedTasks[$task['status']])) {
            $groupedTasks[$task['status']][] = $task;
        }
    }

    return $groupedTasks;
}

// Haal alle taken op voor de index pagina
$taken = getAllTasks();

// Alleen verwerken als het een POST request is (vanuit een formulier)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Variabelen vullen en valideren
    $errors = [];
    $action = $_POST['action'] ?? 'create';
    
    $titel = $_POST['titel'] ?? null;
    if (empty($titel)) {
        $errors[] = "Vul de titel in.";
    }
    
    $beschrijving = $_POST['beschrijving'] ?? null;
    if (empty($beschrijving)) {
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
    
    // Alleen opslaan als er geen errors zijn
    if (empty($errors)) {
        // Query
        $query = "INSERT INTO taken (titel, beschrijving, afdeling, status)
                  VALUES (:titel, :beschrijving, :afdeling, :status)";
        
        // Prepare en Execute
        $statement = $conn->prepare($query);
        $statement->execute([
            ":titel" => $titel,
            ":beschrijving" => $beschrijving,
            ":afdeling" => $afdeling,
            ":status" => $status
        ]);
        
        // Redirect alleen na succesvolle POST
        header('Location: ../task/index.php?msg=Taak succesvol aangemaakt');
        exit();
    } else {
        // Bij errors, terug naar create.php met foutmeldingen
        $error_msg = implode(', ', $errors);
        header('Location: ../task/index.php?error=' . urlencode($error_msg));
        exit();
    }
}
?>
