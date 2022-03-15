<?php   session_start();
/*** -------------------------------------------------------------------------
   * Gestione della tabella 'asl' articoli slide/tab
=========================================================e====================  */

//   bottoni gestione
$btx = new bottoni_str_par('Articoli slide/tab','asl','upd_asl.php',array('nuovo','modifica','copia','cancella','chiudi'));
          $btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];
$_SESSION['tab'] = "asl";

// zona messaggi
$parm = $_SESSION['esito'];
$m = new msg($parm);
$m->msg();

// mostra la tabella filtrata --------------------------------------------------
echo "<div class='table fb-hv80'>";

echo "<div class='th'>";
echo "<div class='td'>Scelta</div>";
echo "<div class='td'>Stato</div>";
echo "<div class='td'>Progr.</div>";
echo "<div class='td'>Codice</div>";
echo "<div class='td'>Descrizione</div>";
echo "<div class='td'> Template</div>";
echo "<div class='td'>Tipo</div>";
echo "<div class='td'>Capitolo</div>";
echo "<div class='td'>Articolo</div>";
echo "</div>";

// transazione
    $sql2 = "  SELECT *
               FROM `".DB::$pref."asl`
               ORDER BY dprog ";
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();
     foreach($PDO->query($sql2) as $row)
  	{ require('fields_asl.php');

     echo "<div class='tr'>";
     echo "<div class='td'>";
  	$f1 = new fieldi($did,'did',5,'');
  	   $f1->field_ck(); echo "</div>";
  	$st = new fieldi($dstat,'dstat',2,'');
  	echo "<div class='td'>";
      $st->field_st(); echo "</div>";
?>
  <div class='td'><?php echo $dprog ?></div>
  <div class='td'><?php echo $dcod  ?></div>
  <div class='td'><?php echo $ddes  ?></div>
  <div class='td'><?php echo $dtmp  ?></div>
  <div class='td'><?php echo $dtipo ?></div>
  <div class='td'><?php echo $dcap  ?></div>
  <div class='td'><?php echo $dart  ?></div>
  <?php
     echo "</div>";
     }
     echo "</div>";
     echo "</form>";

?>
