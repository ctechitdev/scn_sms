<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ໜ້າຟັງຊັ້ນ";
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
		var pageid = $(this).data("pageid");

		$.post('../function/modal/page-function-edit.php', {
				pageid: pageid
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
										<h4 class="text-dark">ຈັດການຫນ້າຟັງຊັ້ນ</h4>

									</div>
									<form method="post" id="addpage">


										<div class="row">


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
														?> <option value="<?php echo $row5['sub_header_id']; ?>"> <?php echo $row5['sub_header_name']; ?></option>
														<?php
															}
														}
														?>
													</select>
												</div>
											</div>

											<div class="col-lg-12">
												<div class="form-group">
													<label for="firstName">ຊື່ຫນ້າ</label>
													<input type="text" class="form-control" name="page_name" required>
												</div>
											</div>

											<div class="col-lg-12">
												<div class="form-group">
													<label for="firstName">ຊື່ໄຟຣ</label>
													<input type="text" class="form-control" name="page_file_name" required>
												</div>
											</div>

										</div>

										<div class="d-flex justify-content-end mt-6">
											<button type="submit" class="btn btn-primary mb-2 btn-pill">ເພີ່ມຂໍ້ມູນ</button>
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
										<th>ເລກລຳດັບ</th>
										<th>ຊື່ຫນ້າ</th>
										<th>ຊື່ໄຟຣ</th>
										<th>ຫົວຂໍ້</th>
										<th></th>
									</tr>
								</thead>
								<tbody>


									<?php
									$stmt4 = $conn->prepare("SELECT  page_title_id,page_title_name,page_title_file_name ,sub_header_name
									FROM tbl_page_title a
									left join tbl_sub_header b on a.sub_header_id = b.sub_header_id order by page_title_id desc");
									$stmt4->execute();
									if ($stmt4->rowCount() > 0) {
										while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
											$page_title_id = $row4['page_title_id'];
											$page_title_name = $row4['page_title_name'];
											$page_title_file_name = $row4['page_title_file_name'];
											$sub_header_name = $row4['sub_header_name'];

									?>

											<tr>
												<td><?php echo "$page_title_id"; ?></td>
												<td><?php echo "$page_title_name"; ?></td>
												<td><?php echo "$page_title_file_name"; ?></td>
												<td><?php echo "$sub_header_name"; ?></td>
												<td>
													<div class="dropdown">
														<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
														</a>

														<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
															<a href="javascript:0" class="dropdown-item" id="editmodal" data-pageid='<?php echo "$page_title_id"; ?>' data-toggle="modal" data-target="#modal-edit">ແກ້ໄຂ</a>
															<a class="dropdown-item" type="button" id="deletefunction" data-id='<?php echo $row4['page_title_id']; ?>' class="btn btn-danger btn-sm">ລືບ</a>

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
		// Add data
		$(document).on("submit", "#addpage", function() {
			$.post("../query/add-page.php", $(this).serialize(), function(data) {
				if (data.res == "failed") {
					Swal.fire(
						'ຜິດພາດ',
						'ບໍສາມາດຈັດການຂໍ້ມູນໄດ້',
						'error'
					)
				} else if (data.res == "success") {
					Swal.fire(
						'ສຳເລັດ',
						'ເພິ່ມຂໍ້ມູນສຳເລັດ',
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

		// update data
		$(document).on("submit", "#update-page", function() {
			$.post("../query/update-page.php", $(this).serialize(), function(data) {
				if (data.res == "failed") {
					Swal.fire(
						'ຜິດພາດ',
						'ບໍສາມາດຈັດການຂໍ້ມູນໄດ້',
						'error'
					)
				} else if (data.res == "success") {
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
		$(document).on("click", "#deletefunction", function(e) {
			e.preventDefault();
			var page_id = $(this).data("id");
			$.ajax({
				type: "post",
				url: "../query/delete-page.php",
				dataType: "json",
				data: {
					page_id: page_id
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
								window.location.href = 'page-function.php';
							}, 1000);

					} else if (data.res == "failed") {
						Swal.fire(
							'ຜິດພາດ',
							'ບໍສາມາດລຶບໄດ້',
							'error'
						)
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