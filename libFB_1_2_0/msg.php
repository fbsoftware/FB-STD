<?php
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
?>