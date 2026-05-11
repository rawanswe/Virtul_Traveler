<?php
session_start(); // بدء الجلسة للتمكن من إنقائها
session_unset(); // مسح جميع البيانات المخزنة في الجلسة
session_destroy(); // تدمير الجلسة نهائياً

// التوجه لصفحة تسجيل الدخول بعد الخروج
header("Location: login.php");
exit();
?>