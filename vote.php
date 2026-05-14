<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$type = $_GET['type'] ?? 'up';

if ($id <= 0 || !in_array($type, ['up', 'down'])) {
    die("طلب غير صالح.");
}

// التحقق هل المستخدم صوّت قبل كده
$check = $conn->prepare("SELECT id FROM votes_log WHERE user_id = ? AND question_id = ?");
$check->bind_param("ii", $user_id, $id);
$check->execute();
$check_result = $check->get_result();

if ($check_result->num_rows > 0) {
    // المستخدم صوّت قبل كده
    echo "<script>alert('لقد قمت بالتصويت على هذا السؤال من قبل!'); window.location='profile.php';</script>";
    exit;
}

// لو أول مرة يصوّت
if ($type === 'up') {
    $stmt = $conn->prepare("UPDATE questions SET votes = votes + 1 WHERE id = ?");
} else {
    $stmt = $conn->prepare("UPDATE questions SET downvotes = downvotes + 1 WHERE id = ?");
}
$stmt->bind_param("i", $id);
$stmt->execute();

// تسجيل التصويت في جدول votes_log
$log = $conn->prepare("INSERT INTO votes_log (user_id, question_id) VALUES (?, ?)");
$log->bind_param("ii", $user_id, $id);
$log->execute();

header("Location: profile.php");
exit;