<?php
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3   
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * --------------------------------------------------------------------------
   *  FUNZIONI DI UTILITA'
   * --------------------------------------------------------------------------
   *              
=============================================================================== 
  Classe 'alias'       
  metodo fa_alias per ottenere un alias da una stringa trasformando prima
  in minuscolo, troncandola al primo doppio spazio e sostituendo gli spazi con
  trattini. 
============================================================================= */
class alias
{
public $s=""; 

        public function __construct($s)       
               { $this->s = $s;  }
               
         function fa_alias() 
                {      
               $this->s = strtolower($this->s);
               $l = strpos($this->s,"  ");
               if ($l == 0) $l=strlen($this->s);
               $this->s = substr($this->s,0,$l);
               $this->s = strtr($this->s," ","-");
               return $this->s;
               }
}

/**========================================================================== 
  imgdim.php                                                                        
  Classe per il dimensionamento delle immagini in modo da adeguarle alla
  finestra che le ospita.
============================================================================= */
class imgdim            
{                                                 
     public $img    =  '';
     public $alt    =  '';
     public $lun    =  '';
     
     public $width  =  '';
     public $height =  '';
     public $imgh =  '';
     public $imgl =  '';
  
        public function __construct($img,$alt,$lun)       
               {    $this->img     = $img;
                    $this->alt     = $alt;
                    $this->lun     = $lun;
               }  
                       
        public function maxdim()       
          {
          $pathimg = DB::$path_imm.$this->img;
          $dim=array();
          $dim = getimagesize($pathimg);
          $x=$dim['0'];   $this->imgl = $x; 
          $y=$dim['1'];   $this->imga = $y;
          // nei limiti entrambe le dimensioni 
               if($this->imgl <= $this->lun && $y <= $this->alt) 
                         {
                         $vx = $this->imgl;   
                         $vy = $this->imga;
                         }
               else      {
                         $vx = $this->lun/$this->imgl;   
                         $vy = $this->alt/$this->imga;
                         }
               // adeguo la + critica fra le dimensioni       
               if($vx < $vy)  $this->width = $this->lun;  
               else           $this->height= $this->alt;
          }
}

/**===============================================================================
  Partendo dal presupposto che il tipo della struttura di una tabella di database
  mySQL puo' contenerne la lunghezza, es.: VARCHAR(15), ricava la lunghezza campo
  database da questa stringa
  
  Metodi:
  lun()             calcola lunghezza
  Variabili:
  lung              valore della lunghezza (ritorna zero se non indicato il 
                    valore come per campi: text,mediumtext,ecc in quanto
                    mancano i riferimenti alle parentesi)
============================================================================= */
class lun_f         
{       
        public $valore ='';
        public $lung =0;
 
    public function __construct($valore)       
               { $this->valore = $valore; 
                 $this->lung = @$lung;}   

    public function lun_f()               
    {   
    $x1=strpos($this->valore,'(');
    if ($x1 > 0)
       {	  
       $x2=strpos($this->valore,')');       
       $start=($x1+1);     
       $lun=(($x2-$x1)-1);            
       return $this->lung=substr($this->valore,$start,$lun);
       }
    else
       {return $this->lung=0;}
    }    
}

/**===============================================================================
  Gestione mappa di login
  
  Presupposti:
  utilizzo del cookie "$_COOKIE['err']" per segnalare errore nei dati forniti
  utilizzo tabella 'ute' con dati degli utenti
  utilizzo del pgm "login_test.php" per i controlli
  utilizzo del framework "bootstrap"
  utilizzo dell'immagine "images/logo/logo.png" per il logo dell'applicazione
  utilizzo delle classi: login,red
   
  Metodi:
  getUser()         acquisisce i dati di collegamento 
  ckUser()          testa i dati di collegamento
  
  Variabili:
  valore            nome del file selezionato
============================================================================= */

class login          
{        
        public $path   ='';
        public $valini =''; 
        public $campo  ='';
        public $valore ='';              // scelta della select
        public $label  ='';
        public $toolt  ='';              // tooltip
         
    public function __construct()       
               { 
//               $this->path    = $path;
               }   

