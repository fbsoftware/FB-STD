<?php
/**========================================================================== 
  imgdim.php                                                                        
  Classe per il dimensionamento delle immagini in modo da adeguarle alla
  finestra che le ospita.
============================================================================= */
class imgdim            
{                                                 
     public $img    =  '';
     public $alt    =  '';
     public $lun    =  '';
     
     public $width  =  '';
     public $height =  '';
     public $imgh =  '';
     public $imgl =  '';
  
        public function __construct($img,$alt,$lun)       
               {    $this->img     = $img;
                    $this->alt     = $alt;
                    $this->lun     = $lun;
               }  
                       
        public function maxdim()       
          {
          $pathimg = $this->img;
          $dim=array();
          $dim = getimagesize($pathimg);
          $x=$dim['0'];   $this->imgl = $x; 
          $y=$dim['1'];   $this->imga = $y;
          // nei limiti entrambe le dimensioni 
               if($this->imgl <= $this->lun && $y <= $this->alt) 
                         {
                         $vx = $this->imgl;   
                         $vy = $this->imga;
                         }
               else      {
                         $vx = $this->lun/$this->imgl;   
                         $vy = $this->alt/$this->imga;
                         }
               // adeguo la + critica fra le dimensioni       
               if($vx < $vy)  $this->width = $this->lun;  
               else           $this->height= $this->alt;
          }
}

?>