<?php
session_start();

// Check of gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['msg']) || isset($_GET['error'])) {
    header("Refresh: 3; url=" . strtok($_SERVER["REQUEST_URI"], '?'));
}
?>

<!doctype html>
<html lang="nl">

<head>
    <title>Mijn Taken</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <?php
    require_once __DIR__ . '/../backend/conn.php';

    // Haal alleen taken van de ingelogde gebruiker op
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM taken WHERE user = :user_id ORDER BY deadline ASC, id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':user_id' => $user_id]);
    $taken = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="main-content">
        <div class="header">
            <img src="../img/logo-big-v4.png" alt="logo">
            <h1>Mijn Taken</h1>
            <div class="links">
                <a href="index.php">← Alle Taken</a>
                <a href="create.php">+ Nieuwe Taak</a>
                <a href="afdeling.php">Done Taken</a>
                <a href="logout.php">Uitloggen</a>
            </div>
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
                                    <h3><?php echo htmlspecialchars($taak['titel']); ?></h3>
                                    <p><?php echo htmlspecialchars($taak['beschrijving']); ?></p>
                                    <span class="afdeling"><?php echo htmlspecialchars($taak['afdeling']); ?></span>
                                    <?php if (!empty($taak['deadline'])) {
                                        $display = date('d-m', strtotime($taak['deadline'])); ?>
                                        <span class="task-date">Deadline: <?php echo $display; ?></span>
                                    <?php } ?>
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
                                    <h3><?php echo htmlspecialchars($taak['titel']); ?></h3>
                                    <p><?php echo htmlspecialchars($taak['beschrijving']); ?></p>
                                    <span class="afdeling"><?php echo htmlspecialchars($taak['afdeling']); ?></span>
                                    <?php if (!empty($taak['deadline'])) {
                                        $display = date('d-m', strtotime($taak['deadline'])); ?>
                                        <span class="task-date">Deadline: <?php echo $display; ?></span>
                                    <?php } ?>
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
                                    <h3><?php echo htmlspecialchars($taak['titel']); ?></h3>
                                    <p><?php echo htmlspecialchars($taak['beschrijving']); ?></p>
                                    <span class="afdeling"><?php echo htmlspecialchars($taak['afdeling']); ?></span>
                                    <?php if (!empty($taak['deadline'])) {
                                        $display = date('d-m', strtotime($taak['deadline'])); ?>
                                        <span class="task-date">Deadline: <?php echo $display; ?></span>
                                    <?php } ?>
                                    <a href="edit.php?id=<?php echo $taak['id']; ?>">✏️ Aanpassen</a>
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

</body>

</html>