    public function getUser()               
    {    
//  controllo utente
     echo     "<div class='container' style='margin: 50px auto 0 30%'>"; 
     echo     "<div class='form-horizontal'>";                
     echo     "<div class='row well col-md-4'>";
 

echo  "<h3><img class='login' src='images/logo/logo.png' alt='logo.png, 1,6kB' title='Logo' height='75''>";
echo  "Collegamento</h3>"; 
          echo  "<hr >";  
//   prepara il modulo del login  
          echo  "<form name='modulo' action='login_test.php' method='post'>";
           $f = new input(array('','uten',30,'Utente','Nome utente','i'));
           $f->field();

           $f = new input(array('','pass',30,'Password','Inserire la password','pw'));
           $f->field();
          echo  "<br ><button type=submit name=submit value=Login>Accedi</button>";
          echo  "</form>";

          if  ($_COOKIE['err'] == 1)
          {      
          echo  "<p class=red><b>Credenziali NON VALIDE !</b></p>";
          }
          else
          {
          echo  "<p>&nbsp;&nbsp;&nbsp;&nbsp;</p>" ;
          }
          echo  "<form name=modulo_back action=uscita.php method=post>"; 
          echo  "<hr >";
          echo  "<button type=submit name=submit_back value=Ritorno>Ritorno</button>"; 
          echo  "</form>";

          echo  "</div></div></div>"; 

    }
}
    
/** ********************************************
 * @class:          login_test
 * @description:    controllo credenziali di collegamento
 * @author:         Fausto Bresciani  
 * @email:          fbsoftware@libero.it
 * @version:        0.1
 * ********************************************/

class login_test          extends DB
     { 

	// variabili
	public $callbk_ok = '';
	public $callbk_err = '';

	// costruttore
  public function __construct($callbk_ok,$callbk_err)
	{
	$this->callbk_ok = $callbk_ok ;
     $this->callbk_err = $callbk_err ;
	}

/************************************************
 * @method:   ckUser()
 * @description: controllo credenziali di collegamento
 * **********************************************/

  public function ckUser()
     {
     $username =$_POST['uten']; 
     $upassword =$_POST['pass']; 

     // cripto la password
     $passmd5  =md5($upassword);    
     $ok       = '  ';
          $con = "mysql:host=".self::$host.";dbname=".self::$db.""; 
          $PDO = new PDO($con,self::$user,self::$pw);
          $PDO->beginTransaction();

     $sql = "  SELECT * 
               FROM `".DB::$pref."ute`
               WHERE username='$username' ";
     foreach($PDO->query($sql) as $row)  
     {         
    	if ( $row['upassword'] == $passmd5)
            {    
            setcookie('admin','admin',time()+3600,'','','');
            setcookie('accesso',$row['uaccesso'],time()+3600,'','','');
            setcookie('err',0,time()+3600,'','','');   
            header('location:'.$this->callbk_ok.'') ;
            }
       else
           { 
           $ok='no';  
           $pwx = $row['upassword'];   
           echo "| pw-errata=".$pwx;
           setcookie('err',1,time()+3600,'','','');
           header('location:'.$this->callbk_err.'') ;  
           } 
    } 
ob_end_flush();    	
     }
}    
/**===============================================================================
  Crea select dei files .php/.htm/.html contenuti in una cartella  
  Metodi:
  file()            elenca in una select i files nella directory
  Variabili:
  valore            nome del file selezionato
============================================================================= */
class select_file 
{        
        public $path   ='';
        public $valini =''; 
        public $campo  ='';
        public $valore ='';              // scelta della select
        public $label  ='';
        public $toolt  ='';              // tooltip
         
    public function __construct($path,$valini,$campo,$label,$toolt)       
               { 
               $this->path    = $path;
               $this->valini  = $valini;
               $this->campo   = $campo;
               $this->label   = $label; 
               $this->toolt   = $toolt;                                            
               }   

