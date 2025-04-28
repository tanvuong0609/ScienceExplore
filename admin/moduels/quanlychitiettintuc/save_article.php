<?php 
// Kết nối database
$mysqli = new mysqli("localhost", "root", "", "web-explore");
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}
 
// Xử lý khi form được submit
if (isset($_POST['themCTtintuc'])) {
    $idtintuc = $mysqli->real_escape_string($_POST['idtintuc']);
    $title = $mysqli->real_escape_string($_POST['title']);
    $mota = $mysqli->real_escape_string($_POST['mota']);
    
    // Xử lý upload ảnh chính
    // $hinhanh = '';
    // if(isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
    //     $upload_dir = 'quanlychitietbaiviet/uploads/';
    //     if (!file_exists($upload_dir)) {
    //         mkdir($upload_dir, 0777, true);
    //     }
        
    //     $hinhanh = uniqid() . '_' . basename($_FILES['anh']['name']);
    //     $target_file = $upload_dir . $hinhanh;
        
    //     if (!move_uploaded_file($_FILES['anh']['tmp_name'], $target_file)) {
    //         die("Lỗi khi upload file ảnh");
    //     }
    // }
    $hinhanh = '';
if(isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
    $upload_dir = 'uploads/'; // Local path
    $full_upload_dir = __DIR__ . '/' . $upload_dir; // Full server path
    
    if (!file_exists($full_upload_dir)) {
        mkdir($full_upload_dir, 0777, true);
    }
    
    $hinhanh = uniqid() . '_' . $_FILES['anh']['name'];
    $hinhanh_tmp = $_FILES['anh']['tmp_name'];
    $target_path = $full_upload_dir . $hinhanh;
    
    // For debugging
    echo "Upload path: " . $target_path . "<br>";
    echo "Temp file exists: " . (file_exists($hinhanh_tmp) ? 'Yes' : 'No') . "<br>";
    echo "Upload dir exists: " . (file_exists($full_upload_dir) ? 'Yes' : 'No') . "<br>";
    echo "Upload dir is writable: " . (is_writable($full_upload_dir) ? 'Yes' : 'No') . "<br>";
    
    if(move_uploaded_file($hinhanh_tmp, $target_path)) {
        echo "File uploaded successfully!";
    } else {
        echo "File upload failed with error code: " . $_FILES['anh']['error'];
    }
}
    
    // 1. Lưu thông tin chung bài viết
    $sql = "INSERT INTO tintucc (idtintuc, title, hinhanh,mota) VALUES ('$idtintuc', '$title', '$hinhanh','$mota')";
    if ($mysqli->query($sql)) {
        $article_id = $mysqli->insert_id;
         
        // 2. Lưu các block nội dung
        if (!empty($_POST['blocks'])) {
            foreach ($_POST['blocks'] as $block) {
                $block_type = $mysqli->real_escape_string($block['type']);
                $sort_order = (int)$block['sort_order'];
                $content = $mysqli->real_escape_string($block['content'] ?? '');
                $caption = $mysqli->real_escape_string($block['caption'] ?? '');
                $image_url = '';
                
                // Xử lý upload ảnh cho block
                if ($block_type === 'image' && !empty($_FILES['blocks']['tmp_name'][$sort_order]['image'])) {
                    $file_name = uniqid() . '_' . basename($_FILES['blocks']['name'][$sort_order]['image']);
                    $target_file = $upload_dir . $file_name;
                    
                    if (move_uploaded_file($_FILES['blocks']['tmp_name'][$sort_order]['image'], $target_file)) {
                        $image_url = $file_name;
                    }
                }
                
                $sql = "INSERT INTO chitiettintuc
                        (idtintuc,article_id, block_type, content, image_url, caption, sort_order) 
                        VALUES 
                        ('$idtintuc','$article_id', '$block_type', '$content', '$image_url', '$caption', '$sort_order')";
                $mysqli->query($sql);
            }
        }
        
        header("Location: ../index.php?action=quanlychitiettintuc&success=1");
        exit();
    } else {
        echo "Lỗi: " . $mysqli->error;
    }
}


?>
<!-- xóa bài viết -->
 <?php
