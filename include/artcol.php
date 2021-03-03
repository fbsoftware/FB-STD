<?php   
echo	"<section id='artcol'>";

// transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 

        $sql = "SELECT *
                FROM `".DB::$pref."arc`
                WHERE htmp= '".TMP::$tmenu."' 
                    and hstat <> 'A'
				and hcod = '$lcod'";
          foreach($PDO->query($sql) as $row)
     	{       
		//print_r($row);//debug
		require'admin/fields_arc.php'; 
	
// articoli in colonne
	echo "<div class='f-flex fd-row jc-start'>";
	if ($hsino1 == 1) 
		{  
          // ricerca articolo
          echo "<div class='f-item f-dim1' >";
			echo "<div>";
          $art = new getArt($htit1);
          $art->getFieldsdArt();
          $a = new txt($art->atext);
          $a->ingloba();
          echo "</div>";
		  echo "</div>";
		}
	if ($hsino2 == 1) 
		{  
          // ricerca articolo
          echo "<div class='f-item f-dim1'>";  
echo "<div>";		  
          $art = new getArt($htit2);
          $art->getFieldsdArt();
          $a = new txt($art->atext);
          $a->ingloba();
          echo "</div>";
		   echo "</div>";
		}
	if ($hsino3 == 1) 
		{  
          // ricerca articolo
          echo "<div class='f-item f-dim1'>"; 
echo "<div>";		  
          $art = new getArt($htit3);
          $art->getFieldsdArt();
          $a = new txt($art->atext);
          $a->ingloba();
          echo "</div>";
		   echo "</div>";
		}
	if ($hsino4 == 1) 
		{  
          // ricerca articolo
          echo "<div class='f-item f-dim1'>";   
echo "<div>";		  
          $art = new getArt($htit4);
          $art->getFieldsdArt();
          $a = new txt($art->atext);
          $a->ingloba();
          echo "</div>";
		   echo "</div>";
		}
  	}	            
echo "</div>";  //-- flex -->
echo "</section>"; 
?>     
