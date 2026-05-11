const countriesData = {
    'europe': [
        { name: 'فرنسا', img: 'https://images.pexels.com/photos/1470502/pexels-photo-1470502.jpeg?auto=compress&cs=tinysrgb&w=600', info: 'مشهورة بالعطور، وفن الطبخ، وبرج إيفل.' },
        { name: 'إيطاليا', img: 'https://images.pexels.com/photos/1797161/pexels-photo-1797161.jpeg?auto=compress&cs=tinysrgb&w=600', info: 'موطن البيتزا، الباستا، والآثار الرومانية.' },
        { name: 'ألمانيا', img: 'https://images.pexels.com/photos/414459/pexels-photo-414459.jpeg?auto=compress&cs=tinysrgb&w=600', info: 'تتميز بالقلاع التاريخية والدقة في الصناعة.' },
        { name: 'إسبانيا', img: 'https://images.unsplash.com/photo-1559386081-325882507af7?q=80&w=736&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', info: 'تشتهر برقصة الفلامنكو ومهرجاناتها الملونة.' },
        { name: 'سويسرا', img: 'https://images.unsplash.com/photo-1570161766218-f8488ebb8078?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', info: 'أرض الجبال الثلجية، الشوكولاتة، والساعات.' }
    ],
    'asia': [
        { name: 'اليابان', img: 'https://images.unsplash.com/photo-1573455494060-c5595004fb6c?q=80&w=1140&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', info: 'كوكب اليابان، يجمع بين التكنولوجيا والتقاليد.' },
        { name: 'الصين', img: 'https://plus.unsplash.com/premium_photo-1664304488525-44a96338c0cc?q=80&w=875&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', info: 'سور الصين العظيم وعادات الشاي العريقة.' },
        { name: 'المملكة العربية السعودية', img: 'https://plus.unsplash.com/premium_photo-1697729765416-780f169ef78b?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', info: 'مهد الكرم العربي، والتطور المعماري الحديث.' },
        { name: 'الهند', img: 'https://images.pexels.com/photos/1603650/pexels-photo-1603650.jpeg?auto=compress&cs=tinysrgb&w=600', info: 'بلد الألوان، التوابل، والقصور التاريخية.' },
        { name: 'كوريا الجنوبية', img: 'https://images.pexels.com/photos/3848886/pexels-photo-3848886.jpeg?auto=compress&cs=tinysrgb&w=600', info: 'تتميز بالثقافة المعاصرة (K-pop) والمدن الذكية.' }
    ],
    'africa': [
        { name: 'مصر', img: 'https://images.pexels.com/photos/71241/pexels-photo-71241.jpeg?auto=compress&cs=tinysrgb&w=600', info: 'أرض الأهرامات، الحضارة الفرعونية، ونهر النيل العظيم.' },
        { name: 'المغرب', img: 'https://images.pexels.com/photos/30272053/pexels-photo-30272053.jpeg', info: 'تتميز بالمعمار الأندلسي، الأسواق الملونة، وجبال الأطلس.' },
        { name: 'جنوب أفريقيا', img: 'https://images.pexels.com/photos/259447/pexels-photo-259447.jpeg?auto=compress&cs=tinysrgb&w=600', info: 'بلد التنوع الطبيعي، جبل الطاولة، ورحلات السفاري المذهلة.' },
        { name: 'تنزانيا', img: 'https://images.pexels.com/photos/9539030/pexels-photo-9539030.jpeg', info: 'موطن قمة كيليمانجارو وجزيرة زنجبار ذات الشواطئ الفيروزية.' },
        { name: 'كينيا', img: 'https://images.pexels.com/photos/1051516/pexels-photo-1051516.jpeg?auto=compress&cs=tinysrgb&w=600', info: 'قلب الحياة البرية في أفريقيا وموطن قبائل الماساي.' }
    ],
    'america': [
        { name: 'الولايات المتحدة', img: 'https://images.pexels.com/photos/378570/pexels-photo-378570.jpeg?auto=compress&cs=tinysrgb&w=600', info: 'أرض الأحلام، تمثال الحرية، وناطحات السحاب في نيويورك.' },
        { name: 'البرازيل', img: 'https://images.pexels.com/photos/12989147/pexels-photo-12989147.jpeg', info: 'موطن غابات الأمازون، الكرنفالات، وتمثال المسيح الفادي.' },
        { name: 'المكسيك', img: 'https://images.pexels.com/photos/19937220/pexels-photo-19937220.jpeg', info: 'تشتهر بحضارة المايا، الأطعمة الحارة، والشواطئ الساحرة.' },
        { name: 'كندا', img: 'https://images.pexels.com/photos/1510610/pexels-photo-1510610.jpeg?auto=compress&cs=tinysrgb&w=600', info: 'بلد الطبيعة الخلابة، البحيرات الزرقاء، وشراب القيقب الشهير.' },
        { name: 'الأرجنتين', img: 'https://images.pexels.com/photos/415999/pexels-photo-415999.jpeg?auto=compress&cs=tinysrgb&w=600', info: 'أرض التانغو، جبال الأنديز، وشلالات إيغواسو العظيمة.' }
    ],
};

function showCountries(continentId) {
    const displayArea = document.getElementById('countries-display');
    const listArea = document.getElementById('countries-list');
    const continentTitle = document.getElementById('continent-name');
    
    const countries = countriesData[continentId];
    
    // تحديد اسم القارة
    const titles = {
        'europe': "اكتشف دول قارة أوروبا",
        'asia': "اكتشف دول قارة آسيا",
        'africa': "اكتشف دول قارة أفريقيا",
        'america': "اكتشف دول قارة أمريكا"
    };
    continentTitle.innerText = titles[continentId] || "اكتشف الدول";

    listArea.innerHTML = ''; // مسح المحتوى القديم

    countries.forEach(country => {
        // قمنا بإضافة زر "احجز الآن" مع استدعاء دالة openBooking
        const card = `
            <div class="country-item">
                <img src="${country.img}" alt="${country.name}">
                <h3>${country.name}</h3>
                <p>${country.info}</p>
                <button onclick="openBooking('${country.name}')" class="book-now-btn">احجز الآن</button>
            </div>
        `;
        listArea.innerHTML += card;
    });

    // إظهار القسم والنزول إليه بسلاسة
    displayArea.classList.add('active');
    displayArea.style.display = 'block'; // للتأكد من ظهوره
    displayArea.scrollIntoView({ behavior: 'smooth' });
}

// أضفت لكِ دالتي التحكم في النافذة هنا لضمان عملها
function openBooking(countryName) {
    document.getElementById('bookingModal').style.display = 'flex';
    document.getElementById('destinationTitle').innerText = "حجز رحلة إلى " + countryName;
    document.getElementById('countryInput').value = countryName;
}

function closeModal() {
    document.getElementById('bookingModal').style.display = 'none';
}