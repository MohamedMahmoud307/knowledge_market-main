<?php
$servername = "localhost";
$username = "root";
$password = ""; // كلمة السر فاضية لو أنت ما غيرتهاش
$dbname = "knowledge_market";

// الاتصال بالطريقة التقليدية بدون أسماء المتغيرات
$conn = new mysqli($servername, $username, $password, $dbname, 3306);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// تعيين الترميز
$conn->set_charset("utf8mb4");
?>