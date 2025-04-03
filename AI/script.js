document.addEventListener("DOMContentLoaded", function () {
  // Hiệu ứng fade-in khi cuộn xuống
  const articles = document.querySelectorAll("article");

  const fadeInOnScroll = () => {
    articles.forEach((article) => {
      const articlePosition = article.getBoundingClientRect().top;
      const screenPosition = window.innerHeight / 1.2;

      if (articlePosition < screenPosition) {
        article.classList.add("show");
      } else {
        article.classList.remove("show"); // Gỡ class để hiệu ứng chạy lại khi cuộn
      }
    });
  };

  window.addEventListener("scroll", fadeInOnScroll);
  fadeInOnScroll(); // Kích hoạt ngay khi trang tải xong

  // Hiệu ứng đổi màu header khi di chuột
  const header = document.querySelector("header");
  header.addEventListener("mouseenter", () => {
    header.style.backgroundColor = "#ffcc00";
    header.style.color = "#000";
  });

  header.addEventListener("mouseleave", () => {
    header.style.backgroundColor = "";
    header.style.color = "";
  });

  // Cuộn mượt khi nhấp vào liên kết
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));

      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    });
  });
});
