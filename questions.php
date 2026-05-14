<?php
require_once 'db.php';

// نجيب كل الأسئلة من جدول questions
$result = $conn->query("
    SELECT q.id, u.username, q.question, q.created_at
    FROM questions q
    JOIN users u ON q.user_id = u.id
    ORDER BY q.created_at DESC
");
?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>عرض الأسئلة</title>
<style>
body { font-family: Tahoma, Arial; margin: 30px; direction: rtl; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { border: 1px solid #ccc; padding: 10px; text-align: right; }
th { background-color: #f0f0f0; }
</style>
</head>
<body>
<h2>كل الأسئلة المضافة</h2>
<table>
    <tr>
        <th>رقم</th>
        <th>اسم المستخدم</th>
        <th>السؤال</th>
        <th>تاريخ الإضافة</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['username']); ?></td>
        <td><?php echo htmlspecialchars($row['question']); ?></td>
        <td><?php echo $row['created_at']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>