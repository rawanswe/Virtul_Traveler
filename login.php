<?php 
session_start(); 

// --- التعديل الجديد هنا ---
// إذا كان المستخدم مسجل دخول فعلياً، ليش نخليه يشوف صفحة الدخول؟ نحوله للرئيسية فوراً
if(isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}
// -------------------------

$message = "";
if(isset($_GET['error'])){
    if($_GET['error'] == "wrong") $message = "بيانات الدخول غير صحيحة!";
    if($_GET['error'] == "empty") $message = "لطفاً، املأ جميع الخانات!";
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول | رحالة</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login-style.css">
    <style>
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 14px;
            text-align: center;
        }
        .alert-danger {
            background: rgba(231, 76, 60, 0.15);
            color: #e74c3c;
            border: 1px solid #e74c3c;
        }
        .alert-success {
            background: rgba(46, 204, 113, 0.15);
            color: #2ecc71;
            border: 1px solid #2ecc71;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form class="login-form" id="loginForm" action="php/login_process.php" method="POST" onsubmit="return validateLogin(event)">
            <h2>رَحّــالة</h2>
            <p>سجل دخولك لاستكشاف أجمل وجهات العالم</p>

            <?php if(isset($_SESSION['success_msg'])): ?>
                <div class="alert alert-success">
                    ✨ <?php 
                        echo $_SESSION['success_msg']; 
                        unset($_SESSION['success_msg']); 
                    ?>
                </div>
            <?php endif; ?>

            <?php if($message != ""): ?>
                <div class="alert alert-danger"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <div class="input-group">
                <label>البريد الإلكتروني</label>
                <input type="email" id="email" name="email" placeholder="example@mail.com" required autocomplete="off">
            </div>

            <div class="input-group">
                <label>كلمة المرور</label>
                <input type="password" id="password" name="password" placeholder="********" required>
            </div>

            <button type="submit" class="login-btn">دخول</button>
            
            <div class="form-footer">
                <span>ليس لديك حساب؟ <a href="register.php">إنشاء حساب جديد</a></span>
            </div>
        </form>
    </div>

    <script>
        function validateLogin(event) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();

            if (email === "" || password === "") {
                alert("لطفاً، املأ جميع الخانات!");
                return false;
            }
            return true; 
        }
    </script>
</body>
</html>