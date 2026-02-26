<?php
/**
   Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
   package		Gestionale
   versione 1.0    
   copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   license		GNU/GPL
   Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   all'uso anche improprio di FB open template.
=============================================================================== 
  Crea il 2° livello del navigatore principale.
=============================================================================== */
require 'call_ok.php';
require_once("connectDB.php");
       $sql3 = "SELECT * 
                FROM `".DB::$pref."nav`  
                WHERE nmenu='".TMP::$tmenu."' and nstat <> 'A' and nli = '".$voce."'  and ndesc > ''
                ORDER BY nprog";
                
echo "<ul class='dropdown-menu'>";  
$accesso = 0;              
foreach($PDO->query($sql3) as $row2)  
     	{   
          $xli         = $row2['ndesc'];
          $xtipo       = $row2['ntipo'];
          $xsotvo      = $row2['nsotvo'];
          $xpag        = $row2['npag'];
          $xnaccesso   = $row2['naccesso'];
          if ($accesso >= $xnaccesso)  
               {         
               if (($xtipo == 'arg') || ($xtipo == 'cap') || ($xtipo == 'art') || ($xtipo == 'htm'))
                    {
                    echo "<li><a href='index.php?forma=".$nli."&sub=".$xli."&content=".$xtipo."&dati=".$xsotvo."&pag=".$xpag."'>".$xli."</a></li>";
                    }
               else
                    {                                                                                                          
                    echo "<li><a href='index.php?forma=".$nli."&sub=".$xli."&content=".$xtipo."&urla=".$xsotvo."&pag=".$xpag."'>".$xli."</a></li>";            
                    }
               }
     }
        echo "</ul>";
$con = NULL;  
?> 