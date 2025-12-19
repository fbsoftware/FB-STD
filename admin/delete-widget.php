<?php
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$conn = new PDO("mysql:host=localhost;dbname=my_database;charset=utf8", "root", "");
$lid = intval($_GET["lid"]);

echo $conn->query("DELETE FROM prefix_lay WHERE lid=" . $lid);

echo "OK";
