<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$id_role = $_POST['id_role'];

?>

<script src="../plugins/nprogress/nprogress.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>



<form id="update-modal">
    <div class="modal-body pt-0">
        <div class="row no-gutters">

            <input type="hidden" name="id_role" value='<?php echo "$id_role"; ?>'>

            <?php
            $edit_row = $conn->query("select * from tbl_roles where role_id = '$id_role' ")->fetch(PDO::FETCH_ASSOC);

            ?>

            <div class="form-group col-lg-12 text-center mb-4">
                <label class="text-dark font-weight-medium h3"> ແກ້ໄຂຂໍ້ມູນ
                </label>
            </div>

            <div class="col-md-12">
                <div class="profile-content-left px-4">
                    <div class="card text-center px-0 border-0">


                        <div class="form-group col-lg-12">
                            <label class="text-dark font-weight-medium"> ຊື່ສິດ </label>
                            <input name="role_name" class="form-control" value='<?php echo $edit_row['role_name']; ?>' required />
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