<?php
// controlla che non sia richiamato fuori dal framework -test per GitHub-
$file=str_replace('\\','/',__FILE__);
if($file == $_SERVER['SCRIPT_FILENAME']) exit('Accesso non consentito') ;
?>
