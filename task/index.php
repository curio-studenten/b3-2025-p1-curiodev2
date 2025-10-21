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

    <div class="container">
        <h1>Nieuwe Taak</h1>
        <a href="create.php">Nieuwe Taak &gt;</a>

        <div>
            <table>
                <tr>
                    <th>Titel</th>
                    <th>Beschrijving</th>
                    <th>Afdeling</th>
                    <th>Status</th>
                </tr>
                <?php 
                    // Check if $taken exists and has data
                    if (isset($taken) && count($taken) > 0): 
                        foreach ($taken as $taak);
                ?>
                    <tr>
                        <td><?php echo $taak['titel']; ?></td>
                        <td><?php echo $taak['beschrijving']; ?></td>
                        <td><?php echo $taak['afdeling']; ?></td>
                        <td><?php echo $taak['status']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $melding['id']; ?>">✏️ Aanpassen</a>
                        </td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>

</body>

</html>