    public function file()               
    {   
$dh  = opendir($this->path);
if (is_dir($this->path)) 
{
while (false !== ($filename = readdir($dh))) 
     {
     if(!is_dir($filename))   $files[] = $filename;
     }
//closedir($this->path);       
} 
else {
	echo "Directory non trovata";
}
// elaborazione dell' array 
sort($files);
echo "<br />";
$nx=count($files);
 echo "<label for='$this->campo'><a href='#' data-toggle='tooltip' title=$this->toolt>$this->label</a></label>";
 echo "<select name='$this->campo'>";
for ($n=0; $n<$nx ;$n++ ) 
{
	

if (($files[$n] != '.') && ($files[$n] != '..'))
{
     $file_ext = substr($files[$n], strripos($files[$n], '.')); 
     if  ($file_ext == '.php'  || $file_ext == '.htm' || $file_ext == '.html')
     {
          if ($files[$n] == $this->valini) 
          echo "<option selected='selected' value='$this->valini'>".$files[$n]."</option>";	                                              
          else
          echo "<option value='$files[$n]'>".$files[$n]."</option>";	
     }
}

}
echo "</select>";
}

// ==================================
        public function image()               
    {    
     $f=opendir($this->path) ;
     while(false!==($g=readdir($f)))          //legge fino a false
     {
         if($g!="." && $g!="..")              //elimino il punto ed i doppi punti
         {   if(is_dir($this->path.$g))            //creo un array con le directory trovate
             { $array_dir[]=$g; }
               if(is_file($this->path.$g))       //creo un array con i file trovati
                  { $array_file[]=$g;
                  $numg++; }                 //numero di file trovati
         }
     }
     closedir($f);                           //chiudo la directory
           echo "<fieldset class='input'><div>
                 <label for='$this->campo'><a href='#' data-toggle='tooltip' title='$this->toolt'>$this->label</a></label>";    
           echo "<select name='$this->campo'>";
           echo "<option value=''>".NULL."</option>";
           $conto2=count($array_file);
           for($b=0; $b<$conto2; $b++)
           { 
           $file_ext = substr($array_file[$b], strripos($array_file[$b], '.')); 
          if  ($file_ext=='.jpg'  || $file_ext=='.png' || $file_ext=='.gif'
             || $file_ext=='.JPG'  || $file_ext=='.PNG' || $file_ext=='.GIF')
           $this->valore = $array_file[$b]; 
               { 
               if ($this->valini == $this->path.$this->valore)
                 {
                 echo "<option selected='selected' value=".$this->valini.">
                       ".$this->valini."
                       </option>"; 
                 }
                 else  echo "<option value=".$this->path.$this->valore.">".$this->path.$this->valore."</option>"; 
               }
           }    
           echo "</select></div></fieldset>";
    }
}
/**===============================================================================
  Crea select dei files .php/.htm/.html contenuti nella root
  Metodi:
  select_dir()      elenca in una select i files nella root
  Variabili:
  valore            nome del file selezionato
============================================================================= */
 class select_root
{
        public $valini ='';
        public $campo  ='';
        public $valore ='';              // scelta della select
        public $label  ='';

    public function __construct($valini,$campo,$label)
               {
               $this->valini  = $valini;
               $this->campo   = $campo;
               $this->label   = $label;
               }

