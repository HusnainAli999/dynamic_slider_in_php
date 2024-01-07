<?php
include "config.php";
include "css.php";


echo "Image data : " . $_GET['data'] . "<br>";
echo "id : " . $_GET['id'] . "<br>";
echo "index : " . $_GET['imageIndex'] . "<br>";

$data = explode(", ", $_GET['data']);

if (isset($_POST['update_image_btn'])) {

    $file = basename($_FILES['update_slider_image']['name']);
    $tmp_file = $_FILES['update_slider_image']['tmp_name'];

    $targetFileData = "uploads/" . $file;

    $data[$_GET['imageIndex']] = "uploads/" . $file;

    $data = implode(", ", $data);

    if(!move_uploaded_file($tmp_file, $targetFileData)) {
        echo "Image Failed to move in folder";
        exit;
    }

    $stmt = mysqli_prepare($conn, "UPDATE products_table SET slider_images = ? WHERE id = ?");
    $stmt->bind_param("si", $data, $_GET['id']);
    if ($stmt->execute()) {
        echo "<script> window.location.href='index.php' </script>";
    }
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="update_slider_image">
    <button type="submit" name="update_image_btn">Update Image</button>
</form>