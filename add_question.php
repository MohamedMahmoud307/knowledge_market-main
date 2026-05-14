<?php
session_start(); // نبدأ الجلسة
require_once 'db.php';

$message = "";

// نجيب رقم المستخدم من الـ session
$user_id = $_SESSION['user_id'] ?? null;

// لو المستخدم مش عامل تسجيل دخول
if (!$user_id) {
    die("يجب تسجيل الدخول أولًا.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = trim($_POST['question'] ?? '');

    if ($question === '') {
        $message = "من فضلك اكتب السؤال.";
    } else {
        $stmt = $conn->prepare("INSERT INTO questions (user_id, question) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $question);
        if ($stmt->execute()) {
            $message = "تم إضافة السؤال بنجاح.";
        } else {
            $message = "حدث خطأ أثناء إضافة السؤال.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>إضافة سؤال</title>
<style>
body { font-family: Tahoma, Arial; margin: 30px; direction: rtl; }
form { max-width: 400px; margin: 0 auto; display: grid; gap: 12px; }
textarea { min-height: 100px; padding: 8px; }
button { padding: 10px; cursor: pointer; }
.message { margin: 10px auto; max-width: 400px; color: #333; }
</style>
</head>
<body>
<h2>إضافة سؤال</h2>
<?php if ($message): ?>
<div class="message"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>
<form method="post">
    <label>السؤال:
        <textarea name="question" required></textarea>
    </label>
    <button type="submit">إضافة</button>
</form>
</body>
</html>