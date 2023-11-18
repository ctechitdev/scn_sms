<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);


$sql = $conn->query("select * from tbl_user where user_name ='$user_name'");
$sql->execute();
if ($sql->rowCount() > 0) {
	$res = array("res" => "exist");
} else {
	$sqlinsert = $conn->query("INSERT INTO tbl_user( full_name,user_name,user_password,role_id,company_id,depart_id,user_status,add_by,date_add)
	VALUES( '$full_name','$user_name','123','$role_id','$company_id','$depart_id','1','$id_users',now()) ");
	if ($sqlinsert) {
		$res = array("res" => "success", "user name" => $user_name);
	} else {
		$res = array("res" => "failed", "user name" => $user_name);
	}
}








echo json_encode($res);
