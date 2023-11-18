<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$user_id = $_POST['userid'];

?>

<script src="../plugins/nprogress/nprogress.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>

<script>
    $(function() {
        $('#edit_company_id').change(function() {
            var edit_company_id = $('#edit_company_id').val();
            $.post('../function/dynamic_dropdown/get_depart.php', {
                    company_id: edit_company_id
                },
                function(output) {
                    $('#edit_depart_id').html(output).show();
                });
        });


    });
</script>



<form id="update-modal">
    <div class="modal-body pt-0">
        <div class="row no-gutters">

            <input type="hidden" name="user_id" value='<?php echo "$user_id"; ?>'>

            <?php
            $edit_row = $conn->query("select * from tbl_user where user_id = '$user_id' ")->fetch(PDO::FETCH_ASSOC);

            $id_company = $edit_row['company_id'];
            ?>

            <div class="form-group col-lg-12 text-center mb-4">
                <label class="text-dark font-weight-medium h3"> ແກ້ໄຂຂໍ້ມູນ </label>
            </div>


            <div class="col-lg-12">
                <div class="form-group text-center h3">
                    <label for="firstName "><?php echo $edit_row['user_name']; ?></label>
                </div>
            </div>

            <div class="col-md-12">
                <div class="profile-content-left px-4">
                    <div class="card text-center px-0 border-0">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="firstName">ຊື່ນາມສະກຸນພະນັກງານ</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" value='<?php echo $edit_row['full_name']; ?>' required>
                            </div>
                        </div>


                        <div class="form-group  col-lg-12">
                            <label class="text-dark font-weight-medium">ສິດເຂົ້າເຖິງ</label>
                            <div class="form-group">
                                <select class=" form-control font" name="id_role">
                                    <option value=""> ເລືອກສິດ </option>
                                    <?php
                                    $stmt5 = $conn->prepare(" SELECT * FROM tbl_roles   ");
                                    $stmt5->execute();
                                    if ($stmt5->rowCount() > 0) {
                                        while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                                    ?> <option value="<?php echo $row5['role_id']; ?>" <?php if ($edit_row['role_id'] == $row5['role_id']) {
                                                                                            echo "selected";
                                                                                        } ?>> <?php echo $row5['role_name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="text-dark font-weight-medium">ບໍລິສັດ</label>
                            <div class="form-group">

                                <select class=" form-control font" name="edit_company_id" id="edit_company_id">
                                    <option value=""> ເລືອກບໍລິສັດ </option>
                                    <?php
                                    $stmt5 = $conn->prepare(" SELECT * FROM tbl_company ");
                                    $stmt5->execute();
                                    if ($stmt5->rowCount() > 0) {
                                        while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                            <option value="<?php echo $row5['company_id']; ?>" <?php if ($id_company == $row5['company_id']) {
                                                                                                    echo "selected";
                                                                                                } ?>> <?php echo $row5['company_name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="text-dark font-weight-medium">ພະແນກ</label>
                            <div class="form-group">

                                <select class=" form-control font" name="edit_depart_id" id="edit_depart_id">
                                    <option value=""> ເລືອກພະແນກ </option>
                                    <?php
                                    $stmt6 = $conn->prepare(" SELECT * FROM tbl_depart where company_id = '$id_company' ");
                                    $stmt6->execute();
                                    if ($stmt6->rowCount() > 0) {
                                        while ($row6 = $stmt6->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                            <option value="<?php echo $row6['depart_id']; ?>" <?php if ($edit_row['depart_id'] == $row6['company_id']) {
                                                                                                    echo "selected";
                                                                                                } ?>> <?php echo $row6['depart_name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="card text-center px-0 border-0">


                            <div class="card-body">
                                <button type="submit" class="btn btn-primary mb-2 btn-pill">ແກ້ໄຂ</button>
                            </div>
                        </div>


                    </div>

                </div>
            </div>


        </div>
    </div>
</form>