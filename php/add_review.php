<?php
session_start();
include "../db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // استلام البيانات وتأمينها
    $country = mysqli_real_escape_string($conn, $_POST['review_country']);
    $speed   = mysqli_real_escape_string($conn, $_POST['speed']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    // تنسيق التعليق ليظهر بشكل احترافي
    $full_comment = "⭐ الاستجابة: " . $speed . " | الملاحظة: " . $comment;

    // إدخال البيانات في جدول التقييمات
    $sql = "INSERT INTO reviews (user_id, country, comment) VALUES ('$user_id', '$country', '$full_comment')";

    if (mysqli_query($conn, $sql)) {
        // نستخدم success لكي تظهر الرسالة الخضراء في صفحة حجوزاتي
        header("Location: ../my_bookings.php?success=شكراً لتقييمك! رأيك يهمنا جداً");
        exit();
    } else {
        // في حال وجود خطأ في قاعدة البيانات
        header("Location: ../my_bookings.php?error=عذراً، فشل إرسال التقييم");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>