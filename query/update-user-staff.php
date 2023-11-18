<?php
include("../setting/checksession.php");

include("../setting/conn.php");
extract($_POST);

$sqlupdate = $conn->query(" update tbl_user set full_name ='$full_name' , role_id ='$id_role', company_id = '$edit_company_id' ,depart_id ='$edit_depart_id' WHERE user_id='$user_id' ");

if ($sqlupdate) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}


echo json_encode($res);
