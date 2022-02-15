<?php  session_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 2.0.1
   * copyright	Copyright (C) 2022 - 2023 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
=============================================================================
   *
============================================================================= */
require_once('init_admin.php');
require_once('post_mnu.php');
$azione  =$_POST['submit'];
//print_r($_POST);//debug

switch ($azione)
{
case 'nuovo':
        $sql = "INSERT INTO ".DB::$pref."mnu
                               (bid,bprog,bstat,bmenu,btipo,btesto,bselect)
                        VALUES (NULL,'$bprog','$bstat','$bmenu','$btipo',
                               '$btesto','$bselect')";
		$PDO->exec($sql);
		$PDO->commit();
    array_push($_SESSION['esito'],'54');
		   break;

case 'ritorno':
               array_push($_SESSION['esito'],'2');
               break;

case 'modifica':
        $sql = "UPDATE ".DB::$pref."mnu
                        SET bprog='$bprog' , bstat='$bstat' , bmenu='$bmenu' ,
                            btipo='$btipo' , btesto='$btesto' , bselect='".$bselect."'
                        WHERE bid= '$bid' ";
		$PDO->exec($sql);
		$PDO->commit();
		array_push($_SESSION['esito'],'55');
			break;

case 'cancella':
        $sql = "DELETE from ".DB::$pref."mnu
				 WHERE bid= '$bid' ";
		$PDO->exec($sql);
		$PDO->commit();
    array_push($_SESSION['esito'],'53');
			 break;
case 'chiudi' :
		header('location:admin.php?urla=widget.php&pag=');
		break;
default:
               array_push($_SESSION['esito'],'1');
               echo "WRITE-Operazione invalida: azione=".$azione;
}
	header('location:admin.php?'.$_SESSION['location'].'');
?>
