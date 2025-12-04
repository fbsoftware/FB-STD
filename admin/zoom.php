<<?php 

?>
!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://fbsoftware.github.io/FB-CODE/css/stili-custom.css">
<style>
* {box-sizing: border-box;}

.img-zoom-container {
  position: relative;
}

.img-zoom-lens {
  position: absolute;
  border: 1px solid #d4d4d4;
  width: 40px;/*set the size of the lens:*/
  height: 40px;
}

.img-zoom-result {
  border: 1px solid #d4d4d4;
  width: 300px;/*set the size of the result div:*/
  height: 240px;
}
</style>

<script>
function imageZoom(imgID, resultID) {
  var img, lens, result, cx, cy;
  img = document.getElementById(imgID);
  result = document.getElementById(resultID);
  /*create lens:*/
  lens = document.createElement("DIV");
  lens.setAttribute("class", "img-zoom-lens");
  /*insert lens:*/
  img.parentElement.insertBefore(lens, img);
  /*calculate the ratio between result DIV and lens:*/
  cx = result.offsetWidth / lens.offsetWidth;
  cy = result.offsetHeight / lens.offsetHeight;
  /*set background properties for the result DIV:*/
  result.style.backgroundImage = "url('" + img.src + "')";
  result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
  /*execute a function when someone moves the cursor over the image, or the lens:*/
  lens.addEventListener("mousemove", moveLens);
  img.addEventListener("mousemove", moveLens);
  /*and also for touch screens:*/
  lens.addEventListener("touchmove", moveLens);
  img.addEventListener("touchmove", moveLens);

  function moveLens(e) {
    var pos, x, y;
    /*prevent any other actions that may occur when moving over the image:*/
    e.preventDefault();
    /*get the cursor's x and y positions:*/
    pos = getCursorPos(e);
    /*calculate the position of the lens:*/
    x = pos.x - (lens.offsetWidth / 2);
    y = pos.y - (lens.offsetHeight / 2);
    /*prevent the lens from being positioned outside the image:*/
    if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
    if (x < 0) {x = 0;}
    if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
    if (y < 0) {y = 0;}
    /*set the position of the lens:*/
    lens.style.left = x + "px";
    lens.style.top = y + "px";
    /*display what the lens "sees":*/
    result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
  }
  function getCursorPos(e) {
    var a, x = 0, y = 0;
    e = e || window.event;
    /*get the x and y positions of the image:*/
    a = img.getBoundingClientRect();
    /*calculate the cursor's x and y coordinates, relative to the image:*/
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /*consider any page scrolling:*/
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
}
</script>
</head>
<body>

<h1>Image Zoom</h1>

<p>Passa il mouse sull'immagine per ingrandire:</p>

<?php
/* cerca immagine zoomabile da pubblicare /*  FROM `".DB::$pref."zim`
                WHERE ztmp = '".TMP::$tcod."'
                              and zstat <> 'A'
				        AND zcod = '$lcod'  
                ORDER BY zprog ";
                
                <?php echo $zimg; ?>
                */
       $sql = "SELECT * FROM `prefix_zim`
                WHERE ztmp = 'blog'
                              and zstat <> 'A'
				        AND zcod = 'ttmmpp'  
                ORDER BY zprog ";
              
     foreach($PDO->query($sql) as $row)
  print_r($row);
     {
        require 'admin/fields_zim.php'; 
    ?>
        <div class="img-zoom-container f-flex fd-row jc-between fw fb-secondary">
          <div><img id="myimage" src="images/trota.jpg" width="70%" /></div>
          <div id="myresult" class="img-zoom-result"></div>
        </div>
  <?php }?>      
  
<script>
// Initiate zoom effect:
imageZoom("myimage", "myresult");
</script>

</body>
</html>
<?php ?>