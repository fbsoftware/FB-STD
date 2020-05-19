<?php
// scelta dell'editor di testi
if (TMP::$teditor == 'tinymce') 
	{  require('tinys.php');  } 
else {  echo "<script src='ckeditor/ckeditor.js'></script>"; }
?>