<?php

require_once __DIR__ . '/conn.php';

function getAllTasks()
{
    global $conn;
    $sql = "SELECT * FROM taken ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

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

$taken = getAllTasks();


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
    

    if (empty($errors)) {
        if ($action === 'create') {
            $query = "INSERT INTO taken (titel, beschrijving, afdeling, status)
                  VALUES (:titel, :beschrijving, :afdeling, :status)";
            $params = [
                ":titel" => $titel,
                ":beschrijving" => $beschrijving,
                ":afdeling" => $afdeling,
                ":status" => $status
            ];
        } elseif ($action === 'update') {
            $id = $_POST['id'] ?? null;
            if (empty($id)) {
                $errors[] = "Geen geldig ID opgegeven.";
            } else {
                $query = "UPDATE taken SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, status = :status WHERE id = :id";
                $params = [
                    ":titel" => $titel,
                    ":beschrijving" => $beschrijving,
                    ":afdeling" => $afdeling,
                    ":status" => $status,
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
function deleteTask($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM taken WHERE id = ?");
    $stmt->execute([(int)$id]); // cast naar int voor veiligheid
}
?>
