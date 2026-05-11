<?php
session_start();
include '../db_conn.php'; // تأكدي أن مسار ملف الاتصال صحيح

if (isset($_POST['email']) && isset($_POST['password'])) {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($email) || empty($password)) {
        header("Location: ../login.php?error=empty");
        exit();
    } else {
        // استعلام للتأكد من المستخدم
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            
            // تخزين بيانات المستخدم في الجلسة
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['full_name'] = $row['full_name'];
            $_SESSION['email'] = $row['email'];

            // --- التعديل الجوهري هنا ---
            // التوجيه إلى الصفحة الرئيسية (index.php) بدلاً من الخريطة
            header("Location: ../index.php"); 
            exit();
        } else {
            header("Location: ../login.php?error=wrong");
            exit();
        }
    }
} else {
    header("Location: ../login.php");
    exit();
}