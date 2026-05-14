<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM questions WHERE user_id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>ملفي الشخصي</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
  <h2>مرحباً يا <?php echo $_SESSION['username']; ?> 👋</h2>
</header>

<nav>
  <a href="index.php">الرئيسية</a>
  <a href="top_questions.php">أكثر الأسئلة تصويتًا</a>
  <?php if($_SESSION['is_admin'] == 1): ?>
    <a href="admin.php">لوحة المدير</a>
  <?php endif; ?>
  <a href="logout.php">تسجيل خروج</a>
</nav>

<table>
<tr>
    <th>رقم</th>
    <th>السؤال</th>
    <th>تاريخ الإضافة</th>
    <th>تصويت إيجابي 👍</th>
    <th>تصويت سلبي 👎</th>
    <th>إجراءات</th>
</tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo htmlspecialchars($row['question']); ?></td>
    <td><?php echo $row['created_at']; ?></td>
    <td><?php echo $row['votes']; ?></td>
    <td><?php echo $row['downvotes']; ?></td>
    <td>
        <a href="vote.php?id=<?php echo $row['id']; ?>&type=up">👍</a>
        <a href="vote.php?id=<?php echo $row['id']; ?>&type=down">👎</a>
        <a href="edit_question.php?id=<?php echo $row['id']; ?>">تعديل</a>
        <a href="delete_question.php?id=<?php echo $row['id']; ?>">حذف</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>