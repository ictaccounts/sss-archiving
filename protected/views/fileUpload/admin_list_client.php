<?php
$provider = FileUpload::model()->search_list_client($_GET);
$pagesss = $provider->pagination->pageSize;
// echo $pagesss;
?>
<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style>
	.modal-lg {
		max-width: 90% !important;
	}
</style>
<div class="slim-mainpanel">
	<div class="container">
		<div class="manager-header">
			<div class="slim-pageheader">
				<ol class="breadcrumb slim-breadcrumb">
					<!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active" aria-current="page">File Manager</li> -->
				</ol>
				<h6 class="slim-pagetitle">List of Files</h6>
			</div><!-- slim-pageheader -->
			<a id="managerNavicon" href="" class="contact-navicon"><i class="icon ion-navicon-round"></i></a>
		</div><!-- manager-header -->



		<div class="section-wrapper mg-t-20">


			<div class="search-form" style="display:block">
				<?php $this->renderPartial('_search_list_client', array(
					'model' => $model,
				)); ?>
			</div><!-- search-form -->

			<div class="row mg-t-20">
				<div class="col-lg-2">
					<select class="form-control" id="pagesizes">
						<option value=10 <?php echo $_GET['FileUpload']['selectpagination'] == 10 ? "selected" : "" ?>>10</option>
						<option value=20 <?php echo $_GET['FileUpload']['selectpagination'] == 20 ? "selected" : "" ?>>20</option>
						<option value=50 <?php echo $_GET['FileUpload']['selectpagination'] == 50 ? "selected" : "" ?>>50</option>
					</select>
				</div>
				<div class="col-lg-12">
				</div>

			</div>

			<div class="table">

				<table class="table table-bordered mg-t-20">
					<thead class="thead-colored bg-primary">
						<tr>
							<th class="wd-3p">#</th>
							<th class="wd-30p">Title</th>
							<th class="wd-20p">Category</th>
							<th class="wd-20p">Size</th>
							<th class="wd-20p">Tags</th>
							<th class="wd-20p">Date</th>
							<th class="wd-10p" colspan="2"></th>
						</tr>
					</thead>
					<tbody>

						<?php


						$data = FileUpload::model()->search_list_client($_GET);
						$i = 1;
						foreach ($data->getdata() as $val) {
						?>

							<tr>
								<th scope="row"><?php echo $i ?></th>

								<th scope="row"><?php echo $val['title'] ?></th>
								<td><?php echo FileUpload::model()->categoryname($val['filecategory']) ?></td>
								<td><?php echo $val['filesize'] ?></td>
								<td><?php echo $val['tags'] ?></td>
								<td><?php echo date("M d,Y", strtotime($val['date_transaction'])) ?></td>
								<td> <a href="" class="btn btn-primary btn-sm btn-icon rounded-circle" data-toggle="modal" data-target="#modaldemo<?php echo $val['id'] ?>" onclick='return insertlog(<?php echo $val['id']; ?>,1)'>
										<div><i class="icon ion-eye"></i></div>
									</a>
								</td>
								<td>
									<a href="<?php echo $val['path'] . $val['filename'] ?>" download class="btn btn-success btn-sm btn-icon rounded-circle" onclick='return insertlog(<?php echo $val['id']; ?>,2)'>
										<div><i class="fa fa-download"></i></div>
									</a>


								</td>
							</tr>



						<?php $i++; } ?>

					</tbody>
				</table>

				<div class="row mg-t-60">

					<div class="col-lg-9">
					</div>
					<div class="col-lg-1">
					</div>
					<div class="col-lg-2">
						<span class="btn btn-primary btn-block btn-sm mg-b-10 btn-oblong" href="" onclick="return seemore()">
							<i class="fa fa-plus mg-r-5"></i>See More</span>
					</div>
				</div>

			</div>
		</div>
		<?php
		$data = FileUpload::model()->search($_GET);

		foreach ($data->getdata() as $val) {
		?>


			<div id="modaldemo<?php echo $val['id'] ?>" class="modal fade modalsss">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content tx-size-sm">
						<div class="modal-header pd-x-20 bg-primary ">
							<h3 class="tx-20 mg-b-0 tx-uppercase tx-inverse tx-bold text-white"><?php echo $val['title'] ?></h3>
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
											<!-- <img src="<?php echo $val['path'] . $val['filename'] ?>" alt="Italian Trulli"> -->
											<img src="<?php echo $val['path'] . $val['filename'] ?>" width="700" />
										<?php } ?>
										<?php if ($val['filecategory'] == 3) { ?>
											<video width="700" controls>
												<source src="<?php echo $val['path'] . $val['filename'] ?>" type='video/<?php echo $val['format'] ?>' />
											</video>
										<?php } ?>
										<?php if ($val['filecategory'] == 4) { ?>
											<audio width="900" controls>
												<source src="<?php echo $val['path'] . $val['filename'] ?>" type='audio/<?php echo $val['format'] ?>' />
											</audio>
										<?php } ?>

									</td>
									<td class="col-md-5" valign="top">
										<h3 class="tx-20 mg-b-0 tx-uppercase tx-inverse tx-bold ">PROJECT INFORMATION</h3>
										<br>
										<div class="row">
											<div class="col-md-6"><strong>Material Type : </strong></div>
											<div class="col-md-6"><?php echo $val['type'] ?></div>
										</div>
										<div class="row">
											<div class="col-md-6"><strong>Description : </strong></div>
											<div class="col-md-6"><?php echo $val['description'] ?></div>
										</div>
										<div class="row">
											<div class="col-md-6"><strong>Company : </strong></div>
											<div class="col-md-6"><?php echo $val['type'] ?></div>
										</div>
										<div class="row">
											<div class="col-md-6"><strong>Product : </strong></div>
											<div class="col-md-6"><?php echo $val['product'] ?></div>
										</div>
										<?php if ($val['filecategory'] == 4) { ?>
											<div class="row">
												<div class="col-md-6"><strong>Duration : </strong></div>
												<div class="col-md-6"><?php echo $val['filelength'] ?></div>
											</div>
										<?php } ?>
										<div class="row">
											<div class="col-md-6"><strong>Project Size : </strong></div>
											<div class="col-md-6"><?php echo $val['filesize'] ?></div>
										</div>
										<div class="row">
											<div class="col-md-6"><strong>Tags : </strong></div>
											<div class="col-md-6"><?php echo $val['tags'] ?></div>
										</div>
										<div class="row">
											<div class="col-md-6"><strong>Date : </strong></div>
											<div class="col-md-6"><?php echo date("M d, Y", strtotime($val['created_at'])) ?></div>
										</div>
										<br>
										<h3 class="tx-20 mg-b-0 tx-uppercase tx-inverse tx-bold ">DOWNLOAD MEDIA</h3>
										<br>

										<div class="row">
											<div class="col-md-12">
												<strong><a href="<?php echo $val['path'] . $val['filename'] ?>" download><i class="fa fa-download"></i> &nbsp;Download Link (<?php echo $val['filename']; ?>) </a></strong>
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
		<?php } ?>
		<?php
		// $this->widget('zii.widgets.grid.CGridView', array(
		// 	'id' => 'users-grid',
		// 	'dataProvider' => $model->search(),
		// 	'filter' => $model,
		// 	'columns' => array(
		// 		'id',
		// 		'user_fullname',
		// 		'user_company',
		// 		'user_email',
		// 		'user_password',
		// 		'user_role',
		// 		/*
		// 'created_at',
		// */
		// 		array(
		// 			'class' => 'CButtonColumn',
		// 		),
		// 	),
		// )); 
		?>
	</div>
</div>
</div>

<script>
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

	function seemore() {

		var url = document.location.hostname
		var pagination = $("#pagesizes").val()
		var curr_pagesize = '<?php echo intVal($pagesss) ?>'
		// alert(pagination + - + curr_pagesize)
		var request_url = "<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/adminListClient&FileUpload%5Bselectpagination%5D=" + pagination + "&FileUpload%5Bpagination%5D=" + (parseInt(curr_pagesize) + parseInt(pagination))
		window.location.href = request_url;
		// $('html, body').animate({ scrollTop: $(document).height() }, 1200);	

	}
</script>