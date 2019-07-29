<?php
require_once('loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once("connectDB.php");
// DOCTYPE & head
$app = new Head('Gestione menu');
$app->openHead();
require_once("jquery_link.php");
require_once("bootstrap_link.php");
require_once("include_head.php");
require_once('lingua.php'); 
$app->closeHead();
?>
<a class="btn btn-danger" href="#">
  <i class="fa fa-trash-o fa-lg"></i> Delete</a>
<a class="btn btn-default btn-sm" href="#">
  <i class="fa fa-cog"></i> Settings</a>
