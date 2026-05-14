<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>الصفحة الرئيسية</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <h2>📚 منصة الأسئلة والتصويت</h2>
</header>

<nav>
  <a href="index.php">الرئيسية</a>
  <a href="top_questions.php">أكثر الأسئلة تصويتًا</a>
  <?php if (isset($_SESSION['user_id'])): ?>
    <a href="profile.php">ملفي الشخصي</a>
    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
      <a href="admin.php">لوحة المدير</a>
    <?php endif; ?>
    <a href="logout.php">تسجيل خروج</a>
  <?php else: ?>
    <a href="login.php">تسجيل دخول</a>
    <a href="register.php">مستخدم جديد</a>
  <?php endif; ?>
</nav>

<div style="text-align:center; margin-top:30px;">
  <p>مرحباً بك في منصتنا! هنا يمكنك إضافة أسئلتك، التصويت عليها، ومشاركة المعرفة مع الآخرين.</p>
</div>

</body>
</html>