<?php 
error_reporting(E_ERROR | E_PARSE); 
include 'includes/header.php'; 
include 'db_conn.php';

if (session_status() === PHP_SESSION_NONE) { session_start(); }

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id']; 
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

$current_user = $user['username'] ?? '';
$current_pass = $user['password'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = mysqli_real_escape_string($conn, $_POST['username']);
    $new_pass = mysqli_real_escape_string($conn, $_POST['password']);
    
    $update_sql = "UPDATE users SET username = '$new_name', password = '$new_pass' WHERE id = '$user_id'";
    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('تم تحديث بياناتك بنجاح ✅'); window.location='index.php';</script>";
    }
}
?>

<style>
    /* تطبيق نفس إعدادات صفحة التواصل لضمان عمل السكرول وعدم وجود فراغات */
    html, body {
        margin: 0;
        padding: 0;
        width: 100%;
        min-height: 100%;
        background: #0f172a;
        overflow-x: hidden;
        overflow-y: auto;
        font-family: 'Tajawal', sans-serif;
    }

    /* نفس خلفية الـ Hero في صفحة التواصل */
    .edit-hero {
        width: 100%;
        min-height: 100vh;
        background-image: linear-gradient(rgba(15, 23, 42, 0.6), rgba(15, 23, 42, 0.6)), 
                        url('https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=1500'); 
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 100px 20px;
        box-sizing: border-box;
    }

    /* نفس الكرت الزجاجي الأنيق */
    .glass-card-edit {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        padding: 40px;
        border-radius: 35px;
        border: 2px solid #c5a059; /* برواز رَحّـالة الذهبي */
        box-shadow: 0 30px 60px rgba(0,0,0,0.4);
        max-width: 500px;
        width: 100%;
        text-align: center;
        animation: slideUp 0.8s ease-out;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .glass-card-edit h2 {
        color: #0f172a;
        font-size: 2rem;
        margin-bottom: 10px;
        font-weight: 800;
    }

    .sub-text {
        color: #64748b;
        margin-bottom: 30px;
        font-size: 1rem;
        font-weight: 500;
    }

    /* تنسيق الحقول المطابق تماماً */
    .input-group {
        margin-bottom: 20px;
        text-align: right;
    }

    .input-group label {
        display: block;
        margin-bottom: 8px;
        color: #0f172a;
        font-weight: 800;
        font-size: 0.9rem;
    }

    .input-group input {
        width: 100%;
        padding: 14px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        font-size: 1rem;
        outline: none;
        font-family: 'Tajawal', sans-serif;
        transition: 0.3s;
        background: #f8fafc;
    }

    .input-group input:focus {
        border-color: #c5a059;
        background: white;
        box-shadow: 0 0 10px rgba(197, 160, 89, 0.15);
    }

    /* زر الحفظ بنفس تنسيق زر الإرسال */
    .save-btn {
        width: 100%;
        padding: 16px;
        background: #c5a059;
        color: #0f172a;
        border: none;
        border-radius: 15px;
        font-size: 1.2rem;
        font-weight: 800;
        cursor: pointer;
        transition: 0.4s;
        box-shadow: 0 8px 20px rgba(197, 160, 89, 0.2);
    }

    .save-btn:hover {
        background: #0f172a;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(15, 23, 42, 0.3);
    }
    
    .cancel-link {
        display: block;
        margin-top: 20px;
        color: #64748b;
        text-decoration: none;
        font-weight: 600;
    }
    .cancel-link:hover { color: #c5a059; }
</style>

<div class="edit-hero">
    <div class="glass-card-edit">
        <h2>تعديل الملف الشخصي</h2>
        <p class="sub-text">بإمكانكِ هنا تحديث اسم المستخدم الخاص بكِ وكلمة المرور في رَحّـالة.</p>

        <form method="POST">
            <div class="input-group">
                <label>اسم المستخدم الجديد</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($current_user); ?>" required>
            </div>

            <div class="input-group">
                <label>كلمة المرور الجديدة</label>
                <input type="password" name="password" value="<?php echo htmlspecialchars($current_pass); ?>" required>
            </div>

            <button type="submit" class="save-btn">حفظ التعديلات</button>
            <a href="index.php" class="cancel-link">إلغاء والعودة للرئيسية</a>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>