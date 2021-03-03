<?php  session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.4    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= */              
require_once('../loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once("../connectDB.php");
// DOCTYPE & head
$app = new Head('Gestione menu');
$app->openHead();
require_once("../jquery_link.php");
//require_once("../bootstrap_link.php");
require_once("../include_head.php");
require_once('../lingua.php'); 
$app->closeHead();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

echo  "<body>";

//  controllo utente
     echo     "<div class='f-flex fd-row jc-center ai-center'>"; 
              
     echo     "<fieldset class='f-flex fd-column jc-center ai-center' style='width:400px;height:400px;'>";
 
echo  "<h3 class='center'><img src='images/logo/logo.png' alt='logo.png, 1,6kB' title='logo' height='75' style='margin-right:30px'>";
echo  "&nbsp;&nbsp;&nbsp;&nbsp;Collegamento&nbsp;&nbsp;&nbsp;&nbsp;</h3>"; 
          
//   prepara il modulo del login  
echo  "<form name='modulo' action='login_test.php' method='post'>";

 $f1 = new input(array('','uten',20,'Utente','','ir'));           
     $f1->field();
 $f2 = new input(array('','pass',20,'Password','','pw'));         
     $f2->field();
echo  "<hr >"; 
echo  "<div class='f-flex jc-center'>";
echo  "<button class='btn btn-primary' type='submit' name='submit' value='Login' >Accedi</button>";
echo  "<button class='btn btn-danger' type='reset' name='submit_back' value='Resetta' >Resetta</button>"; 

	if  ($_COOKIE['err'] == 1) 
		{
		echo  "<p class=red><b>Credenziali NON VALIDE !</b></p>" ;
		}
	if 	($_COOKIE['err'] == 2) 
		{
		echo  "<p class=red><b>Utente sconosciuto !</b></p>" ;
		}
	else
		{
		echo  "&nbsp;" ;
		}
echo  "</div>";
echo  "</form>";
echo  "</fieldset>";

echo  "</div>";			// container
echo  "</body>";
echo  "</html>";

?> 
