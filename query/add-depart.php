<?php 
include("../setting/checksession.php");

include("../setting/conn.php");

 extract($_POST);
 

 
	$add_data = $conn->query("INSERT INTO tbl_depart (company_id, depart_name) VALUES('$company_id','$depart_name') ");
	if($add_data)
	{
		$res = array("res" => "success" );
	}
	else
	{
		$res = array("res" => "failed" );
	}
 



 echo json_encode($res);
