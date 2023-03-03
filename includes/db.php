<?php
$connection = mysqli_connect(
   $config['database']['server'],
   $config['database']['username'],
   $config['database']['password'],
   $config['database']['name']
);
if ($connection == false) {
   echo 'Error :(';
   echo mysqli_connect_error();
   exit();
}
