<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$dp_id = $_POST['dp_id'];

?>

<script src="../plugins/nprogress/nprogress.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>



<form id="update-modal">
    <div class="modal-body pt-0">
        <div class="row no-gutters">

            <input type="hidden" name="dp_id" value='<?php echo "$dp_id"; ?>'>

            <?php
            $edit_row = $conn->query("select * from tbl_depart where depart_id = '$dp_id' ")->fetch(PDO::FETCH_ASSOC);

            ?>

            <div class="form-group col-lg-12 text-center mb-4">
                <label class="text-dark font-weight-medium h3"> ແກ້ໄຂຂໍ້ມູນ
                </label>
            </div>

            <div class="col-md-12">
                <div class="profile-content-left px-4">
                    <div class="card text-center px-0 border-0">

                        <div class="form-group  col-lg-12">
                            <label class="text-dark font-weight-medium">ຫົວຂໍ້</label>
                            <div class="form-group">
                                <select class=" form-control font" name="company_id" required>
                                    <option value=""> ເລືອກຫົວຂໍ້ </option>
                                    <?php
                                    $stmt5 = $conn->prepare(" SELECT * FROM tbl_company ");
                                    $stmt5->execute();
                                    if ($stmt5->rowCount() > 0) {
                                        while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                                    ?> <option value="<?php echo $row5['company_id']; ?>" <?php if ($edit_row['company_id']  == $row5['company_id']) {
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
                            <label class="text-dark font-weight-medium"> ຊື່ຫນ້າ </label>
                            <input name="depart_name" class="form-control" value='<?php echo $edit_row['depart_name']; ?>' required />
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