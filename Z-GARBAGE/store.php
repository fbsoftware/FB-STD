
<?php 
/**
 * store.php file
 */

 require_once('init_admin.php');
 require_once("editor.php");			// scelta editor
?>
<style>
.dragelement{ 
  padding:5px; 
  margin:3px; 
  width:270px; 
  height: 25px;
  border:#99FF66 solid 1px;
  background-color:#E2FFC6;
  cursor:move;
  color:#000;
  font-size:13px;
}</style>
<div class="dragelement">
<b>
<?php echo $_POST['element'] ?>;
</b>
</div>
<?php 
/**
 * Connect to database and Store this result or do whatever you want with it.
 */
echo $sql = "UPDATE `".DB::$pref."wdg`
        INSERT `ycont`= ".$_POST['element']."  ";
$PDO->exec($sql);
$PDO->commit();
?>