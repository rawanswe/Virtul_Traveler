<?php
// 1. استدعاء ملف الاتصال بالقاعدة
include "../db_conn.php";

// 2. التأكد أن المستخدم ضغط على الزر وأرسل بيانات
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // يفضل تشفيرها لاحقاً ولكن للآن خلّيها كذا

    // 3. كود إضافة البيانات للجدول اللي سويتيه في الصورة
    $sql = "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        // إذا نجح التسجيل يوديه لصفحة اللوجن
        header("Location: ../login.php?success=تم إنشاء الحساب بنجاح");
    } else {
        echo "خطأ في التسجيل: " . mysqli_error($conn);
    }
}
?>