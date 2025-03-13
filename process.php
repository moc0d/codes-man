<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "codemandb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// جمع البيانات من النموذج
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// استخدام Prepared Statements
$stmt = $conn->prepare("INSERT INTO message (name, email, subject, text) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $subject, $message);

if ($stmt->execute()) {
    echo "تم إرسال الرسالة بنجاح!";
} else {
    echo "حدث خطأ: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
