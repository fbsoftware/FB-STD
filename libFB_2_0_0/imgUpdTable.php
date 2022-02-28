<?php
/**
  class:      imgUpdTable
  description:Tabella con immagini dimensionate e celle per riga
                e possibilità di upload/download.
 author Fausto Bresciani <fbsoftware@libero.it>
 version 0.1
 */
class imgUpdTable    extends imgTable
{ // BEGIN class imgUpdTable
	// variabili
	public $path   = NULL;       // directory delle immagini
	public $height = 0;          // altezza max immagine
	public $width  = 0;          // larghezza max immagine
	public $numero = 0;          // celle per riga
	public $callbk = "";          // action del form
	public $path_img = "";
	// costruttore
  public function __construct($path,$height,$width,$numero,$callbk)
	{
	   $this->path   = $path ;
	   $this->height = $height ;
     $this->width  = $width ;
     $this->numero = $numero ;
     $this->callbk = $callbk ;
		 	}
/************************************************
 * @method:   putTable()
 * @description:Emette la tabella con immagini
 * **********************************************/
  public function putUpdTable()
     {

$array_file=array();
foreach (glob($this->path."*.*") as $array_filex)
{    array_push($array_file,$array_filex); }
//print_r($array_file);//debug

// cartella immagini generali sel sito, mostro i file in una tabella
echo    "<div class='tabella'>";
echo    "<table cellpadding='10'>";
echo    "<tr>";
//---------------------------------------------------------
echo    "<td>";
$conto2=count($array_file);
for($b=0; $b<$conto2; $b++)
{
    $file_ext = substr($array_file[$b], strripos($array_file[$b], '.'));
    if  ($file_ext=='.jpg'  ||$file_ext=='.JPG'
       ||$file_ext=='.png'  ||$file_ext=='.PNG'
       ||$file_ext=='.gif'  ||$file_ext=='.GIF'
       ||$file_ext=='.bmp'  ||$file_ext=='.BMP'
       ||$file_ext=='.ico'  ||$file_ext=='.ICO')
        {
     // form per gestione
     echo "<form method='post' action='".$this->callbk."'>";
				// verifica dimensioni
        $dim = getimagesize($array_file[$b]);
        $x=$dim['0'];
		$y=$dim['1'];
        // link
        echo  "<a class='img' href='".$array_file[$b]."' target='_blank'>";

         // nei limiti entrambe le dimensioni
        if($x <= $this->width && $y <= $this->height)
          {
          echo    "<img class='img-centro' src='".$array_file[$b]."' width='".$x."' float='left'>";
          }

        else
          {   // adeguo la larghezza
          echo    "<img  class='img-centro' src='".$array_file[$b]."' width='".$this->width."' float='left'>";
          }
        //echo    "</a><br >".$array_file[$b] = str_replace($this->path,'',$array_file[$b]);
        echo    "</a><br >".$array_file[$b];

        // bottone di cancellazione
		echo "<div class='row'>";
	//	echo "<div>";
        echo "<input type='hidden' name='img_del' value='$array_file[$b]'>";
        echo "<button name='submit' type='submit' value='cancella' class='fb-primary'>
				<img src='images/bottoni/cancella.png' width='18' vspace='0'
				alt='canc' align='left'>Cancella</button>";
        // bottone di download e chiusura form
        echo "<input type='hidden' name='img_del' value='$array_file[$b]'>";
        echo "<button name='submit' type='submit' value='download' 			class='fb-primary'>
				<img src='images/bottoni/download.png' width='18' vspace='0'
				alt='download' align='right'>Download</button>";
	//	echo "</div>";
		echo "</div>";
		echo "</form>";



                // immagini per riga
                $nn=$nn+1;    // per iniziare da 1 e non da zero
            if   ($nn%$this->numero == 0)
               { echo"</tr><tr><td>";}
            else
               {echo"</td><td>";}
        }
}
//---------------------------------------------------------
echo    "</tr></table></div>";
     }
} // END class imgUpdTable
?>
