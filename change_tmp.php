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
require_once('loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once("connectDB.php");
// DOCTYPE & head
$app = new Head('Gestione templates');
$app->openHead();
require_once("jquery_link.php");
require_once("bootstrap_link.php");
require_once("include_head.php");
require_once('lingua.php'); 
$app->closeHead();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// toolbar
	$param  = array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi');    
	$btx    = new bottoni_str_par('Cambio template','tmp','fix_tmp.php',$param);  
		$btx->btn();

// zona messaggi
require_once 'msg.php';
		
// selezione template                 
     echo  "<div id=login class='col-md-6' style='clear:both;margin:0 25% 0;'>";
     echo  "<fieldset class='center'>";
     echo  "<select name='scelto' class='img-centro'>";
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

     echo  "</fieldset>";
     echo  "</div>";  
?> 