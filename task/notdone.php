<?php require_once __DIR__ . '/../backend/taskController.php';
    $tasksByStatus = getTasksByStatus();
    $incompleteTasks = array_merge($tasksByStatus['todo'], $tasksByStatus['in-progress']);
    ?>

    <div class="container">
        <h1>Not Completed Tasks</h1>


        <h2>Not Completed Tasks</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Department</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($incompleteTasks)): ?>
                    <?php foreach ($incompleteTasks as $task): ?>
                        <tr>
                            <td><?= $task['id'] ?></td>
                            <td><?= $task['titel'] ?></td>
                            <td><?= $task['beschrijving'] ?></td>
                            <td><?= $task['afdeling'] ?></td>
                            <td><?= $task['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No tasks found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- <section class="board" aria-label="Tasks board">
            <section class="column" aria-labelledby="todo-heading">
                <h2 id="todo-heading">To Do <span class="count"></span></h2>
                <ul class="task-list" aria-describedby="todo-heading">
                    <?php if (!empty($incompleteTasks)): ?>
                        <?php foreach ($incompleteTasks as $task): ?>
                            <li class="task">
                                <strong><?= $task['titel'] ?></strong>: <?= $task['beschrijving'] ?> (<?= $task['afdeling'] ?>)
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="task">No tasks found.</li>
                    <?php endif; ?>
                </ul>
            </section>
        </section> -->
    </div>