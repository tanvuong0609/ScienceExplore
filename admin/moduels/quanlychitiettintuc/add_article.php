<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm bài viết</title>
    <style>
        .block {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button, input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }
        button:hover, input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Thêm bài viết</h2>
    <form action="quanlychitiettintuc/save_article.php" method="post" enctype="multipart/form-data">
        <label for="title">Tiêu đề bài viết:</label><br>
        <input type="text" id="title" name="title" required><br><br>
        
        <div id="blocks"></div>
        
        <button type="button" onclick="addTextBlock()">+ Thêm đoạn văn</button>
        <button type="button" onclick="addImageBlock()">+ Thêm ảnh</button><br><br>
        
        <input type="submit" name="themCTtintuc" value="Lưu bài viết">
    </form>
    
    <script>
        let blockIndex = 0;
        
        function addTextBlock() {
            const div = document.createElement('div');
            div.className = 'block';
            div.innerHTML = `
                <input type="hidden" name="blocks[${blockIndex}][type]" value="text">
                <label>Đoạn văn:</label><br>
                <textarea name="blocks[${blockIndex}][content]" rows="4" cols="50" required></textarea>
                <button type="button" onclick="this.parentNode.remove()">Xóa</button>
            `;
            document.getElementById('blocks').appendChild(div);
            blockIndex++;
        }
        
        function addImageBlock() {
            const div = document.createElement('div');
            div.className = 'block';
            div.innerHTML = `
                <label>Ảnh:</label><br>
                <input type="file" name="image_${blockIndex}" accept="image/*" required><br>
                <label>Chú thích:</label><br>
                <input type="text" name="caption_${blockIndex}">
                <button type="button" onclick="this.parentNode.remove()">Xóa</button>
            `;
            document.getElementById('blocks').appendChild(div);
            blockIndex++;
        }
        
        // Thêm sẵn một block đoạn văn khi trang được tải
        window.onload = function() {
            addTextBlock();
        }
    </script>
</body>
</html>