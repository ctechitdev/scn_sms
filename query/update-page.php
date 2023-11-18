<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);



$update_data = $conn->query(" update tbl_page_title set 
sub_header_id='$sub_header_id', page_title_name ='$page_title_name', page_title_file_name='$page_title_file_name' 
WHERE page_title_id='$page_title_id'  ");
if ($update_data) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}



echo json_encode($res);
