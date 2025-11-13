<?php

require_once __DIR__ . '/conn.php';

function normalizeDateForDb($input)
{
    if ($input === null || $input === '') {
        return null;
    }
    return $input;
}


function formatDateForDisplay($date)
{
    if (empty($date)) return '';

    $d = DateTime::createFromFormat('Y-m-d', $date); #lets you parse a string according to an format(strtotime also works but this is more explicit)
    if ($d) {
        return $d->format('d-m');
    }
    return $date;
}

function getAllTasks()
{
    global $conn;
    $sql = "SELECT * FROM taken ORDER BY deadline ASC, id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTasksByStatus()
{
    global $conn;
    $sql = "SELECT * FROM taken ORDER BY deadline ASC, id DESC";
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

    $rawDatum = $_POST['deadline'] ?? null;
    $datum_db = normalizeDateForDb($rawDatum);
    if ($datum_db === false) {
        $errors[] = "Ongeldige datum opgegeven.";
    }
    

    if (empty($errors)) {
        if ($action === 'create') {
            $query = "INSERT INTO taken (titel, beschrijving, afdeling, status, deadline)
                  VALUES (:titel, :beschrijving, :afdeling, :status, :deadline)";
            $params = [
                ":titel" => $titel,
                ":beschrijving" => $beschrijving,
                ":afdeling" => $afdeling,
                ":status" => $status,
                ":deadline" => $datum_db
            ];
        } elseif ($action === 'update') {
            $id = $_POST['id'] ?? null;
            if (empty($id)) {
                $errors[] = "Geen geldig ID opgegeven.";
            } else {
                $query = "UPDATE taken SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, status = :status, deadline = :deadline WHERE id = :id";
                $params = [
                    ":titel" => $titel,
                    ":beschrijving" => $beschrijving,
                    ":afdeling" => $afdeling,
                    ":status" => $status,
                    ":deadline" => $datum_db,
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
