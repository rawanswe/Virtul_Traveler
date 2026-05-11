<?php
// إعدادات الاتصال بالسيرفر المحلي
$sname = "localhost";
$unmae = "root";  // المستخدم الافتراضي
$password = "";   // لا توجد كلمة مرور افتراضية في XAMPP
$db_name = "rahala_db"; // اسم القاعدة اللي ظهرت في صورتك السابقة

// تنفيذ عملية الاتصال
$conn = mysqli_connect($sname, $unmae, $password, $db_name);

// التأكد من نجاح الاتصال
if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}
?>