<?php 
// 1. استدعاء الهيدر الموحد
include 'includes/header.php'; 

// 2. الاتصال بالقاعدة
include "db_conn.php";

// 3. استعلام جلب التقييمات مع أسماء المستخدمين (عملية Join احترافية)
// سنفترض أن اسم جدول المستخدمين users وعمود الاسم full_name
$sql = "SELECT reviews.*, users.full_name 
        FROM reviews 
        JOIN users ON reviews.user_id = users.id 
        ORDER BY reviews.id DESC";

$result = mysqli_query($conn, $sql);
?>

<style>
    body {
        background: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), 
                    url('https://images.unsplash.com/photo-1488085061387-422e29b40080?w=1500');
        background-size: cover; background-position: center; background-attachment: fixed;
        color: white; min-height: 100vh;
    }

    .main-content { display: flex; flex-direction: column; align-items: center; padding: 120px 20px 60px; }
    
    .reviews-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 25px;
        width: 100%;
        max-width: 1200px;
    }

    /* كرت التقييم الزجاجي */
    .review-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(197, 160, 89, 0.2);
        border-radius: 25px;
        padding: 30px;
        transition: 0.4s;
        position: relative;
        overflow: hidden;
    }

    .review-card:hover {
        transform: translateY(-10px);
        border-color: #c5a059;
        box-shadow: 0 15px 30px rgba(197, 160, 89, 0.1);
    }

    .user-info { display: flex; align-items: center; margin-bottom: 15px; }
    .user-avatar {
        width: 50px; height: 50px; background: #c5a059; 
        border-radius: 50%; display: flex; justify-content: center; 
        align-items: center; margin-left: 15px; font-weight: bold; color: #0f172a;
    }

    .review-country { color: #c5a059; font-weight: 800; font-size: 0.9rem; margin-bottom: 10px; display: block; }
    
    .comment-text {
        font-size: 1rem; color: #cbd5e1; line-height: 1.6; font-style: italic;
    }

    .quote-icon {
        position: absolute; left: 20px; bottom: 10px; 
        font-size: 3rem; color: rgba(197, 160, 89, 0.1);
    }
</style>

<div class="main-content">
    <h1 style="color: #c5a059; margin-bottom: 10px; font-weight: 800; font-size: 2.8rem;">آراء المسافرين</h1>
    <p style="color: #94a3b8; margin-bottom: 50px; font-size: 1.2rem;">كلمات من القلب من عائلة "رَحّـالة" حول العالم</p>

    <div class="reviews-grid">
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="review-card">
                    <span class="review-country">📍 رحلة إلى <?php echo $row['country']; ?></span>
                    
                    <div class="user-info">
                        <div class="user-avatar">
                            <?php echo mb_substr($row['full_name'], 0, 1, 'utf-8'); ?>
                        </div>
                        <div>
                            <h3 style="margin: 0; font-size: 1.1rem;"><?php echo $row['full_name']; ?></h3>
                            <small style="color: #64748b;">عميل متميز</small>
                        </div>
                    </div>

                    <p class="comment-text">
                        "<?php echo $row['comment']; ?>"
                    </p>
                    
                    <div class="quote-icon">❝</div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div style="grid-column: 1/-1; text-align: center; padding: 50px;">
                <p style="color: #94a3b8;">لا توجد تقييمات بعد.. كون أول من يشارك تجربته!</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>