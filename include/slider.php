<?php //  carousel slider     
?>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
		<script "text/javascript" src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
<style type="text/css">
div.sli-tit{
position:relative;
left:100px;	
bottom:330px;
color:white;
font-size:2em;
}
div.sli-text{
position:relative;
left:100px;	
bottom:320px;
color:white;
font-size:1em;
}
</style>
<?php		
echo "<section id='slider'>";
           
echo "<div class='slider'>";

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
           echo "<img src='".$row['slimg']."'  alt='".$row['slimg']."' title='".$row['slalt']."' >";
		   echo "<div class=sli-tit>";
		   echo $row['slcaption'];
		   echo	"</div>";
		   echo "<div class=sli-text>";
		   echo $row['sldesc'];
		   echo	"</div>";
		   echo	"</div>";   // img
		}  
echo	"</div>";   // slider
?>
        <script>
            $('.slider').bxSlider({
                autoControls: true,
                auto: true,
                pager: false,
                slideWidth: 1270,
                mode: 'fade',
                captions: false,
                speed: 1000
            });
        </script>
<?php		
echo "</section>";
?>  