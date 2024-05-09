<?php

/**=============================================================================== 
  Popup di dialogo modale con titolo, testo o bottone per link
  Metodi:
  popup()         emette mappa dialog
  ---------------------------------------------------------------------------
  16.03.21	tolto link per conflitto con javascript:void(0), se serve il link 
			metterlo nel testo/immagine che lancia il modale. 
	9/5/24	tolto testo inutile
============================================================================= */
class popup_modale
{
public $id=""; 
public $header="";
public $img="";
public $link="";
public $text="";

        public function __construct($id,$header,$img,$link,$text)       
               { 
               $this->id 	 = $id;
               $this->header = $header;
               $this->img 	 = $img;
               $this->link 	 = $link;
               $this->text 	 = $text;
               }
               
         function popup()
{   
 
//-- popup modale --> 
echo	"<div class='popup' popup-name='".$this->id."' id='".$this->id."' style='z-index:10'>"; 
		echo	"<div class='popup-content fb-primary'>";  
//------------------------------------------
//titolo
	echo	"<div class='fb-primary'>";    
	echo	"<h3>".$this->header."</h3>";
	// bottone di chiusura del popup	
	echo "<a class='close-button trasp' popup-close='".$this->id."' href='javascript:void(0)'>x</a>";
	echo	"</div>";   
// immagine			
	echo	"<div>";    	
	echo	"<img src='".$this->img."' alt='".$this->img."' class='img-responsive' style='max-width:500px'>";    	
	echo	"</div>";
// testo   	
	/*echo	"<div>"; 
	echo "<p>".$this->text."</p>";
	echo "</div>";*/
	

//------------------------------------------
	echo "</div>";	// .popup-content		
	echo "</div>"; 	// .popup
	
}
}
?>