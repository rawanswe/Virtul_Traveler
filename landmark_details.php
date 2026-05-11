<?php 
error_reporting(E_ERROR | E_PARSE); 
include 'includes/header.php'; 
include 'db_conn.php';

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : 0;
$sql = "SELECT * FROM landmarks WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) { header("Location: index.php"); exit; }
?>

<style>
    body { background-color: #0f172a; margin: 0; font-family: 'Tajawal', sans-serif; }
    .details-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 60px 20px; }
    .custom-card { background: rgba(255, 255, 255, 0.04); backdrop-filter: blur(15px); border: 1px solid rgba(197, 160, 89, 0.3); border-radius: 35px; width: 100%; max-width: 1000px; overflow: hidden; text-align: right; color: white; }
    /* تعديل المسار هنا أيضاً */
    .card-image { width: 100%; height: 400px; object-fit: cover; border-bottom: 2px solid #c5a059; }
    .card-body { padding: 45px; }
    .card-title { color: #c5a059; font-size: 2.6rem; margin: 0 0 20px 0; font-weight: 900; }
    .card-text { font-size: 1.15rem; line-height: 2; color: #e2e8f0; margin-bottom: 35px; }
    .btn-map { display: inline-block; padding: 16px 40px; border: 2px solid #c5a059; border-radius: 50px; color: #c5a059; text-decoration: none; font-weight: 800; transition: 0.3s; }
    .btn-map:hover { background: #c5a059; color: #0f172a; transform: translateY(-3px); }
</style>

<div class="details-container">
    <div class="custom-card">
        <img src="assets/img/<?php echo $row['image']; ?>" class="card-image" alt="Landmark">
        <div class="card-body">
            <h1 class="card-title"><?php echo $row['name']; ?></h1>
            <p class="card-text"><?php echo $row['description']; ?></p>
            <a href="<?php echo $row['map_url']; ?>" target="_blank" class="btn-map">📍 عرض الموقع الجغرافي</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>