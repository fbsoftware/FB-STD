<?php
spl_autoload_register('my_autoloader');  
 
function my_autoloader($className) {
    $path = 'libFB_1_2_0/';
    include $path.$className.'.php';
}

$app = new DB();
echo "page title = ".DB::$page_title;

$tmp = new TMP('admin');
$tmp->read_tmp();
echo "<br/>descrizione = ".TMP::$ttdesc;

$ins = new DB_ins('art','aprog');
echo "<br/>progressivo = ".$ins->insert();

$ins = new DB_tip_i('color','','','Colore','Scegliere un colore');
echo $ins->select();

$ins = new DB_tip_i('lin','','','Lingua','Scegliere la lingua');
echo $ins->select_lin();	

$ins = new DB_mnu('lin');
echo $ins->select_mnu2();	
?>