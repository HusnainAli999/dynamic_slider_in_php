<?php include "config.php"; require "css.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="input_handler_div">
            <button type="button" class="s_img_btn">Chose Slider Images</button>
            <input type="file" name="sliderimage[]" multiple>
        </div>
        <button type="submit">Submit Files</button>
    </form>
</body>

</html>

<?php
$lastInsertId = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $directory = "uploads/";
    $uploadedFiles = [];

    foreach ($_FILES['sliderimage']['name'] as $index => $filename) {
        $tmpname = $_FILES['sliderimage']['tmp_name'][$index];

        $targetFile = $directory . basename($filename);

        if (empty($_FILES['sliderimage']['name'][0])) {
            echo "<h1 class='alert_h1'> Please Select At Least One Image </h1>";
            exit;
        }

        if (count($_FILES['sliderimage']['name']) > 2) {
            echo "<h1 class='alert_h1'> Images Cannot More Then 2 </h1>";
            exit;
        }

        if (!move_uploaded_file($tmpname, $targetFile)) {
            echo "<h1 class='alert_h1'> File $filename failed to move to folder </h1> <br>";
        } else {
            $uploadedFiles[] = $targetFile;
        }
    }

    $file = implode(", ", $uploadedFiles);

    $filesExtensions = pathinfo($file, PATHINFO_EXTENSION);
    $allowedExtensions = ["jpg", "jpeg", "png"];

    if (!in_array($filesExtensions, $allowedExtensions)) {
        echo "<h1 class='alert_h1'> Only JPG, JPEG and PNG Extensions Allowed</h1>";
        exit;
    }

    if (!empty($uploadedFiles)) {
        $insertStmt = mysqli_prepare($conn, "INSERT INTO products_table (slider_images) VALUES (?)");
        $insertStmt->bind_param("s", $file);
        $insertStmt->execute();
        $lastInsertId = $conn->insert_id;

        $updateStmt = mysqli_prepare($conn, "UPDATE save_product_id SET product_id = ? WHERE temp_id = ?");
        $staticIdForSaveProductId = 1;
        $updateStmt->bind_param("ii", $lastInsertId, $staticIdForSaveProductId);
        $updateStmt->execute();
    }
}

$select = mysqli_prepare($conn, "SELECT save_product_id.*, products_table.* FROM products_table
INNER JOIN save_product_id ON save_product_id.product_id = products_table.id");
$select->execute();
$result = $select->get_result();

echo " <div class='slideshow-container'>";
while ($row = mysqli_fetch_assoc($result)) {

    $id = $row['id'];

    $sliderImages = explode(", ", $row['slider_images']);

    $stringSliderImages = implode(", ", $sliderImages);

    if (!empty($sliderImages[0])) {
        echo '<div class="mySlides fade">';
        echo "<img src='" . $sliderImages[0] . "'  />";
        echo "<a href='update_slider_images.php?id=$id&imageIndex=0&data=$stringSliderImages' class='update_img_a' >Update Image</a>";
        echo '</div>';
    }

    if (!empty($sliderImages[1])) {
        echo '<div class="mySlides fade">';
        echo "<img src='" . $sliderImages[1] . "'  />";
        echo "<a href='update_slider_images.php?id=$id&imageIndex=1&data=$stringSliderImages' class='update_img_a' >Update Image</a>";
        echo '</div>';
    }
}
echo '
<a class="prev" onclick="plusSlides(-1)">❮</a>
<a class="next" onclick="plusSlides(1)">❯</a>
';
echo "</div>";
?>
<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.transform = "scale(0)";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.transform = "scale(1)";
        dots[slideIndex - 1].className += " active";
    }
</script>