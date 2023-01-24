<?php
include 'api.php';

function update_data($id,array $post_array)
{
	$api_obj=new API('PUT',$id);
	$res=$api_obj->processRequest($post_array);
	return true;
}
update_data($_GET['guest_id'],$_POST);

/*echo "<pre>";
print_r($_GET);
echo "<br/>";
print_r($_POST);
echo "</pre>";*/
?>