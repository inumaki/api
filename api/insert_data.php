<?php
include 'api.php';

$api_obj=new API('POST',NULL);
$res=$api_obj->processRequest($_POST);
echo "<pre>";
print_r($res);
echo "</pre>";

/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/

?>