<?php
// scelta dell'editor di testi
if (TMP::$teditor == 'tinymce') 
	{  include('tinys.php');  } 
else {  echo "<script src='ckeditor/ckeditor.js'></script>"; }
?>