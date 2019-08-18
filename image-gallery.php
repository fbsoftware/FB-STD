<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Simple Image Gallery</title>
<style type="text/css">
    .img-box{
        display: inline-block;
        text-align: center;
        margin: 0 15px;
    }
</style>
</head>
<body>
    <?php
    // Array containing sample image file names
    $images = array("admin.png", "test.png");
    
    // Loop through array to create image gallery
    foreach($images as $image){
        echo '<div class="img-box">';
            echo '<img src="images/' . $image . '" width="200" alt="' .  pathinfo($image, PATHINFO_FILENAME) .'">';
            echo '<button><a href="download.php?file=' . urlencode($image) . '">
			<img src="images/bottoni/download.png" width="50" alt="' .  pathinfo($image, PATHINFO_FILENAME) .'">
			</a></button>';
        echo '</div>';
    }
    ?>
</body>
</html>