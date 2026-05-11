<?php
session_start();
include "../db_conn.php";

if (isset($_POST['trip_name']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // استلام البيانات من الخريطة
    $trip_name = mysqli_real_escape_string($conn, $_POST['trip_name']);
    
    // استلام التاريخ والوقت اللي حددتيهم في المودال
    $booking_date = mysqli_real_escape_string($conn, $_POST['booking_date']);
    $booking_time = isset($_POST['booking_time']) ? mysqli_real_escape_string($conn, $_POST['booking_time']) : "00:00:00";

    /* تعديل سطر الـ SQL:
       غيرنا trip_name إلى country لأن هذا هو المسبب للـ Fatal Error
    */
    $sql = "INSERT INTO bookings (user_id, country, booking_date, booking_time) 
            VALUES ('$user_id', '$trip_name', '$booking_date', '$booking_time')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../my_bookings.php?success=تم الحجز بنجاح!");
        exit();
    } else {
        // في حال وجود خطأ في الأعمدة سيظهر لك التنبيه هنا
        die("خطأ في تنفيذ الطلب: " . mysqli_error($conn));
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>