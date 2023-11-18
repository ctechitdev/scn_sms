<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ສິນຄ້າໃນສາງ";
$header_click = "2";
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php

    include("../setting/callcss.php");

    ?>

</head>
<script src="../plugins/nprogress/nprogress.js"></script>

<body class="navbar-fixed sidebar-fixed" id="body">

    <div class="wrapper">

        <?php include "menu.php"; ?>

        <div class="page-wrapper">

            <?php

            include "header.php";
            ?>
            <div class="content-wrapper">
                <div class="content">

                    <div class="email-wrapper rounded border bg-white">
                        <div class="  no-gutters justify-content-center">
                            <div class="">
                                <div class="  p-4 p-xl-5">
                                    <div class="email-body-head mb-6 ">
                                        <h4 class="text-dark">ຂາຍສິນຄ້າ</h4>
                                    </div>


                                    <form action="" method="post">



                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="firstName">ຂາຍຜ່ານສາງ</label>
                                                <select class="form-control" name="warehouse_id" required>
                                                    <option value="">ເລືອກສາງ</option>
                                                    <?php
                                                    $stmt2 = $conn->prepare("SELECT * FROM tbl_warehouse WHERE warehouse_type_id = 1");
                                                    $stmt2->execute();
                                                    if ($stmt2->rowCount() > 0) {
                                                        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                            <option value="<?php echo $row2['warehouse_id']; ?>"> <?php echo $row2['warehouse_name']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" name="btn_search" class="btn btn-primary mb-2 btn-pill">ສະແດງ</button>
                                        </div>


                                        <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ຊື່ສິນຄ້າ</th>
                                                    <th>ຍອດເຫຼືອ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php




                                                if (isset($_POST['btn_search'])) {


                                                    $warehouse_id = $_POST['warehouse_id'];

                                                    $stmt4 = $conn->prepare(" call stp_view_stock_remain('$warehouse_id') ");
                                                } else {
                                                    $stmt4 = $conn->prepare(" call stp_view_stock_remain('0') ");
                                                }


                                                $i = 1;


                                                $stmt4->execute();
                                                if ($stmt4->rowCount() > 0) {
                                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {


                                                ?>
                                                        <tr>

                                                            <td><?php echo $row4['item_name']; ?></td>
                                                            <td><?php echo number_format($row4['item_remain']); ?> ອັນ</td>

                                                        </tr>
                                                <?php
                                                    }
                                                }



                                                ?>


                                            </tbody>
                                        </table>
                                    </form>






                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <?php include "footer.php"; ?>
        </div>
    </div>

    <?php include("../setting/calljs.php"); ?>


</body>

</html>