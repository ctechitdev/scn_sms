<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);



$update_data = $conn->query("update tbl_roles set role_name = '$role_name' where role_id = '$id_role'  ");
if ($update_data) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}



echo json_encode($res);
