<?php
echo	"<div id='footer' class='f-flex fd-row  fb-bgcolor-sec jc-around fw'>"; 

// lettura footer elements
        $sql = "SELECT *
                FROM `".DB::$pref."foo`
                WHERE fcod = '$lcod'
                    and ftmp= '".TMP::$tmenu."' 
                    and fstat <> 'A' 
                ORDER BY fprog ";
				
		$stmt = $PDO->prepare($sql);
		$stmt->execute();		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		json_encode($rows);
		$colonne = $stmt->rowCount();				
				
		foreach($rows as $row)
			{
switch ($row['ftipo'])	
{
// modulo tipo immagine e/o testo
    case 'img':	
			echo "<div class='f-dim1'>";
			echo	"<img  class='center promo' src='".$row['felemento']."' alt='".$row['felemento']."'>";
			echo	"<p class='center little''>";
			if (isset($row['ftitolo'])) 		
				{ echo	"<h3 class='center'>".$row['ftitolo']."</h3>"; }
			if (isset($row['ftext'])) 	{ echo	$row['ftext']; }
			echo  "</p>";
			echo  "</div>";
			break;
			
// modulo tipo contatti        
    case 'cnt':	
// lettura contatti
        $sql = "SELECT *
                FROM `".DB::$pref."ctt`
                WHERE '".$row['fcod']."' = '".$lcod."'
                	and ecod = '".$row['felemento']."'
                    and etmp= '".TMP::$tmenu."' 
                    and estat <> 'A' 
                ORDER BY eprog ";		
          foreach($PDO->query($sql) as $row)
          {	
		  echo "<div class='f-dim1'>";
		  echo "<p class='center little'>";
			if ($row['eimg']) 
				{	echo "<img class='center promo' src='".$row['eimg']."' alt='' border='0' />";  }
			if ($row['ftit'])
				{  echo	"<h3 class='center'>".$row['ftit']."</h3>";	}
			if ($row['edes']) 	{ echo "<h3 class='center'>".$row['edes']."</h3>"; }
				echo "<br />".$row['email'];
				echo "<br />".$row['epec'];
				echo "<br />".$row['esito'];
				echo "<br />".$row['esede'];
				echo "<br />".$row['enote'];
				echo "</p>";
			echo	"</div>";
  		}    // foreach  ctt      
		}    // switch
		}    // foreach  foo
          echo	"</div>";			            
?>
