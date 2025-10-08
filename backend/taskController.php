<?php

//Variabelen vullen
$action = $_POST['action'];
$id = $_POST['id'];
$title = $_POST['title'];
if (empty($title)) {
    $errors[] = "Vul de title in.";
}
$beschrijving= $_POST['beschrijving'];
if (empty($title)) {
    $errors[] = "Vul de beschrijving in.";
}
$afdeling= $_POST['afdeling'];
if (empty($title)) {
    $errors[] = "Vul de afdeling in.";
}
$status= $_POST['status'];
$deadline =$_POST['deadline'];
$user = $_POST['user'];
$created_at	= $_POST['created_at'];

//1. Verbinding
require_once '../../../backend/conn.php';



//2. Query
$query = "INSERT INTO taken (id, title, beschrijving, afdeling, status, deadline, user, created_at)
VALUES (:id, :title, :beschrijving, :afdeling, :status, :deadline, :user, :created_at)"

//3. Prepare
?>