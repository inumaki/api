<?php

include 'api.php';

function fetch_single_data(array $post_array)
{
	$api_obj=new API('GET',$_POST['guest_id']);
	$res=$api_obj->processRequest();
}
fetch_single_data($_POST);
?>