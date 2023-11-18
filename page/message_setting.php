<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຂໍ້ຄວາມSMS";
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
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
	$(document).on("click", "#editmodal", function(e) {
		e.preventDefault();
		var id_role = $(this).data("roleid");

		$.post('../function/modal/role-edit.php', {
				id_role: id_role
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
										<h4 class="text-dark">ຂໍ້ຄວາມSMS</h4>



									</div>
									<form method="post" id="addrole">


										<div class="row">

											<div class="col-lg-12">
												<div class="form-group">
													<label for="firstName">ເນື້ອໃນ</label> 
													<textarea name="messege_sms" class="form-control"   cols="30" rows="10"></textarea>
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
										<th>ເລກລຳດັບ</th>
										<th>ຊື່ສິດ</th>
										<th></th>
									</tr>
								</thead>
								<tbody>


									<?php
									$stmt4 = $conn->prepare("select * from tbl_roles order by role_id desc");
									$stmt4->execute();
									if ($stmt4->rowCount() > 0) {
										while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
											$id_role = $row4['role_id'];
											$role_name = $row4['role_name'];

									?>



											<tr>
												<td><?php echo "$id_role"; ?></td>
												<td><?php echo "$role_name"; ?></td>
												<td>
													<div class="dropdown">
														<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
														</a>

														<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
															<a href="javascript:0" class="dropdown-item" id="editmodal" data-roleid='<?php echo "$id_role"; ?>' data-toggle="modal" data-target="#modal-edit">ແກ້ໄຂ</a>
															<a class="dropdown-item" type="button" id="deleteroles" data-id='<?php echo $row4['role_id']; ?>' class="btn btn-danger btn-sm">ລືບ</a>

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
		// Add 
		$(document).on("submit", "#addrole", function() {
			$.post("../query/add-roles.php", $(this).serialize(), function(data) {
				if (data.res == "success") {
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

		// update
		$(document).on("submit", "#update-modal", function() {
			$.post("../query/update-role.php", $(this).serialize(), function(data) {
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
		$(document).on("click", "#deleteroles", function(e) {
			e.preventDefault();
			var r_id = $(this).data("id");
			$.ajax({
				type: "post",
				url: "../query/delete-role.php",
				dataType: "json",
				data: {
					r_id: r_id
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
								location.reload();
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