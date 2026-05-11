<?php include 'includes/header.php'; ?>

<style>
    /* 1. إعدادات الصفحة الأساسية لضمان عمل السكرول */
    html, body {
        margin: 0;
        padding: 0;
        width: 100%;
        min-height: 100%;
        background: #0f172a; /* لون الخلفية الأساسي */
        overflow-x: hidden;
        overflow-y: auto; /* تفعيل التمرير */
        font-family: 'Tajawal', sans-serif;
    }

    /* 2. الخلفية الكبيرة التي تغطي كامل الشاشة */
    .contact-hero {
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
        padding: 100px 20px; /* مساحة للنافبار وللراحة البصرية */
        box-sizing: border-box;
    }

    /* 3. تصميم الكرت الزجاجي الأنيق */
    .glass-card-small {
        background: rgba(255, 255, 255, 0.95); /* شفافية بسيطة جداً ليبقى النص واضحاً */
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

    .glass-card-small h2 {
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

    /* 4. تنسيق الحقول */
    .input-group {
        margin-bottom: 20px;
        text-align: right; /* محاذاة العناوين لليمين */
    }

    .input-group label {
        display: block;
        margin-bottom: 8px;
        color: #0f172a;
        font-weight: 800;
        font-size: 0.9rem;
    }

    .input-group input, .input-group textarea {
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

    .input-group input:focus, .input-group textarea:focus {
        border-color: #c5a059;
        background: white;
        box-shadow: 0 0 10px rgba(197, 160, 89, 0.15);
    }

    /* 5. زر الإرسال */
    .send-btn {
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

    .send-btn:hover {
        background: #0f172a;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(15, 23, 42, 0.3);
    }

    /* تنبيه النجاح */
    .alert-success {
        background: rgba(16, 185, 129, 0.15);
        color: #059669;
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-weight: bold;
        border: 1px solid #059669;
    }
</style>

<div class="contact-hero">
    <div class="glass-card-small">
        <h2>تواصل معنا</h2>
        <p class="sub-text">نحن هنا للإجابة على استفساراتكم وتنسيق رحلاتكم الملكية.</p>

        <?php if(isset($_GET['success'])): ?>
            <div class="alert-success">✅ تم إرسال رسالتك بنجاح يا روان!</div>
        <?php endif; ?>

        <form action="php/send_message.php" method="POST">
            <div class="input-group">
                <label>الاسم الكامل</label>
                <input type="text" name="name" value="<?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : ''; ?>" placeholder="اسمكم الكريم" required>
            </div>

            <div class="input-group">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" placeholder="example@mail.com" required>
            </div>

            <div class="input-group">
                <label>كيف يمكننا مساعدتك؟</label>
                <textarea name="message" rows="4" placeholder="اكتبي استفسارك هنا..." required></textarea>
            </div>

            <button type="submit" class="send-btn">إرسال الرسالة</button>
        </form>
    </div>
</div>
<script>
document.querySelector('form').addEventListener('submit', function(e) {
    let name = document.querySelector('input[name="name"]').value;
    let email = document.querySelector('input[name="email"]').value;
    let message = document.querySelector('textarea[name="message"]').value;

    if (name.length < 3) {
        alert("يرجى إدخال اسم صحيح (أكثر من 3 حروف)");
        e.preventDefault(); // منع إرسال النموذج
        return;
    }

    if (!email.includes('@')) {
        alert("يرجى إدخال بريد إلكتروني صحيح يحتوي على @");
        e.preventDefault();
        return;
    }

    if (message.length < 10) {
        alert("الرسالة قصيرة جداً، يرجى كتابة تفاصيل أكثر");
        e.preventDefault();
        return;
    }
    
    alert("شكرًا لكِ يا " + name + "! يتم الآن إرسال استفسارك...");
});
</script>
<?php include 'includes/footer.php'; ?>

</body>
</html>