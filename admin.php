
<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    die("غير مسموح بالدخول هنا إلا للمدير.");
}

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->get_result();

$stmt2 = $conn->prepare("SELECT * FROM questions");
$stmt2->execute();
$questions = $stmt