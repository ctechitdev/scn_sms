<?php
include('../../setting/conn.php');

$id_role = $_POST['id_role'];

$pcheck = "";

$i = 1;
$stmt = $conn->prepare("select * from tbl_sub_header ");
$stmt->execute();
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $sub_header_id = $row['sub_header_id'];
        $sub_header_name = $row['sub_header_name'];

?>

        <div class="form-group">
            <label for="firstName"><?php echo  "$sub_header_name"; ?></label>
            <br>

            <?php

            $stmt1 = $conn->prepare("select * from tbl_page_title where sub_header_id ='$sub_header_id'");
            $stmt1->execute();
            if ($stmt1->rowCount() > 0) {
                while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $page_title_id = $row1['page_title_id'];
                    $page_title_name = $row1['page_title_name'];


                    $stmt2 = $conn->prepare(" SELECT  * FROM tbl_role_use_page where role_id = '$id_role' and page_title_id ='$page_title_id'  ");
                    $stmt2->execute();
                    if ($stmt2->rowCount() > 0) {
                        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {


                            if (!empty($row2['page_title_id'])) {
                                $pcheck = $row2['page_title_id'];
                            } else {
                                $pcheck = "";
                            }
                        }
                    }




            ?>
                    <div class="custom-control custom-checkbox checkbox-success d-inline-block mr-3 mb-3">

                        <input type="checkbox" class="custom-control-input" <?php if ($pcheck == $page_title_id) {
                                                                                echo "checked";
                                                                            } ?> value='<?php echo "$page_title_id"; ?>' name="pagecheck[]" id='pagecheck<?php echo "$i"; ?>'>
                        <label class="custom-control-label" for='pagecheck<?php echo "$i"; ?>'><?php echo "$page_title_name"; ?></label>
                    </div>

            <?php

                    $i++;
                }
            }


            ?>


        </div>


<?php

    }
}


?>