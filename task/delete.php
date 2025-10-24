<?php
require_once __DIR__ . '/../backend/taskController.php';

// --- Stap 1: Controleer of een taak-ID is meegegeven via GET ---
if (isset($_GET['id']) && !isset($_POST['confirm'])) {
    $id = htmlspecialchars($_GET['id']);

    // Zoek de taak op basis van ID
    $allTasks = getAllTasks();
    $task = null;
    foreach ($allTasks as $t) {
        if ($t['id'] == $id) {
            $task = $t;
            break;
        }
    }

    // Als de taak niet bestaat
    if (!$task) {
        echo "<p>Taak niet gevonden.</p>";
        exit();
    }
    ?>

    <!doctype html>
    <html lang="nl">
    <head>
        <meta charset="UTF-8">
        <title>Taak verwijderen</title>
        <?php require_once 'head.php'; ?>
    </head>
    <body>
        <div class="container" style="max-width: 600px; margin: 50px auto; text-align: center;">
            <h1>Taak verwijderen</h1>
            <p>Weet je zeker dat je deze taak wilt verwijderen?</p>

            <div class="task-info" style="text-align:left; margin-top:20px;">
                <strong>Titel:</strong> <?= htmlspecialchars($task['titel']); ?><br>
                <strong>Afdeling:</strong> <?= htmlspecialchars($task['afdeling']); ?><br>
                <strong>Beschrijving:</strong><br>
                <p><?= nl2br(htmlspecialchars($task['beschrijving'])); ?></p>
            </div>

            <form method="POST" style="margin-top:20px;">
                <input type="hidden" name="id" value="<?= $task['id']; ?>">
                <input type="hidden" name="confirm" value="1">
                <button type="submit" 
                        style="background-color:#e74c3c; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer;">
                    🗑️ Ja, verwijder deze taak
                </button>
                <a href="index.php" 
                   style="margin-left:10px; padding:10px 20px; background:#ccc; border-radius:8px; text-decoration:none; color:black;">
                    Annuleren
                </a>
            </form>
        </div>
    </body>
    </html>

    <?php
    exit();
}
?>

<?php
// --- Stap 2: Als gebruiker bevestigt, verwijder de taak ---
if (isset($_POST['id']) && isset($_POST['confirm'])) {
    $id = $_POST['id'];

    // Zorg dat deleteTask bestaat in taskController.php
    global $conn;
    $stmt = $conn->prepare("DELETE FROM taken WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php?msg=Taak+verwijderd");
    exit();
} else {
    echo "<p>Geen taak-ID opgegeven.</p>";
}
?>