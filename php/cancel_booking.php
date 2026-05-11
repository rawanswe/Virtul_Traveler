<?php
session_start();
include "../db_conn.php";

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $booking_id = mysqli_real_escape_string($conn, $_GET['id']);
    $user_id = $_SESSION['user_id'];
    
    // الأفضل إضافة user_id للأمان عشان ما أحد يحذف حجز غيره
    $sql = "DELETE FROM bookings WHERE id = '$booking_id' AND user_id = '$user_id'";
    
    if (mysqli_query($conn, $sql)) {
        // غيرناها إلى success عشان تظهر في الكود اللي حطيناه بصفحة حجوزاتي
        header("Location: ../my_bookings.php?success=تم إلغاء حجزك بنجاح");
        exit();
    } else {
        header("Location: ../my_bookings.php?error=فشل الإلغاء: " . mysqli_error($conn));
        exit();
    }
} else {
    header("Location: ../my_bookings.php");
    exit();
}
?>