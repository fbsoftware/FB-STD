<?php
/* ----------------------------------------
	04/05/24    modulo immagine zoomabile
------------------------------------------- */
echo	"<section id='imgzoom'>";
?>
<style>
    .img-zoom-container {
    position: relative;
    display: flex;
  }
  
  .img-zoom-lens {
    position: absolute;
    border: 1px solid #d4d4d4;  
    /*set the size of the lens:*/
    width: 50px;
    height: 50px;
  }
  
  .img-zoom-result {
    border: 1px solid #d4d4d4;
    float:right;
    /*set the size of the result div:*/
    width: 400px;
    height:400px;
    margin-right: 100px;
  }
  #myimage  {
    margin-left: 100px;
  }
</style>
  <script>
  $( function() {
  $( ".fb-primary p" ).addClass('fb-primary');
    $( ".fb-primary h1" ).addClass('fb-primary');
  } );
  </script>
  <script>/* zoom parziale su immagine */
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
    }</script>
<?php
// cerca immagine zoomabile da pubblicare
echo "<div class='f-flex fd-row jc-between fw fb-secondary'>";		// flex
        $sql = "SELECT *
                FROM `".DB::$pref."zim`
                WHERE ztmp = '".TMP::$tcod."'
                    and zstat <> 'A'
				        AND zcod = '$lcod'  
                ORDER BY zprog ";
     foreach($PDO->query($sql) as $row)

     {
        require 'admin/fields_zim.php'; 
    ?>
        <div class="img-zoom-container">
          <div><img id="myimage" src="<?php echo $zimg; ?>" width="70%"" /></div>
          <div id="myresult" class="img-zoom-result"></div>
        </div>
        
    <?php 
     } 
    
echo "</div>";     // flex

?>
<script>
imageZoom("myimage", "myresult");
</script>
</section>