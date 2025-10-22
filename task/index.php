<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once 'head.php'; ?>
</head>

<<<<<<< HEAD
<body>
    <?php require_once __DIR__ . '/../backend/taskController.php';

=======
<!-- <body>
    <section class="board" aria-label="Tasks board">
      <section class="column" aria-labelledby="todo-heading">
        <h2 id="todo-heading">To Do <span class="count"></span></h2>
        <ul class="task-list" aria-describedby="todo-heading">
          <li class="task"></li>
          <li class="task"></li>
          <li class="task"></li>
        </ul>
      </section> -->


    <?php
    require_once __DIR__ . '/../backend/taskController.php';
>>>>>>> bd917693d4308d9716667d75aae0612031bd8a4a
    require_once 'notdone.php';
    ?>

    <div class="container">
        <div class="header">
            <h1>Nieuwe Taak</h1>
            <a href="create.php" class="btn-new-task">+ Nieuwe Taak</a>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <div class='msg'><?php echo htmlspecialchars($_GET['msg']); ?></div>
        <?php endif; ?>

<<<<<<< HEAD
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
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
=======
        <?php
        require_once __DIR__ . '/../backend/taskController.php';
        $tasksByStatus = getTasksByStatus();
        ?>

        <div class="cards">
            <!-- To Do Card -->
            <div class="card">
                <h2>To Do</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Department</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasksByStatus['todo'] as $task): ?>
                            <tr>
                                <td><?= $task['id'] ?></td>
                                <td><?= $task['titel'] ?></td>
                                <td><?= $task['beschrijving'] ?></td>
                                <td><?= $task['afdeling'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- In Progress Card -->
            <div class="card">
                <h2>In Progress</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Department</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasksByStatus['in-progress'] as $task): ?>
                            <tr>
                                <td><?= $task['id'] ?></td>
                                <td><?= $task['titel'] ?></td>
                                <td><?= $task['beschrijving'] ?></td>
                                <td><?= $task['afdeling'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Done Card -->
            <div class="card">
                <h2>Done</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Department</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasksByStatus['done'] as $task): ?>
                            <tr>
                                <td><?= $task['id'] ?></td>
                                <td><?= $task['titel'] ?></td>
                                <td><?= $task['beschrijving'] ?></td>
                                <td><?= $task['afdeling'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
>>>>>>> bd917693d4308d9716667d75aae0612031bd8a4a
            </div>
        </div>
    </div>

</body>

</html>