  public function select_dir()
{
$path = $_SERVER['SCRIPT_FILENAME'];  //identifica il percorso della Directory
$path_parts = pathinfo($path);        // effettua parsing della path
 // apre la directory
$dir_handle = opendir($path_parts['dirname']) or die("Impossibile aprire ".$path_parts['dirname']);
$dh  = opendir($path_parts['dirname']);
while (false !== ($filename = readdir($dh)))
     {
      $files[] = $filename;
     }
//closedir($path_parts);
sort($files);
echo "<fieldset class='input'><div>
          <label for='$this->campo'>$this->label</label>";
echo "<select name='$this->campo'>";
echo "<option value=''>Scegliere il file</option>";

 foreach ($files as $key=>$this->valore)
     {
          if (strpos($this->valore, '.php',1)
           || strpos($this->valore, '.html',1)
           || strpos($this->valore, '.htm',1))
          {
   //       echo "<a href='$file'>$file</a><br/>";
               if ($this->valini == $this->valore)
                 {
                 echo "<option selected='selected' value=".$this->valini.">
                       ".$this->valini."
                       </option>";
                 }
                 else  echo "<option value=".$this->valore.">".$this->valore."</option>";

          }
     }
echo "</select>";
}

}
/**===========================================================================
   * Classe per la gestione degli inglobamenti di HTML specifico nei testi
   * per gestire:
   * - video YpuTube
   * - gallery Picasa
   * - testo scorrevole
   * - select a scelta singola
   * - select a scelta multipla
   * - calendario Google
   * - mappa Google (+ 31/10/2014)
   * - indicatore ShinyStat
   * - spezzone di html
=============================================================================*/
class txt
     {
     public $text ='';          // testo da trattare
     public $testo=array();     // array interna

        public function __construct($text)
               {
               $this->testo  = $text;
               }

        public function ingloba()
        {
          $testo = $this->testo  ;
          $this->testo=explode('{media}',$this->testo);
          $i=0;
          for ($i=0; $i < count($this->testo) ;$i++ )
          {
// YouTube
               if (substr($this->testo[$i],0,8) == 'youtube|')
               { echo "<br />";
               $codvid=array();
               $testoi=$this->testo[$i];
               list($codvid,$width,$height)=explode('|',substr($this->testo[$i],8));
               if ($width  <= 0)   $width=480;
               if ($height <= 0)   $height=360;
               echo "<div id='wrapp'>
               <iframe id='player'  src='https://www.youtube.com/embed/".$codvid."'
               frameborder='0' allowfullscreen>
               </iframe></div><br />";
               }
// gallery Picasa
                elseif (substr($this->testo[$i],0,7) == 'picasa|')
               {echo "<br />";
               $codvid=array();
               $testoi=$this->testo[$i];
               list($coduser,$codgal,$width,$height)=explode('|',substr($this->testo[$i],7));
               if ( $width == 0) $width=400;
               if ( $heigh == 0) $heigh=300;
               $rgb="0x".TMP::$tcolchi;    if ( $rgb == '0x      ')  $rgb='0xffffff';
               echo  "<embed type='application/x-shockwave-flash' ";
               echo  "src='https://picasaweb.google.com/s/c/bin/slideshow.swf'";
               echo  "width='".$width."'";
               echo  "height='".$heigh."'";
               echo  "flashvars='host=picasaweb.google.com&captions=1&noautoplay=1&hl=it&feat=flashalbum&RGB=".$rgb."&feed=https%3A%2F%2Fpicasaweb.google.com%2Fdata%2Ffeed%2Fapi%2Fuser%2F".$coduser."%2Falbumid%2F".$codgal."%3Falt%3Drss%26kind%3Dphoto%26hl%3Dit' ";
               echo  "pluginspage='http://www.macromedia.com/go/getflashplayer'></embed>";
               }
// marquee
               elseif (substr($this->testo[$i],0,8) == 'marquee|')
               {
               echo "<br />";
               list($marq_text)=explode('|',substr($this->testo[$i],8));
               echo "<marquee scrollamount=3 scrolldelay=9 >$marq_text</marquee><br />";
               }
// select
               elseif (substr($this->testo[$i],0,7) == 'select|')
               {
               echo "<br />";
               $select_text=array();
               $testoi=$this->testo[$i];
               echo "<select>";
               $select_text=explode('|',substr($this->testo[$i],7));
               $conta = count($select_text);
               for($x=0; $x<$conta; $x++)
               {
               echo "<option value='$select_text[$x]'>$select_text[$x]</option>";
               }
               echo "</select><br />";
               }
// select a scelte multiple
               elseif (substr($this->testo[$i],0,8) == 'selectm|')
               {
               echo "<br />";
               $select_text=array();
               $testoi=$this->testo[$i];
               echo "<select multiple='multiple'>";
               $select_text=explode('|',substr($this->testo[$i],8));
               $conta = count($select_text);
               for($x=0; $x<$conta; $x++)
               {
               echo "<option value='$select_text[$x]'>$select_text[$x]</option>";
               }
               echo "</select><br />";
               }
// calendario Google
               elseif (substr($this->testo[$i],0,12) == 'calengoogle|')
               {
               $calen = "<iframe src='https://www.google.com/calendar/embed?title=Calendario%20eventi%202014&amp;height=375&amp;wkst=1&amp;hl=it&amp;bgcolor=%23ff6666&amp;src=gbnh153mq19ahltfdsj9t6788s%40group.calendar.google.com&amp;color=%23711616&amp;ctz=Europe%2FRome' style=' border:solid 1px #777 ' width='490' height='375' frameborder='0' scrolling='no'></iframe>
               ";
               $this->testo[$i] = $calen;
               echo "<br />".$this->testo[$i];
                }
// mappa Google
               elseif (substr($this->testo[$i],0,12) == 'mappagoogle|')
               {
               $codvid=array();
               $testoi=$this->testo[$i];
               list($indir,$luogo)=explode('|',substr($this->testo[$i],12));
               $map = "<iframe   width='180'    height='180' frameborder='0' style='border:0'
                    src='https://www.google.com/maps/embed/v1/place?key=AIzaSyDVQgfYwTz6wN0SlnTttmAuNJRz69270Fg
                    &q=".$indir.",".$luogo."></iframe>";
               $this->testo[$i] = $map;
               echo "<br />".$this->testo[$i];
                }
// ShinyStat
               elseif (substr($this->testo[$i],0,10) == 'shinystat|')
               {
               $shiny = "<!-- Begin Shinystat code -->
               <script type='text/javascript' src='http://codice.shinystat.com/cgi-bin/getcod.cgi?USER=fbsoftware'></script>
               <noscript>
               <a href='http://www.shinystat.com' target='_top'>
               <img src='http://www.shinystat.com/cgi-bin/shinystat.cgi?USER=fbsoftware' alt='Free hit counters' border='0' /></a>
               </noscript>
               <!-- End Shinystat code -->
               ";
               $this->testo[$i] = $shiny;
               echo "<br />".$this->testo[$i];
               }
// html
               elseif (substr($testo[$i],0,5) == 'html|')
               {
               $codvid=array();
               $testoi=$testo[$i];
               include substr($testo[$i],5,25);
               }



// altrimenti mantengo il testo originario
               else
               {
               echo $this->testo[$i];
               }

          }
     }
     }
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

