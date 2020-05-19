<?php   
echo	"<section id='artcol'>";

// transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 

// Conta i moduli promo da mostrare per il template
//  per calcolare la larghezza delle colonne. 
$count    = 0;
	
        $sql = "SELECT *
                FROM `".DB::$pref."arc`
                WHERE htmp= '".TMP::$tmenu."' 
                    and hstat <> 'A'
				and hcod = '$lcod'";
          foreach($PDO->query($sql) as $row)
     	{       //print_r($row);//debug
		require'admin/fields_arc.php'; 
	
		if ($hsino1 == 1) {$count++;} 
   	 	if ($hsino2 == 1) {$count++;}
   	 	if ($hsino3 == 1) {$count++;}
   	 	if ($hsino4 == 1) {$count++;}
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

// articoli in colonne
	echo "<div class='row'>";
	if ($hsino1 == 1) 
		{  
          // ricerca articolo
          echo "<div class='$colonna' >";          
          $art = new getArt($htit1);
          $art->getFieldsdArt();
          $a = new txt($art->atext);
          $a->ingloba();
          echo "</div>";
		}
	if ($hsino2 == 1) 
		{  
          // ricerca articolo
          echo "<div class='$colonna'>";          
          $art = new getArt($htit2);
          $art->getFieldsdArt();
          $a = new txt($art->atext);
          $a->ingloba();
          echo "</div>";
		}
	if ($hsino3 == 1) 
		{  
          // ricerca articolo
          echo "<div class='$colonna'>";          
          $art = new getArt($htit3);
          $art->getFieldsdArt();
          $a = new txt($art->atext);
          $a->ingloba();
          echo "</div>";
		}
	if ($hsino4 == 1) 
		{  
          // ricerca articolo
          echo "<div class='$colonna'>";          
          $art = new getArt($htit4);
          $art->getFieldsdArt();
          $a = new txt($art->atext);
          $a->ingloba();
          echo "</div>";
		}
  	}	            
echo "</div>";  //-- row -->
echo "</section>"; 
?>     
