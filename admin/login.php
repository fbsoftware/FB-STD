<?php  session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.4    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= */require_once('init_admin.php');

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

echo  "<body>";

//  controllo utente
     echo     "<div class='f-flex fd-c jc-center ai-center'>"; 
              
     echo     "<fieldset  class='fb-w25'>";

echo  "<h3 class='center'><img src='images/logo/logo.png' alt='logo.png, 1,6kB' title='logo' height='75' >";
echo  "&nbsp;&nbsp;&nbsp;&nbsp;Collegamento&nbsp;&nbsp;&nbsp;&nbsp;</h3>"; 
          
//   prepara il modulo del login  
echo  "<form name='modulo' action='login_test.php' method='post'>";

 $f1 = new input(array('','uten',20,'Utente','','ir'));           
     $f1->field();
 $f2 = new input(array('','pass',20,'Password','','pw'));         
     $f2->field();
 
echo  "<div class='f-flex jc-center'>";
echo  "<button class='fb-bgcolor-primary fb-p05 fb-rad7 fb-m05' type='submit' name='submit' value='Login' ><span class='ui-icon ui-icon-person'></span>Accedi</button>";
echo  "<button class='fb-bgcolor-danger fb-p05 fb-rad7 fb-m05' type='reset' name='submit_back' value='Resetta' ><span class='ui-icon ui-icon-transferthick-e-w'></span>Resetta</button>"; 
echo  "</div>";
echo  "</form>";
// se errori ...
echo "<div>";
	if  ($_COOKIE['err'] == 1) 
		{
		echo  "<p class='fb-bgcolor-danger center'><b>Credenziali NON VALIDE !</b></p>" ;
		}
	if 	($_COOKIE['err'] == 2) 
		{
		echo  "<p class='fb-bgcolor-danger center'><b>Utente sconosciuto !</b></p>" ;
		}
	else
		{
		echo  "&nbsp;" ;
		}
echo "</div>";

echo  "</fieldset>";

echo  "</div>";			// container
echo  "</body>";
echo  "</html>";

?> 
