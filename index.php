<?php
// 1. تفعيل الجلسة للتحقق من هوية المستخدم
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. حماية الصفحة: إذا لم يسجل الدخول، يتم توجيهه لصفحة الدخول فوراً
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// 3. استدعاء الهيدر (تأكدي أن الهيدر لا يحتوي على فراغات علوية زائدة)
include 'includes/header.php'; 
?>

<style>
    /* 1. إعدادات الصفحة الأساسية */
    html, body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        background: #0f172a;
        overflow-x: hidden;
        font-family: 'Tajawal', sans-serif;
    }

    /* 2. قسم الـ Hero - تم تعديله لإلغاء الفراغات */
    .hero-section {
        min-height: 100vh;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)), 
                    url('https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=1500'); 
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 40px 20px; /* تقليل البادينج العلوي */
        box-sizing: border-box;
        margin-top: -70px; /* سحب المحتوى للأعلى ليتداخل مع الهيدر الشفاف */
    }

    .hero-section h1 { 
        font-size: 3.8rem; 
        color: #c5a059; 
        margin: 0 0 20px 0; /* إلغاء المارجن العلوي تماماً */
        font-weight: 800;
        animation: fadeInUp 1s ease-out;
    }

    .hero-section p { 
        font-size: 1.3rem; 
        max-width: 750px; 
        line-height: 1.8; 
        color: #f1f5f9;
        margin-bottom: 30px;
        animation: fadeInUp 1.2s ease-out;
    }

    /* 3. شريط البحث */
    .search-container {
        width: 100%;
        max-width: 700px;
        margin: 20px auto;
        position: relative;
        animation: fadeInUp 1.4s ease-out;
    }

    .search-form {
        display: flex;
        background: rgba(255, 255, 255, 0.07);
        backdrop-filter: blur(15px);
        padding: 8px;
        border-radius: 60px;
        border: 1px solid rgba(197, 160, 89, 0.3);
        transition: 0.4s;
    }

    .search-form:focus-within {
        border-color: #c5a059;
        box-shadow: 0 0 20px rgba(197, 160, 89, 0.2);
    }

    .search-form input {
        flex: 1;
        background: transparent !important;
        border: none;
        padding: 12px 25px;
        color: white !important;
        font-size: 1.1rem;
        outline: none;
    }

    .search-btn {
        background: #c5a059;
        color: #0f172a;
        border: none;
        padding: 0 30px;
        border-radius: 50px;
        font-weight: 800;
        cursor: pointer;
        transition: 0.3s;
    }

    /* 4. الأزرار والإحصائيات */
    .start-btn {
        margin-top: 15px;
        padding: 15px 45px;
        background: rgba(255, 255, 255, 0.05);
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 700;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: 0.4s;
        display: inline-block;
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
        width: 100%;
        max-width: 1100px;
        margin-top: 50px;
        animation: fadeInUp 1.8s ease-out;
    }

    .stat-item {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        padding: 20px;
        border-radius: 20px;
        border: 1px solid rgba(197, 160, 89, 0.15);
        transition: 0.4s;
    }

    .stat-item h3 { color: #c5a059; font-size: 2.2rem; margin: 0 0 5px 0; }
    .stat-item p { color: #94a3b8; margin: 0; font-size: 0.9rem; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="hero-section">
    <h1>مرحباً بكِ يا <?php echo isset($_SESSION['full_name']) ? explode(' ', $_SESSION['full_name'])[0] : 'رورو'; ?> في رَحّـالة</h1>
    
    <p>وجهتك الأولى لاستكشاف العالم وتوثيق رحلاتك بطريقة تفاعلية ذكية. نحن هنا لنجعل من سفرك تجربة ملكية لا تُنسى.</p>

    <div class="search-container">
        <form action="search_results.php" method="GET" class="search-form" autocomplete="off">
            <input type="text" name="query" placeholder="ابحثي عن معلم سياحي (مثلاً: جبل فوجي، برج إيفل)..." required>
            <button type="submit" class="search-btn">بحث 🔍</button>
        </form>
    </div>
    
    <a href="map.php" class="start-btn">أو استكشفي الخريطة التفاعلية</a>

    <div class="stats-container">
        <div class="stat-item">
            <h3>50+</h3>
            <p>وجهة سياحية</p>
        </div>
        <div class="stat-item">
            <h3>1.2k+</h3>
            <p>مسافر سعيد</p>
        </div>
        <div class="stat-item">
            <h3>4.9</h3>
            <p>تقييم العملاء</p>
        </div>
        <div class="stat-item">
            <h3>24/7</h3>
            <p>دعم متواصل</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>