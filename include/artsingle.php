<?php		// INCOMPLETO !!!

echo	"<section id='artsingle'>";
$count = 0; 
$arr 	= array();
$arrt	= array();	
$arrc	= array();		
// cerca nel layout articoli singoli
        $sql = "SELECT *
                FROM `".DB::$pref."asl`
                WHERE dtmp = '".TMP::$tmenu."'
                    and dtipo = 'artsingle'
                    and dstat <> 'A'
                ORDER BY dprog ";
        foreach($PDO->query($sql) as $row2)
		{   	
// lettura articoli, conteggio e messa in array
        $sql = "SELECT *
                FROM `".DB::$pref."art`
                WHERE atit = '".$row2['dart']."'
                    and astat <> 'A' 
                ORDER BY aprog ";
			foreach($PDO->query($sql) as $row)
			{ 
			$count++;
			$a = new txt($row['atext']);
			$arr[] 	= $a->ingloba();
			$arrt[] = $row['atit'];
			//$arrt[] = $row['atit'];
			};   	// lettuta art
		};        	// lettura asl

// determina numero colonne
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


echo "<div class='f-flex fd-row jc-center  ai-start fb-secondary'>";
          echo "<div class='container'>";
          echo "<div class='row'>";

          

          echo "</div>";     // row
          echo "</div>";     // flex
          $count++;
     }     
?>
</section>