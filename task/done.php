<?php require_once __DIR__ . '/../backend/config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location: login.php?msg=$msg");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once '../head.php'; ?>
    <title>TaakVerdeling</title>
</head>
<body>
    <?php require_once __DIR__ . '/../backend/taskController.php';
    $tasksByStatus = getTasksByStatus();
    $doneTasks = $tasksByStatus['done'];
    ?>

    <div class="kanban-column">
            <h2 class="column-header done-header">Done</h2>
                    <div class="tasks-container tasks-grid">
                        <?php
                        foreach ($doneTasks as $taak): ?>
                            <div class="task-card">
                                <span class="task-title"><?= $taak['titel']; ?></span>
                                <span class="task-desc"><?= $taak['beschrijving']; ?></span>
                                <span class="afdeling"><?= $taak['afdeling']; ?></span>
                                <?php if (!empty($taak['deadline'])) { $display = date('d-m', strtotime($taak['deadline'])); ?>
                                    <span class="task-date">Deadline: <?= $display; ?></span>
                                <?php } ?>
                                <span class="task-checkmark"></span>
                                <a href="edit.php?id=<?= $taak['id']; ?>">✏️ Aanpassen</a>
                            </div>
                        <?php endforeach; ?>
                    </div>




            </div>


</body>
</html>