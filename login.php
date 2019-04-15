<?php  session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.4    
   * copyright	Copyright (C) 2012 - 2013 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= */              
require_once('loadLibraries.php');
require_once('loadTemplateSito.php');
require_once('lingua.php');

// DOCTYPE & head
$head = new getBootHead('gestione layout di pagina');
     $head->getBootHead();

echo  "<body>";

//  controllo utente
     echo     "<div class='container' style='margin: 50px auto 0 30%'>"; 
     echo     "<div class='form-horizontal'>";                
     echo     "<div class='row well col-md-4'>";
 
echo  "<h3><img class='login' src='images/logo/logo.png' alt='logonew.png, 1,6kB' title='fael' height='75''>";
echo  "Collegamento</h3>"; 
echo  "<hr >"; 
          
//   prepara il modulo del login  
echo  "<form name='modulo' action='login_test.php' method='post'>";


 $f1 = new input(array('','uten',20,'Utente',' ','ir'));           
     $f1->field();
 $f2 = new input(array('','pass',20,'Password',' ','pw'));         
     $f2->field();

echo  "<br ><button type=submit name=submit value=Login >Accedi</button><br >";
echo  "</form>";

  if  ($_COOKIE['err'] == 1) 
  {
  echo  "<p class=red><b>Credenziali NON VALIDE !</b></p>" ;
  }
  else
      {
      echo  "&nbsp;" ;
      }

echo  "<form name=modulo_back action=uscita.php method=post>"; 
echo  "<hr >";
echo  "<button type=submit name=submit_back value=Ritorno >Ritorno</button>"; 
echo  "</form>";

echo  "</div></div></div>"; 
echo  "</body></html>";
?> 
