<?php
echo	"<section id='artslide'>";
//-- Pannello --       
		$head	= new section_head(TMP::$tsldtitle,TMP::$tsldtit,TMP::$tsldtext,TMP::$tcolor);
			$head->head();
$arr 	= array();
$arrt	= array();			
// cerca nel layout le slide
        $sql = "SELECT *
                FROM `".DB::$pref."asl`
                WHERE dtmp = '".TMP::$tmenu."'
                    and dtipo = 'artslide'
                    and dstat <> 'A'
                ORDER BY dprog ";
        foreach($PDO->query($sql) as $row2)
		{   	
// lettura articoli della categoria
        $sql = "SELECT *
                FROM `".DB::$pref."art`
                WHERE acap = '".$row2['dcap']."'
                    and astat <> 'A' 
                ORDER BY aprog ";
			foreach($PDO->query($sql) as $row)
			{ 
			$a = new txt($row['atext']);
			$arr[] 	= $a->ingloba();
			$arrt[] = $row['atit'];
			};   	// lettuta art
		};        	// lettura asl
?>

<div id="carouselExampleControls" class="carousel slide" data-ride='carousel' data-interval='<?php echo TMP::$tslidetime ?>'>			
	<div class='carousel-inner'>
   <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  Navigazione
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
<?php	
		$count	=	count($arr);
		for($i = 0; $i <= $count; $i++)
		{
?>
<!-- items -->
			
			<div class="item active"> 
			<div class="panel-carousel-heading fb-bgcolor-<?php echo TMP::$tcolor; ?>">
			<h4><?php echo $arrt[$i]; ?></h4>
			</div>
			<div class="panel-carousel-body">
			<?php echo $arr[$i]; ?>
			</div>
			</div>
			
			 
     <?php
}
     ?>
      </div>	 <!-- carousel-inner -->
	</div>       	<!-- carousel-slide --> 

</section>   
