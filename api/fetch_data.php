<?php
include 'api.php';
function fetch_data()
{
	$api_obj=new API('GET',NULL);
	$res=$api_obj->processRequest();
}
fetch_data();
?>