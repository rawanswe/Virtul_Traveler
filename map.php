<?php include 'includes/header.php'; ?>

<style>
    /* التنسيق العام للصفحة */
    body { 
        margin: 0; font-family: 'Tajawal', sans-serif; 
        background: #0f172a; color: white; min-height: 100vh; 
    }
    .page-wrapper { padding: 100px 20px 40px; max-width: 1200px; margin: 0 auto; }
    .main-header { text-align: center; margin-bottom: 50px; }
    .main-header h1 { color: #c5a059; font-size: 2.5rem; font-weight: 800; }

    /* شبكة بطاقات القارات */
    .cards-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px; }
    .continent-card { 
        background: rgba(255,255,255,0.05); border-radius: 20px; overflow: hidden; 
        cursor: pointer; transition: 0.3s; border: 1px solid rgba(255,255,255,0.1); 
        backdrop-filter: blur(15px); 
    }
    .continent-card:hover { transform: translateY(-10px); border-color: #c5a059; }
    .card-image { height: 180px; background-size: cover; background-position: center; }
    .card-info { padding: 20px; text-align: center; }

    /* قسم الدول */
    .countries-section { display: none; margin-top: 50px; padding: 40px; background: rgba(255,255,255,0.02); border-radius: 30px; border-top: 2px solid #c5a059; }
    .countries-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; }
    
    .country-item { background: rgba(30, 41, 59, 0.7); padding: 15px; border-radius: 15px; text-align: center; border: 1px solid rgba(255,255,255,0.05); }
    .country-item img { width: 100%; height: 140px; border-radius: 10px; object-fit: cover; margin-bottom: 15px; }

    /* نافذة الحجز (المودال) المحدثة بالخلفية */
    .modal { position: fixed; z-index: 9999; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.85); display: none; justify-content: center; align-items: center; backdrop-filter: blur(8px); }
    
    .modal-content { 
        /* إضافة الخلفية هنا */
        background-image: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.85)), url('https://images.unsplash.com/photo-1436491865332-7a61a109c0f2?w=800'); 
        background-size: cover;
        background-position: center;
        padding: 40px; border-radius: 30px; border: 1.5px solid #c5a059; 
        width: 90%; max-width: 480px; text-align: center;
        box-shadow: 0 25px 50px rgba(0,0,0,0.6);
    }

    .modal-content h2 { color: #c5a059; font-weight: 800; margin-bottom: 25px; text-shadow: 0 2px 4px rgba(0,0,0,0.5); }
    .modal-content label { display: block; text-align: right; margin-bottom: 8px; font-weight: bold; color: #c5a059; font-size: 0.9rem; }

    .select-group { display: flex; gap: 10px; margin-bottom: 20px; direction: ltr !important; }
    .select-group select { 
        flex: 1; padding: 12px; border-radius: 12px; border: 1px solid #c5a059; 
        background: white; color: #0f172a; font-weight: 800; text-align: center; font-size: 1rem;
        cursor: pointer;
    }

    /* تنسيق النص الشفاف داخل القائمة */
    select option[disabled] { color: rgba(15, 23, 42, 0.4); }

    .book-btn { 
        background: #c5a059; color: #0f172a; border: none; padding: 15px; 
        border-radius: 12px; font-weight: 800; cursor: pointer; width: 100%; 
        margin-top: 10px; font-size: 1.1rem; transition: 0.3s;
        box-shadow: 0 5px 15px rgba(197, 160, 89, 0.3);
    }
    .book-btn:hover { background: white; transform: scale(1.02); }
</style>

<div class="page-wrapper">
    <header class="main-header">
        <h1>أين وجهتك القادمة؟</h1>
        <p>استكشفي جمال العالم مع رَحّـالة</p>
         <p>اختاري القارة أولاً</p>
    </header>

    <main class="cards-grid">
        <div class="continent-card" onclick="showCountries('asia')">
            <div class="card-image" style="background-image: url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=500');"></div>
            <div class="card-info"><h2>آسيا</h2></div>
        </div>
        <div class="continent-card" onclick="showCountries('europe')">
            <div class="card-image" style="background-image: url('https://images.unsplash.com/photo-1467269204594-9661b134dd2b?w=500');"></div>
            <div class="card-info"><h2>أوروبا</h2></div>
        </div>
        <div class="continent-card" onclick="showCountries('africa')">
            <div class="card-image" style="background-image: url('https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=500');"></div>
            <div class="card-info"><h2>أفريقيا</h2></div>
        </div>
        <div class="continent-card" onclick="showCountries('america')">
            <div class="card-image" style="background-image: url('https://images.unsplash.com/photo-1501594907352-04cda38ebc29?w=500');"></div>
            <div class="card-info"><h2>أمريكا</h2></div>
        </div>
    </main>

    <div id="countries-display" class="countries-section">
        <h2 id="continent-title" style="text-align: center; color: #c5a059; margin-bottom: 25px;"></h2>
        <div id="countries-list" class="countries-grid"></div>
    </div>
</div>

<div id="bookingModal" class="modal">
    <div class="modal-content">
        <h2 id="destinationTitle">حجز رحلة</h2>
        <form action="php/book_trip.php" method="POST" onsubmit="prepareData()">
            <input type="hidden" name="trip_name" id="countryInput"> 
            <input type="hidden" name="booking_date" id="finalDate">
            <input type="hidden" name="booking_time" id="finalTime">

            <label>تاريخ السفر:</label>
            <div class="select-group">
                <select id="year" required>
                    <option value="" disabled selected>السنة</option>
                    <option value="2026">2026</option><option value="2027">2027</option><option value="2028">2028</option>
                </select>
                <select id="month" required>
                    <option value="" disabled selected>الشهر</option>
                    <?php for($i=1; $i<=12; $i++) echo "<option value='".sprintf("%02d", $i)."'>$i</option>"; ?>
                </select>
                <select id="day" required>
                    <option value="" disabled selected>اليوم</option>
                    <?php for($i=1; $i<=31; $i++) echo "<option value='".sprintf("%02d", $i)."'>$i</option>"; ?>
                </select>
            </div>

            <label>وقت الإقلاع:</label>
            <div class="select-group">
                <select id="hour" required>
                    <option value="" disabled selected>الساعة</option>
                    <?php for($i=0; $i<=23; $i++) echo "<option value='".sprintf("%02d", $i)."'>".sprintf("%02d", $i)."</option>"; ?>
                </select>
                <select id="minute" required>
                    <option value="" disabled selected>الدقيقة</option>
                    <?php for($i=0; $i<=55; $i+=5) echo "<option value='".sprintf("%02d", $i)."'>".sprintf("%02d", $i)."</option>"; ?>
                </select>
            </div>

            <button type="submit" class="book-btn">تأكيد الحجز الآن</button>
            <button type="button" onclick="closeModal()" style="background:none; color:white; border:none; width:100%; margin-top:15px; cursor:pointer; font-weight: bold; opacity: 0.8;">إلغاء</button>
        </form>
    </div>
</div>

<script>
    const destinations = {
        asia: [{name: 'اليابان', img: 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?w=500'}, {name: 'كوريا الجنوبية', img: 'https://images.unsplash.com/photo-1517154421773-0529f29ea451?w=500'}, {name: 'تايلاند', img: 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?w=500'}, {name: 'إندونيسيا', img: 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=500'}],
        europe: [{name: 'فرنسا', img: 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=500'}, {name: 'إيطاليا', img: 'https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?w=500'}, {name: 'سويسرا', img: 'https://images.unsplash.com/photo-1527668752968-14dc70a27c95?w=500'}, {name: 'ألمانيا', img: 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?w=500'}],
        africa: [{name: 'مصر', img: 'https://images.unsplash.com/photo-1503177119275-0aa32b3a9368?w=500'}, {name: 'المغرب', img: 'https://images.unsplash.com/photo-1539020140153-e479b8c22e70?w=500'}, {name: 'تنزانيا', img: 'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=500'}, {name: 'جنوب أفريقيا', img: 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=500'}],
        america: [{name: 'البرازيل', img: 'https://images.unsplash.com/photo-1483729558449-99ef09a8c325?w=500'}, {name: 'المكسيك', img: 'https://images.unsplash.com/photo-1518105779142-d975f22f1b0a?w=500'}, {name: 'كندا', img: 'https://images.pexels.com/photos/14436948/pexels-photo-14436948.jpeg'}, {name: 'أمريكا', img: 'https://images.unsplash.com/photo-1501594907352-04cda38ebc29?w=500'}]
    };

    function showCountries(continent) {
        const section = document.getElementById('countries-display');
        const list = document.getElementById('countries-list');
        const names = {asia: 'آسيا', europe: 'أوروبا', africa: 'أفريقيا', america: 'أمريكا'};
        document.getElementById('continent-title').innerText = 'وجهات رَحّـالة في ' + names[continent];
        list.innerHTML = '';
        destinations[continent].forEach(item => {
            list.innerHTML += `<div class="country-item"><img src="${item.img}"><h3>${item.name}</h3><button class="book-btn" onclick="openModal('${item.name}')">حجز الآن</button></div>`;
        });
        section.style.display = 'block';
        section.scrollIntoView({ behavior: 'smooth' });
    }

    function openModal(name) {
        document.getElementById('countryInput').value = name;
        document.getElementById('destinationTitle').innerText = 'حجز رحلة إلى ' + name;
        document.getElementById('bookingModal').style.display = 'flex';
    }

    function closeModal() { document.getElementById('bookingModal').style.display = 'none'; }

    function prepareData() {
        const y = document.getElementById('year').value;
        const m = document.getElementById('month').value;
        const d = document.getElementById('day').value;
        document.getElementById('finalDate').value = `${y}-${m}-${d}`;
        
        const hr = document.getElementById('hour').value;
        const min = document.getElementById('minute').value;
        document.getElementById('finalTime').value = `${hr}:${min}:00`;
    }
</script>

<?php include 'includes/footer.php'; ?>