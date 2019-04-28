<?php
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
               }
               return $row;   // per eventuale utilizzo
          }



}             
?>