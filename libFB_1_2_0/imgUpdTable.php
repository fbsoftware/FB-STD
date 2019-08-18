<?php
/**
 * @class:      imgUpdTable
 *
 * @description:Tabella con immagini dimensionate e celle per riga
 *               e possibilità di upload/download.
 * @author Fausto Bresciani <fbsoftware@libero.it>
 * @version 0.1
 */
class imgUpdTable    
{ // BEGIN class imgUpdTable
	// variabili
	public $path   = NULL;       // directory delle immagini
	public $height = 0;          // altezza max immagine
	public $width  = 0;          // larghezza max immagine
	public $numero = 0;          // celle per riga
	public $callbk = 0;          // action del form
	public $array_file =array(); // schiera immagini
	// costruttore
  public function __construct($path,$height,$width,$numero,$callbk)
	{
	$this->path   = $path ;
	$this->height = $height ;
     $this->width  = $width ;
     $this->numero = $numero ;
     $this->callbk = $callbk ;
	 $this->array_file = $array_file ;
	}
/************************************************
 * @method:   putTable()
 * @description:Emette la tabella con immagini
 * **********************************************/
  public function putUpdTable()
     {
// lettura directory
foreach (glob($this->path."*.*") as $key => $gx)
	{  $this->array_file[$key] = $gx; }

// cartella immagini generali sel sito, mostro i file in una tabella
echo "<div class='tableFixHead'>";    
echo "<table class='table table-hover table-striped table-bordered table-condensed'>"; 

//echo    "<div class='tabella'>";
//echo    "<table cellpadding='10'>";
echo    "<tr>";
//---------------------------------------------------------
echo    "<td>";
$conto2=count($this->array_file);
for($b=0; $b<$conto2; $b++)
{
// checkbox	
//$input = new input(array($array_file[$b],'img_del',50,'','','ck'));     
//     $input->field();
		$f1 = new fieldi($this->array_file[$b],'img_del',50,'');           
			$f1->field_ck();  

			
    $file_ext = substr($this->array_file[$b], strripos($this->array_file[$b], '.'));
    if  ($file_ext=='.jpg'  ||$file_ext=='.JPG'
       ||$file_ext=='.png'  ||$file_ext=='.PNG'
       ||$file_ext=='.gif'  ||$file_ext=='.GIF'
       ||$file_ext=='.bmp'  ||$file_ext=='.BMP'
       ||$file_ext=='.ico'  ||$file_ext=='.ICO')
        {
   /* // form per gestione
		echo "<form method='post' action='".$this->callbk.".php'>";
    // bottone di cancellazione
		echo "<div>";
        echo    "<br ><button name='submit' type='submit' value='cancella'>
          <img src='images/bottoni/delete.png' width='40' vspace='0'
          alt='canc' align='left'></button>";
	// bottone di download e chiusura form
        echo    "<button name='submit' type='submit' value='download'>
          <img src='images/bottoni/down.png' width='40' vspace='0'
          alt='download' align='right'></button>";
		echo "</div>";
		echo "</form>";*/
	 
        // verifica dimensioni
        $dim = getimagesize($this->array_file[$b]);
        $x=$dim['0'];    $y=$dim['1'];

        // link
        echo  "<a class='img' href='".$this->array_file[$b]."' target='_blank'>";

         // nei limiti entrambe le dimensioni
        if($x <= $this->width && $y <= $this->height)
          {
          echo    "<img class='img-centro' src='".$this->array_file[$b]."' width='".$x."' float='left'>";
          }
        else
          {   // adeguo la larghezza
          echo    "<img  class='img-centro' src='".$this->array_file[$b]."' width='".$this->width."' float='left'>";
          }
        echo    "</a><br >".$this->array_file[$b] = str_replace($this->path,'',$this->array_file[$b]);

		$input = new input(array($this->array_file[$b],'img_del','','','','h'));     
			$input->field();     

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