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
  public static $tslidebutt   = '';     // slide - bottoni navigazione
  public static $tslidetime   = 0;      // slide - tempo permanenza immagine
  public static $tportitle    = '';     // portfolio - titolo
  public static $tgliftitle   = '';     // glifi - titolo
  public static $tgliftext    = '';     // glifi - testo
  public static $tglyforma    = '';     // glifi - forma  
  public static $tglyreverse  = '';     // glifi - reverse color
  public static $tcod      	=  '';		// codice del template
  public static $ttipo   	=  '';		// tipo template: sito-admin
  public static $tpromotitle=  '';		// titolo promo si-no
  public static $tpromotit	=  '';		// titolo promo
  public static $tpromotext	=  '';		// testo promo


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
               self::$tcolor  		= $row['tcolor'];
               self::$tslidebutt    = $row['tslidebutt'];
               self::$tslidetime    = $row['tslidetime'];
               self::$tportitle     = $row['tportitle'];
               self::$tglyforma     = $row['tglyforma'];
               self::$tgliftitle    = $row['tgliftitle'];
               self::$tgliftext     = $row['tgliftext'];
               self::$tglyreverse   = $row['tglyreverse'];
				self::$tcod      	= $row['tcod'];			// codice del template
				self::$ttipo   		= $row['ttipo'];		// tipo template: sito-admin
				self::$tpromotitle	= $row['tpromotitle'];	// titolo promo si-no
				self::$tpromotit	= $row['tpromotit'];	// titolo promo
				self::$tpromotext	= $row['tpromotext'];	// testo promo			   
			   
               }
               return $row;   // per eventuale utilizzo
          }



}             
?>