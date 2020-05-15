<?php
/** 
===============================================================================
* @pakage		TMP class
  Classe per la gestione della tabella 'tmp' dei template
=============================================================================== 
	30.4.2019	aggiunti i campi mancanti esistenti nella struttura della tabella
=============================================================================== */
class TMP       extends  DB

{ public static $ambiente     =  '';	// ambiente: sito,admin
  public static $tid     	=  '';
  public static $tprog   	=  '';
  public static $tstat   	=  '';
  public static $tsel    	=  '';		// * = attivato
  public static $ttdesc  	=  '';		// nome del template
  public static $tfolder 	=  '';		// percorso del template
  public static $tdesc   	=  '';		// descrizione del template
  public static $tmenu   	=  '';		// nome menu del template
  public static $tlang   	=  '';      // template - lingua
  public static $tcolor  	=  '';      // colore base del template
  public static $tcod      	=  '';		// codice del template
  public static $ttipo   	=  '';		// tipo template: sito-admin  
  // slide
  public static $tslidebutt   = '';     // slide - bottoni navigazione
  public static $tslidetime   = 0;      // slide - tempo permanenza immagine
  // portfolio
  public static $tportitle  = 0;        // titolo s-n
  public static $tportit	=  '';		// titolo 
  public static $tportext	=  '';		// testo   
  // glifi
  public static $tgliftit     = '';     // glifi - titolo
  public static $tgliftitle   = 0;      // glifi - titolo s-n
  public static $tgliftext    = '';     // glifi - testo
  public static $tgliforma    = '';     // glifi - forma  
  public static $tglireverse  = '';     // glifi - reverse color
  // promo
  public static $tpromotitle=  0;		// titolo si-no
  public static $tpromotit	=  '';		// titolo 
  public static $tpromotext	=  '';		// testo 
  // contatti
  public static $tcttitle	=  0;		// titolo si-no
  public static $tcttit		=  '';		// titolo 
  public static $tcttext	=  '';		// testo 
  // accordion
  public static $taccotitle	=  0;		// titolo si-no
  public static $taccotit		=  '';		// titolo 
  public static $taccotext	=  '';		// testo 
  // articoli in tab
  public static $ttabtitle	=  0;		// titolo si-no
  public static $ttabtit		=  '';		// titolo 
  public static $ttabtext	=  '';		// testo 
  // articoli in slide
  public static $tsldtitle	=  0;		// titolo si-no
  public static $tsldtit		=  '';		// titolo 
  public static $tsldtext	=  '';		// testo 
  // editor
  public static $teditor	=  '';		// editor di testo 
  
		function __construct($ambiente) 
		{
		self::$ambiente = $ambiente;
		//parent::__construct(); 
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
				self::$tcolor  		= $row['tcolor'];		// colore di base
				self::$tcod      	= $row['tcod'];			// codice del template
				self::$ttipo   		= $row['ttipo'];		// tipo template: sito-admin
			   // slide
               self::$tslidebutt    = $row['tslidebutt'];
               self::$tslidetime    = $row['tslidetime'];
			   // portfolio
				self::$tportitle    = $row['tportitle'];	// titolo si-no
				self::$tportit		= $row['tportit'];		// titolo 
				self::$tportext		= $row['tportext'];		// testo 			   
			   // glifi
				self::$tgliforma     = $row['tgliforma'];
				self::$tgliftit      = $row['tgliftit'];
				self::$tgliftitle    = $row['tgliftitle'];
				self::$tgliftext     = $row['tgliftext'];
				self::$tglireverse   = $row['tglireverse'];
				// promo
				self::$tpromotitle	= $row['tpromotitle'];	// titolo si-no
				self::$tpromotit	= $row['tpromotit'];	// titolo
				self::$tpromotext	= $row['tpromotext'];	// testo 
				// contatti
				self::$tcttitle		= $row['tcttitle'];	// titolo si-no
				self::$tcttit		= $row['tcttit'];	// titolo
				self::$tcttext		= $row['tcttext'];	// testo 
				// accordion
				self::$taccotitle	= $row['taccotitle'];	// titolo si-no
				self::$taccotit		= $row['taccotit'];	// titolo
				self::$taccotext	= $row['taccotext'];	// testo 
				// articoli in tab
				self::$ttabtitle	= $row['ttabtitle'];	// titolo si-no
				self::$ttabtit		= $row['ttabtit'];	// titolo
				self::$ttabtext		= $row['ttabtext'];	// testo 				
				// articoli in slide
				self::$tsldtitle	= $row['tsldtitle'];	// titolo si-no
				self::$tsldtit		= $row['tsldtit'];	// titolo
				self::$tsldtext		= $row['tsldtext'];	// testo 	
				// editor di testo
				self::$teditor		= $row['teditor'];	// editor di testo 	
				
               }
               return $row;   // per eventuale utilizzo
          }



}             
?>