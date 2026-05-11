<style>
    .main-footer {
        background: #0f172a; /* الكحلي الرسمي لمشروعك */
        color: white;
        padding: 30px 20px;
        text-align: center;
        border-top: 1px solid rgba(197, 160, 89, 0.3);
        margin-top: 50px;
    }
    .footer-links a {
        color: #c5a059;
        text-decoration: none;
        margin: 0 15px;
        font-size: 0.9rem;
    }
    .footer-links a:hover { text-decoration: underline; }
    .copyright { margin-top: 15px; font-size: 0.8rem; color: #94a3b8; }
</style>

<footer class="main-footer">
    <div class="footer-links">
        <a href="index.php">الرئيسية</a>
        <a href="about.php">عن رَحّـالة</a>
        <a href="contact.php">اتصل بنا</a>
    </div>
    <p class="copyright">
        &copy; <?php echo date("Y"); ?> جميع الحقوق محفوظة | تصميم هندسة البرمجيات - مشروع رَحّـالة
    </p>
</footer>