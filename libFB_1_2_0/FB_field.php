<?php  
/*** Fausto Bresciani    fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package  FB open template
   * versione 2.0  
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
=============================================================================== 
  Gestione dei campi input di form a 6 parametri
  1.0.0		tooltip left
============================================================================= */
class input
{
    public $label   = "";       // label campo database / testata
    public $valini  = "";       // valore campo database
    public $lung    = 0;        // lunghezza da mostrare del campo database / cols x textarea
    public $campo   = "";       // nome variabile campo database (Per il suo valore)
    public $pch     = "";       // placeholder
    public $tipo    = "";       // tipo di campo
    public $param   =  array(); // parametri
        public function __construct($param)
               { 
               $this->valini   = $param[0];             
               $this->campo    = $param[1];               
               $this->lung     = $param[2];
               $this->label    = $param[3];
               $this->pch      = $param[4];
               $this->tipo     = $param[5];
               }


        public function field()
          {  // label non serve per tipo = h/star  
			echo "<div>";   
              if (($this->tipo !== 'h') && ($this->tipo !== 'star'))
                  { echo "<label for='$this->campo' data-toggle='tooltip' data-placement='top' title='$this->pch'>$this->label</label>"; }
 switch ($this->tipo) {
case 'ck':      // check box
                echo "<input type='checkbox' id='$this->campo' name='$this->campo'
                         value=$this->valini size='$this->lung'  ";
                if ($this->valini === 1) { echo "checked";} 
                echo ">";
 break;

 case 'star':     // immagine stella
          if ($this->valini == '*') 
               {
               echo "<input type='image' class='titolo' 
                    name='$this->campo' value= '$this->valini' 
                    src='images/star.png '>"; 
               }
          else
               { 
               echo "<input type='image' class='titolo' 
                    name='$this->campo' value= '$this->valini' 
                    src='images/null.png '>"; 
               } 
break;

case 'pw':      // input password
                echo "<input type='password'  id='$this->campo' name='$this->campo'
                    value='$this->valini' size='$this->lung' >";
break;

case 'pwr':     // input password readonly
                echo "<input type='password'  readonly  name='$this->campo'
                    value='$this->valini' size='$this->lung' >";
break;

case 'r':       // input readonly
                    echo "<input type='text' class='titolo' readonly name='$this->campo'
                        id='$this->campo' value= '$this->valini'
                        size='$this->lung' >";
break;

case 'rb':      // input readonly + bold
                    echo "<input type='text' class='titolo_b' readonly='readonly'
                        name='$this->campo'  id='$this->campo' value= '$this->valini'
                        size='$this->lung' >";
break;

case 'i':       // input
                    echo "<input type='text' id='$this->campo' name='$this->campo'
                        value='$this->valini' size='$this->lung' >";
break;

case 'tx':       // textarea
                    echo "<textarea type='text' id='$this->campo' name='$this->campo'
                          cols='$this->lung' rows='5'>$this->valini</textarea>";
break;

case 'txr':       // textarea readonly
                    echo "<textarea type='text' id='$this->campo' name='$this->campo'
                          cols='$this->lung' rows='5' readonly='readonly'>$this->valini</textarea>";
break;

case 'ia':      // input text con autofocus
                    echo "<input type='text' id='$this->campo' name='$this->campo'
                        value='$this->valini' size='$this->lung' autofocus>
                         <script>
                         if (!('autofocus' in document.createElement('input')))
                         {
                         document.getElementById('$this->campo').focus();
                         }
                         </script>";
break;

case 'ir':          // input text obbligatorio
                        echo "<input type='text' required='Compilare questo campo'  name='$this->campo'
                            id='$this->campo' value='$this->valini' size='$this->lung' >";
break;

case 't' :          // input testate di colonna
                        echo "<input disabled class='blue' value='$this->label' size='$this->lung'>";
break;

case 'h':            // input hidden (Lunghezza e label facoltative)
                        echo  "<input type='hidden'
                        name='$this->campo' id='$this->campo' value='$this->valini' >";
break;

case 'ic':            // input text + color picker
                        echo "<input type='color' class='color' name='$this->campo' id='$this->campo'
                            value='$this->valini' size='$this->lung' >";
break;

case 'st':            // input status
                    if ($this->valini != 'A')
                        { echo "<input type='image' class='nobord'
                            src='images/ok.png' height='16px' width='16px'
                          name='$this->campo' id='$this->campo' value='$this->valini' >";}
                    else
                        {echo "<input type='image' class='nobord' src='images/stop.png' height='16px'
                         name='$this->campo' id='$this->campo' value='$this->valini' width='16px' >";}
break;

case 'ip':          // input text + placeholder
                    echo "<input type='text' id='$this->campo' name='$this->campo'
                        value='$this->valini' size='$this->lung'  placeholder='$this->pch' >";
break;

case 'ipr':			// input text + placeholder + required
                    echo "<input type='text' required='Compilare questo campo'
                     name='$this->campo' id='$this->campo' value='$this->valini'
                     size='$this->lung' placeholder='$this->pch' >";
break;

case 'd1' :			// datepicker 1
        echo "<input type='text' id='datepicker1' 
                     name='$this->campo' value='$this->valini' 
                     size='$this->lung'>";
break;

case 'd2' :			// datepicker 2
        echo "<input type='text' id='datepicker2' 
                     name='$this->campo' value='$this->valini' 
                     size='$this->lung'>";
break;     

case 'd3' :			// datepicker 3
        echo "<input type='text' id='datepicker3' 
                     name='$this->campo' value='$this->valini' 
                     size='$this->lung'>";
break;     

case 'sn' :			// radio button 0=NO  1=SI
		if($this->valini == 0) 
        { 
        echo  "<input id='state0' type='radio' value='0' name='$this->campo' checked='checked'>&nbsp;No&nbsp;";
        echo  "<input id='state1' type='radio' value='1' name='$this->campo'>&nbsp;Si&nbsp;";
        }                                     
        if($this->valini == 1) 
        {
        echo  "<input id='state0' type='radio' value='0' name='$this->campo'>&nbsp;No&nbsp;";
        echo  "<input id='state1' type='radio' value='1' name='$this->campo' checked='checked' >&nbsp;Si&nbsp;";
        }
break; 
		 
default:
break;
        }
     echo "</div>";          
     }
}

/**=============================================================================== 
  Gestione dei campi input di form 
============================================================================= */
class fieldi           
{                                                 
  public $valini  = "";  // valore campo database 
  public $lung    = 0;   // lunghezza campo database
  public $campo   = "";  // nome variabile campo database (Per il suo valore)
  
        public function __construct($valini,$campo,$lung)       
               { $this->campo  = $campo;
                 $this->lung   = $lung;
                 $this->valini = $valini;}        
                       
         public function field_r()   // input readonly  
          { 
          echo "<input type='text' class='titolo' readonly  
                       name='$this->campo' value= '$this->valini' size='$this->lung' >"; 
          } 

        public function field_ck()   // input checkbox  (Lunghezza facoltativa)
          { 
          echo "<input type='checkbox'  class='nobord' 
                       name='$this->campo' value='$this->valini'>"; 
          } 
                       
        public function field_i()   // input text  
          { 
           echo "<input type='text' 
                        name='$this->campo' value='$this->valini' size='$this->lung' >";
          } 
                       
        public function field_ic()   // input text + color picker 
          { 
           echo "<input type='text' class='colore'
                        name='$this->campo' value='$this->valini' size='$this->lung' >";
          } 
 
                       
        public function field_ir()   // input text requested 
          { 
           echo "<input type='text' requested='requested' 
                        name='$this->campo' value='$this->valini' size='$this->lung' >";
          } 
                       
        public function field_pw()   // input password 
          { 
           echo "<input type='password'  readonly='readonly' 
                        name='$this->campo' value='$this->valini' size='$this->lung' >";
          } 
                       
        public function field_h()   // input hidden (Lunghezza facoltativa)
          { 
          echo  "<input type='hidden' 
                        name='$this->campo' value='$this->valini' >"; 
          } 
                       
         public function field_st()   // input status
          {
          if ($this->valini != 'A') 
             {  echo "&nbsp;<input type='image' class='nobord' src='images/ok.png' 
                     height='20' width='20'>&nbsp;";}
             else 
             {  echo "&nbsp;<input type='image' class='nobord' src='images/stop.png' 
                     height='20' width='20' >&nbsp;";}
          }  
                       
        public function field_id1()   // input data-1 con calendario jquery  
          {    echo "<input type='text' id='datepicker1' 
                     name='$this->campo' value='$this->valini' 
                     size='$this->lung' >";
          } 
                       
        public function field_id2()   // input data-2 con calendario jquery  
          {    echo "<input type='text' id='datepicker2' 
                     name='$this->campo' value='$this->valini' 
                     size='$this->lung' >";
          } 
                        
} 


/* ===========================================================================
	SOLO PER COMPATIBILITA' CON VERSIONI PRECEDENTI
   =========================================================================== */


/**==========================================================================
  Gestione dei campi input di form
============================================================================= */
class field              extends fieldi
{ 
  public $label  = "";   // label campo database / testata
  
        public function __construct($valini,$campo,$lung,$label)       
               { $this->valini   = $valini;
                 $this->lung     = $lung;
                 $this->campo    = $campo;
                 $this->label    = $label;}        
                       
        public function field_r()   // input readonly  
          {    echo "<div> 
                     <label for='$this->campo'>$this->label</label>
                     <input type='text' class='titolo' readonly='readonly' 
                     name='$this->campo'  id='$this->campo' value= '$this->valini' 
                     size='$this->lung'  ></div>"; 
          } 
                       
        public function field_rb()   // input readonly + bold 
          {    echo "<div> 
                     <label for='$this->campo'>$this->label</label>
                     <input type='text' class='titolo_b' readonly='readonly' 
                     name='$this->campo'  id='$this->campo' value= '$this->valini' 
                     size='$this->lung'  ></div>"; 
          } 
                                                  
        public function field_ck()   // checkbox  
          {    echo "<div> 
                     <label for='$this->campo'>$this->label</label>
                     <input type='checkbox' class='nobord' id='$this->campo' 
                     name='$this->campo' value=$this->valini 
                     size='$this->lung' ></div>"; 
          } 
                       
        public function field_i()   // input text  
          {    echo "<div> 
                     <label for='$this->campo'>$this->label</label>
                     <input type='text' id='$this->campo' 
                     name='$this->campo' value='$this->valini' 
                     size='$this->lung' ></div>";
          } 
                       
        public function field_ia()   // input text con autofocus 
          {    echo "<div> 
                     <label for='$this->campo'>$this->label</label>
                     <input type='text' id='$this->campo' 
                     name='$this->campo' value='$this->valini' 
                     size='$this->lung' autofocus>
                         <script>
                         if (!('autofocus' in document.createElement('input')))
                         {
                         document.getElementById('$this->campo').focus();
                         }
                         </script></div>";
          } 
                       
                       
        public function field_ir()   // input text requested 
          {    echo "<div>
                     <label for='$this->campo'>$this->label</label>
                     <input class='req' type='text' required
                     name='$this->campo' id='$this->campo' value='$this->valini' 
                     size='$this->lung' ></div>";
          } 
                       
        public function field_t()   // input testate di colonna
          {    echo "<div>
                     <label for='$this->campo'>$this->label</label>
                     <input disabled='disabled' class='blue' 
                     value='$this->label' size='$this->lung'>
                     </div>"; 
          } 
                       
        public function field_pw()   // input password 
          { 
           echo "<div>
                 <label for='$this->campo'>$this->label</label>
                 <input type='password'  id='$this->campo'
                        name='$this->campo' value='$this->valini' 
                        size='$this->lung' ></div>";
          } 
                       
        public function field_pwr()   // input password readonly
          { 
           echo "
           <div>
                 <label for='$this->campo'>$this->label</label>
                 <input type='password'  readonly
                        name='$this->campo' value='$this->valini' 
                        size='$this->lung'  ></div>
                        ";
          } 
                       
                        
        public function field_h()   // input hidden (Lunghezza e label facoltative)
          { 
          echo  "
          <div><input type='hidden' 
                        name='$this->campo' id='$this->campo' value='$this->valini' >
                        </div>
                        "; 
          } 
                       
        public function field_ic()   // input text + color picker 
          { 
           echo "
           <div>
                 <label for='$this->campo'>$this->label</label> 
                 <input type='text' class='colore'
                        name='$this->campo' id='$this->campo' value='$this->valini' 
                        size='$this->lung' ></div>
                        ";
          } 
                       
         public function field_st()   // input status
          {
          if ($this->campo != 'A') 
             {  echo "
             <div>
                      <label for='$this->campo'>$this->label</label>
                      <input type='image' class='nobord' src='images/ok.png' 
                      name='$this->campo' id='$this->campo' value='$this->valini'
                      height='16px' ></div>
                      ";}
             else 
             {  echo "
             <div>
                      <label for='$this->campo'>$this->label</label>
                      <input type='image' class='nobord' src='images/stop.png'
                      name='$this->campo' id='$this->campo' value='$this->valini' 
                      height='16px' ></div>
                      &nbsp;";}
          }  
                       
        public function field_d1()   // input data-1 con calendario jquery  
          {    echo "<div> 
                     <label for='$this->campo'>$this->label</label>
                     <input type='text' id='datepicker1' 
                     name='$this->campo' value='$this->valini' 
                     size='$this->lung' ></div>";
          } 
                       
        public function field_d2()   // input data-2 con calendario jquery  
          {    echo "<div> 
                     <label for='$this->campo'>$this->label</label>
                     <input type='text' id='datepicker2' 
                     name='$this->campo' value='$this->valini' 
                     size='$this->lung' ></div>";
          } 

}
/**===========================================================================
  Classe per la gestione delle testate di tabella
============================================================================= */

class fieldt          
{ 
  public $lung   = 0;    // lunghezza campo database
  public $label  = "";   // label campo testata
  
        public function __construct($label,$lung)       
               { $this->lung     = $lung;
                 $this->label    = $label;
               }        
                       
        public function field()   // input testate di colonna
               {    
               echo "<input disabled='disabled' class='blue' 
               value='$this->label' size='$this->lung'>"; 
               } 
}


/**===========================================================================
  Classe per la gestione dei radio-button 1=si/0=no.
============================================================================= */
class sn             
{                                                 
public $valini  =  0;
public $campo   =  '';
public $label   =  ''; 
  
  public function __construct($valini,$campo,$label)       
               { $this->valini = $valini;
                 $this->campo  = $campo;
                 $this->label  = $label;}  
                       
        public function show()     // mostra radio-button con label
        {
        if($this->valini == 0) 
        { 
        echo  "<fieldset class='input'><div>
               <label for='$this->campo'>$this->label</label>
               <input id='state0' type='radio' value='0' name='$this->campo' 
               checked='checked'>No";
        echo  "<input id='state1' type='radio' value='1' name='$this->campo'>Si
               </div></fieldset>";
        }                                     
        if($this->valini == 1) 
        {
        echo  "<fieldset class='input'><div>
               <label for='$this->campo'>$this->label</label>
               <input id='state1' type='radio' value='1' name='$this->campo' checked='checked' >
               Si";
        echo  "<input id='state0' type='radio' value='0' name='$this->campo'>
               No
               </div></fieldset>";
        }
        }
        
                    
}

?> 