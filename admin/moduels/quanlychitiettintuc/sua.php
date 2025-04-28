<?php
    $mysqli = new mysqli("localhost", "root", "", "web-explore");
    if ($mysqli->connect_error) {
        die("Kết nối thất bại: " . $mysqli->connect_error);
    }
    if (!isset($_GET['id'])) {
        die("Thiếu tham số ID bài viết");
    }
    $manh = $_GET['id'];
    $sql_sua = "SELECT * FROM tintucc WHERE idtintuc = '$manh'";
    $query_sua = mysqli_query($mysqli, $sql_sua);
    $row = mysqli_fetch_array($query_sua);
    
    // Lấy tất cả các block
    $sql_blocks = "SELECT * FROM chitiettintuc WHERE idtintuc = '$manh' ORDER BY sort_order ASC";
    $blocks_result = mysqli_query($mysqli, $sql_blocks);
    $blocks = [];
    while ($block = mysqli_fetch_assoc($blocks_result)) {
        $blocks[] = $block;
    }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="stylesheet" href="quanlychitietbaiviet/manh.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa tin tức</title>
    <!-- CSS styles remain the same -->
</head>
<body> 
    <div style="max-width: 800px; margin: 0 auto; padding: 20px;">
        <h2>Sửa bài viết</h2>
        <form action="quanlychitiettintuc/save_article.php" method="post" enctype="multipart/form-data">
            <div>
                <label>Tiêu đề bài viết</label>
                <input type="text" value="<?php echo $row['title']; ?>" name="title">
            </div>
            
            <div>
                <label>Hình ảnh hiện tại</label>
                <?php if(!empty($row['hinhanh'])): ?>
                    <div>
                        <img src="quanlychitiettintuc/uploads/<?php echo $row['hinhanh']; ?>" width="100px">
                        <input type="hidden" name="anh_cu" value="<?php echo $row['hinhanh']; ?>">
                    </div>
                <?php endif; ?>
            </div>
            
            <div>
                <label>Hình ảnh mới</label>
                <input type="file" name="hinhanh">
            </div>
            
            <div>
                <label>Mô tả</label>
                <input type="text" value="<?php echo $row['mota']; ?>" name="mota">
            </div>
            
            <input type="hidden" name="idtintuc" value="<?php echo $row['idtintuc']; ?>">
            
            <h3>Nội dung chi tiết</h3>
            <div id="blocks">
                <?php 
                // Hiển thị các block có sẵn
                $blockIndex = 0;
                foreach($blocks as $block): 
                ?>
                    <div class="block">
                        <div class="block-header">
                            <span class="block-type"><?php echo ($block['block_type'] === 'text') ? 'Đoạn văn' : 'Hình ảnh'; ?></span>
                            <button type="button" class="remove-block" onclick="this.parentNode.parentNode.remove()">
                                <i class="fas fa-times"></i> Xóa
                            </button>
                        </div>
                        <input type="hidden" name="blocks[<?php echo $blockIndex; ?>][type]" value="<?php echo $block['block_type']; ?>">
                        <input type="hidden" name="blocks[<?php echo $blockIndex; ?>][sort_order]" value="<?php echo $blockIndex; ?>">
                        
                        <?php if($block['block_type'] === 'text'): ?>
                            <textarea name="blocks[<?php echo $blockIndex; ?>][content]" required><?php echo htmlspecialchars($block['content']); ?></textarea>
                        <?php elseif($block['block_type'] === 'image'): ?>
                            <div style="margin-bottom: 10px;">
                                <label>Hình ảnh hiện tại:</label>
                                <?php if(!empty($block['image_url'])): ?>
                                    <div>
                                        <img src="quanlychitiettintuc/uploads/<?php echo $block['image_url']; ?>" style="max-width: 200px; max-height: 200px;">
                                        <input type="hidden" name="blocks[<?php echo $blockIndex; ?>][existing_image]" value="<?php echo $block['image_url']; ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label>Hình ảnh mới:</label>
                                <input type="file" name="blocks[<?php echo $blockIndex; ?>][image]" accept="image/*">
                            </div>
                            <div>
                                <label>Chú thích:</label>
                                <input type="text" name="blocks[<?php echo $blockIndex; ?>][caption]" value="<?php echo htmlspecialchars($block['caption']); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                <?php 
                    $blockIndex++;
                    endforeach; 
                ?>
            </div>
            
            <div class="block-actions">
                <button type="button" onclick="addTextBlock()">
                    <i class="fas fa-paragraph"></i> Thêm đoạn văn
                </button>
                <button type="button" onclick="addImageBlock()">
                    <i class="fas fa-image"></i> Thêm ảnh
                </button>
            </div>
            
            <div style="margin-top: 30px;">
                <input type="submit" name="suaCTtintuc" value="Lưu tin tức" style="padding: 10px 20px; font-size: 16px;">
            </div>
        </form>
    </div>
    
    <script>
        let blockIndex = <?php echo $blockIndex; ?>; // Tiếp tục từ số block hiện có

        // Các hàm JavaScript giữ nguyên
        function addTextBlock(content = '') {
            const div = document.createElement('div');
            div.className = 'block';
            div.innerHTML = `
                <div class="block-header">
                    <span class="block-type">Đoạn văn</span>
                    <button type="button" class="remove-block" onclick="this.parentNode.parentNode.remove()">
                        <i class="fas fa-times"></i> Xóa
                    </button>
                </div>
                <input type="hidden" name="blocks[${blockIndex}][type]" value="text">
                <input type="hidden" name="blocks[${blockIndex}][sort_order]" value="${blockIndex}">
                <textarea name="blocks[${blockIndex}][content]" required>${content}</textarea>
            `;
            document.getElementById('blocks').appendChild(div);
            blockIndex++;
        }

        function addImageBlock(imageUrl = '', caption = '') {
            const div = document.createElement('div');
            div.className = 'block';
            div.innerHTML = `
                <div class="block-header">
                    <span class="block-type">Hình ảnh</span>
                    <button type="button" class="remove-block" onclick="this.parentNode.parentNode.remove()">
                        <i class="fas fa-times"></i> Xóa
                    </button>
                </div>
                <input type="hidden" name="blocks[${blockIndex}][type]" value="image">
                <input type="hidden" name="blocks[${blockIndex}][sort_order]" value="${blockIndex}">
                <div style="margin-bottom: 10px;">
                    <label>Hình ảnh:</label>
                    <input type="file" name="blocks[${blockIndex}][image]" accept="image/*">
                    ${imageUrl ? `<input type="hidden" name="blocks[${blockIndex}][existing_image]" value="${imageUrl}">` : ''}
                </div>
                <div>
                    <label>Chú thích:</label>
                    <input type="text" name="blocks[${blockIndex}][caption]" value="${caption}">
                </div>
                ${imageUrl ? `<div style="margin-top: 10px;">
                    <img src="quanlychitietbaiviet/uploads/${imageUrl}" style="max-width: 200px; max-height: 200px;">
                </div>` : ''}
            `;
            document.getElementById('blocks').appendChild(div);
            blockIndex++;
        }
    </script>
    
    <!-- Thêm Font Awesome cho icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>
</html>