const express = require("express");
const mysql = require("mysql");
const bcrypt = require("bcryptjs");
const cors = require("cors");
const bodyParser = require("body-parser");
require("dotenv").config();

const app = express();
const port = 3000;

// Cấu hình CORS
app.use(cors());
app.use(bodyParser.json());

// Kết nối MySQL
const db = mysql.createConnection({
  host: "localhost",
  user: "root", // Thay bằng user của bạn
  password: "", // Thay bằng password của bạn
  database: "userdb",
});

db.connect((err) => {
  if (err) throw err;
  console.log("✅ Kết nối MySQL thành công!");
});

// API đăng ký
app.post("/register", async (req, res) => {
  const { username, email, password } = req.body;
  if (!username || !email || !password) {
    return res.status(400).json({ message: "Vui lòng nhập đầy đủ thông tin." });
  }

  const hashedPassword = await bcrypt.hash(password, 10);

  const sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
  db.query(sql, [username, email, hashedPassword], (err, result) => {
    if (err) return res.status(500).json({ message: "Lỗi khi đăng ký." });
    res.json({ message: "Đăng ký thành công!" });
  });
});

// API đăng nhập
app.post("/login", (req, res) => {
  const { username, password } = req.body;

  const sql = "SELECT * FROM users WHERE username = ?";
  db.query(sql, [username], async (err, results) => {
    if (err) return res.status(500).json({ message: "Lỗi server" });
    if (results.length === 0)
      return res.status(401).json({ message: "Tài khoản không tồn tại." });

    const user = results[0];
    const isMatch = await bcrypt.compare(password, user.password);
    if (!isMatch) return res.status(401).json({ message: "Sai mật khẩu." });

    res.json({ message: "Đăng nhập thành công!" });
  });
});

// Chạy server
app.listen(port, () => {
  console.log(`🚀 Server chạy tại http://localhost:${port}`);
});
