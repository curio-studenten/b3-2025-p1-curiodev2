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
    $tasks = getIncompleteTasks();
    ?>

    <?php require_once 'create.php'; ?>
    <div class="container">
        <?php require_once 'create.php'; ?>

    </div>

</body>

</html>