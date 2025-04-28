let slideIndex = 0;
let slideInterval;

// Khởi tạo slideshow
function initSlideshow() {
    showSlides();
    startAutoSlide();
}

// Hiển thị slide
function showSlides() {
    let i;
    let slides = document.getElementsByClassName("slide");
    let dots = document.getElementsByClassName("dot");
    
    // Ẩn tất cả slide
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    
    // Tăng chỉ số slide
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    
    // Đặt active cho dot
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    
    // Hiển thị slide hiện tại
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
}

// Tự động chuyển slide
function startAutoSlide() {
    slideInterval = setInterval(() => {
        showSlides();
    }, 3000); // Chuyển slide mỗi 3 giây
}

// Dừng tự động chuyển slide
function stopAutoSlide() {
    clearInterval(slideInterval);
}

// Chuyển đến slide cụ thể
function currentSlide(n) {
    slideIndex = n - 1;
    showSlides();
    stopAutoSlide();
    startAutoSlide();
}

// Chuyển slide tiếp theo/trước đó
function plusSlides(n) {
    slideIndex += n - 1;
    showSlides();
    stopAutoSlide();
    startAutoSlide();
}

// Bắt đầu slideshow khi trang được tải
document.addEventListener('DOMContentLoaded', initSlideshow);

// Tạm dừng slideshow khi hover
document.querySelector('.slideshow-container').addEventListener('mouseenter', stopAutoSlide);
document.querySelector('.slideshow-container').addEventListener('mouseleave', startAutoSlide);