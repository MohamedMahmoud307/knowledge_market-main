<?php
session_start();
require_once 'db.php';

$stmt = $conn->prepare("SELECT * FROM questions ORDER BY votes DESC LIMIT 20");
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>أكثر الأسئلة تصويتًا</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
  <h2>📊 أكثر الأسئلة تصويتًا</h2>
</header>

<nav>
  <a href="index.php">الرئيسية</a>
  <a href="profile.php">ملفي الشخصي</a>
  <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
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
</tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo htmlspecialchars($row['question']); ?></td>
    <td><?php echo $row['created_at']; ?></td>
    <td><?php echo $row['votes']; ?></td>
    <td><?php echo $row['downvotes']; ?></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>