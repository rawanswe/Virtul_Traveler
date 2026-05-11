<?php
include "../db_conn.php";

if (isset($_POST['full_name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']); 

    $sql = "INSERT INTO users(full_name, email, password) VALUES('$name', '$email', '$pass')";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../login.php?success=Account created successfully");
    } else {
        header("Location: ../register.php?error=Registration failed");
    }
}
?>