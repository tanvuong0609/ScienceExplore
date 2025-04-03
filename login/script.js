const container = document.querySelector(".container");
const registerBtn = document.querySelector(".register-btn");
const loginBtn = document.querySelector(".login-btn");

registerBtn.addEventListener("click", () => {
  container.classList.add("active");
});

loginBtn.addEventListener("click", () => {
  container.classList.remove("active");
});

document.addEventListener("DOMContentLoaded", function () {
  // Form đăng nhập
  document.getElementById("loginForm").addEventListener("submit", async function (event) {
      event.preventDefault();
      const username = document.getElementById("login-username").value;
      const password = document.getElementById("login-password").value;

      const response = await fetch("/login", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ username, password }),
      });

      const data = await response.json();
      document.getElementById("loginMessage").innerText = data.message;

      if (response.ok) {
          window.location.href = "/dashboard.html"; // Chuyển hướng sau khi đăng nhập thành công
      }
  });

  // Form đăng ký
  document.getElementById("registerForm").addEventListener("submit", async function (event) {
      event.preventDefault();
      const username = document.getElementById("register-username").value;
      const email = document.getElementById("register-email").value;
      const password = document.getElementById("register-password").value;

      const response = await fetch("/register", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ username, email, password }),
      });

      const data = await response.json();
      document.getElementById("registerMessage").innerText = data.message;
  });
});