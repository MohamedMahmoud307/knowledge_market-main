<?php
session_start();
require_once 'db.php';

$user_id = $_SESSION['user_id'] ?? null;
$id = $_GET['id'] ?? null;

if (!$user_id) {
    die("يجب تسجيل الدخول أولًا.");
}

if (!$id) {
    die("لم يتم تحديد السؤال.");
}

// حذف السؤال من قاعدة البيانات
$stmt = $conn->prepare("DELETE FROM questions WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);
if ($stmt->execute()) {
    header("Location: profile.php");
    exit;
} else {
    echo "حدث خطأ أثناء الحذف.";
}
?>