<?php
// utile in sviluppo per vedere gli errori
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
// percorso corretto (modifica se il path è diverso)
require "PopupImmaginePlus.php";


$foto = new PopupImmaginePlus(
    "popup1",
    "Foto Bellissima",
    "Questa è una descrizione dell’immagine.",
    "fb-home.png",
    "fb-home.png"
);

echo $foto->render();
echo PopupImmaginePlus::scripts();
