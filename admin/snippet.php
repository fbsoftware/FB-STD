<?php 
/* SOLUZIONE 2 (più pulita, consigliata)

Invece di creare mille variabili, crei un array unico.

post_lay.php (versione migliore)*/
$POST_LAY = $_POST;


//oppure esplicito:

$POST_LAY = [
  'lid'      => $_POST['lid']      ?? '',
  'lprog'    => $_POST['lprog']    ?? '',
  'lstat'    => $_POST['lstat']    ?? '',
  'lcod'     => $_POST['lcod']     ?? '',
  'ldesc'    => $_POST['ldesc']    ?? '',
  'ltmp'     => $_POST['ltmp']     ?? '',
  'lpage'    => $_POST['lpage']    ?? '',
  'ltipo'    => $_POST['ltipo']    ?? '',
  'linclude' => $_POST['linclude'] ?? ''
];

//Nella classe
global $POST_LAY;
$this->valini = $POST_LAY[$this->campo] ?? '';


/*
✔️ più leggibile
✔️ più controllabile
✔️ meno “magia”
*/
?>