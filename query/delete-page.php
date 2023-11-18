<?php


include("../setting/conn.php");

extract($_POST);


$delete_data = $conn->query(" delete from tbl_page_title where page_title_id = '$page_id'  ");
if ($delete_data) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}




echo json_encode($res);
