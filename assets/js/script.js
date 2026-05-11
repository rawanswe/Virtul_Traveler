const text = "هل أنت مستعد لاستكشاف العالم؟";
let index = 0;

function typeWriter() {
    if (index < text.length) {
        document.getElementById("typewriter").innerHTML += text.charAt(index);
        index++;
        setTimeout(typeWriter, 100);
    }
}

window.onload = typeWriter;

function startJourney() {
    // 1. إخفاء المحتوى الحالي
    document.getElementById("heroSection").style.opacity = "0";
    
    // 2. الانتظار لمدة ثانية ثم الانتقال
    setTimeout(() => {
        window.location.href = "map.html"; 
    }, 1000);
}