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

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// toolbar
	$param  = array($CLO.'|chiudi');    
	$btx    = new bottoni_str_par('Cambio template','tmp','fix_tmp.php',$param);  
		$btx->btn();

// zona messaggi
require_once 'msg.php';
		
// selezione template                 
     echo  "<div class='f-flex fd-c jc-center ai-center'>";
	 echo     "<fieldset  class='fb-w25'>";
     
     echo  "<div class='f-flex jc-center'><select name='scelto'>";
     $sql= "    SELECT * 
               FROM ".DB::$pref."tmp 
               WHERE tstat=' ' and tcod != 'admin'";
            foreach($PDO->query($sql) as $row)
              {
              if    ( $row['tsel'] == '*')
                {echo "<option selected='selected' value=".$row['tcod'].">".$row['tcod']."</option>"; }
              else
                {echo "<option value=".$row['tcod'].">".$row['tcod']."</option>"; }
              }
            echo "</select></div>";
     echo "<br ><br >"; 

echo  "<div class='f-flex jc-center'>";
echo  "<button class='fb-secondary fb-p05 fb-rad7 fb-m05' type='submit' name='submit' value='Conferma'>Conferma</button>";
echo  "<button class='fb-accent fb-p05 fb-rad7 fb-m05' type='reset' name='submit' value='Ritorno'>Ripristina</button>";
echo  "</div>";
echo  "</form>";

     echo  "</fieldset>";
     echo  "</div>";  
?> 