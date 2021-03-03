<?php session_start();      ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		Gestionale
   * versione 1.0    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= 
   * 1.0.0	tolto codice inserito in: set_nav.php
			tolto bottone di exit inserito in moduli/nav2.php
============================================================================= */
// prima voce menù
$nav	= new setNav(TMP::$ambiente);
	$nav->setNav(); 
//require_once("set_nav.php"); 
echo	"<body>";
//-- CONTENUTO DELLA PAGINA ...
echo	"<div class='container-fluid well'>";
echo	"<a name='inizio'></a>";
require 'layout.php';  
require 'goBack.php';  
echo	"</div>";
?>
<script type="text/javascript">
    window.addEventListener ("scroll",function(){

    if (window.pageYOffset>300) {
    document.getElementById ("tornasu").style.display= "block";
    }

    else if (window.pageYOffset<300) {
    document.getElementById ("tornasu").style.display= "none";
    }

    val[0].innerHTML= "PageYOffset = "+window.pageYOffset
    },!1);
</script>
<?php
echo	"</body>";
echo	"</html>";
?>