<?php
echo "<section id='article'>";
$count = 0; 
     echo "<div class='row'>";
//   cerca nel layout gli articoli che posiziona in righe 
//   secondo le dimensioni delle colonne.

        $sql = "SELECT *
                FROM `".DB::$pref."art`
                WHERE atit = '$lcod'
                    and astat <> 'A' 
                ORDER BY aprog ";
     foreach($PDO->query($sql) as $row)
		{    
		 $atit      =$row['atit'];
         require 'articolo.php';
         $count++;
		}  
	echo "</div>";
	echo "</section>";
?>