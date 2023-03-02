<?php
$genres = $_POST['GENRES'];
for ($i = 0; $i < count($genres); $i++) {
   echo $genres[$i] . PHP_EOL;
}
