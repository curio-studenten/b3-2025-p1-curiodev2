<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once 'head.php'; ?>
</head>

<body>
    <?php
    // require_once __DIR__ . '/../backend/taskController.php';

    // Gebruik de functie uit de controller om taken op te halen
    //$tasks = getIncompleteTasks();
    ?>

    <div class="container">
        <h1>Nieuwe Taak</h1>
        <a href="create.php">Nieuwe Taak &gt;</a>

        <?php if (isset($_GET['msg'])) {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>


    </div>

</body>

</html>