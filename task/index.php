<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once 'head.php'; ?>
</head>

<body>

    <?php
    require_once __DIR__ . '/../backend/taskController.php';
    // require_once 'notdone.php';
    ?>

    <div class="main-flex">
        <nav class="sidebar">
            <h2>Taak Overzicht</h2>
            <ul class="sidebar-list">
                <?php
                    $tasksByStatus = getTasksByStatus();
                    $hasTasks = false;
                    foreach (['todo', 'in-progress', 'done'] as $status) {
                        foreach ($tasksByStatus[$status] as $taak) {
                            $hasTasks = true;
                            $statusClass = $status . '-header';
                            echo '<li class="sidebar-task">'
                                . '<span class="sidebar-title">' . $taak['titel'] . '</span> '
                                . '<span class="' . $statusClass . ' sidebar-status">' . $taak['status'] . '</span>'
                                . '</li>';
                        }
                    }
                    if (!$hasTasks) {
                        echo '<li>Geen taken gevonden.</li>';
                    }
                ?>
            </ul>
        </nav>
            <div class="main-content">
        <div class="header">
            <h1>Taak Verdeling</h1>
            <a href="create.php" class="btn-new-task">+ Nieuwe Taak</a>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <div class='msg'><?php echo htmlspecialchars($_GET['msg']); ?></div>
        <?php endif; ?>

        <div class="kanban-board">
            <!-- TO DO Column -->
            <div class="kanban-column">
                <h2 class="column-header todo-header">To Do</h2>
                <div class="tasks-container">
                    <?php
                    if (isset($taken) && count($taken) > 0) {
                        foreach ($taken as $taak) {
                            if ($taak['status'] == 'todo') {
                                ?>
                                <div class="task-card">
                                    <h3><?php echo $taak['titel']; ?></h3>
                                    <p><?php echo $taak['beschrijving']; ?></p>
                                    <span class="afdeling"><?php echo $taak['afdeling']; ?></span>
                                    <a href="edit.php?id=<?php echo $taak['id']; ?>">✏️ Aanpassen</a>
                                    <button class="delete-btn" data-id="<?php echo $taak['id']; ?>">🗑️ Verwijderen</button>
                                </div>
                                
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- DOING Column -->
            <div class="kanban-column">
                <h2 class="column-header doing-header">Doing</h2>
                <div class="tasks-container">
                    <?php
                    if (isset($taken) && count($taken) > 0) {
                        foreach ($taken as $taak) {
                            if ($taak['status'] == 'in-progress') {
                                ?>
                                <div class="task-card">
                                    <h3><?php echo $taak['titel']; ?></h3>
                                    <p><?php echo $taak['beschrijving']; ?></p>
                                    <span class="afdeling"><?php echo $taak['afdeling']; ?></span>
                                    <a href="edit.php?id=<?php echo $taak['id']; ?>">✏️ Aanpassen</a>
                                    <button class="delete-btn" data-id="<?php echo $taak['id']; ?>">🗑️ Verwijderen</button>
                                </div>
                                
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- DONE Column -->
            <div class="kanban-column">
                <h2 class="column-header done-header">Done</h2>
                <div class="tasks-container">
                    <?php
                    if (isset($taken) && count($taken) > 0) {
                        foreach ($taken as $taak) {
                            if ($taak['status'] == 'done') {
                                ?>
                                <div class="task-card">
                                    <h3><?php echo $taak['titel']; ?></h3>
                                    <p><?php echo $taak['beschrijving']; ?></p>
                                    <span class="afdeling"><?php echo $taak['afdeling']; ?></span>
                                    <a href="edit.php?id=<?php echo $taak['id']; ?>">✏️ Aanpassen</a>
                                    <button class="delete-btn" data-id="<?php echo $taak['id']; ?>">🗑️ Verwijderen</button>
                                </div>
                                
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        </div>
    </div>

</body>

</html>