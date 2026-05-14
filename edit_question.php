<?php
session_start();
require_once 'db.php';

$user_id = $_SESSION['user_id'] ?? null;
$id = $_GET['id'] ?? null;

if (!$user_id) die("يجب تسجيل الدخول أولًا.");
if (!$id) die("لم يتم تحديد السؤال.");

// جلب السؤال الحالي
$stmt = $conn->prepare("SELECT question FROM questions WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) die("السؤال غير موجود أو ليس لك.");

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_question = trim($_POST['question']);
    $update = $conn->prepare("UPDATE questions SET question = ? WHERE id = ? AND user_id = ?");
    $update->bind_param("sii", $new_question, $id, $user_id);
    if ($update->execute()) $message = "تم تعديل السؤال بنجاح.";
}
?>
<form method="post">
    <textarea name="question"><?php echo htmlspecialchars($row['question']); ?></textarea><br>
    <button type="submit">حفظ التعديل</button>
</form>
<?php echo $message; ?>