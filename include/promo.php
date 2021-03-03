<?php
/* ==========================================================
	16/5/20	struttura FLEX
   ========================================================*/
?>
<style type='text/css'>
img.promo	{
	height:200px;
	display: block;
	margin-left: auto;
	margin-right: auto;
}
</style> 
<?php  
echo	"<section id='promo'>";

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
		
// stampa il titolo se richiesto
	if ($otit_sn == 1) 
	{
		echo "<div class='f-flex fd-column fb-bgcolor-".TMP::$tcolor."'>"; 
		if (TMP::$tpromotit > " ") { echo "<h1>".TMP::$tpromotit."</h1>"; } 
		if (TMP::$tpromotext > " ") { echo "<p>".TMP::$tpromotext."</p>"; }
		echo "</div>";	
	}  
       
// elementi promo
	echo "<div class='f-flex fd-row jc-center ai-start'>";
	if ($osino1 == 1) 
		{  
         	echo "<div class='f-dim1'>";
			echo "<a data-target='#promo1".$lcod."' data-toggle='modal'>";
			echo "<img class='promo' src='".$oimg1."' alt='".$oimg1."'>";
			echo "</a>";
			echo "<h4 class='service-heading'>".$otit1."</h3>";
			echo "<span class='text-muted'>".$otext1."</span>";
			echo "</div>"; 			
		$target	= "promo1".$lcod;
		$modal	= new dialogo_modale($target,$otit1,$oimg1,'',$otext2);
			$modal->dialog();
		}
	if ($osino2 == 1) 
		{  
         	echo	"<div class='f-dim1'>";
			echo	"<a data-target='#promo2".$lcod."' data-toggle='modal'>";
			echo "<img class='promo' src='".$oimg2."' alt='".$oimg2."' height='200px'>";
			echo "</a>";
			echo "<h4 class='service-heading'>".$otit2."</h3>";
			echo "<span class='text-muted'>".$otext2."</span>";
			echo "</div>";
		$target	= "promo2".$lcod;
		$modal	= new dialogo_modale($target,$otit2,$oimg2,'',$otext2);
			$modal->dialog();
		}
	if ($osino3 == 1) 
		{  
         	echo	"<div class='f-dim1'>";
			echo	"<a data-target='#promo3".$lcod."' data-toggle='modal'>";
			echo "<img class='promo' src='".$oimg3."' alt='".$oimg3."'>";
			echo "</a>";
			echo "<h4 class='service-heading'>".$otit3."</h3>";
			echo "<span class='text-muted'>".$otext3."</span>";
			echo "</div>"; 
		$target	= "promo3".$lcod;
		$modal	= new dialogo_modale($target,$otit3,$oimg3,'',$otext3);
			$modal->dialog();
		}
	if ($osino4 == 1) 
		{  
         	echo	"<div class='f-dim1'>";
			echo	"<a data-target='#promo4".$lcod."' data-toggle='modal'>";
			echo "<img class='promo' src='".$oimg4."' alt='".$oimg4."'>";
			echo "</a>";
			echo "<h4 class='service-heading'>".$otit4."</h3>";
			echo "<span class='text-muted'>".$otext4."</span>";
			echo "</div>";
		$target	= "promo4".$lcod;
		$modal	= new dialogo_modale($target,$otit4,$oimg4,'',$otext4);
			$modal->dialog();
		}
  	}	            
echo "</div>";  //-- row -->
echo "</section>"; 
?>     
