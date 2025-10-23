<?php
require_once __DIR__ . '/../backend/taskController.php';

// Fetch task data if ID is provided
$task = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $allTasks = getAllTasks();
    foreach ($allTasks as $t) {
        if ($t['id'] == $id) {
            $task = $t;
            break;
        }
    }
}

if (!$task) {
    echo "<p>Task not found.</p>";
    exit();
}
?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Taak aanpassen</title>
    <?php require_once 'head.php'; ?>
</head>

<body>
    <div class="container">
        <form action="../backend/taskController.php" method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?= $task['id'] ?>">

            <div class="Taken">
                <label for="titel">Titel:</label>
                <input type="text" id="titel" name="titel" value="<?= $task['titel'] ?>" placeholder="Titel" required>
            </div>

            <div class="Taken">
                <label for="afdeling">Afdeling:</label>
                <select id="afdeling" name="afdeling" required>
                    <option value="personeel" <?= $task['afdeling'] === 'personeel' ? 'selected' : '' ?>>Personeel</option>
                    <option value="horeca" <?= $task['afdeling'] === 'horeca' ? 'selected' : '' ?>>Horeca</option>
                    <option value="techniek" <?= $task['afdeling'] === 'techniek' ? 'selected' : '' ?>>Techniek</option>
                    <option value="inkoop" <?= $task['afdeling'] === 'inkoop' ? 'selected' : '' ?>>Inkoop</option>
                    <option value="klantenservice" <?= $task['afdeling'] === 'klantenservice' ? 'selected' : '' ?>>Klantenservice</option>
                    <option value="groen" <?= $task['afdeling'] === 'groen' ? 'selected' : '' ?>>Groen</option>
                    <option value="kantoor" <?= $task['afdeling'] === 'kantoor' ? 'selected' : '' ?>>Kantoor</option>
                </select>
            </div>

            <div class="Taken">
                <label for="beschrijving">Beschrijving:</label>
                <textarea id="beschrijving" name="beschrijving" placeholder="Beschrijving" required><?= $task['beschrijving'] ?></textarea>
            </div>

            <div class="Taken">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="todo" <?= $task['status'] === 'todo' ? 'selected' : '' ?>>To Do</option>
                    <option value="in-progress" <?= $task['status'] === 'in-progress' ? 'selected' : '' ?>>In Progress</option>
                    <option value="done" <?= $task['status'] === 'done' ? 'selected' : '' ?>>Done</option>
                </select>
            </div>

            <button type="submit">Taak bijwerken</button>
        </form>
    </div>
</body>

</html>