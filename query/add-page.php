<?php 
include("../setting/checksession.php");

include("../setting/conn.php");

 extract($_POST);
 

 
	$insCourse = $conn->query("INSERT INTO tbl_page_title (  page_title_name,page_title_file_name,sub_header_id ) VALUES( '$page_name','$page_file_name','$sub_header_id') ");
	if($insCourse)
	{
		$res = array("res" => "success" );
	}
	else
	{
		$res = array("res" => "failed" );
	}
 



 echo json_encode($res);
 ?>