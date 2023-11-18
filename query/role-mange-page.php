<?php
include("../setting/checksession.php");

include("../setting/conn.php");

$id_role = $_POST['id_role'];

$delprole = $conn->query("DELETE  FROM tbl_role_use_page WHERE role_id='$id_role'  ");
if ($delprole) {




    $counitem = count($_POST['pagecheck']);

    for ($i = 0; $i < ($counitem); $i++) {
        extract($_POST);

        $stmt3 = $conn->prepare(" SELECT page_title_id,page_title_name,a.sub_header_id,header_title_id
        FROM  tbl_page_title a
        left join tbl_sub_header b on a.sub_header_id =b.sub_header_id
    where page_title_id ='$pagecheck[$i]' ");

        $stmt3->execute();
        if ($stmt3->rowCount() > 0) {
            while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {

                $page_title_id = $row3['page_title_id'];
                $sub_header_id = $row3['sub_header_id'];
                $header_title_id = $row3['header_title_id'];

                if (!empty($page_title_id)) {

                    $insCourse = $conn->query("INSERT INTO tbl_role_use_page (role_id,header_title_id,sub_header_id,page_title_id ) 
                    VALUES('$id_role','$header_title_id','$sub_header_id','$pagecheck[$i]')  ");
                    if ($insCourse) {
                        $res = array("res" => "success");
                    } else {
                        $res = array("res" => "failed");
                    }
                }
            }
        }
    }
}

echo json_encode($res);
?>