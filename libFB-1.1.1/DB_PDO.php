<?php   
/** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
 * 
   * @pakage		libFB-1.0.0
   * versione 3.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
=============================================================================== */
/**  File: DB.php 
 *   
* @pakage		DB class                                                  
  Classe "DB" per la gestione del database e della configurazione.
  Parametri di connessione memorizzati in 'config.ini' ed accessibili come
  proprietà statiche.
  3.0     impiego di PDO per MySQL
  3.1.1   tolto parametro
============================================================================= */
class DB
{      
        public static $con  = '';         // collegamento  
        public static $PDO  = '';         // collegamento PDO
        public static $host = '';         // host
        public static $user = '';         // utente
        public static $db   = '';         // database
        public static $pw   = '';         // password
        public static $pref = '';         // prefisso archivi
        public static $ambi = '';         // ambiente 'sito/amm'
        public static $incr = 0;          // incremento per inserimento  
        public static $root = '';         // root - localhost
        public static $site = '';         // nome del sito
        public static $sep = '';          // separatore directory
        public static $dir_cont = '';     // directory contenuti
        public static $dir_imm = '';      // directory immagini
        public static $dir_help = '';     // directory contenuti di help
        public static $path_site = '';    // path del sito
        public static $path_imm = '';     // path completo immagini
        public static $page_title = '';   // titolo del sito
        public static $content = '';      // colonna dei contenuti
        public static $e_mail = '';       // e-mail relativa al sito       
        public static $url = '';          // url del sito (http://....)
        public static $livello = '';      // livello di versione
        public static $modifica = '';     // modifica di versione
        public static $rilascio = '';     // rilascio di versione
        public static $author = '';       // autore
        public static $keywords = '';     // parole chiave
        public static $lib = '';          // libreria standard
		
//        public $mod_ins = 0;              // progressivo per inserimento moduli
        public $max = 0;                  // nuovo inserimento

  
        public function __construct()     
          {
          $arr = parse_ini_file ( "config.ini" , true );

                  self::$livello   = $arr['versione']['livello'];
                  self::$rilascio  = $arr['versione']['rilascio'];
                  self::$modifica  = $arr['versione']['modifica'];

                  self::$root      = $arr['DB']['root'];
                  self::$host      = $arr['DB']['host'];
                  self::$user      = $arr['DB']['user'];
                  self::$pw        = $arr['DB']['pw'];
                  self::$db        = $arr['DB']['db'];
                  self::$pref      = $arr['DB']['pref'];

                  self::$incr       = $arr['config']['incr'];
                  self::$site       = $arr['config']['site'];
                  self::$sep        = $arr['config']['sep'];
                  self::$dir_imm    = $arr['config']['dir_imm'];
                  self::$page_title = $arr['config']['page_title'];
                  self::$e_mail     = $arr['config']['e_mail'];
                  self::$url        = $arr['config']['url'];
                  self::$author     = $arr['config']['author'];
                  self::$keywords   = $arr['config']['keywords'];
				  self::$lib        = $arr['config']['lib'];
				  
                  self::$path_site  = DB::$root.DB::$site.DB::$sep;
                  self::$path_imm  = DB::$root.DB::$site.DB::$sep.DB::$dir_imm;
          return $arr;
         }
				  
// destruct        
         public function __destruct()      // chiusura DB e connessione
        {   $con = NULL;
        }
}
/** 
===============================================================================
* @pakage		TMP class
  Classe per la gestione della tabella 'tmp' dei template
=============================================================================== 
*/

class TMP       extends  DB
{ public static $ambiente     =  '';	// ambiente: sito,admin
  public static $tid     =  '';
  public static $tprog   =  '';
  public static $tstat   =  '';
  public static $tsel    =  '';
  public static $ttdesc  =  '';
  public static $tfolder =  '';
  public static $tdesc   =  '';
  public static $tmenu   =  '';
  public static $tlang   =  '';        // template - lingua
  public static $tcolor  =  '';        // colore base del template
  public static $tslidebutt   = '';    // slide - bottoni navigazione
  public static $tslidetime   = 0;     // slide - tempo permanenza immagine
  public static $tportitle    = '';    // portfolio - titolo
  public static $tgliftitle   = '';    // glifi - titolo
  public static $tgliftext    = '';    // glifi - testo
  public static $tglyforma    = '';    // glifi - forma  
  public static $tglyreverse  = '';    // glifi - reverse color

