<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <video width="400" controls>
<source src="uploads/mp4.mp4" type='video/mp4' />

  Your browser does not support HTML video.
</video>
 -->
<?php $email = Yii::app()->user->name; ?>
<style>
	.modal-lg {
		max-width: 90% !important;
	}
</style>

<div class="slim-mainpanel">
	<div class="container">
		<div class="slim-pageheader">
			<ol class="breadcrumb slim-breadcrumb">
				<!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Dashboard</li> -->
			</ol>
			<h6 class="slim-pagetitle">Welcome back, <?php echo Users::model()->get_type_by_fullname(Yii::app()->user->name); ?></h6>
		</div><!-- slim-pageheader -->

		<div class="row row-xs">
			<div class="col-sm-6 col-lg-4">
				<div class="card card-status">
					<div class="media">
						<i class="icon ion-ios-cloud-download-outline tx-purple"></i>
						<div class="media-body">
							<h1><?php echo FileUpload::model()->get_recent_project($email); ?></h1>
							<p>Recent Added Projects</p>
						</div><!-- media-body -->
					</div><!-- media -->
				</div><!-- card -->
			</div><!-- col-3 -->
			<div class="col-sm-6 col-lg-4 mg-t-10 mg-sm-t-0">
				<div class="card card-status">
					<div class="media">
						<i class="icon ion-ios-bookmarks-outline tx-teal"></i>
						<div class="media-body">
							<h1><?php echo FileUpload::model()->get_all_project($email); ?></h1>
							<p>Total Materials</p>
						</div><!-- media-body -->
					</div><!-- media -->
				</div><!-- card -->
			</div><!-- col-3 -->
			<div class="col-sm-6 col-lg-4 mg-t-10 mg-lg-t-0">
				<div class="card card-status">
					<div class="media">
						<i class="icon ion-ios-cloud-upload-outline tx-primary"></i>
						<div class="media-body">
							<!-- <h1><?php // echo FileUpload::model()->formatSizeUnits(disk_total_space("C:"));
										?></h1> -->
							<h1><?php echo FileUpload::model()->get_disk_usage($email); ?></h1>
							<p>Total Disk Usage</p>
						</div><!-- media-body -->
					</div><!-- media -->
				</div><!-- card -->
			</div><!-- col-3 -->
		</div><!-- row -->
		<br>
		<div class="manager-header">
			<div class="slim-pageheader">
				<ol class="breadcrumb slim-breadcrumb">
					<!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Pages</a></li>
              <li class="breadcrumb-item active" aria-current="page">File Manager</li> -->
				</ol>
				<h6 class="slim-pagetitle">Projects</h6>
			</div><!-- slim-pageheader -->
			<a id="managerNavicon" href="" class="contact-navicon"><i class="icon ion-navicon-round"></i></a>
		</div><!-- manager-header -->







		<div class="manager-wrapper">
			<div class="manager-right">
				<label class="section-label">Project List</label>
				<div class="file-group">
					<?php

					$data = FileUpload::model()->search($_GET);

					foreach ($data->getData() as $val) {
					?>
						<div class="file-item">
							<div class="row no-gutters wd-100p">
								<div class="col-3 col-sm-6 d-flex align-items-center" style="">
									<?php if ($val['filecategory'] == 1) { ?>
										<i class="fa fa-file-o"></i>
									<?php } ?>
									<?php if ($val['filecategory'] == 2) { ?>
										<i class="fa fa-file-image-o"></i>
									<?php } ?>
									<?php if ($val['filecategory'] == 3) { ?>
										<i class="fa fa-file-video-o"></i>
									<?php } ?>
									<?php if ($val['filecategory'] == 4) { ?>
										<i class="fa fa-file-sound-o"></i>
									<?php } ?>
									<span class="card-text" style="font-size: 16px; display: inline-block;
    width: 180px;
    white-space: nowrap;
    overflow: hidden !important;
    text-overflow: ellipsis;"><strong><?php echo $val['title']; ?></strong></span>
								</div><!-- col-6 -->
								<div class="col-3 col-sm-2 tx-right tx-sm-left"><?php echo $val['filesize']; ?></div>
								<div class="col-3 col-sm-2 mg-t-5 mg-sm-t-0"><?php echo date('M d, Y h:i:s A', strtotime($val['created_at'])); ?></div>
								<div class="col-3 col-sm-2 tx-right mg-t-5 mg-sm-t-0 float-right">
									<a href="" data-toggle="modal" data-target="#modaldemo<?php echo $val['id']; ?>" onclick='return insertlog(<?php echo $val['id']; ?>,1)'>
										<i class="fa fa-eye"></i></a>
									<a href="" data-toggle="modal" data-target="#modaldemo2<?php echo $val['id']; ?>">
										<i class="fa fa-pencil"></i></a>
									<span style="cursor:pointer" onclick="uploadthumbnail(<?php echo $val['id']; ?>)">
										<i class="fa fa-image"></i></span>
									<span style="cursor:pointer" onclick="deletetran(<?php echo $val['id']; ?>)">
										<i class="fa fa-trash"></i></span>

								</div>

							</div><!-- row -->
						</div><!-- file-item -->

						<!-- LARGE MODAL -->

						<div id="modaldemo<?php echo $val['id']; ?>" class="modal fade">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content tx-size-sm">
									<div class="modal-header pd-x-20 bg-primary ">
										<h3 class="tx-20 mg-b-0 tx-uppercase tx-inverse tx-bold text-white"><?php echo $val['title']; ?></h3>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body pd-20">
										<table>
											<tr>
												<td class="col-md-5">
													<?php if ($val['filecategory'] == 1) { ?>
														<img src="images/box.png" width="400" />
													<?php } ?>

													<?php if ($val['filecategory'] == 2) { ?>
														<!-- <img src="<?php echo $val['path'] . $val['filename']; ?>" alt="Italian Trulli"> -->
														<img src="<?php echo $val['path'] . $val['filename']; ?>" width="700" />
													<?php } ?>
													<?php if ($val['filecategory'] == 3) { ?>
														<video width="700" controls>
															<source src="<?php echo $val['path'] . $val['filename']; ?>" type='video/<?php echo $val['format']; ?>' />
														</video>
													<?php } ?>
													<?php if ($val['filecategory'] == 4) { ?>
														<audio width="900" controls>
															<source src="<?php echo $val['path'] . $val['filename']; ?>" type='audio/<?php echo $val['format']; ?>' />
														</audio>
													<?php } ?>

												</td>
												<td class="col-md-5" valign="top">
													<h3 class="tx-20 mg-b-0 tx-uppercase tx-inverse tx-bold ">PROJECT INFORMATION</h3>
													<br>
													<?php if ($val['type'] != '') { ?>
														<div class="row">
															<div class="col-md-6"><strong>Material Type : </strong></div>
															<div class="col-md-6"><?php echo $val['type']; ?></div>
														</div>
													<?php } ?>
													<?php if ($val['description'] != '') { ?>
														<div class="row">
															<div class="col-md-6"><strong>Description : </strong></div>
															<div class="col-md-6"><?php echo $val['description']; ?></div>
														</div>
													<?php } ?>
													<?php if ($val['company'] != '') { ?>
														<div class="row">
															<div class="col-md-6"><strong>Agency/Company : </strong></div>
															<div class="col-md-6"><?php echo $val['company']; ?></div>
														</div>
													<?php } ?>
													<?php if ($val['product'] != '') { ?>
														<div class="row">
															<div class="col-md-6"><strong>Product : </strong></div>
															<div class="col-md-6"><?php echo $val['product']; ?></div>
														</div>
													<?php } ?>
													<?php if ($val['filelength'] != '') { ?>
														<?php if ($val['filecategory'] == 4) { ?>
															<div class="row">
																<div class="col-md-6"><strong>Length : </strong></div>
																<div class="col-md-6"><?php echo $val['filelength']; ?></div>
															</div>
														<?php } ?>
													<?php } ?>
													<?php if ($val['filesize'] != '') { ?>
														<div class="row">
															<div class="col-md-6"><strong>Project Size : </strong></div>
															<div class="col-md-6"><?php echo $val['filesize']; ?></div>
														</div>
													<?php } ?>
													<?php if ($val['created_at'] != '') { ?>
														<div class="row">
															<div class="col-md-6"><strong>Date : </strong></div>
															<div class="col-md-6"><?php echo date('M d, Y', strtotime($val['date_transaction'])); ?></div>
														</div>
													<?php } ?>
													<?php if ($val['tags'] != '') { ?>
														<div class="row">
															<div class="col-md-6"><strong>Tags : </strong></div>
															<div class="col-md-6"><?php echo $val['tags']; ?></div>
														</div>
													<?php } ?>
													<br>
													<h3 class="tx-20 mg-b-0 tx-uppercase tx-inverse tx-bold ">DOWNLOAD MEDIA</h3>
													<br>

													<div class="row">
														<div class="col-md-12">
															<strong><a onclick='return insertlog(<?php echo $val['id']; ?>,2)' href="<?php echo $val['path'] . $val['filename']; ?>" download><i class="fa fa-download"></i> &nbsp;Download Link (<?php echo $val['filename']; ?>) </a></strong>
														</div>
													</div>
													<!-- <div class="row">
														<div class="col-md-12">
															<strong><a href="http://sss-archiving.test/UPLOADS/mp4.mp4" download><i class="fa fa-download"></i> &nbsp;Download Link 2</a></strong>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<strong><a href="http://sss-archiving.test/UPLOADS/mp4.mp4" download><i class="fa fa-download"></i> &nbsp;Download Link 3</a></strong>
														</div>
													</div> -->


													<br>
												</td>
											</tr>

										</table>



									</div><!-- modal-body -->
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div><!-- modal-dialog -->
						</div><!-- modal -->


					<?php
					} ?>
				</div><!-- file-group -->
			</div><!-- manager-right -->
			<div class="manager-left">
				<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/create" class="btn btn-contact-new">Upload File</a>
				<nav class="nav">
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/admin&fileUpload%5Bfilecategory%5D=100" class="nav-link <?php echo $_GET['fileUpload']['filecategory'] == 100 ? 'active' : ''; ?>">
						<span>All File Type</span>
						<span><?php echo FileUpload::model()->get_all_file_type($email, $_GET); ?></span>
					</a>
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/admin&fileUpload%5Bfilecategory%5D=1" class="nav-link <?php echo $_GET['fileUpload']['filecategory'] == 1 ? 'active' : ''; ?>">
						<span>Documents</span>
						<span><?php echo FileUpload::model()->get_diff_file_type($email, 1, $_GET); ?></span>
					</a>
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/admin&fileUpload%5Bfilecategory%5D=2" class="nav-link <?php echo $_GET['fileUpload']['filecategory'] == 2 ? 'active' : ''; ?>">
						<span>Images</span>
						<span><?php echo FileUpload::model()->get_diff_file_type($email, 2, $_GET); ?></span>
					</a>
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/admin&fileUpload%5Bfilecategory%5D=3" class="nav-link <?php echo $_GET['fileUpload']['filecategory'] == 3 ? 'active' : ''; ?>">
						<span>Videos</span>
						<span><?php echo FileUpload::model()->get_diff_file_type($email, 3, $_GET); ?></span>
					</a>
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/admin&fileUpload%5Bfilecategory%5D=4" class="nav-link <?php echo $_GET['fileUpload']['filecategory'] == 4 ? 'active' : ''; ?>">
						<span>Sound</span>
						<span><?php echo FileUpload::model()->get_diff_file_type($email, 4, $_GET); ?></span>
					</a>
				</nav>

			</div><!-- manager-left -->
		</div><!-- manager-wrapper -->


	</div>
