<?php

require_once __DIR__ . '/conn.php';

function getAllTasks()
{
    global $conn;
    // Sorteer de taken op deadline (eerst de vroegste deadline)
    // NULL deadlines komen als laatste
    $sql = "SELECT * FROM taken ORDER BY deadline IS NULL, deadline ASC, id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTasksByStatus()
{
    global $conn;
    // Sorteer de taken op deadline (eerst de vroegste deadline)
    // NULL deadlines komen als laatste
    $sql = "SELECT * FROM taken ORDER BY deadline IS NULL, deadline ASC, id DESC";
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

$taken = getAllTasks();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $action = $_POST['action'] ?? 'create';
    
    if ($action === 'delete') {
        $id = $_POST['id'] ?? null;
        
        if (!empty($id)) {
            $query = "DELETE FROM taken WHERE id = :id";
            $statement = $conn->prepare($query);
            $statement->execute([':id' => $id]);
            
            header('Location: ../task/index.php?msg=Taak succesvol verwijderd');
            exit;
        } else {
            header('Location: ../task/index.php?error=Geen geldig ID opgegeven');
            exit;
        }
    }
    
    $errors = [];
    
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
    
    // Deadline is optioneel, dus geen validatie nodig
    // Als er geen deadline is ingevuld, wordt deze NULL in de database
    $deadline = !empty($_POST['deadline']) ? $_POST['deadline'] : null;
    
    // Valideer of de deadline een geldige datum is (format: YYYY-MM-DD)
    if ($deadline !== null && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $deadline)) {
        $errors[] = "Ongeldige deadline datum. Gebruik het datumveld.";
    }

    if (empty($errors)) {
        if ($action === 'create') {
            // Voeg een nieuwe taak toe inclusief de deadline
            $query = "INSERT INTO taken (titel, beschrijving, afdeling, status, deadline)
                  VALUES (:titel, :beschrijving, :afdeling, :status, :deadline)";
            $params = [
                ":titel" => $titel,
                ":beschrijving" => $beschrijving,
                ":afdeling" => $afdeling,
                ":status" => $status,
                ":deadline" => $deadline
            ];
        } elseif ($action === 'update') {
            $id = $_POST['id'] ?? null;
            if (empty($id)) {
                $errors[] = "Geen geldig ID opgegeven.";
            } else {
                // Update de taak inclusief de deadline
                $query = "UPDATE taken SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, status = :status, deadline = :deadline WHERE id = :id";
                $params = [
                    ":titel" => $titel,
                    ":beschrijving" => $beschrijving,
                    ":afdeling" => $afdeling,
                    ":status" => $status,
                    ":deadline" => $deadline,
                    ":id" => $id
                ];
            }
        }

        if (empty($errors)) {
            $statement = $conn->prepare($query);
            $statement->execute($params);
            header('Location: ../task/index.php?msg=Taak succesvol verwerkt');
            exit();
        }
    } else {

        $error_msg = implode(', ', $errors);
        header('Location: ../task/index.php?error=' . urlencode($error_msg));
        exit();
    }
}
?>
