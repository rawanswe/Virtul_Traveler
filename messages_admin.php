<?php 
include 'includes/header.php'; 
include 'db_conn.php';

// كود الحذف (Delete)
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM contact_messages WHERE id = $id");
    echo "<script>alert('تم حذف الرسالة بنجاح'); window.location='messages_admin.php';</script>";
}

$result = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY id DESC");
?>

<div style="padding: 100px 40px; background: #0f172a; min-height: 100vh; color: white;">
    <h1 style="color: #c5a059; text-align: center;">إدارة الرسائل الاستفسارية</h1>
    <table border="1" style="width: 100%; margin-top: 30px; border-collapse: collapse; text-align: center; background: rgba(255,255,255,0.05);">
        <tr style="background: #c5a059; color: #0f172a;">
            <th>الاسم</th>
            <th>البريد</th>
            <th>الرسالة</th>
            <th>الإجراء</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['message']; ?></td>
            <td>
                <a href="messages_admin.php?delete_id=<?php echo $row['id']; ?>" 
                   style="color: #f87171; text-decoration: none;" 
                   onclick="return confirm('هل أنتِ متأكدة من حذف هذه الرسالة؟')">حذف 🗑️</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
<?php include 'includes/footer.php'; ?>