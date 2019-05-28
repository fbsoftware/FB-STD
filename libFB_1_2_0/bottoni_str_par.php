<?php
/** ---------------------------------------------------------------------
 * Classe "bottoni_str_par"   Barra titolo con IMG e bottoni di gestione 
 * ----------------------------------------------------------------------
 * parametri:  immagine e titolo della mappa
 *             tabella di database interessata
 *             programma di callback
 *             array diparametri (Bottoni da visualizzare)
 *             livello di accesso (min=0 , max=9)
 * ----------------------------------------------------------------------
 * Metodi:
 *        btn()     per visualizzare
 * ----------------------------------------------------------------------
 * Note:  - ambiente Bootstrap 
 *        - controllo livello utente per accesso al singolo bottone se usata
 *          la gestione utenti, altrimenti accesso a tutto
 *        - protezione tasto invio (non ammesso)
 *	1.0.0	immagini tabella da images/archivi
 * 	1.0.1	solo se c'è immagine
------------------------------------------------------------------------- */
          // funzione con parametri
class bottoni_str_par         
{                                                 
  public $titolo   =  '';      // titolo
  public $tabella  =  '';      // nome archivio
  public $callbk   =  '';      // pgm di callback
  public $param    =  array(); // parametri
  public $accesso  =  '';      // livello di accesso ( min.0 --> 9 max.) 
  
        public function __construct($titolo,$tabella,$callbk,$param)       
               { $this->titolo  = $titolo;
                 $this->tabella = $tabella;
                 $this->callbk  = $callbk;
                 $this->param   = $param;
                 if (isset($_COOKIE['accesso'])) 
                    {  
                    $this->accesso = $_COOKIE['accesso'];
                    }  
                 else 
                    {
                    $this->accesso = 9;
                    }  
               }             
        public function btn()           //  bottoni gestione
          {      
				echo "<div class='row toolbar-color'>";
				// immagine ampiezza = 1
                echo "<div class='col-md-1'>";
				if (file_exists("images/archivi/".$this->tabella.".png"))
				{
                echo "<img src='images/archivi/".$this->tabella.".png' alt='manca img' height='40'> ";
				}
				echo    "</div>";
                
                // titolo ampiezza = 4
                echo "<div class='col-md-4 text-center'>";
                echo "<h1 class='toolbar'>&nbsp;".$this->titolo."</h1>";
                echo    "</div>";
                
                // bottoni ampiezza = 7
                echo    "<div class='btn-group col-md-7 text-right'>"; 
                echo    "<form method='post' id='".$this->tabella."' action='".$this->callbk."' onkeypress='return event.keyCode != 13;'>" ;
				// accessi consentiti ai bottoni
				$b5   = array('nuovo','modifica','cancella','archivia','cerca','ripristina','salva'); 
				$b0   = array('chiudi','uscita','mostra','stampa','ritorno');
				// scan bottoni
				$length = count($this->param);
               for ($i = 0; $i < $length; $i++) 
	   {
				// test se label diversa da azione
               $act = $this->param[$i];
				$pos = strpos($this->param[$i], '|');
			if ($pos === false) 
				{
				// controllo accesso al bottone 
				if(in_array($act, $b5))  { $accesso_bottone = 5; }
				if(in_array($act, $b0))  { $accesso_bottone = 0; }
				if ($this->accesso >= $accesso_bottone) 
				{
				echo    "<button class='btn btn-default btn-md' type='submit' name='submit' value='".$act."' id='".$act."'>
                         <img src=images/bottoni/".$act.".png alt='".$act."' height=25 />".$act."</button>";
				}
				}
			else
				{
				list($label,$act)=explode('|',$this->param[$i]); 
               // controllo accesso al bottone 
               if(in_array($act, $b5))  { $accesso_bottone = 5; }
               if(in_array($act, $b0))  { $accesso_bottone = 0; }
               if ($this->accesso >= $accesso_bottone) 
               {
               echo    "<button class='btn btn-default btn-md' type='submit' name='submit' value='".$act."' id='".$act."'>
                         <img src=images/bottoni/".$label.".png alt='".$label."' height=25 />".$label."</button>";
               }
				}
		}	// endfor
                echo    "</div>";
				echo    "</div>";	// row

	}	// end function
}	// end class
?>