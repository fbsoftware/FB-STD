<?php
//   cerca nel layout la pagina richiesta  
echo "<section id='pagina-".$lcod."'>";
$count = 0; 

     // stampa riga di separazione
			echo "<hr class='fb-primary'>"; 

     echo "<div class='f-flex fb-secondary'>";
 echo       $sql = "SELECT *
                FROM `".DB::$pref."pag`
                WHERE jcod = '$lcod'
                    and jstat <> 'A' 
                ORDER BY jprog ";
     foreach($PDO->query($sql) as $row)
		{ 
		  echo "<div>";
		  echo "<h1>".$row['jpage']."</h1>";
      echo $row['jcod']."-----".$row['jcont'];
      echo "</div>";
		}  
	echo "</div>";
	echo "</section>";
?>