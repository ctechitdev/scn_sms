<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$page_title_id = $_POST['pageid'];

?>

<script src="../plugins/nprogress/nprogress.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>



<form id="update-page">
    <div class="modal-body pt-0">
        <div class="row no-gutters">

            <input type="hidden" name="page_title_id" value='<?php echo "$page_title_id"; ?>'>

            <?php
            $edit_row = $conn->query("select * from tbl_page_title where page_title_id = '$page_title_id' ")->fetch(PDO::FETCH_ASSOC);

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
                                <select class=" form-control font" name="sub_header_id" required>
                                    <option value=""> ເລືອກຫົວຂໍ້ </option>
                                    <?php
                                    $stmt5 = $conn->prepare(" SELECT * FROM tbl_sub_header ");
                                    $stmt5->execute();
                                    if ($stmt5->rowCount() > 0) {
                                        while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                                    ?> <option value="<?php echo $row5['sub_header_id']; ?>" <?php if ($edit_row['sub_header_id']  == $row5['sub_header_id']) {
                                                                                                    echo "selected";
                                                                                                } ?>> <?php echo $row5['sub_header_name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group col-lg-12">
                            <label class="text-dark font-weight-medium"> ຊື່ຫນ້າ </label>
                            <input name="page_title_name" class="form-control" value='<?php echo $edit_row['page_title_name']; ?>' required />
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="text-dark font-weight-medium"> ຊື່ໄຟຣ </label>
                            <input name="page_title_file_name" class="form-control" value='<?php echo $edit_row['page_title_file_name']; ?>' required />
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