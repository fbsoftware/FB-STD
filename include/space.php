<?php
/**
    Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
    package		Gestionale
    versione 1.0
    copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
    license		GNU/GPL
    Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
    all'uso anche improprio di FB open template.
================================================================================
  05/05/24  Spaziatura
================================================================================*/
echo "<section id='space'>";
// Spaziatura

 // lettura voci menu
         $sql = "SELECT *
                FROM `".DB::$pref."spz`
                WHERE rtmp = '".TMP::$tmenu."' and rstat <> 'A' 
                AND rcod = '$lcod' 
                ORDER BY rprog";
          foreach($PDO->query($sql) as $row)
       {
          require 'admin/fields_spz.php'; 
        echo "<div class='f-flex fd-row jc-start ai-center fw fb-secondary'
                style='width:100%; height:".$rspa."px;'>";  
        echo "</div>";
        }

echo "</section>";
?>
