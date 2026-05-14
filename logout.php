<?php
session_start(); // نبدأ الجلسة

// نمسح كل بيانات الجلسة
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>تسجيل الخروج</title>
</head>
<body>
<h2>تم تسجيل الخروج بنجاح</h2>
<p><a href="login.php">اضغط هنا للعودة لصفحة تسجيل الدخول</a></p>
</body>
</html>