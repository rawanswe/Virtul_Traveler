<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        /* ستايل القائمة العلوية المطور */
        .navbar {
            background: #0f172a; 
            padding: 12px 60px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            border-bottom: 2px solid #c5a059;
            position: fixed; /* تبقى ثابتة فوق */
            top: 0; width: 100%; z-index: 9999;
            box-sizing: border-box;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        
        .nav-logo { 
            color: #c5a059; 
            font-size: 1.8rem; 
            font-weight: 800; 
            text-decoration: none;
            letter-spacing: 1px;
        }

        .nav-links a { 
            color: white; 
            text-decoration: none; 
            margin: 0 15px; 
            font-weight: 700; 
            font-size: 0.95rem;
            transition: 0.3s;
        }
        
        .nav-links a:hover { color: #c5a059; }

        /* ستايل زر المستخدم والدروب داون */
        .user-dropdown { position: relative; }
        
        .dropbtn { 
            background: #c5a059; 
            color: #0f172a; 
            padding: 8px 20px; 
            border-radius: 50px; 
            cursor: pointer; 
            border: none; 
            font-weight: 800;
            font-family: 'Tajawal', sans-serif;
            transition: 0.3s;
        }
        
        .dropbtn:hover { background: white; transform: scale(1.05); }

        .dropdown-content { 
            display: none; 
            position: absolute; 
            right: 0;
            background: #1e293b; 
            min-width: 180px; 
            border-radius: 12px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            margin-top: 10px;
            overflow: hidden;
            border: 1px solid rgba(197, 160, 89, 0.3);
        }
        
        .dropdown-content a {
            display: block; 
            padding: 12px 20px; 
            color: white; 
            text-decoration: none; 
            font-size: 0.9rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            transition: 0.3s;
        }

        .dropdown-content a:hover { background: #c5a059; color: #0f172a; }
        .show { display: block !important; }

        /* لإزاحة المحتوى تحت القائمة الثابتة */
        body { padding-top: 70px; }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="index.php" class="nav-logo">رَحّـالة</a>
    
    <div class="nav-links">
        <a href="index.php">الرئيسية</a>
        <a href="about.php">عن رَحّـالة</a>
        <a href="map.php">الخريطة</a>
        <a href="my_bookings.php">حجوزاتي</a>
        <a href="contact.php">اتصل بنا</a>
    </div>

    <div class="user-dropdown">
        <button onclick="toggleDropdown()" class="dropbtn">
            مرحباً، <?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'زائر'; ?> ▾
        </button>
        <div id="myDropdown" class="dropdown-content">
            <a href="index.php">🏠 الرئيسية</a>
            <a href="my_bookings.php">📋 حجوزاتي</a>
            <hr style="border: 0.5px solid rgba(255,255,255,0.1);">
            <a href="edit_profile.php" style="color: #c5a059; text-decoration: none; margin-left: 15px;">👤 ملفي الشخصي</a>
<a href="logout.php" style="color: #f87171; text-decoration: none;">تسجيل خروج</a>
        </div>
    </div>
</nav>

<script>
    function toggleDropdown() { 
        document.getElementById("myDropdown").classList.toggle("show"); 
    }
    // إغلاق القائمة إذا ضغط المستخدم خارجها
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>