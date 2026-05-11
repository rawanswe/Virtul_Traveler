<?php include 'includes/header.php'; ?>

<style>
    /* 1. إعدادات الصفحة الأساسية لضمان عمل السكرول */
    html, body {
        margin: 0;
        padding: 0;
        width: 100%;
        min-height: 100%;
        background: #0f172a;
        overflow-x: hidden;
        overflow-y: auto; /* تفعيل النزول تحت */
        font-family: 'Tajawal', sans-serif;
    }

    /* 2. قسم الخلفية */
    .about-hero {
        min-height: 100vh;
        width: 100%;
        background: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.85)), 
                    url('https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=1500'); 
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 110px 20px 60px; /* مساحة للنافبار */
        box-sizing: border-box;
    }

    /* 3. الكرت الزجاجي المصغر */
    .about-content-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px);
        border-radius: 35px;
        border: 1px solid rgba(197, 160, 89, 0.3);
        padding: 35px 30px;
        max-width: 700px; /* الحجم المصغر المطلب */
        width: 100%;
        box-shadow: 0 30px 60px rgba(0,0,0,0.4);
        text-align: right;
        margin-bottom: 50px;
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn { 
        from { opacity: 0; transform: scale(0.98); } 
        to { opacity: 1; transform: scale(1); } 
    }

    .about-content-card h1 {
        color: #c5a059;
        font-size: 2.2rem;
        text-align: center;
        margin-bottom: 25px;
        font-weight: 800;
    }

    .about-content-card p {
        color: #f1f5f9;
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    /* كروت الرؤية والأهداف داخل الكرت الزجاجي */
    .vision-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .vision-item {
        background: rgba(197, 160, 89, 0.08);
        padding: 20px;
        border-radius: 15px;
        border-right: 4px solid #c5a059;
        transition: 0.3s;
    }

    .vision-item:hover {
        background: rgba(197, 160, 89, 0.12);
        transform: translateY(-5px);
    }

    .vision-item h3 {
        color: #c5a059;
        margin-bottom: 10px;
        font-size: 1.3rem;
    }

    .vision-item p {
        font-size: 0.95rem;
        margin: 0;
        line-height: 1.6;
        color: #cbd5e1;
    }
</style>

<div class="about-hero">
    <div class="about-content-card">
        <h1>قصة رَحّـالة</h1>
        
        <p>
            بدأت رَحّـالة كشغف لدمج التكنولوجيا بعالم السفر. نحن نؤمن أن الرحلة الحقيقية تبدأ من سهولة التخطيط والتطلع لوجهة جديدة تعكس ذوقكِ الرفيع.
        </p>

        <p>
            بصفتنا منصة متخصصة، نسعى لتوفير تجربة تفاعلية تليق بعملاء رَحّـالة، حيث تلتقي الرفاهية بالابتكار البرمجي لتكتشفي العالم بلمسة واحدة.
        </p>

        <div class="vision-grid">
            <div class="vision-item">
                <h3>رؤيتنا</h3>
                <p>أن نصبح الخيار الأول لكل مسافر يبحث عن التميز والابتكار في رحلاته العالمية.</p>
            </div>
            <div class="vision-item">
                <h3>مهمتنا</h3>
                <p>تسهيل تجربة السفر عبر حلول ذكية تجعل من الحجز والبحث عملية ممتعة وبسيطة.</p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>