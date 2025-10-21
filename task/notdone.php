    <?php $incompleteTasks = getIncompleteTasks();
    ?>

    <div class="container">
        <h1>Tasks</h1>

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
                <?php foreach ($incompleteTasks as $task): ?>
                    <tr>
                        <td><?= $task['id'] ?></td>
                        <td><?= $task['titel'] ?></td>
                        <td><?= $task['beschrijving'] ?></td>
                        <td><?= $task['afdeling'] ?></td>
                        <td><?= $task['status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>