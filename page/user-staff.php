<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຜູ້ໃຊ້";
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
<script type="text/javascript" src="../js/jquery.min.js"></script> <!-- jQuery -->
<script>
	$(function() {
		$('#company_id').change(function() {
			var company_id = $('#company_id').val();
			$.post('../function/dynamic_dropdown/get_depart.php', {
					company_id: company_id
				},
				function(output) {
					$('#depart_id').html(output).show();
				});
		});


	});

	$(document).on("click", "#editmodal", function(e) {
		e.preventDefault();
		var userid = $(this).data("userid");

		$.post('../function/modal/user-staff-edit.php', {
				userid: userid
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
										<h4 class="text-dark">ສ້າງຜູ້ໃຊ້</h4>



									</div>
									<form method="post" id="addstaffuserFrm">


										<div class="row">

											<div class="col-lg-12">
												<div class="form-group">
													<label for="firstName">ຊື່ນາມສະກຸນພະນັກງານ</label>
													<input type="text" class="form-control" id="full_name" name="full_name" required>
												</div>
											</div>

											<div class="col-lg-12">
												<div class="form-group">
													<label for="firstName">ຢູສເຊີ້</label>
													<input type="text" class="form-control" id="user_name" name="user_name" required>
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
														?> <option value="<?php echo $row5['role_id']; ?>"> <?php echo $row5['role_name']; ?></option>
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

													<select class=" form-control font" name="company_id" id="company_id">
														<option value=""> ເລືອກບໍລິສັດ </option>
														<?php
														$stmt5 = $conn->prepare(" SELECT * FROM tbl_company ");
														$stmt5->execute();
														if ($stmt5->rowCount() > 0) {
															while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
														?>
																<option value="<?php echo $row5['company_id']; ?>"> <?php echo $row5['company_name']; ?></option>
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

													<select class=" form-control font" name="depart_id" id="depart_id">
														<option value=""> ເລືອກພະແນກ </option>
													</select>
												</div>
											</div>
										</div>

										<div class="d-flex justify-content-end mt-6">
											<button type="submit" class="btn btn-primary mb-2 btn-pill">ເພີ່ມຜູ້ໃຊ້ພະນັກງານ</button>
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
										<th>ຊື່ຜູ້ໃຊ້</th>
										<th>ຢູສເຊີ້</th>
										<th>ບໍລິສັດ</th>
										<th>ພະແນກ</th>
										<th>ສະຖານະ</th>
										<th>ສິດຈັດການ</th>
										<th></th>
									</tr>
								</thead>
								<tbody>


									<?php



									$stmt4 = $conn->prepare(" select user_id,full_name,user_name,depart_name,role_name,
									(case when user_status = 1 then 'ເປີດນຳໃຊ້' else 'ປິດນຳໃຊ້' end) as status_name,date_add,company_name,user_status
									from tbl_user a
									LEFT JOIN tbl_depart b on a.depart_id = b.depart_id
									LEFT join tbl_roles c on a.role_id = c.role_id
									left join tbl_company d on a.company_id = d.company_id ");
									$stmt4->execute();
									if ($stmt4->rowCount() > 0) {
										while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
											$user_id = $row4['user_id'];
											$full_name = $row4['full_name'];
											$user_name = $row4['user_name'];
											$company_name = $row4['company_name']; 
											$depart_name = $row4['depart_name'];
											$user_status = $row4['user_status'];
											$status_name = $row4['status_name'];

											$role_name = $row4['role_name'];

									?>



											<tr>
												<td><?php echo "$user_id"; ?></td>
												<td><?php echo "$full_name"; ?></td>
												<td><?php echo "$user_name"; ?></td>
												<td><?php echo "$company_name"; ?></td>
												<td><?php echo "$depart_name"; ?></td>
												<td> <span class="badge <?php
																		if ($user_status == '2') {
																			echo "badge-secondary";
																		} else {
																			echo "badge-success";
																		}

																		?>">
														<?php echo "$status_name"; ?></span></td>
												<td><?php echo "$role_name"; ?></td>



												<td>
													<div class="dropdown">
														<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
														</a>

														<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
															<a href="javascript:0" class="dropdown-item" id="editmodal" data-userid='<?php echo "$user_id"; ?>' data-toggle="modal" data-target="#modal-edit">ແກ້ໄຂ</a>
															<a class="dropdown-item" type="button" id="deleteuser" data-id='<?php echo $row4['usid']; ?>' class="btn btn-danger btn-sm">ລືບ</a>
															<a class="dropdown-item" type="button" id="activestaffuser" data-id='<?php echo $row4['usid']; ?>' class="btn btn-danger btn-sm">ເປິດນຳໃຊ້</a>
															<a class="dropdown-item" type="button" id="inactivestaffuser" data-id='<?php echo $row4['usid']; ?>' class="btn btn-danger btn-sm">ປິດນຳໃຊ້</a>
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
		$(document).on("submit", "#addstaffuserFrm", function() {
			$.post("../query/add-user.php", $(this).serialize(), function(data) {
				if (data.res == "exist") {
					Swal.fire(
						'ລົງທະບຽນຊ້ຳ',
						'ຜູ້ໃຊ້ນີ້ຖືກລົງທະບຽນແລ້ວ',
						'error'
					)
				} else if (data.res == "success") {
					Swal.fire(
						'ສຳເລັດ',
						'ເພິ່ມຜູ້ໃຊ້ສຳເລັດ',
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
			$.post("../query/update-user-staff.php", $(this).serialize(), function(data) {
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
		$(document).on("click", "#deleteuser", function(e) {
			e.preventDefault();
			var usid = $(this).data("id");
			$.ajax({
				type: "post",
				url: "../query/delete-user.php",
				dataType: "json",
				data: {
					usid: usid
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
								window.location.href = 'user-staff.php';
							}, 1000);

					}
				},
				error: function(xhr, ErrorStatus, error) {
					console.log(status.error);
				}

			});


			return false;
		});



		// active user
		$(document).on("click", "#activestaffuser", function(e) {
			e.preventDefault();
			var id = $(this).data("id");
			$.ajax({
				type: "post",
				url: "../query/activestaffuser.php",
				dataType: "json",
				data: {
					id: id
				},
				cache: false,
				success: function(data) {
					if (data.res == "success") {
						Swal.fire(
							'ສຳເລັດ',
							'ເປີດນຳໃຊ້ສຳເລັດ',
							'success'
						)
						setTimeout(
							function() {
								window.location.href = 'user-staff.php';
							}, 1000);

					}
				},
				error: function(xhr, ErrorStatus, error) {
					console.log(status.error);
				}

			});



			return false;
		});


		// inactive user
		$(document).on("click", "#inactivestaffuser", function(e) {
			e.preventDefault();
			var id = $(this).data("id");
			$.ajax({
				type: "post",
				url: "../query/inactivestaffuser.php",
				dataType: "json",
				data: {
					id: id
				},
				cache: false,
				success: function(data) {
					if (data.res == "success") {
						Swal.fire(
							'ສຳເລັດ',
							'ປິດນຳໃຊ້ສຳເລັດ',
							'success'
						)
						setTimeout(
							function() {
								window.location.href = 'user-staff.php';
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