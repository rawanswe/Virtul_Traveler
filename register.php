<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إنشاء حساب | رحالة</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login-style.css">
</head>
<body>
    <div class="login-container">
        <form class="login-form" action="php/register_process.php" method="POST">
            <h2>انضم لـ رَحّالة</h2>
            <p>أنشئ حسابك وابدأ برحلتك اليوم</p>
            
            <div class="input-group">
                <label>الاسم الكامل</label>
                <input type="text" name="full_name" placeholder="أدخل اسمك" required>
            </div>

            <div class="input-group">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" placeholder="example@mail.com" required>
            </div>

            <div class="input-group">
                <label>كلمة المرور</label>
                <input type="password" name="password" placeholder="********" required>
            </div>

            <button type="submit" class="login-btn">تأكيد التسجيل</button>
            
            <div class="form-footer">
                <span>لديك حساب بالفعل؟ <a href="login.php">انشاء حساب جديد </a></span>
            </div>
        </form>
    </div>
</body>
</html>