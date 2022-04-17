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


	/* .pricing-list {
    margin: 0 20px 25px;
    padding: 0;
    list-style: none;
	display: block !important; 
	overflow: hidden !important; 
	text-decoration: none !important; 
    text-overflow: ellipsis !important; 
    white-space: nowrap !important;	
   
}

.card-pricing-three .card-body {
    padding: 30px;
    text-align: center;
    border: 1px solid #ced4da;
    border-top: 0;
	display: block !important; 
	overflow: hidden !important; 
	text-decoration: none !important; 
    text-overflow: ellipsis !important; 
    white-space: nowrap !important;
} */
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
				<h6 class="slim-pagetitle">Recent Projects</h6>
			</div><!-- slim-pageheader -->
			<a id="managerNavicon" href="" class="contact-navicon"><i class="icon ion-navicon-round"></i></a>
		</div><!-- manager-header -->





		<div class="file-group ">
			<div class="row row-lg col-xl-12">
				<?php

				$data = FileUpload::model()->search_client($_GET);

				foreach ($data->getData() as $val) {
				?>

					<div class="col-md-2 col-md-offset-1 mg-sm-t-20 ">
						<div class="card card-pricing-three">
							<div class="card-header bg-primary"><?php echo $val['company']; ?></div>

							<div class="card-pricing">
								<?php if ($val['filecategory'] == 1) { ?>
									<img src="images/file.png" width="100" />
								<?php } ?>

								<?php if ($val['filecategory'] == 2) { ?>
									<img src="images/image.png" width="100" />
								<?php } ?>
								<?php if ($val['filecategory'] == 3) { ?>
									<img src="images/video.png" width="100" />
								<?php } ?>
								<?php if ($val['filecategory'] == 4) { ?>
									<img src="images/sound.png" width="100" />
								<?php } ?>
							</div><!-- card-pricing -->
							<div class="card-body">
								<ul class="pricing-list">
									<div style="display: block !important; 
								overflow: hidden !important; 
								text-decoration: none !important; 
								text-overflow: ellipsis !important; 
								white-space: nowrap !important;	">
										<!-- <h4><?php echo $val['title']; ?></h4> -->
									</div>

									<li>Date: <?php echo $val['date_transaction']; ?></li>
									<li>File Size: <?php echo $val['filesize']; ?></li>
								</ul><!-- pricing-list -->
								<a href="" onclick='return insertlog(<?php echo $val['id']; ?>,1)' class="btn btn-primary btn-pricing" data-toggle="modal" data-target="#modaldemo<?php echo $val['id']; ?>"><i class="icon ion-eye"></i> View File</a>
							</div><!-- card-body -->
						</div><!-- card -->
					</div><!-- col -->

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

			</div>
		</div><!-- manager-wrapper -->

		<div class="row mg-t-60">

			<div class="col-lg-8">
			</div>
			<div class="col-lg-2">
				<span class="btn btn-primary btn-block btn-sm mg-b-10 btn-oblong" href="" onclick="return seeless(6)">
					<i class="fa fa-minus mg-r-5"></i>See Less</span>
			</div>
			<div class="col-lg-2">
				<span class="btn btn-primary btn-block btn-sm mg-b-10 btn-oblong" href="" onclick="return seemore(6)">
					<i class="fa fa-plus mg-r-5"></i>See More</span>
			</div>
		</div>
	</div>
</div>
<?php
$provider = FileUpload::model()->search_client($_GET);
$page = $provider->pagination->pageSize;


?>
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

	function seemore(pagination) {

		var url = document.location.hostname
		// var pagination = $("#searchtags").val()
		var curr_pagesize = '<?php echo intVal($page) ?>'
		var request_url = "<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/admin_client&fileUpload%5Bpagination%5D=" + (parseInt(curr_pagesize) + parseInt(pagination))
		window.location.href = request_url;
		// $('html, body').animate({ scrollTop: $(document).height() }, 1200);	

	}

	function seeless(pagination) {

var url = document.location.hostname
// var pagination = $("#searchtags").val()
var curr_pagesize = '<?php echo intVal($page) ?>'
var request_url = "<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/admin_client&fileUpload%5Bpagination%5D=" + (parseInt(curr_pagesize) - parseInt(pagination)) 
window.location.href = request_url;
// $('html, body').animate({ scrollTop: $(document).height() }, 1200);	

}
</script>