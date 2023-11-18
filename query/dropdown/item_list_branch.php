<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$stmt1 = $conn->prepare("SELECT * FROM tbl_item_data order by item_name asc");
$stmt1->execute();

$data = $stmt1->fetchAll();

echo json_encode($data);

?>
