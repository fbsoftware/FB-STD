<?php
//   cerca nel layout l'articolo richiesto
echo "<section id='article'>";
$count = 0; 

     // stampa riga di separazione
			echo "<hr class='fb-primary'>"; 

     echo "<div class='f-flex jc-center fb-secondary'>";
        $sql = "SELECT *
                FROM `".DB::$pref."art`
                WHERE atit = '$lcod'
                    and astat <> 'A' 
                ORDER BY aprog ";
     foreach($PDO->query($sql) as $row)
		{ 
		 echo "<div>";
		  if ($row['amostra'] == 1) 
			{
			echo "<h1>".$row['atit']."</h1>";
			}
		  // ricerca articolo
                   
          $art = new getArt($row['atit']);
          $art->getFieldsdArt();
          $a = new txt($art->atext);
          $a->ingloba();
          echo "</div>";
		}  
	echo "</div>";
	echo "</section>";
?>