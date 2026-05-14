<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['is_admin'] = (int)$row['is_admin'];
        header("Location: profile.php");
        exit;
    } else {
        $error = "اسم المستخدم أو كلمة السر غير صحيحة";
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>تسجيل الدخول</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>تسجيل الدخول</h2>
<form method="post">
    <label>اسم المستخدم:</label>
    <input type="text" name="username" required><br>
    <label>كلمة السر:</label>
    <input type="password" name="password" required><br>
    <button type="submit">دخول</button>
</form>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>