<?php
spl_autoload_register('my_autoloader');  
 
function my_autoloader($className) {
    $path = 'libFB_2_0_0/';
    require $path.$className.'.php';
}
?>