/**
 * @class:      imgUpdTable
 *
 * @description:Tabella con immagini dimensionate e celle per riga
 *               e possibilità di upload/download.
 * @author Fausto Bresciani <fbsoftware@libero.it>
 * @version 0.1
 */
class imgUpdTable    extends imgTable
{ // BEGIN class imgUpdTable
	// variabili
	public $path   = NULL;       // directory delle immagini
	public $height = 0;          // altezza max immagine
	public $width  = 0;          // larghezza max immagine
	public $numero = 0;          // celle per riga
	public $callbk = 0;          // action del form
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
     // form per gestione
     echo "<form method='post' action='".$this->callbk.".php'>";
        // verifica dimensioni
        $dim = getimagesize($array_file[$b]);
        $x=$dim['0'];    $y=$dim['1'];

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
        echo    "</a><br >".$array_file[$b] = str_replace($this->path,'',$array_file[$b]);

        // bottone di cancellazione
        echo    "<div><input type='hidden' name='img_del' value='$array_file[$b]'>";
        echo    "<br ><button name='submit' type='submit' value='canc'>
          <img src='images/cancel_f2.png' width='18' vspace='0'
          alt='canc' align='left'></button>";
        // bottone di download e chiusura form
        echo    "<input type='hidden' name='img_del' value='$array_file[$b]'>";
        echo    "<button name='submit' type='submit' value='download'>
          <img src='images/down.png' width='18' vspace='0'
          alt='download' align='right'></button></div></form>";


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
/**=============================================================================== 
  Classe 'getBootHead'       
  metodo getBootHead()    crea testata di HTML per framework Bootstrap
============================================================================= */
class getBootHead
{
public $titolo=""; 

        public function __construct($titolo)       
               { $this->titolo = $titolo;  }
			   
               
function getBootHead() 
     { 
echo "<head>";

?> 
     <title><?php echo DB::$page_title." - ".$this->titolo; ?></title>
     <meta charset="utf-8">
     <!-- Bootstrap -->
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="css/stili-custom.css" type="text/css" media="screen">
     <!-- Jquery -->
  <script src="jquery/jquery-1.12.4.js"></script>
  <script src="jquery/ui/1.12.1/jquery-ui.js"></script>  
  <link rel="stylesheet" href="jquery/ui/1.12.1/themes/base/jquery-ui.css">
<?php 
//-- personali -->
include 'include_head.php';
echo "</head>";
     }
}
/**=============================================================================== 
  Classe 'Head'       
  metodo openHead()    crea testata di HTML 
  metodo closeHead()    chiude testata di HTML
============================================================================= */
class Head
{
public $titolo=""; 

        public function __construct($titolo)       
            { $this->titolo = $titolo;  }
               
	function openHead() 
    { 
	echo "<head>";
    echo "<title>".DB::$page_title." - ".$this->titolo."</title>";
	echo "<meta charset='utf-8'>";
	echo "<meta http-equiv='content-type' content='text/html'> ";
	echo "<meta name='description' 	content='".DB::$site."' >";             
    echo "<meta name='keywords' 	content='".DB::$keywords."' >";             
    echo "<meta name='author' 		content='".DB::$author."' >";	           

	// personali 
	include 'include_head.php';
     }
	 
