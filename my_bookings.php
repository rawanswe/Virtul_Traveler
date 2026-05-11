<?php 
// 1. استدعاء الهيدر الموحد
include 'includes/header.php'; 

// 2. حماية الصفحة
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// 3. الاتصال بالقاعدة
include "db_conn.php";
$user_id = $_SESSION['user_id'];

// 4. استعلام جلب الحجوزات
$sql = "SELECT * FROM bookings WHERE user_id = '$user_id' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<style>
    body {
        background: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), 
                    url('https://images.unsplash.com/photo-1436491865332-7a61a109c0f2?w=1500');
        background-size: cover; background-position: center; background-attachment: fixed;
        color: white; min-height: 100vh;
    }

    .main-content { display: flex; flex-direction: column; align-items: center; padding: 100px 20px 40px; }
    
    .container {
        width: 100%; max-width: 1100px; 
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px); 
        border: 1px solid rgba(197, 160, 89, 0.3);
        border-radius: 30px; padding: 40px; 
        box-shadow: 0 25px 50px rgba(0,0,0,0.5);
    }

    /* تنسيق رسالة النجاح */
    .alert-success {
        background: rgba(16, 185, 129, 0.2); 
        color: #10b981; 
        padding: 15px; 
        border-radius: 15px; 
        border: 1px solid #10b981; 
        margin-bottom: 25px; 
        width: 100%; 
        max-width: 1100px; 
        text-align: center; 
        font-weight: bold;
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th { color: #c5a059; padding: 20px; border-bottom: 2px solid #c5a059; text-align: center; font-size: 1.1rem; }
    td { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255, 255, 255, 0.05); }

    .rate-btn {
        background: transparent; border: 1px solid #c5a059; color: #c5a059;
        padding: 8px 18px; border-radius: 12px; cursor: pointer; transition: 0.3s;
        font-weight: bold; font-family: 'Tajawal';
    }
    .rate-btn:hover { background: #c5a059; color: #0f172a; }

    .cancel-btn { 
        background: #ef4444; color: white; padding: 10px 20px; 
        border-radius: 12px; text-decoration: none; font-size: 0.9rem; 
        font-weight: bold; transition: 0.3s;
    }
    .cancel-btn:hover { background: #b91c1c; transform: scale(1.05); }

    /* المودال */
    .modal { position: fixed; z-index: 9999; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); display: none; justify-content: center; align-items: center; backdrop-filter: blur(12px); }
    .modal-content { background: #1e293b; padding: 40px; border-radius: 30px; border: 1px solid #c5a059; width: 90%; max-width: 450px; text-align: center; }
    .input-field { width: 100%; padding: 12px; border-radius: 12px; background: white; color: #0f172a; border: 1px solid #c5a059; margin-top: 10px; margin-bottom: 20px; outline: none; font-family: 'Tajawal'; font-weight: bold; }
</style>

<div class="main-content">
    
    <?php if (isset($_GET['success'])): ?>
        <div class="alert-success">
            ✅ <?php echo htmlspecialchars($_GET['success']); ?>
        </div>
    <?php endif; ?>

    <h1 style="color: #c5a059; margin-bottom: 10px; font-weight: 800; font-size: 2.5rem;">رِحـلاتي المجدولة</h1>
    <p style="color: #94a3b8; margin-bottom: 40px;">هنا تجد قائمة بمغامراتك القادمة مع رَحّـالة</p>

    <div class="container">
        <?php if(mysqli_num_rows($result) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>🌍 الوجهة</th>
                        <th>📅 التاريخ</th>
                        <th>⏰ الوقت</th>
                        <th>⚙️ التحكم</th>
                        <th>⭐ التقييم</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td style="font-weight: 800; color: #fff;"><?php echo $row['country']; ?></td>
                        <td><?php echo $row['booking_date']; ?></td>
                        <td><?php echo isset($row['booking_time']) ? $row['booking_time'] : '--:--'; ?></td>
                        <td>
                            <a href="php/cancel_booking.php?id=<?php echo $row['id']; ?>" class="cancel-btn" onclick="return confirm('هل أنتِ متأكدة من إلغاء رحلتك إلى <?php echo $row['country']; ?>؟')">إلغاء الحجز</a>
                        </td>
                        <td>
                            <button onclick="openRateModal('<?php echo $row['country']; ?>')" class="rate-btn">قيّم الخدمة</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div style="text-align: center; padding: 40px;">
                <p style="color: #94a3b8; font-size: 1.2rem; margin-bottom: 20px;">لا توجد حجوزات نشطة حالياً .</p>
                <a href="map.php" style="color: #c5a059; text-decoration: none; font-weight: bold; border: 1px solid #c5a059; padding: 10px 25px; border-radius: 50px;">استكشفي الخريطة الآن</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<div id="rateModal" class="modal">
    <div class="modal-content">
        <h2 id="rateTitle" style="color: #c5a059;">تقييم رحلة</h2>
        <form action="php/add_review.php" method="POST">
            <input type="hidden" name="review_country" id="rateCountryInput">
            <div style="text-align: right;">
                <label style="color: #c5a059; font-weight: bold;">كيف كانت تجربتك؟</label>
                <select name="speed" class="input-field">
                    <option value="ممتاز">🚀 تجربة ملكية (ممتاز)</option>
                    <option value="جيد">👍 رائعة جداً (جيد)</option>
                    <option value="متوسط">😐 جيدة (متوسط)</option>
                </select>
            </div>
            <div style="text-align: right;">
                <label style="color: #c5a059; font-weight: bold;">ملاحظاتك الإضافية:</label>
                <textarea name="comment" class="input-field" rows="3" required placeholder="اكتب رأيك هنا..."></textarea>
            </div>
            <button type="submit" style="background: #c5a059; color: #0f172a; border: none; padding: 15px; border-radius: 15px; width: 100%; font-weight: 800; cursor: pointer; font-size: 1.1rem;">إرسال التقييم</button>
            <button type="button" onclick="closeRateModal()" style="background: none; color: #94a3b8; border: none; margin-top: 15px; cursor: pointer;">تراجع</button>
        </form>
    </div>
</div>

<script>
    function openRateModal(country) {
        document.getElementById('rateModal').style.display = 'flex';
        document.getElementById('rateTitle').innerText = "تقييم رحلة " + country;
        document.getElementById('rateCountryInput').value = country;
    }
    function closeRateModal() { document.getElementById('rateModal').style.display = 'none'; }
    window.onclick = function(event) { if (event.target == document.getElementById('rateModal')) { closeRateModal(); } }
</script>

<?php include 'includes/footer.php'; ?>