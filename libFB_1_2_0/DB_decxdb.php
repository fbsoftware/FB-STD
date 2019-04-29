<?php
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

?>