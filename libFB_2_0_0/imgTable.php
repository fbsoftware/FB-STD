<?php
/**
 * @class:      imgTable
 *
 * @description:Tabella con immagini dimensionate e celle per riga
 *
 * @author Fausto Bresciani <fbsoftware@libero.it>
 * @version 0.1
 */
class imgTable
{ // BEGIN class imgTable
	// variabili
	public $path   = NULL;       // directory delle immagini
	public $height = 0;          // altezza max immagine
	public $width  = 0;          // larghezza max immagine
	public $numero = 0;          // celle per riga
	// costruttore
  public function __construct($path,$height,$width,$numero)
	{
	$this->path   = $path ;
	$this->height = $height ;
     $this->width  = $width ;
     $this->numero = $numero ;
	}
/************************************************
 * @method:   putTable()
 * @description:Emette la tabella con immagini
 * **********************************************/
  public function putTable()
     {
		 $array_file=array();
// lettura directory
foreach (glob($this->path."*.*") as $key => $gx)
{    $array_file[$key] = $gx; }
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
        // link
        echo  "<a href='".$array_file[$b]."' target='_blank'>";
        // verifica dimensioni
        $dim = getimagesize($array_file[$b]);
        $x=$dim['0'];    $y=$dim['1'];
         // nei limiti entrambe le dimensioni
        if($x <= $this->width && $y <= $this->height) {
          echo    "<img class='img-centro' src='".$array_file[$b]."' height='".$y."' float='left'>"; }
        else { $vx = $this->width/$x;   $vy = $this->height/$y;
        // adeguo la + critica fra le dimensioni
               if($vx <= $vy) {echo    "<img  class='img-centro' src='".$array_file[$b]."' width='".$this->width."' float='left'>";}  else  {
        echo    "<img class='img-centro'  src='".$array_file[$b]."' height='".$this->height."' float='left'>"; }
        }
        echo    "</a><br >".$array_file[$b] = str_replace($dirimm,'',$array_file[$b]);
                // 4 immagini per riga
                $nn=$nn+1;    // per iniziare da 1 e non da zero
            if   ($nn%$this->numero == 0)  { echo"</tr><tr><td>";}
            else {echo"</td><td>";}
        }
}
//---------------------------------------------------------
echo    "</tr></table></div>";
     }
} // END class imgTable
?>