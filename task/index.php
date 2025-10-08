<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once 'head.php'; ?>
</head>

<body>
    <?php
    require_once '/../backend/conn.php';

    require_once '/../backend/taskController.php';

    // Gebruik de functie uit de controller om taken op te halen
    $tasks = getIncompleteTasks();
    ?>

    <?php require_once 'create.php'; ?>
    <div class="container">
        <a href="create.php">Create</a>

    </div>

</body>

</html>
