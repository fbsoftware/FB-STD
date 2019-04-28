<?php
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
     }
	 
	function closeHead() 
    { 
	echo "</head>";
     }
}

?>