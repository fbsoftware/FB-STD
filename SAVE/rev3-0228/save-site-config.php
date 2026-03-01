<?php
$data = file_get_contents("php://input");
file_put_contents("site-config.json", $data);
echo json_encode(["ok"=>true]);