		function __construct($ambiente ='sito') 
		{
		self::$ambiente = $ambiente;
		}

       public function  read_tmp()       // legge template selezionato
            { 
              $con = "mysql:host=".self::$host.";dbname=".self::$db."";
              $PDO = new PDO($con,self::$user,self::$pw);
              $PDO->beginTransaction();
					if (self::$ambiente == 'sito') 
					{
              $sql="SELECT *
                    FROM `".self::$pref."tmp`
                    WHERE tsel='*' 
					AND	  ttipo <> 'admin'
					limit 1";
					} 
					else 
					{
              $sql="SELECT *
                    FROM `".self::$pref."tmp`
                    WHERE tsel='*' 
					AND	  ttipo = 'admin'
					limit 1";
					}			  

              foreach($PDO->query($sql) as $row)
              {  
               self::$tid     		= $row['tid'];
               self::$tprog   		= $row['tprog'];
               self::$tstat   		= $row['tstat'];
               self::$tsel    		= $row['tsel'];
               self::$ttdesc  		= $row['ttdesc'];
               self::$tfolder 		= $row['tfolder'];
               self::$tdesc   		= $row['tdesc'];
               self::$tmenu   		= $row['tmenu'];
               self::$tlang   		= $row['tlang'];
               self::$tcolor  		= $row['tcolor'];
               self::$tslidebutt    = $row['tslidebutt'];
               self::$tslidetime    = $row['tslidetime'];
               self::$tportitle     = $row['tportitle'];
               self::$tglyforma     = $row['tglyforma'];
               self::$tgliftitle    = $row['tgliftitle'];
               self::$tgliftext     = $row['tgliftext'];
               self::$tglyreverse   = $row['tglyreverse'];
               }
               return $row;   // per eventuale utilizzo
          }



}             
/**=============================================================================== 
  Calcola in valore del progressivo per inserimento record nel database
  Metodi:       
  insert()       
  Ritorna : progressivo per inserimento
/**  -----------------------------------------------------------
  Esempio: $x = new DB_ins('tabella','campo del progressivo')
============================================================================= */
class DB_ins          extends DB

{       public $tabella ='';
        public $prog    ='';
// variabili interne
        public $max     = 0;  
  
    public function __construct($tabella,$prog)       
           { 
           $this->tabella = $tabella;
           $this->prog    = $prog;     // campo del progressivo di ordinamento
           }   

       public function insert()          // n° record inserimento da confog.ini
              { 
              $con = "mysql:host=".self::$host.";dbname=".self::$db.""; 
              $PDO = new PDO($con,self::$user,self::$pw);
              $PDO->beginTransaction(); 
                                        
              $sql = "   SELECT * 
                         FROM ".self::$pref.$this->tabella."
                         ORDER BY ".$this->prog." desc 
                         limit 1";

              foreach($PDO->query($sql) as $row)                      
                    { 
                    $this->max  =($row[$this->prog] + self::$incr); 
                    }
                    if ($this->max == 0) {$this->max = self::$incr;} 
               return $this->max;                  
              }              

       public function insert1()          // n° record inserimento +1
              {                            
             { 
              $con = "mysql:host=".self::$host.";dbname=".self::$db.""; 
              $PDO = new PDO($con,self::$user,self::$pw);
              $PDO->beginTransaction(); 
                                        
              $sql = "   SELECT * 
                         FROM ".self::$pref.$this->tabella."
                         ORDER BY ".$this->prog." desc 
                         limit 1";

              foreach($PDO->query($sql) as $row)                      
                    { 
                    $max =($row[$this->prog] + 1); 
                    $this->max = $max;
                    }
                    if ($this->max == 0) {$this->max = self::$incr;} 
               return $this->max;                  
              }              
              }              


}
/**=============================================================================== 
  Select delle tipologie prestabilite
  Metodi:
  select()         select della tipologia richiesta 
                    + label, se valorizzata
                    + autofocus se valorizzato
============================================================================= */
class DB_tip_i          extends DB

