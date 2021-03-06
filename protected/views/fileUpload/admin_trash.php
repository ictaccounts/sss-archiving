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
		</div><!-- slim-pageheader -->

		<div class="manager-header">
			<div class="slim-pageheader">
				<ol class="breadcrumb slim-breadcrumb">
					<!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Pages</a></li>
              <li class="breadcrumb-item active" aria-current="page">File Manager</li> -->
				</ol>
				<h6 class="slim-pagetitle">Recycle Bin/Trash</h6>
			</div><!-- slim-pageheader -->
			<a id="managerNavicon" href="" class="contact-navicon"><i class="icon ion-navicon-round"></i></a>
		</div><!-- manager-header -->







		<div class="manager-wrapper">
			<div class="manager-right">
				<label class="section-label">Project List</label>
				<div class="file-group">
					<?php

					$data = FileUpload::model()->search_delete($_GET);

					foreach ($data->getData() as $val) {
					?>
						<div class="file-item">
							<div class="row no-gutters wd-100p">
								<div class="col-9 col-sm-5 d-flex align-items-center">
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

									<a href=""><?php echo $val['title']; ?></a>
								</div><!-- col-6 -->
								<div class="col-3 col-sm-2 tx-right tx-sm-left"><?php echo $val['filesize']; ?></div>
								<div class="col-6 col-sm-4 mg-t-5 mg-sm-t-0"><?php echo date('M d, Y h:i:s A', strtotime($val['created_at'])); ?></div>
								<div class="col-6 col-sm-1 tx-right mg-t-5 mg-sm-t-0">
									<a href="" data-toggle="modal" data-target="#modaldemo<?php echo $val['id']; ?>" onclick='return insertlog(<?php echo $val['id']; ?>,1)'>
										<i class="icon ion-eye"></i></a>
									<span onclick="return restoretran(<?php echo $val['id']; ?>)" href="">
										<i class="fa fa-forward"></i></span>
									<span onclick="return permanent_del(<?php echo $val['id']; ?>)" href="" >
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

		</div><!-- manager-wrapper -->


	</div>
</div>


<script>
	function restoretran(id) {

		// alert(id)



		Swal.fire({
			title: 'Are you sure?',
			text: 'You want to restore this file?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			cancelButtonColor: 'gray',
			confirmButtonText: 'Yes, restore it!'

		}).
		then((result) => {

			if (result.isConfirmed) {
				$.ajax({
					url: '<?php echo $this->createUrl('fileUpload/restoreTran'); ?>',
					type: 'POST',
					dataType: 'html',
					data: {
						'data': "1",

						'id': id,

						'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					},
					success: function(response, status, data) {

						Swal.fire('Restored',
							'Transaction successfully restored',
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


	function permanent_del(id){

		Swal.fire({
			title: 'Are you sure?',
			text: 'You want to delete this file permanently?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'red',
			cancelButtonColor: 'gray',
			confirmButtonText: 'Yes, delete it permanently!'

		}).
		then((result) => {

			if (result.isConfirmed) {
				$.ajax({
					url: '<?php echo $this->createUrl('fileUpload/deletePermTran'); ?>',
					type: 'POST',
					dataType: 'html',
					data: {
						'data': "1",
						'id': id,
						'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					},
					success: function(response, status, data) {

						Swal.fire('Deleted',
							'Transaction permanently deleted',
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

		});

	}
</script>