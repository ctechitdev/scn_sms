<?php 
include("../setting/checksession.php");

include("../setting/conn.php");
 extract($_POST);

 

$update_data = $conn->query(" update tbl_depart set depart_name ='$depart_name' , company_id = '$company_id'  WHERE depart_id ='$dp_id'  ");
if($update_data)
{
	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>