<!-- Right Sidebar (Optional) -->
<!-- <aside class="right-sidebar">
                    <div class="popular-posts">
                        <h3>Bài viết phổ biến</h3>
                        <ul>
                            <li><a href="#">Top 10 phát minh khoa học năm 2024</a></li>
                            <li><a href="#">Cuộc sống trên sao Hỏa: Có thể hay không?</a></li>
                            <li><a href="#">Trí tuệ nhân tạo và tương lai của nhân loại</a></li>
                            <li><a href="#">Bí ẩn của vật chất tối trong vũ trụ</a></li>
                        </ul>
                    </div>
                </aside> -->

                <!-- Right Sidebar -->
<div class="right-sidebar">
    <div class="popular-posts">
        <h3>Tin tức mới nhất</h3>
        <ul>
            <?php
            // Kết nối đến cơ sở dữ liệu
            include("admin/config.php");
            
            // Truy vấn để lấy các bài viết tin tức mới nhất
            $sql = "SELECT * FROM tintucc ORDER BY idtintuc DESC LIMIT 5";
            $query = mysqli_query($mysqli, $sql);
            
            while($row = mysqli_fetch_array($query)) {
            ?>
            <li class="news-item">
                <div class="news-thumbnail">
                    <img src="images/anh1.jpg" alt="">
                    <!-- <img src="images/<?php echo $row['hinhanh']; ?>" alt="<?php echo $row['title']; ?>"> -->
                </div>
                <div class="news-content">
                    <a href="?page=tintuc&id=<?php echo $row['idtintuc']; ?>">
                        <h4><?php echo $row['title']; ?></h4>
                    </a>
                    <p><?php echo substr($row['mota'], 0, 100).'...'; ?></p>
                </div>
            </li>
            <?php
            }
            ?>
        </ul>
        
        <h3 class="second-heading">Tin tức thời sự</h3>
        <ul>
            <li>
                <div class="news-item">
                    <div class="news-thumbnail">
                        <img src="images/anh1.jpg" alt="Quảng Nam">
                    </div>
                    <div class="news-content">
                        <a href="#">
                            <h4>Quảng Nam giảm tiếp còn 78 xã khi hợp nhất với Đà Nẵng</h4>
                        </a>
                        <p>HĐND tỉnh Quảng Nam thông qua nghị quyết tán thành chủ trương sáp xếp 78 xã phường khi sáp nhập với TP Đà Nẵng, giảm 10 xã so với phương án ban đầu.</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="news-item">
                    <div class="news-thumbnail">
                        <img src="images/anh1.jpg" alt="Thứ trưởng">
                    </div>
                    <div class="news-content">
                        <a href="#">
                            <h4>Trung tướng Nguyễn Hồng Thái làm Thứ trưởng Quốc phòng</h4>
                        </a>
                        <p>Thủ tướng quyết định bổ nhiệm trung tướng Nguyễn Hồng Thái, Tư lệnh Quân khu 1, giữ chức Thứ trưởng Quốc phòng.</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>