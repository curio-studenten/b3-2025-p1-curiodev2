<?php
session_start();
require_once __DIR__ . '/../backend/config.php';
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once '../head.php'; ?>
</head>

<body>
    <div class="container">
        <?php if (isset($_GET['msg'])): ?>
            <div class='msg'><?php echo htmlspecialchars($_GET['msg']); ?></div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class='msg'><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        <div class="form">
            <form action="../backend/loginController.php" method="POST" class="login-form">
                <h1>Inloggen</h1>
                <div class="form-group">
                    <label for="username">Gebruikersnaam:</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Wachtwoord:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <input type="submit" value="login">
            </form>
        </div>
    </div>

</body>

</html>