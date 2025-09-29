<?php   session_start();       ob_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * aggiornamento tabella 'zim'      
============================================================================= */ 
require_once('init_admin.php');
require_once 'post_spz.php';
$azione  =$_POST['submit'];    
//print_r($_POST); //debug

switch ($azione)
{
case 'nuovo':
case 'copia':
    echo      $sql = "INSERT INTO `".DB::$pref."spz` 
                      (qid,qprog,qstat,qcod,qtmp,qspa,qpage,qdesc) 
                      VALUES (NULL,'$qprog','$qtat','$qcod','$qtmp','$qspa','$qpage','$qdesc')";
          $PDO->exec($sql);    
          $PDO->commit();
          $_SESSION['esito'] = 54;
          break;

case 'modifica':
          echo $sql = "UPDATE `".DB::$pref."spz` 
          SET qprog='$qprog',qstat='$qstat',
                         qcod='$qcod',qspa='$qspa',qtmp='$qtmp',qpage='$qpage',qdesc='$qdesc'
                    WHERE qid= '$qid' ";
          $PDO->exec($sql);    
          $PDO->commit();
          $_SESSION['esito'] = 55;
          break;
  
case 'cancella':
          $sql = "DELETE from `".DB::$pref."spz` 
                    WHERE qid= '$qid' ";
		$PDO->exec($sql);    
          $PDO->commit();
          $_SESSION['esito'] = 53;
          break;
  
case 'ritorno':
          $_SESSION['esito'] = 2;
         break;

         default :
  echo "Operazione invalida";
}
$loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
?> 
