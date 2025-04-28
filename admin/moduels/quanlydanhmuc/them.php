<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>thêm danh mục sản phẩm</p>

<form action="moduels/quanlydanhmuc/xuly.php" method="POST">
    <table>
        <tr>
            <td>Tên danh mục</td>
            <td><input type="text" name="tend   anhmuc"></td>
        </tr>
        <tr>
            <td>Thứ tự</td>
            <td><input type="text" name="thutu"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="them" value="Thêm danh mục"></td>
        </tr>
    </table>
</form>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>thêm danh mục sản phẩm</p>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm danh mục sản phẩm</title>
</head>
<body>
    <h2>Thêm danh mục sản phẩm</h2>
    <form action="quanlydanhmuc/xuly.php" method="POST" enctype="multipart/form-data">

    <!-- <form action="quanlydanhmuc/xuly.php"method="POST"> -->
        <table border="1" width="50%" style="border-collapse: collapse;">
            <tr>
                <td><label for="IDdanhmuc">ID danh mục</label></td>
                <td><input type="text" id="iddanhmuc" name="iddanhmuc" required></td>
            </tr>
            <tr> 
                <td><label for="tendanhmuc">Tên danh mục</label></td>
                <td><input type="text" id="tendanhmuc" name="tendanhmuc" required></td>
            </tr>
            <tr>
                <td><label for="thutu">Thứ tự</label></td>
                <td><input type="number" id="thutu" name="thutu" required></td>
            </tr>
            <tr>
                <td><label for="hinhanh">Hình ảnh</label></td>
                <td><input type="file" id="anh" name="anh" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" name="themdanhmuc" value="Thêm danh mục">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

</form>
</body>
</html>