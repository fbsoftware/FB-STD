<?php  session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= */
   //   bottoni gestione
$param = array('upload','cancella','download',$CLO.'|chiudi');
$btx   = new bottoni_str_par('Media - immagini sito','img','upd_media.php',$param);     
     $btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
require_once 'msg.php';

// emette tebella con immagini
$path   = 'images/';     	// directory delle immagini
$height = 180;          	// altezza max immagine
$width  = 120;          	// larghezza max immagine
$numero = 8;				// immagini per riga

// lettura directory
foreach (glob($path."*.*") as $key => $gx)
	{  $array_file[$key] = $gx; }

// cartella immagini generali sel sito, mostro i file in una tabella
echo "<div class='tableFixHead'>";    
echo "<table class='table table-hover table-striped table-bordered table-condensed'>"; 
echo    "<tr>";
//---------------------------------------------------------
echo    "<td>";
$conto2=count($array_file);
for($b=0; $b<$conto2; $b++)
{	
		echo "<div>";
			// checkbox	
		$input = new input(array($array_file[$b],'img_del',50,'','','ck'));     
			$input->field();
			// caption
		echo $array_caption[$b] = str_replace($path,'',$array_file[$b]);
		echo "</div>";
	// test estensione valida
    $file_ext = substr($array_file[$b], strripos($array_file[$b], '.'));
    if  ($file_ext=='.jpg'  ||$file_ext=='.JPG'
       ||$file_ext=='.jpeg' ||$file_ext=='.JPEG'
	   ||$file_ext=='.png'  ||$file_ext=='.PNG'
       ||$file_ext=='.gif'  ||$file_ext=='.GIF'
       ||$file_ext=='.bmp'  ||$file_ext=='.BMP'
       ||$file_ext=='.ico'  ||$file_ext=='.ICO')
        {
        // verifica dimensioni
        $dim = getimagesize($array_file[$b]);
        $x=$dim['0'];    $y=$dim['1'];

        // link
        echo  "<a class='img' href='".$array_file[$b]."' target='_blank'>";

         // nei limiti entrambe le dimensioni
        if($x <= $width && $y <= $height)
          {
          echo    "<img class='img-centro' src='".$array_file[$b]."' width='".$x."' float='left'>";
          }
        else
          {   // adeguo la larghezza
          echo    "<img  class='img-centro' src='".$array_file[$b]."' width='".$width."' float='left'>";
          }
        echo    "</a>";

		// download
		echo "<div>";
		echo '<button><a href="download.php?file=' . urlencode($array_file[$b]) .'" target="_blank">
			<img src="images/bottoni/download.png" width="30" alt="download">
			</a></button>';
		echo "</div>";
			
                // immagini per riga
                $nn=$nn+1;    // per iniziare da 1 e non da zero
            if   ($nn%$numero == 0)
               { echo"</tr><tr><td>";}
            else
               {echo"</td><td>";}
			   
		   
        }
}
//---------------------------------------------------------
echo "</tr>";
echo "</table>";
echo "</form>";
	 
?>