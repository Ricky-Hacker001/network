<?php
$directory = "../uploads/";
$images = glob($directory . "*.{jpg,png}", GLOB_BRACE);

$response = [];
foreach ($images as $image) {
    $response[] = $image;
}

echo json_encode($response);
?>
