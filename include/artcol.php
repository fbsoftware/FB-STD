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
		
// stampa il titolo se richiesto
	if ($htit_sn == 1) 
	{
		echo "<div class='f-flex fd-column  fb-primary'>"; 
		if ($htit > " ") { echo "<h1>".$htit."</h1>"; } 
		if ($htext > " ") { echo $htext; }
		echo "</div>";	
	}  		
	
// articoli in colonne
	echo "<div class='f-flex fd-row jc-start fnw fb-content'>";
	if ($hsino1 == 1) 
		{  
          // ricerca articolo
          echo "<div>";
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
          echo "<div>";  
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
          echo "<div>"; 
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
          echo "<div>";   
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
