<?php
$filename = 'users.csv';
$users = [
    ['Cristiano', 'Ronaldo', 'Portogallo'],
    ['Gonzalo', 'Higuain', 'Argentina'],
    ['Giorgio', 'Chiellini', 'Italia']
];

$handler = fopen($filename, 'w');

foreach($users as $user) {
    fputcsv($handler, $user, ';');
}

fclose($handler);

?>