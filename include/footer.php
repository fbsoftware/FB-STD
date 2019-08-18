<?php
echo	"<div id='footer' class='fb-bgcolor-".TMP::$tcolor."'>"; 

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
				
	echo "<div class='grid".$colonne." fb-col".$colonne."'>";
		
		foreach($rows as $row)
			{
// modulo tipo immagine
		if ($row['ftipo'] == 'img') 
		{
		  echo	"<div>";
          echo	"<br />";
          echo	"<img  class='center' src='".$row['felemento']."' alt='".$row['felemento']."'  width='' height='100'>";
          if (isset($row['ftitolo'])) 		
				{ echo	"<br><h4>".$row['ftitolo']."</h4>"; }
		  if (isset($row['ftext'])) 		
				{echo	"<p class='center transparent'>".$row['ftext']."</p>"; }
          echo	"</div>";
  		}  
// modulo tipo contatti        
		if ($row['ftipo'] == 'cnt') 
		{
			echo	"<div>"; 
			if ($row['ftit'])
			{
			echo	"<h4>".$row['ftit']."</h4>";
			}
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
			if ($row['edes']) 
				{
				echo "<br />";
				echo "<img class='center' src='".$row['eimg']."' alt='' border='0' align='middle' width='' height='100' />";	
				echo "<br /><h4>".$row['edes']."</h4>"; 
				}
				
				echo "<p class='center'>";
				echo "<br />".$row['email'];
				echo "<br />".$row['epec'];
				echo "<br />".$row['esito'];
				echo "<br />".$row['esede'];
				
				echo "</p>";
			echo	"</div>";
			
  		}          
		}    // foreach  ctt
		}    // foreach  foo
          echo	"</div>";			            
?>
