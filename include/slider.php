<?php //  carousel slider     
?>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
		<script "text/javascript" src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
<style type="text/css">
div.sli-tit{
color:white;
font-size:2em;
}
div.sli-text{
color:white;
font-size:1em;
}
.bx-wrapper		{
background:var(--bg-color) !important;
margin-bottom:50px;	
border:none;
}
.scrim {
	position:relative;
	left:500px;	
	bottom:300px;
	background-color: rgba(0, 0, 0, .2);
	box-shadow: 0 0 5rem rgba(0, 0, 0, .6);
	width: fit-content;
}
img.slide{
	width:100%;
}
</style>
<?php		
echo "<section id='slider'>";
           
echo "<div class='slider fb-content'>";

// lettura slide
        $sql = "SELECT *
                FROM `".DB::$pref."sld`
                WHERE slcod = '$lcod'
                    and sltmp= '".TMP::$tmenu."' 
                    and slstat <> 'A' 
                ORDER BY slprog ";
          foreach($PDO->query($sql) as $row)
		{    
           echo "<div style='position:absolute;'>";	
           echo "<img class='slide' src='".$row['slimg']."'  alt='".$row['slimg']."' title='".$row['slalt']."' >";
		   echo "<div class='scrim fb-rad7 fb-p1 fb-wfit'>";
		   echo "<div class='sli-tit'>";
		   echo $row['slcaption'];
		   echo	"</div>";
		   echo "<div class='sli-text'>";
		   echo $row['sldesc'];
		   echo	"</div>";
		   echo	"</div>";	// scrim
		   echo	"</div>";   // img
		}  
echo	"</div>";   // slider
?>
        <script>
            $('.slider').bxSlider({
                autoControls: true,
                auto: true,
                pager: false,
           /*     slideWidth: 1270*/
                mode: 'fade',
                captions: false,
                speed: '<?php echo TMP::$tslidetime ?>'
            });
        </script>
<?php		
echo "</section>";
?>  