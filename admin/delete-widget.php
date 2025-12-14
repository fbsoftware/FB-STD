<?php
$conn = new PDO("mysql:host=localhost;dbname=my_database;charset=utf8", "root", "");
$lid = intval($_GET["lid"]);

$conn->query("DELETE FROM prefix_lay WHERE lid=" . $lid);

echo "OK";
