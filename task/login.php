<?php
session_start();
require_once __DIR__ . '/../backend/config.php';
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
$msg = isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : '';
?>
<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once '../head.php'; ?>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_GET['msg'])) {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        }
        ?>

        <form action="../backend/loginController.php" method="POST">
            <div class="form-group">
                <label for="username">Gebruikersnaam:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>

</body>

</html>