<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

require_once __DIR__ . '/conn.php';
$query = "SELECT * FROM users WHERE username = :username";
$statement = $conn->prepare($query);
$statement->execute([":username" => $username]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if ($statement->rowCount() < 1) {
    header("Location: ../task/login.php?error=" . urlencode("Account bestaat niet"));
    exit();
}

if (!password_verify($password, $user['password'])) {
    header("Location: ../task/login.php?error=" . urlencode("Wachtwoord is niet juist"));
    exit();
}

$_SESSION['user_id'] = $user['id'];
header("Location: ../task/index.php?msg=Ingelogd");
exit();
?>