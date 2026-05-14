<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, is_admin) VALUES (?, ?, 0)");
    $stmt->bind_param("ss", $username, $password);
    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        $error = "حدث خطأ أثناء التسجيل";
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>مستخدم جديد</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>تسجيل مستخدم جديد</h2>
<form method="post">
    <label>اسم المستخدم:</label>
    <input type="text" name="username" required><br>
    <label>كلمة السر:</label>
    <input type="password" name="password" required><br>
    <button type="submit">تسجيل</button>
</form>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>