<?php
session_start();
include "../db_conn.php"; // التأكد من استدعاء ملف الاتصال

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    // إدخال البيانات في جدول contact_messages
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {
        // العودة لصفحة اتصل بنا مع رسالة نجاح
        header("Location: ../contact.php?success=1");
        exit();
    } else {
        echo "خطأ في قاعدة البيانات: " . mysqli_error($conn);
    }
} else {
    header("Location: ../contact.php");
    exit();
}
?>