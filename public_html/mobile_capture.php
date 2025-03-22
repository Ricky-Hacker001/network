<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $upload_dir = 'uploads/';
    $file_name = $upload_dir . time() . "_" . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $file_name)) {
        echo json_encode(["status" => "success", "message" => "Image uploaded."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Upload failed."]);
    }
}
?>
