<?php
/** FB_template versione 1.4
   Fausto Bresciani
   Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta all'uso
   anche improprio di FB_template.
=============================================================================== 
  Visualizza il navigatore amministrativo nei due livelli previsti
  Gestione voci in base al livello di accesso dell'utente
  1.0.0	aggiunto bottone di exit
=============================================================================== */
$file=str_replace('\\','/',__FILE__);
if($file == $_SERVER['SCRIPT_FILENAME']) exit('Accesso non consentito') ;
/*=============================================================================== */ 
?>

<style type="text/css">
ul.nav2 li a	{
	color: var(--black-color);
}
</style>
<?php
$accesso  =  $_COOKIE['accesso'];
        $sql = "SELECT * 
                FROM `".DB::$pref."nav`  
                WHERE nmenu='admin' and nstat <> 'A' and ndesc <= ' '
                ORDER BY nprog";
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 
        echo "<ul class='nav2'>"; 
foreach($PDO->query($sql) as $row)  
{
require'fields_nav.php';
              
       if ( ($nli == $forma) && ($accesso >= $naccesso) )   // voce corrente
          {  
			echo "<li>";
			if (($ntipo == 'arg') || ($ntipo == 'cap') || ($ntipo == 'art') || ($ntipo == 'htm'))
				{
				echo "<a class='current' href='admin.php?forma=".$nli."&sub=".$row['ndesc']."&content=".$ntipo."&dati=".$nsotvo."&pag=".$npag."'>".$nli."</a>";
				}
			else
				{
				echo "<a class='current' href='admin.php?forma=".$nli."&sub=".$row['ndesc']."&content=".$ntipo."&urla=".$nsotvo."&pag=".$npag."'>".$nli."</a>";            
				}
          require('moduli/liv2a.php');
          echo "</li>";
          }
    else              // altre voci  
	
    if ($accesso >= $naccesso) 
     {
          {  
            echo "<li>";
            if (($ntipo == 'arg') || ($ntipo == 'cap') || ($ntipo == 'art') || ($ntipo == 'htm'))
              {
                echo "<a href='admin.php?forma=".$nli."&sub=".$row['ndesc']."&content=".$ntipo."&dati=".$nsotvo."&pag=".$npag."'>".$nli."</a>";
              }
              else
              {                              
                echo "<a href='admin.php?forma=".$nli."&sub=".$row['ndesc']."&content=".$ntipo."&urla=".$nsotvo."&pag=".$npag."'>".$nli."</a>";
              }
            require('moduli/liv2a.php');
            echo "</li>";
          }
     }
}            
           echo "</ul>"; 

//  bottone logout
echo "<form class='bottoni' method='post' action='login.php'>";
echo "<button class='fb-accent fb-p025 fb-rad7 fb-m05' type='submit' name='submit' value='chiudi'> ";
echo "<img src='images/bottoni/esci.png' alt='esci' height='25'>";
echo $EXIT;
echo "</button>";
echo "</form>";   
?> 
