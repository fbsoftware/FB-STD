<?php session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.2    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= 
   * permette di selezionare il template fra quelli presentati dalla lista
   * che esclude quello dell'amministratore.   
============================================================================= */
echo  "<link rel='stylesheet' type='text/css' href='CSS/style.css'>";
include_once 'include_gest.php';
include_once 'transactDB.php'; 

// selezione template                 
     echo    "<div id=login>";
     echo  "<fieldset class='mid'>";
     echo  "<legend>&nbsp;Cambio template&nbsp;</legend>"; 
     echo  "<p>"; 
     echo  "<form name='modulo' action='fix_tmp.php' method='post'>";
     echo "<select name=scelto class='img-centro'>";
     $sql="    SELECT * 
               FROM ".DB::$pref."tmp 
               WHERE tstat=' ' and tcod != 'admin'";
            foreach($PDO->query($sql) as $row)
              {
              if    ( $row['tsel'] == '*')
                {echo "<option selected='selected' value=".$row['tprog'].">".$row['tcod']."</option>"; }
              else
                {echo "<option value=".$row['tprog'].">".$row['tcod']."</option>"; }
              }
            echo "</select>";
     echo "<br ><br >";    
     echo  "<button type='submit' name='submit' value='Conferma'>Conferma</button><br >";
     echo  "</form>";

// ritorno
     echo  "<form name=modulo  action='fix_tmp.php' method=post>"; 
     echo  "<hr ><br >";
     echo  "<button type='submit' name='submit' value='Ritorno'>Ripristina</button>";
     echo  "<script type='text/javascript' language='JavaScript'> ";
     echo  "close()";
     echo  "</script>" ; 
     echo  "</form>";
     echo  "</p>";
     echo  "</fieldset>";
     echo  "</div>";  
?> 