</div>

<script>
	function deletetran(id) {

		// alert(id)



		Swal.fire({
			title: 'Are you sure?',
			text: 'You want to delete this file?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'red',
			cancelButtonColor: 'gray',
			confirmButtonText: 'Yes, delete it!'

		}).
		then((result) => {

			if (result.isConfirmed) {
				$.ajax({
					url: '<?php echo $this->createUrl('fileUpload/deleteTran'); ?>',
					type: 'POST',
					dataType: 'html',
					data: {
						'data': "1",

						'id': id,

						'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					},
					success: function(response, status, data) {

						Swal.fire('Deleted',
							'Transaction successfully deleted',
							'success').
						then((result) => {
							location.reload();
						})
					},
					error: function(xhr, status, error) {
						alert("Error Update")



					}
				});
			} else if (result.isDenied) {

			}


			// Reload the Page
			// var request_url = "<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/delete&id="+id
			// window.location.href = request_url;
			// location.reload();
		});

	}


	function insertlog(id, type) {
		// alert(id)

		$.ajax({
			url: '<?php echo $this->createUrl('fileUpload/insertlog'); ?>',
			type: 'POST',
			dataType: 'html',
			data: {
				'data': "1",
				'id': id,
				'type': type,


				'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
			},
			success: function(response, status, data) {

			},
			error: function(xhr, status, error) {
				alert("Error Update")

			}
		});
	}

	function uploadthumbnail(id) {

		Swal.fire({
			title: 'Select thumbnail',
			showCancelButton: true,
			confirmButtonText: 'Upload',
			input: 'file',
		
			onBeforeOpen: () => {
				$(".swal2-file").change(function() {
					var reader = new FileReader();
					reader.readAsDataURL(this.files[0]);
				});
			}
		}).then((file) => {
			if (file.value) {
				var formData = new FormData();
				var file = $('.swal2-file')[0].files[0];

				formData.append("fileToUpload", file);
				formData.append("fileToUploadID", id);

				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					method: 'post',
					url: '<?php echo $this->createUrl('thumbnail/upload'); ?>',
					data: formData,
					processData: false,
					contentType: false,
					success: function(resp) {
						Swal.fire('Uploaded', 'Your file have been uploaded', 'success');
						console.log("resp---" + resp)
					},
					error: function() {
						Swal.fire({
							type: 'error',
							title: 'Oops...',
							text: 'Something went wrong!'
						})
					}
				})
			}
		})

	}
</script>