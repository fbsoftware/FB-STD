<?php
echo "<section id='article'>";
$count = 0; 
     echo "<div class='row'>";
//   cerca nel layout gli articoli che posiziona in righe 
//   secondo le dimensioni delle colonne.
        $sql = "SELECT *
                FROM `".DB::$pref."asl`
                WHERE dtmp = '".TMP::$tcod."'
                    and dtipo = 'article'
                    and dcod = '$lcod'
                    and dstat <> 'A' 
                ORDER BY dprog ";
     foreach($PDO->query($sql) as $row)
		{    
		 include 'fields_asl.php'; 
         include 'articolo.php';
         $count++;
		}  
	echo "</div>";
	echo "</section>";
?>