<?php
header('Content-Type: application/json');
$mysqli = new mysqli("localhost", "root", "", "web-explore");

// if ($mysqli->connect_error) {
//     die(json_encode(['success' => false, 'error' => 'Kết nối database thất bại']));
// }
if (isset($_POST['themdanhmuc'])) {
$article_id = $mysqli->real_escape_string($_POST['article_id']);
$name = $mysqli->real_escape_string($_POST['name']);
$comment = $mysqli->real_escape_string($_POST['comment']);

$sql = "INSERT INTO comments (article_id, user_name, content) VALUES ('$article_id', '$name', '$comment')";
if ($mysqli->query($sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $mysqli->error]);
}
}
$mysqli->close();
?>