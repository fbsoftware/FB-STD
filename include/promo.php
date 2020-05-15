<?php   
echo	"<section id='promo'>";

// transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 

// Conta i moduli promo da mostrare per il template
//  per calcolare la larghezza delle colonne. 
	$count    = 0;
        $sql = "SELECT *
                FROM `".DB::$pref."prm`
                WHERE otmp= '".TMP::$tmenu."' 
                    and ostat <> 'A'
				and ocod = '$lcod'";
          foreach($PDO->query($sql) as $row)
     	{       //print_r($row);//debug
		include'admin/fields_prm.php'; 
		
		if ($osino1 == 1) {$count++;} 
   	 	if ($osino2 == 1) {$count++;}
   	 	if ($osino3 == 1) {$count++;}
   	 	if ($osino4 == 1) {$count++;}
		switch ($count) 
		{
	case 1:
		$colonna = "col-md-12";
 		break;
	case 2:
		$colonna = "col-md-6";
 		break;
	case 3:
		$colonna = "col-md-4";
 		break;
	case 4:
		$colonna = "col-md-3";
 		break;
  	default:
  		break;
  		}
		
            
//-- Pannello -->
	if ($otit_sn == 1) {
		$head	= new section_head(TMP::$tpromotitle,TMP::$tpromotit,TMP::$tpromotext,TMP::$tcolor);
			$head->head();
	}          
// elementi promo
		  
	echo "<div class='row'>";
	if ($osino1 == 1) 
		{  
	 	$promo1	= new promo($colonna,$olink1,$oimg1,$otit1,$otext1,'1');
	 		$promo1->show(); 
		$target	= "promo1";
		$modal	= new dialogo_modale($target,$otit1,$oimg1,'',$otext2);
			$modal->dialog();
		}
	if ($osino2 == 1) 
		{  
	 	$promo2	= new promo($colonna,$olink2,$oimg2,$otit2,$otext2,2);
	 		$promo2->show(); 
		$target	= "promo2";
		$modal	= new dialogo_modale($target,$otit2,$oimg2,'',$otext2);
			$modal->dialog();
		}
	if ($osino3 == 1) 
		{  
	 	$promo3	= new promo($colonna,$olink3,$oimg3,$otit3,$otext3,3);
	 		$promo3->show(); 
		$target	= "promo3";
		$modal	= new dialogo_modale($target,$otit3,$oimg3,'',$otext3);
			$modal->dialog();
		}
	if ($osino4 == 1) 
		{  
	 	$promo4	= new promo($colonna,$olink4,$oimg4,$otit4,$otext4,4);
	 		$promo4->show(); 
		$target	= "promo4";
		$modal	= new dialogo_modale($target,$otit4,$oimg4,'',$otext4);
			$modal->dialog();
		}
  	}	            
echo "</div>";  //-- row -->
echo "</section>"; 
?>     