// XÓA tin tức
// Kiểm tra xem có tham số id được truyền vào không
if (isset($_GET['id'])) {
    $id = $mysqli->real_escape_string($_GET['id']);
    
    // Lấy thông tin bài viết trước khi xóa để xóa ảnh
    $sql_info = "SELECT hinhanh FROM tintucc WHERE idtintuc = '$id'";
    $result = $mysqli->query($sql_info);
    $article = $result->fetch_assoc();
    
    // Lấy thông tin các block để xóa ảnh
    $sql_blocks = "SELECT image_url FROM chitiettintuc WHERE idtintuc = '$id' AND block_type = 'image'";
    $blocks_result = $mysqli->query($sql_blocks);
    
    // Xóa các block thuộc bài viết trước
    $sql_delete_blocks = "DELETE FROM chitiettintuc WHERE idtintuc = '$id'";
    if ($mysqli->query($sql_delete_blocks)) {
        // Sau đó xóa bài viết
        $sql_delete_article = "DELETE FROM tintucc WHERE idtintuc = '$id'";
        if ($mysqli->query($sql_delete_article)) {
            // Xóa ảnh chính nếu có
            if (!empty($article['hinhanh'])) {
                $upload_dir = __DIR__ . '/uploads/';
                $image_path = $upload_dir . $article['hinhanh'];
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            
            // Xóa ảnh trong các block
            while ($block = $blocks_result->fetch_assoc()) {
                if (!empty($block['image_url'])) {
                    $block_image_path = __DIR__ . '/uploads/' . $block['image_url'];
                    if (file_exists($block_image_path)) {
                        unlink($block_image_path);
                    }
                }
            }
            
            // Chuyển hướng về trang danh sách với thông báo thành công
            header("Location: ../index.php?action=quanlychitiettintuc&success=3");
            exit();
        } else {
            echo "Lỗi khi xóa bài viết: " . $mysqli->error;
        }
    } else {
        echo "Lỗi khi xóa các block: " . $mysqli->error;
    }
} else {
    echo "Không có ID bài viết được cung cấp để xóa";
}

// $mysqli->close();
?>



<!-- sửa bài viết  -->

<?php
if (isset($_POST['suaCTtintuc'])) {
    $idtintuc = $mysqli->real_escape_string($_POST['idtintuc']);
    $title = $mysqli->real_escape_string($_POST['title']);
    $mota = $mysqli->real_escape_string($_POST['mota']);
    
    // Xử lý upload ảnh chính mới (nếu có)
    $hinhanh = $_POST['anh_cu']; // Giữ ảnh cũ mặc định
    
    if(isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == 0) {
        $upload_dir = 'uploads/'; // Local path
        $full_upload_dir = __DIR__ . '/' . $upload_dir; // Full server path
        
        if (!file_exists($full_upload_dir)) {
            mkdir($full_upload_dir, 0777, true);
        }
        
        $hinhanh = uniqid() . '_' . $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $target_path = $full_upload_dir . $hinhanh;
        
        if(move_uploaded_file($hinhanh_tmp, $target_path)) {
            // Nếu upload thành công, xóa ảnh cũ (nếu có)
            if(!empty($_POST['anh_cu'])) {
                $old_image_path = $full_upload_dir . $_POST['anh_cu'];
                if(file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }
        } else {
            echo "Lỗi khi upload hình ảnh chính mới. Error code: " . $_FILES['hinhanh']['error'];
        }
    }
    
    // 1. Cập nhật thông tin chung bài viết
    $sql = "UPDATE tintucc SET title = '$title', hinhanh = '$hinhanh', mota = '$mota' WHERE idtintuc = '$idtintuc'";
    
    if ($mysqli->query($sql)) {
        // 2. Xóa các block nội dung cũ
        $sql_delete = "DELETE FROM chitiettintuc WHERE idtintuc = '$idtintuc'";
        $mysqli->query($sql_delete);
        
        // 3. Thêm các block nội dung mới
        if (!empty($_POST['blocks'])) {
            foreach ($_POST['blocks'] as $block) {
                $block_type = $mysqli->real_escape_string($block['type']);
                $sort_order = (int)$block['sort_order'];
                $content = $mysqli->real_escape_string($block['content'] ?? '');
                $caption = $mysqli->real_escape_string($block['caption'] ?? '');
                $image_url = '';
                
                // Xử lý nếu có ảnh cũ
                if(isset($block['existing_image'])) {
                    $image_url = $block['existing_image'];
                }
                
                // Xử lý upload ảnh mới cho block
                if ($block_type === 'image' && !empty($_FILES['blocks']['tmp_name'][$sort_order]['image'])) {
                    $upload_dir = 'uploads/';
                    $full_upload_dir = __DIR__ . '/' . $upload_dir;
                    
                    $file_name = uniqid() . '_' . basename($_FILES['blocks']['name'][$sort_order]['image']);
                    $target_file = $full_upload_dir . $file_name;
                    
                    if (move_uploaded_file($_FILES['blocks']['tmp_name'][$sort_order]['image'], $target_file)) {
                        // Nếu có ảnh cũ và upload thành công, xóa ảnh cũ
                        if(!empty($image_url)) {
                            $old_block_image = $full_upload_dir . $image_url;
                            if(file_exists($old_block_image)) {
                                unlink($old_block_image);
                            }
                        }
                        $image_url = $file_name;
                    }
                }
                
                // Thêm block mới vào database
                $article_id = $iddanhmuc; // Trong trường hợp này article_id và iddanhmuc có vẻ giống nhau theo code của bạn
                $sql = "INSERT INTO chitiettintuc
                        (idtintuc, article_id, block_type, content, image_url, caption, sort_order) 
                        VALUES 
                        ('$idtintuc', '$article_id', '$block_type', '$content', '$image_url', '$caption', '$sort_order')";
                $mysqli->query($sql);
            }
        }
        
        header("Location: ../index.php?action=quanlychitiettintuc&success=2");
        exit();
    } else {
        echo "Lỗi khi cập nhật bài viết: " . $mysqli->error;
    }
}

$mysqli->close();
?>