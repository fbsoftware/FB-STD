<?php
require_once('init_site.php');
?>
  <style type="text/css">
  .green	{
  color:green;
  }
  </style>  
  <script>
  $( function() {
    $( "input[type=radio]" ).checkboxradio();
	 $( "fieldset" ).controlgroup();
 } );
  </script>

</head>
<body>
<div class="widget">
<fieldset><legend>My example: </legend>
<label for="radio-x">SI</label>
<input type="radio" name="radio-x" id="radio-x" value=1>
<label for="radio-y">NO</label>
<input type="radio" name="radio-x" id="radio-y" value=0>
</fieldset> 
</div>
</body>
</html>