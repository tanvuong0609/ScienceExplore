<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm bài viết</title>
    <style>
        .block {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f8f9fa;
            position: relative;
        }
        .block-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .block-type {
            font-weight: bold;
            color: #495057;
        } 
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        textarea {
            min-height: 100px;
        }
        button, input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
            font-size: 14px;
        }
        button:hover, input[type="submit"]:hover {
            background-color: #218838;
        }
        .remove-block {
            background-color: #dc3545;
        }
        .remove-block:hover {
            background-color: #c82333;
        }
        #blocks {
            margin-bottom: 20px;
        }
        .block-actions {
            margin-top: 20px;
        }
    </style>
</head> 
<body> 
    <div style="max-width: 800px; margin: 0 auto; padding: 20px;">
        <h2>Thêm bài viết mới</h2>
        <form action="quanlychitietbaiviet/save_article.php" method="post" enctype="multipart/form-data">
            <div style="margin-bottom: 20px;">
                <label for="iddanhmuc">ID danh mục:</label>
                <input type="text" id="iddanhmuc" name="iddanhmuc" required style="padding: 10px; font-size: 16px;">
            </div>
            <div style="margin-bottom: 20px;">
                <label for="title">Tiêu đề bài viết:</label>
                <input type="text" id="title" name="title" required style="padding: 10px; font-size: 16px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="anh">Hình ảnh:</label>
                <input type="file" id="anh" name="anh" required style="padding: 10px; font-size: 16px;">
            </div>
            <div style="margin-bottom: 20px;">
                <label for="title">Mô tả:</label>
                <input type="text" id="mota" name="mota" required style="padding: 10px; font-size: 16px;">
            </div>


            <div id="blocks"></div>
            
            <div class="block-actions">
                <button type="button" onclick="addTextBlock()">
                    <i class="fas fa-paragraph"></i> Thêm đoạn văn
                </button>
                <button type="button" onclick="addImageBlock()">
                    <i class="fas fa-image"></i> Thêm ảnh
                </button>
            </div>
            
            <div style="margin-top: 30px;">
                <input type="submit" name="themCTbaiviet" value="Lưu bài viết" style="padding: 10px 20px; font-size: 16px;">
            </div>
        </form>
    </div> 
    <script>
        let blockIndex = 0;

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
                    <input type="file" name="blocks[${blockIndex}][image]" accept="image/*" ${imageUrl ? '' : 'required'}>
                    ${imageUrl ? `<input type="hidden" name="blocks[${blockIndex}][existing_image]" value="${imageUrl}">` : ''}

                  
                </div>
                <div>
                    <label>Chú thích:</label>
                    <input type="text" name="blocks[${blockIndex}][caption]" value="${caption}">
                </div>
                ${imageUrl ? `<div style="margin-top: 10px;">
                    <img src="quanlychitiettintuc/uploads/${imageUrl}" style="max-width: 200px; max-height: 200px;">
                </div>` : ''}
            `;
            document.getElementById('blocks').appendChild(div);
            blockIndex++;
        }

        window.onload = function() {
            addTextBlock(); // Thêm sẵn một đoạn văn khi tải trang
        }
    </script>
    
    <!-- Thêm Font Awesome cho icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>
</html>