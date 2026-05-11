<?php 
error_reporting(E_ERROR | E_PARSE); 
include 'includes/header.php'; 
include 'db_conn.php';

$query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';
$sql = "SELECT * FROM landmarks WHERE name LIKE '%$query%' OR description LIKE '%$query%' OR continent LIKE '%$query%'";
$result = mysqli_query($conn, $sql);
?>

<style>
    html, body { margin: 0; padding: 0; height: 100%; background-color: #0f172a; }
    .page-wrapper { display: flex; flex-direction: column; min-height: 100vh; background-color: #0f172a; font-family: 'Tajawal', sans-serif; }
    .main-content { flex: 1; padding: 120px 20px 60px; display: flex; flex-direction: column; align-items: center; }
    .search-title { color: #c5a059; font-size: 2.2rem; font-weight: 800; margin-bottom: 40px; text-align: center; }
    .results-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; width: 100%; max-width: 1150px; }
    .landmark-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(15px); border: 1px solid rgba(197, 160, 89, 0.3); border-radius: 25px; overflow: hidden; transition: 0.4s; display: flex; flex-direction: column; }
    .landmark-card:hover { transform: translateY(-10px); border-color: #c5a059; box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
    .card-img { width: 100%; height: 210px; object-fit: cover; background: #1e293b; }
    .card-info { padding: 25px; text-align: right; flex: 1; }
    .card-info h3 { color: #c5a059; margin: 0 0 12px 0; font-size: 1.4rem; }
    .card-info p { color: #cbd5e1; font-size: 0.95rem; line-height: 1.6; height: 60px; overflow: hidden; margin-bottom: 25px; }
    .action-area { display: flex; gap: 12px; }
    .btn-details { flex: 1; background: #c5a059; color: #0f172a; text-align: center; padding: 12px; border-radius: 12px; text-decoration: none; font-weight: 800; }
    .btn-map-icon { width: 45px; background: rgba(255, 255, 255, 0.1); display: flex; align-items: center; justify-content: center; border-radius: 12px; color: #c5a059; text-decoration: none; border: 1px solid rgba(197, 160, 89, 0.2); }
</style>

<div class="page-wrapper">
    <div class="main-content">
        <h2 class="search-title">نتائج البحث عن: "<?php echo htmlspecialchars($query); ?>"</h2>
        <div class="results-grid">
            <?php if(mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="landmark-card">
                        <img src="assets/img/<?php echo $row['image']; ?>" class="card-img" alt="Landmark">
                        <div class="card-info">
                            <h3><?php echo $row['name']; ?></h3>
                            <p><?php echo mb_strimwidth($row['description'], 0, 120, "..."); ?></p>
                            <div class="action-area">
                                <a href="landmark_details.php?id=<?php echo $row['id']; ?>" class="btn-details">التفاصيل الكاملة</a>
                                <a href="<?php echo $row['map_url']; ?>" target="_blank" class="btn-map-icon">📍</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="color: #94a3b8; text-align: center; grid-column: 1/-1;">لم نجد وجهات تطابق بحثكِ.. جربي كلمة أخرى.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</div>