<?php
/*foreach (glob("libFB-1.1.1/*.php") as $filename) 
  {
	include_once ($filename);
  }*/
spl_autoload_register('my_autoloader');  
 
function my_autoloader($className) {
    $path = 'libFB_1_2_0/';
    include $path.$className.'.php';
}


?>