<?php
/**	============================================================
      * @class:      getTmp
      *
      * @description:    ritorna i campi del record ricercato
      *
      * @author Fausto Bresciani <fbsoftware@libero.it>
      * @version 0.1
    =============================================================  */
     
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

?>