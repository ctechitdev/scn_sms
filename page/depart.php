<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ພະແນກ";
$header_click = "1";

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
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
    $(document).on("click", "#editmodal", function(e) {
        e.preventDefault();
        var dp_id = $(this).data("departid");

        $.post('../function/modal/depart-edit.php', {
                dp_id: dp_id
            },
            function(output) {
                $('.show_data_edit').html(output).show();
            });
    });
</script>

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
                        <div class="row no-gutters justify-content-center">


                            <div class="col-xxl-12">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <div class="email-body-head mb-5 ">
                                        <h4 class="text-dark">ສ້າງສິດ</h4>



                                    </div>
                                    <form method="post" id="adddepart">


                                        <div class="row">

                                            <div class="form-group  col-lg-12">
                                                <label class="text-dark font-weight-medium">ບໍລິສັດ</label>
                                                <div class="form-group">
                                                    <select class=" form-control font" name="company_id" required>
                                                        <option value=""> ເລຶອກບໍລິສັດ </option>
                                                        <?php
                                                        $stmt = $conn->prepare(" select * from tbl_company");
                                                        $stmt->execute();
                                                        if ($stmt->rowCount() > 0) {
                                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        ?> <option value="<?php echo $row['company_id']; ?>"> <?php echo $row['company_name']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="firstName">ພະແນກ</label>
                                                    <input type="text" class="form-control" id="depart_name" name="depart_name" required>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ເພິ່ມຂໍ້ມູນ</button>
                                        </div>

                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="content-wrapper">
                <div class="content">
                    <!-- For Components documentaion -->


                    <div class="card card-default">

                        <div class="card-body">

                            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ເລກທີ</th>
                                        <th>ບໍລິສັດ</th>
                                        <th>ພະແນກ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $stmt4 = $conn->prepare("
                                    select  depart_id,depart_name, company_name
                                    from tbl_depart a
                                    left join tbl_company b on a.company_id = b.company_id 
                                    order by depart_id desc ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                            $id_depart = $row4['depart_id'];
                                            $depart_name = $row4['depart_name'];
                                            $company_name = $row4['company_name'];
                                    ?>



                                            <tr>
                                                <td><?php echo "$id_depart"; ?></td>
                                                <td><?php echo "$company_name"; ?></td>
                                                <td><?php echo "$depart_name"; ?></td>

                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a href="javascript:0" class="dropdown-item" id="editmodal" data-departid='<?php echo "$id_depart"; ?>' data-toggle="modal" data-target="#modal-edit">ແກ້ໄຂ</a>
                                                            <a class="dropdown-item" type="button" id="deletedepart" data-id='<?php echo $row4['dp_id']; ?>' class="btn btn-danger btn-sm">ລືບ</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>


                                    <?php
                                        }
                                    }
                                    ?>


                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header justify-content-end border-bottom-0">


                                    <button type="button" class="btn-close-icon" data-dismiss="modal" aria-label="Close">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </div>

                                <div class="show_data_edit">



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

    <script>
        // Add staff user 
        $(document).on("submit", "#adddepart", function() {
            $.post("../query/add-depart.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ເພີ່ມຂໍ້ມູນສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            location.reload();
                        }, 1000);
                }
            }, 'json')
            return false;
        });

        // update
        $(document).on("submit", "#update-modal", function() {
            $.post("../query/update-depart.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ແກ້ໄຂສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            location.reload();
                        }, 1000);
                }
            }, 'json')
            return false;
        });


        
        // delete 
        $(document).on("click", "#deletedepart", function(e) {
            e.preventDefault();
            var dp_id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../query/delete-depart.php",
                dataType: "json",
                data: {
                    dp_id: dp_id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ລືບສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                window.location.href = 'depart.php';
                            }, 1000);

                    }
                },
                error: function(xhr, ErrorStatus, error) {
                    console.log(status.error);
                }

            });


            return false;
        });
    </script>


    <!--  -->


</body>

</html>