{       public $tipo   ='';        // tipologia
        public $nome   ='';        // nome della variabile POST
        public $valini ='';        // valore iniziale (if)
        public $label  ='';        // label del campo (if)
        public $toolt  ='';        // Placeholder-tooltip
        
        public function __construct($tipo,$nome,$valini,$label,$toolt)       
               { $this->tipo    = $tipo;     
                 $this->nome    = $nome;     
                 $this->valini  = $valini;  
                 $this->label   = $label; 
                 $this->toolt   = $toolt;                   
               }

        public function select()       
          { 
               echo "<div>"; 
               if ($this->label > '')
               {
               echo "<label for='$this->nome' data-toggle='tooltip' 
			title='$this->toolt' name='$this->toolt'>$this->label</label>";
               echo "<select name='$this->nome'";
               echo " ><br >";
               }
               $con = "mysql:host=".self::$host.";dbname=".self::$db.""; 
               $PDO = new PDO($con,self::$user,self::$pw);
               $PDO->beginTransaction();
               $sql = "SELECT * FROM ".self::$pref."xdb
                  WHERE xtipo = '$this->tipo' and xstat <> 'A'       
                  ORDER BY xtipo,xdes";  
                                                  
              foreach($PDO->query($sql) as $row)            
              {  
              if    ($row['xcod'] == $this->valini)
                    {echo "<option selected='selected' value='".$row['xcod']."'>
                       ".$row['xdes']."</option>"; }
              else
                    echo "<option value=".$row['xcod'].">".$row['xdes']."</option>"; 
              }
            echo "</select></div>";
          } 
          
        public function select_lin()      // per lingue con bandierina 
          { 
               echo "<div>"; 
               if ($this->label > '')
               echo "<label for='$this->nome' title='$this->toolt'>$this->label</label>";
               echo "<select name='$this->nome'";
               echo " ><br >";
               $con = "mysql:host=".self::$host.";dbname=".self::$db.""; 
               $PDO = new PDO($con,self::$user,self::$pw);
               $PDO->beginTransaction();
               $sql = "SELECT * FROM ".self::$pref."xdb
                  WHERE xtipo = '$this->tipo'        
                  ORDER BY xtipo,xdes";  
                  
              foreach($PDO->query($sql) as $row)            
              {  if ($row['xcod'] == $this->valini)
                 {echo "<option selected='selected' value='".$row['xcod']."'>
                       ".$row['xdes']."</option>"; }
              else {
              echo "<option value=".$row['xcod']." alt='naz' style='background: #ff0000 url(images/".$row['xcod'].".jpg) no-repeat 0,0;'>".$row['xdes']."</option>";  }
              }
            echo "</select></div>";
          } 

}  
/**=============================================================================== 
  Classe 'DB_mnu'     Funzioni per tabella 'mnu'
  Metodi:
  select_mnu()         select dei menu
============================================================================= */
class DB_mnu          extends DB

{       public $valore='';   
  
               public function __construct($valore)       
               { $this->valore = $valore; }   
             
         
        public function select_mnu2()       // tipo menu
          { echo "<select name=menu>";
            $sql="SELECT DISTINCT bmenu 
                         FROM ".self::$pref."mnu 
                         ORDER BY bmenu";
            $result = mysql_query($sql);
            while($row = mysql_fetch_array($result))
              {   // includi tutto  
                if  ($n == 0)
                {
                     if ( $_SESSION['selected'] <> '') 
                        {echo "<option selected value='".$_SESSION['selected']."'>".$_SESSION['selected']."</option>"; }
                echo "<option value='tutto' name='sel_mnu'>Tutti ...</option>"; 
                $n++;
                }
              echo "<option  name='sel_mnu' value=".$row['bmenu'].">".$row['bmenu']."</option>";  
              }
            echo "</select>";
          }  
   
}
/**=============================================================================== 
  Funzioni di utilita' database
  Metodi:
 decod()              decodifica di campo di tabella su chiave doppia
 ============================================================================= */
class DB_decod          extends DB

{       public $tabella ='';
        public $stato   ='';
        public $key     ='';
        public $campo   ='';
        public $descr   ='';
        public $tipo    ='';
                                                     
    public function __construct($tabella,$tipo,$stato,$key,$campo,$descr)       
           { 
           $this->tabella = $tabella;        // tabella
           $this->stato   = $stato;          // campo stato record (!A=valido)  
           $this->tipo    = $tipo;           // valore tipo (settore)
           $this->key     = $key;            // nome campo chiave (elemento)
           $this->campo   = $campo;          // valore campo chiave
           $this->descr   = $descr;          // nome campo decodifica
           }   
             
    public function decod()       // decodifica del campo chiave
           { 
           $PDO = new DB('sito'); 
              $con = "mysql:host=".self::$host.";dbname=".self::$db."";
              $PDO = new PDO($con,self::$user,self::$pw);
              $PDO->beginTransaction();
           $sql="SELECT * 
                 FROM ".self::$pref.$this->tabella." 
                 WHERE ".$this->stato." !='A' 
                    and  xtipo = '".$this->tipo."'
                    and ".$this->key." = '".$this->campo." '" ;
     foreach($PDO->query($sql) as $row)                     
             {
              return $row[$this->descr] ;  
             }
            }
             
    public function upd_xdb()       // update descrizione tabella xdb
           { 
           $db1 = new DB('sito'); 
           $this->descr = $this->descr++;
           $sql="UPDATE ".self::$pref.$this->tabella."
                 SET xdes = ".$this->descr." 
                 WHERE ".$this->stato." !='A' 
                   and ".$this->key1." = '".$this->campo1." '
                   and ".$this->key2." = '".$this->campo2." '                   
                   " ;
           $res2 = mysql_query($sql);   
           }
 
}
/**=============================================================================== 
  Funzioni di utilita' database
  Metodi:
 decod()              decodifica codice di 'xdb'
 ============================================================================= */
class DB_decxdb          extends DB

{       
        public $campo   ='';
        public $tipo    ='';
                                                     
    public function __construct($tipo,$campo)       
           { 
           $this->tipo    = $tipo;           // valore tipo (settore)
           $this->campo   = $campo;          // valore campo chiave
           }   
             
    public function decxdb()       // decodifica del campo chiave
           { 
           $PDO = new DB('sito'); 
              $con = "mysql:host=".self::$host.";dbname=".self::$db."";
              $PDO = new PDO($con,self::$user,self::$pw);
              $PDO->beginTransaction();
           $sql="SELECT * 
                 FROM ".self::$pref."xdb 
                 WHERE xstat !='A' 
                    and  xtipo = '".$this->tipo."'
                    and  xcod  = '".$this->campo." '" ;
     foreach($PDO->query($sql) as $row)                     
             {
              return $row['xdes'] ;  
             }
            }
}

/**============================================================================== 
  Funzioni di utilita' database
  Metodi:
  select()             select di campo di tabella con label e tooltip
============================================================================= */
class DB_sel_lt          extends DB

{ 
        public $tabella;        // tabella                              
        public $prog;           // campo del progressivo di ordinamento
        public $valini;         // valore iniziale (if selected)       
        public $campo;          // valore passato a POST               
        public $select;         // nome variabile POST (name-select)   
        public $stato;          // campo stato record (!A=valido)      
        public $option;         // campo option da mostrare            
        public $label;          // label select                        
        public $toolt;          // tooltip    
            
    public function __construct($tabella,$prog,$valini,$campo,$select,$stato,$option,$label,$toolt)       
           {   
           $this->tabella = $tabella;        // tabella
           $this->prog    = $prog;           // campo del progressivo di ordinamento
           $this->valini  = $valini;         // valore iniziale (if selected)
           $this->campo   = $campo;          // valore passato a POST
           $this->select  = $select;         // nome variabile POST (name-select)
           $this->stato   = $stato;          // campo stato record (!A=valido)
           $this->option  = $option;         // campo option da mostrare
           $this->label   = $label;          // label select
           $this->toolt   = $toolt;          // tooltip
           }   
              
    public function select_lt()           // crea select con label e tooltip su un campo
           {
           echo "<div>";
               if ($this->label > '')
           echo "<label for='$this->select'><a href='#' data-toggle='tooltip' title='$this->toolt'>$this->label</a></label>"; 
           echo "<select name='$this->select'>";
          $con = "mysql:host=".self::$host.";dbname=".self::$db."";
          $PDO = new PDO($con,self::$user,self::$pw);
          $PDO->beginTransaction();

              $sql="SELECT * 
                    FROM ".self::$pref.$this->tabella." 
                    WHERE ".$this->stato." !='A' 
                    ORDER BY ".$this->prog." ";
          foreach($PDO->query($sql) as $row)
            { 

               if ($row[$this->campo] == $this->valini)
                 {echo "<option selected='selected' value='".$row[$this->campo]."'>".$row[$this->option]."</option>"; }
               else
                 {echo "<option value='".$row[$this->campo]."'>".$row[$this->option]."</option>"; 
                       echo $row[$this->campo]."<br >";}                  
            }  
           echo "</select></div>";
          }
}
/**============================================================================== 
  Funzioni di utilita' database
  Metodi:
  select()             select di campo di tabella con label 
============================================================================= */
class DB_sel_l          extends DB

{ 
        public $label   ='';
  
    public function __construct($tabella,$prog,$valini,$campo,$select,$stato,$option,$label,$toolt)       
           { 
           $this->tabella = $tabella;        // tabella
           $this->prog    = $prog;           // campo del progressivo di ordinamento
           $this->valini  = $valini;         // valore iniziale (if selected)
           $this->campo   = $campo;          // valore passato a POST
           $this->select  = $select;         // nome variabile POST (name-select)
           $this->stato   = $stato;          // campo stato record (!A=valido)
           $this->option  = $option;         // campo option da mostrare
           $this->label   = $label;          // label select
           $this->toolt   = $toolt;          // Tooltip
           }   
              
    public function select_label()           // crea select con label su un campo
           {
           echo "<div>";
               if ($this->label > '')
           echo "<label for='$this->select'><a href='#' data-toggle='tooltip' title='$this->toolt'>$this->label</a></label>";
           echo "<select name='$this->select'>";
          $con = "mysql:host=".self::$host.";dbname=".self::$db."";
          $PDO = new PDO($con,self::$user,self::$pw);
          $PDO->beginTransaction();

              $sql="SELECT * 
                    FROM ".self::$pref.$this->tabella." 
                    WHERE ".$this->stato." !='A' 
                    ORDER BY ".$this->campo." ";
          foreach($PDO->query($sql) as $row)
            { 
               if ($row[$this->campo] == $this->valini)
                 {echo "<option selected='selected' value=".$row[$this->campo].">
                       ".$row[$this->option]."
                       </option>"; }
               else
                 {echo "<option value='".$row[$this->campo]."'>
                       ".$row[$this->option]."
                       </option>"; 
                       echo $row[$this->campo]."<br >";}                  
            }  
           echo "</select></div>";
          }
}
/**============================================================================== 
  Gestione della select a gruppi su tabella 'nav' (menu-voci menu)
  Prevista voce in bianco per gestire moduli comuni a tutte le voci (1.4)
============================================================================= */
class DB_nav     extends  DB   
{                                                 
  public $valini  =  '';           // valore iniziale
  public $nome    =  '';           // nome variabile select
  
        public function __construct($valini,$nome)       
               { $this->valini = $valini; 
                 $this->nome   = $nome;   }  
                       
        public function select_nav()       // voce menu
          { $r='dummy999';
          echo "<div>";
            echo "<select name=$this->nome >";
            echo "<option selected='selected' value=$this->valini>$this->valini</option>"; 
            echo "<option value=''>Tutte le pagine</option>";     // 1.4    
            $sql="SELECT * 
                    FROM ".self::$pref."nav 
                    ORDER BY nmenu,nli";
            
               $con = "mysql:host=".self::$host.";dbname=".self::$db.""; 
               $PDO = new PDO($con,self::$user,self::$pw);
               $PDO->beginTransaction(); 
               foreach($PDO->query($sql) as $row)          
               { 
              
                  if ($row['nmenu'] != $r) 
                 { $r = $row['nmenu'];
                   echo "<optgroup label='".$row['nmenu']."'  ";
                   echo "<option value='".$row['nli']."'>".$row['nli']."</option>";
                 } 

              echo "<option value='".$row['nli']."'>".$row['nli']."</option>";  
              }
              
            echo "</optgroup></select>";
            echo "</select></div>";
          }  

  } 
/**
      * @class:      getArt
      *
      * @description:ritorna i campi del record ricercato
      *
      * @author Fausto Bresciani <fbsoftware@libero.it>
      * @version 0.1
      */
     
class getArt          extends  DB  
     { // BEGIN class getArt
     
     	// variabili
     	public $titolo ;
          public $aid     ;
          public $astat   ;
          public $aprog   ;
          public $atit    ;
          public $aalias  ;
          public $atext    ;
          public $aarg     ;
          public $acap     ;
     	public $amostra ;

     	// costruttore
       public function __construct($titolo)
     	{
     	$this->titolo  = $titolo ;
          $this->aid     = $aid ;
          $this->astat   = $astat ;
          $this->aprog   = $aprog ;
          $this->atit    = $atit ;
          $this->aalias  = $aalias ;
          $this->atext   = $atext ;
          $this->aarg    = $aarg ;
          $this->acap    = $acap ;
          $this->amostra = $amostra ;
     	}

/************************************************
 * @method:   getFieldsArt()
 * @description:
 * **********************************************/
  public function getFieldsdArt()
     {
              $con = "mysql:host=".self::$host.";dbname=".self::$db."";
              $PDO = new PDO($con,self::$user,self::$pw);
              $PDO->beginTransaction();
              $sql="SELECT *
                    FROM `".DB::$pref."art`
                    WHERE  astat <> 'A' and atit = '$this->titolo' limit 1";
              foreach($PDO->query($sql) as $val)
              {  
               $this->aid       =$val['aid'];
               $this->astat     =$val['astat'];
               $this->aprog     =$val['aprog'];
               $this->atit      =$val['atit'];
               $this->aalias    =$val['aalias'];
               $this->atext     =$val['atext'];
               $this->aarg      =$val['aarg'];
               $this->acap      =$val['acap'];
               $this->amostra   =$val['amostra'];
               }


     } 
}     // END class getArt
/**
      * @class:      getTmp
      *
      * @description:    ritorna i campi del record ricercato
      *
      * @author Fausto Bresciani <fbsoftware@libero.it>
      * @version 0.1
      */
     
class getTmp          extends  DB  
     { // BEGIN class getTmp
     
     	// variabili
        public $nome   ='';        // nome della variabile POST
        public $valini ='';        // valore iniziale (if)
        public $label  ='';        // label del campo (if)
        public $toolt  ='';        // Placeholder-tooltip          
     	
       public function __construct($valini,$nome,$label,$toolt)      // costruttore
     	{
               $this->nome    = $nome;     
               $this->valini  = $valini;  
               $this->label   = $label; 
               $this->toolt   = $toolt;  
      	}

/************************************************
 * @method:         getTemplate()
 * @description:    select dei templates
 * **********************************************/
  public function getTemplate()
     {                            
              $con = "mysql:host=".self::$host.";dbname=".self::$db."";
              $PDO = new PDO($con,self::$user,self::$pw);
              $PDO->beginTransaction();
     echo "<div><label for='$this->nome'><a href='#' data-toggle='tooltip' title='".$this->toolt."'>$this->label</a></label>";
     echo "<select name='$this->nome'>";
     $sql="    SELECT * 
               FROM ".DB::$pref."tmp 
               WHERE tstat=' ' 
               ORDER BY ttdesc";
            foreach($PDO->query($sql) as $row)
              {  
              if    ( $row['ttdesc'] == $this->valini)
                echo "<option selected='selected' value=".$row['ttdesc'].">".$this->valini."</option>"; 
              else
                echo "<option value=".$row['ttdesc'].">".$row['ttdesc']."</option>"; 
              }
            echo "</select></div>";
     } 
}     // END class getTmp
/***==============================================================================
  Aggiorna tipologia iscritto dal versamento
============================================================================= */

class DB_tipologia      extends DB
{       
        public $iscritto  ='';
        public $importo  ='';
                                                      
    public function __construct($iscritto,$importo)       
           { 
           $this->iscritto   = $iscritto;         // numero iscritto
           $this->importo    = $importo;          // versamento 
           }   
             
    public function upd_tipologia()       
           {
              $con = "mysql:host=".self::$host.";dbname=".self::$db."";
              $PDO = new PDO($con,self::$user,self::$pw);
              $PDO->beginTransaction();
           // sostenitore         
           if ($this->importo > 20) 
              {  $sql="UPDATE ".self::$pref."isc 
                      SET tipologia = '2'  
                      WHERE numero_iscrizione = $this->iscritto  and
                            stato ='I' and tipologia < 3";
                	$PDO->exec($sql);    
                    $PDO->commit();
              }
           if ($this->importo < 21)  
              {
                $sql="UPDATE ".self::$pref."isc 
                      SET tipologia = '1'  
                      WHERE numero_iscrizione = $this->iscritto  and
                            stato ='I' and tipologia < 3";
                	$PDO->exec($sql);    
                    $PDO->commit();
              }
           }

} 
/**==============================================================================
  Funzioni di utilita' database
  Metodi:
 decod2()             decodifica campo tabella a chiave doppia (settore/elemento)
 ================================================================================ */
class DB_decod2         extends DB

{       public $tabella ='';
        public $stato   ='';
        public $key1    ='';
        public $key2    ='';
        public $campo   ='';
        public $descr   ='';
        
    public function __construct($tabella,$stato,$key1,$key2,$campo1,$campo2,$descr)       
           { 
           $this->tabella = $tabella;        // tabella
           $this->stato   = $stato;          // campo stato record (!A=valido)  
           $this->key1    = $key1;           // nome campo chiave (settore)
           $this->key2    = $key2;           // nome campo chiave (elemento)
           $this->campo1  = $campo1;         // valore campo settore
           $this->campo2  = $campo2;         // valore campo elemento           
           $this->descr   = $descr;          // nome campo decodifica

           }   
             
    public function decod2()       // decodifica dei campi settore/elemento
           { 
           // transazione    
           $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
           $PDO = new PDO($con,DB::$user,DB::$pw);
           $PDO->beginTransaction(); 
           $sql="SELECT * 
                 FROM ".self::$pref.$this->tabella." 
                 WHERE ".$this->stato." !='A' 
                   and ".$this->key1." = '".$this->campo1." '
                   and ".$this->key2." = '".$this->campo2." '                   
                   " ;
		foreach($PDO->query($sql) as $row)
              return $row[$this->descr] ;
            }
              
}
/*===============================================================================
  Funzioni di utilita' database
  Metodi:
  select_table()             Mostra struttura tabelle del database aperto
============================================================================= */
class DB_sel_table
{
     public $tabella   ='';
     public $pref      ='';

     public function __construct($pref)
          {
           $this->pref = $pref;
          }

    public function select_table()
          // crea select su un campo
          {
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction();  
	 
		echo "<label for='table'>Scegliere la tabella     </label>";
		echo "<select name='table'>";
		$sql = "SHOW TABLES";
		$result = $PDO->query($sql);
		
		print_r($result);//debug
		while ($tableName = $result->fetch(PDO::FETCH_NUM))
               {
        echo  $this->table = $tableName[0];
               $is = strpos($this->table, $this->pref);
               if ($is !== false)    // filtro il prefisso da considerare
                    {
                    echo "<option value='".$this->table."'>".$this->table."</option>";
                    }
          }
           echo "</select>";
}
}
?>