	function closeHead() 
    { 
	echo "</head>";
     }
}

/**=============================================================================== 
  Classe 'getJquery'       
  metodo getJquery()    script per Jquery
============================================================================= */
class Jquery
{
               
function getJquery() 
	{ 
	echo "<script src='http://code.jquery.com/jquery-1.12.4.js'></script>
	<script src='https://code.jquery.com/ui/1.12.1/jquery-ui.min.js'></script>  
	<link rel='stylesheet' href='http://code.jquery.com//ui/1.12.1/themes/base/jquery-ui.css'>
    <script src='js/FBbase.js'></script>
    <script src='js/date_picker_it.js'></script>";
	}
	
}

/**=============================================================================== 
  Classe 'getBootstrap'       
  metodo getBootstrap()    script per Bootstrap
============================================================================= */
class Bootstrap
{
function getBootstrap() 
    { 
	echo "<meta name='viewport' content='width=device-width, initial-scale=1'>
     <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
     <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
     <link rel='stylesheet' href='css/stili-custom.css' type='text/css' media='screen'>";
    }
}

/**=============================================================================== 
  Classe 'getEditor'       
  metodo getJEditor()    editore di testi================================= */
class Editor
{
               
function getEditor() 
	{ 
	include('tinys.php');
	echo " <link rel='stylesheet' type='text/css' href='tinymce/jscripts/tiny_mce/themes/advanced/skins/default/ui.css'>";
	}
}

/**=============================================================================== 
  Classe 'testChoice'       
  metodo testChoice()    test sulla scelta del pgm precedente
============================================================================= */
class testChoice
{
public $id     =0;
public $azione ="";  
public $callbk ="";

public function __construct($id,$azione,$callbk)       
          { 
          $this->id      = $id;  
          $this->azione  = $azione;
          $this->callbk  = $callbk;          
          }
               
function testChoice() 
          { 
          echo $this->id;//debug
          if (($this->azione == 'modifica' || $this->azione == 'cancella') && $this->id < 1) 
               {
               $_SESSION['esito'] = 4;
               header('location:'.$this->callbk.'');
               }
          }
}
/**=============================================================================== 
  Classe 'msg'       
  metodo msg()    Segnalazione errori
============================================================================= */
     class msg
{
public $errore = '';
public $numero = 0;           // variabile numero per if

        public function __construct($errore)       
               { 
               $this->errore = $errore;
               $this->numero = $this->errore;
               }
               
         function msg()
               { 
               echo "<div class='row'>";
               echo "<div class='col-md-6'>";

                    // danger  0 - 50               
               if ($this->numero > -1  &&  $this->numero < 51)     
                    {echo "<div class='alert alert-danger'>";
                    echo "<img src='images/stop.png' height=20 alt='stop'>";}
                    // success  51 - 100
               if ($this->numero > 50  &&  $this->numero < 101)     
                    {echo "<div class='alert alert-success'>";
                    echo "<img src='images/ok.png' height=20 alt='ok'>"; }
                    // warning  101 - 150
               if ($this->numero > 100  &&  $this->numero < 151)   
                    { echo "<div class='alert alert-warning'>";
                    echo "<img src='images/xdb.png' height=20 alt='nota'>";}
                    // info  151 - 200
               if ($this->numero > 150  &&  $this->numero < 201)     
                    { echo "<div class='alert alert-info'>";
                    echo "<img src='images/info.png' height=20 alt='info'>"; }
                           
                    $f1 = new DB_decxdb('msg',$this->numero);
                    echo "&nbsp;&nbsp;&nbsp;".$f1->decxdb();
                    echo "</div>";                    
                      
               echo "</div>";           // col     
               echo "</div>";           // row
               unset($_SESSION['esito']);                   
               }
}
/**=============================================================================== 
  Trattamento della data fra PHP e MySql e viceversa
  Metodi:
  flipdata()         capovolge campo data 
============================================================================= */
class data          

{       public $datain='';  
        public $dataout='';
      
     public function __construct($datain)       
          { 
          $this->datain       = $datain;       // data letta da MySql
          $this->dataout      = $dataout;      // data convertita per video
          }   

     public function flipData()
          {
          $this->dataout = explode ('-',$this->datain);
          $this->dataout = array_reverse($this->dataout);
          return implode($this->dataout,'-');
          }
}  
?> 
