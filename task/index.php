<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once 'head.php'; ?>
</head>

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
    require_once 'notdone.php';
    ?>

    <div class="container">
        <h1>Nieuwe Taak</h1>
        <a href="create.php">Nieuwe Taak &gt;</a>

        <?php if (isset($_GET['msg'])) {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

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
            </div>
        </div>
    </div>

</body>

</html>