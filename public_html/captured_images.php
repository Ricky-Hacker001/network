<?php
$directory = "uploads/";
$images = glob($directory . "*.{jpg,png}", GLOB_BRACE);

foreach ($images as $image) {
    echo "<img src='$image' width='300' />";
}
?>
