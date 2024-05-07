<?php
/* ==========================================================
	16/5/20	struttura FLEX
   ========================================================*/
echo	"<section id='promo'>";
if ($count < 1) {
	$count=0;	
};
?>
  <script>
  $( function() {
  $( ".fb-primary p" ).addClass('fb-primary');
    $( ".fb-primary h1" ).addClass('fb-primary');
  } );
  </script>
<?php
// transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 

// Cerca i moduli promo da mostrare per il template
        $sql = "SELECT *
                FROM `".DB::$pref."prm`
                WHERE otmp= '".TMP::$tmenu."' 
                    and ostat <> 'A'
				and ocod = '$lcod'";
          foreach($PDO->query($sql) as $row)
     	{       //print_r($row);//debug
		require'admin/fields_prm.php'; 

// stampa il titolo del promo se richiesto
	if (TMP::$tpromotitle == 1) 
	{
		echo "<div class='f-flex fd-column  fb-primary'>"; 
		if (TMP::$tpromotit > " ") { echo "<h1>".TMP::$tpromotit."</h1>"; } 
		if (TMP::$tpromotext > " ") { echo TMP::$tpromotext; }
		echo "</div>";	
	}  
       
// elementi promo

	echo "<div class='f-flex fd-row jc-center ai-start fw fb-secondary'>";
$count++;		// numeratore assoluto  per differenziare ogni promo per dialogo modale
	
	if ($osino1 == 1) 
		{  $target	= "promo1".$count;
         	echo "<div class='f-dim1'>";
			echo "<a class='trasp'  popup-open='".$target."' href='javascript:void(0)'>";
			echo "<img class='promo' src='".$oimg1."' alt='".$oimg1."' height='200px'>";
			echo "</a>";
			echo "<h4 class='service-heading'>".$otit1."</h3>";
			echo "<span class='text-muted'>".$otext1."</span>";
			echo "</div>"; 			
		
		$modal	= new popup_modale($target,$otit1,$oimg1,'',$otext2);
			$modal->popup();
		}
$count++;		// numeratore assoluto  per differenziare ogni promo per dialogo modale

	if ($osino2 == 1) 
		{  $target	= "promo2".$count;
         	echo	"<div class='f-dim1'>";
			echo "<a class='trasp'  popup-open='".$target."' href='javascript:void(0)'>";			
			echo "<img class='promo' src='".$oimg2."' alt='".$oimg2."' height='200px'>";
			echo "</a>";
			echo "<h4 class='service-heading'>".$otit2."</h3>";
			echo "<span class='text-muted'>".$otext2."</span>";
			echo "</div>";
		
		$modal	= new popup_modale($target,$otit2,$oimg2,'',$otext2);
			$modal->popup();
		}
$count++;		// numeratore assoluto  per differenziare ogni promo per dialogo modale

	if ($osino3 == 1) 
		{  $target	= "promo3".$count;
         	echo	"<div class='f-dim1'>";
			echo "<a class='trasp'  popup-open='".$target."' href='javascript:void(0)'>";
			echo "<img class='promo' src='".$oimg3."' alt='".$oimg3."'>";
			echo "</a>";
			echo "<h4 class='service-heading'>".$otit3."</h3>";
			echo "<span class='text-muted'>".$otext3."</span>";
			echo "</div>"; 
		
		$modal	= new popup_modale($target,$otit3,$oimg3,'',$otext3);
			$modal->popup();
		}
$count++;		// numeratore assoluto  per differenziare ogni promo per dialogo modale

	if ($osino4 == 1) 
		{  $target	= "promo4".$count;
         	echo	"<div class='f-dim1'>";
						echo "<a class='trasp'  popup-open='".$target."' href='javascript:void(0)'>";
			echo "<img class='promo' src='".$oimg4."' alt='".$oimg4."'>";
			echo "</a>";
			echo "<h4 class='service-heading'>".$otit4."</h3>";
			echo "<span class='text-muted'>".$otext4."</span>";
			echo "</div>";
		
		$modal	= new popup_modale($target,$otit4,$oimg4,'',$otext4);
			$modal->popup();
		}
  	}	            
echo "</div>";  //-- flex -->
echo "</section>"; 
?>     
