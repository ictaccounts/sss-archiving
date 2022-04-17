<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/fileinput.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/locales/LANG.js"></script>

<style>
	.modal-lg {
		max-width: 90% !important;
	}
</style>

<?php
$form = $this->beginWidget('CActiveForm', [
    'id' => 'uploadForm',
    'enableAjaxValidation' => false,
    'htmlOptions' => ['enctype' => 'multipart/form-data'],
    // 'method' => 'post',
]);
?>

<div class="slim-mainpanel">
	<div class="container">
		<div class="slim-pageheader">
			<ol class="breadcrumb slim-breadcrumb">
				<!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item"><a href="#">Forms</a></li>
				<li class="breadcrumb-item active" aria-current="page">Form Elements</li> -->
			</ol>
			<h6 class="slim-pagetitle">EDIT</h6>
		</div><!-- slim-pageheader -->

		<div class="section-wrapper">
			<div class="row">
				<div class="col-lg">
					<label class="section-title">Title</label>
					<?php echo $form->textField($model, 'title', ['size' => 255, 'maxlength' => 255, 'class' => 'form-control']); ?>
					<?php echo $form->hiddenField($model, 'id', ['size' => 255, 'maxlength' => 255, 'class' => 'form-control']); ?>

					<?php echo $form->error($model, 'title'); ?>
				</div><!-- col -->
				<div class="col-lg">
					<label class="section-title">Company/Agency</label>
					<?php echo $form->textField($model, 'company', ['size' => 255, 'maxlength' => 255, 'class' => 'form-control']); ?>
					<?php echo $form->error($model, 'company'); ?>
				</div><!-- col -->
				<div class="col-lg mg-t-10 mg-lg-t-0">
					<label class="section-title">Material Type</label>
					<?php echo $form->textField($model, 'type', ['size' => 255, 'maxlength' => 255, 'class' => 'form-control']); ?>
					<?php echo $form->error($model, 'type'); ?>
				</div><!-- col -->
				<div class="col-lg mg-t-10 mg-lg-t-0">
					<label class="section-title">Product</label>
					<?php echo $form->textField($model, 'product', ['size' => 255, 'maxlength' => 255, 'class' => 'form-control']); ?>
					<?php echo $form->error($model, 'product'); ?>
				</div><!-- col -->
			</div><!-- row -->
			<br>
			<div class="row ">
				<div class="col-lg">
					<label class="section-title">Description</label>
					<?php echo $form->textField($model, 'description', ['class' => 'form-control']); ?>
					<?php echo $form->error($model, 'description'); ?>
				</div><!-- col -->
				<div class="col-lg mg-t-10 mg-lg-t-0">
					<label class="section-title">Tags </label>
					<?php echo $form->textField($model, 'tags', ['size' => 255, 'maxlength' => 255, 'class' => 'form-control', 'placeholder' => 'format e.g (burgers,fries,spaghetti)']); ?>
					<?php echo $form->error($model, 'tags'); ?>
				</div><!-- col -->
				<div class="col-lg mg-t-10 mg-lg-t-0">
					<label class="section-title">Duration (Seconds) </label>
					<?php echo $form->textField($model, 'filelength', ['size' => 255, 'maxlength' => 255, 'class' => 'form-control', 'placeholder' => 'Seconds']); ?>
					<?php echo $form->error($model, 'filelength'); ?>
				</div><!-- col -->
				<div class="col-lg mg-t-10 mg-lg-t-0">
					<label class="section-title">Date</label>
					<?php echo $form->dateField($model, 'date_transaction', ['class' => 'form-control']); ?>
					<?php echo $form->error($model, 'date_transaction'); ?>
				</div><!-- col -->
			</div><!-- row -->
			<label class="section-title">File Attached</label>

			<div class="row">
			<div class="file-group">
			<div class="file-item">
							<div class="row no-gutters wd-100p">
								<div class="col">
									<i class="fa fa-file"></i>
									<a href=""><?php echo $model->filename; ?></a>
								</div><!-- col-6 -->
								<div class="col"><?php echo $model->filesize; ?></div>
								<div class="col"><?php echo date('M d, Y', strtotime($model->date_transaction)); ?></div>
								<div class="col col-sm-1 tx-right mg-t-5 mg-sm-t-0">
									<a href="" data-toggle="modal" data-target="#modaldemo<?php echo $model->id; ?>">
										<i class="icon ion-eye"></i> <strong>VIEW FILE</strong></a>
								
							</div><!-- row -->
						</div><!-- file-item -->
						</div>
			</div>
						
			</div>

			<!-- LARGE MODAL -->

			<div id="modaldemo<?php echo $model->id; ?>" class="modal fade">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content tx-size-sm">
									<div class="modal-header pd-x-20 bg-primary ">
										<h3 class="tx-20 mg-b-0 tx-uppercase tx-inverse tx-bold text-white"><?php echo $model->title; ?></h3>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body pd-20">
										<table>
											<tr>
												<td class="col-md-5">
													<?php if ($model->filecategory == 1) { ?>
														<img src="images/box.png" width="400" />
													<?php } ?>

													<?php if ($model->filecategory == 2) { ?>
														<!-- <img src="<?php echo $model->path.$model->filename; ?>" alt="Italian Trulli"> -->
														<img src="<?php echo $model->path.$model->filename; ?>" width="700" />
													<?php } ?>
													<?php if ($model->filecategory == 3) { ?>
														<video width="700" controls>
															<source src="<?php echo $model->path.$model->filename; ?>" type='video/<?php echo $model->format; ?>' />
														</video>
													<?php } ?>
													<?php if ($model->filecategory == 4) { ?>
														<audio width="900" controls>
															<source src="<?php echo $model->path.$model->filename; ?>" type='audio/<?php echo $model->format; ?>' />
														</audio>
													<?php } ?>

												</td>
												<td class="col-md-5" valign="top">
													<h3 class="tx-20 mg-b-0 tx-uppercase tx-inverse tx-bold ">PROJECT INFORMATION</h3>
													<br>
													<div class="row">
														<div class="col-md-6"><strong>Material Type : </strong></div>
														<div class="col-md-6"><?php echo $model->type; ?></div>
													</div>
													<div class="row">
														<div class="col-md-6"><strong>Description : </strong></div>
														<div class="col-md-6"><?php echo $model->description; ?></div>
													</div>
													<div class="row">
														<div class="col-md-6"><strong>Agency/Company : </strong></div>
														<div class="col-md-6"><?php echo $model->type; ?></div>
													</div>
													<div class="row">
														<div class="col-md-6"><strong>Product : </strong></div>
														<div class="col-md-6"><?php echo $model->product; ?></div>
													</div>
													<?php if ($model->filecategory == 4) { ?>
													<div class="row">
														<div class="col-md-6"><strong>Length : </strong></div>
														<div class="col-md-6"><?php echo $model->filelength; ?></div>
													</div>
													<?php } ?>
													<div class="row">
														<div class="col-md-6"><strong>Project Size : </strong></div>
														<div class="col-md-6"><?php echo $model->filesize; ?></div>
													</div>
													<div class="row">
														<div class="col-md-6"><strong>Date : </strong></div>
														<div class="col-md-6"><?php echo date('M d, Y', strtotime($model->created_at)); ?></div>
													</div>
													<div class="row">
														<div class="col-md-6"><strong>Tags : </strong></div>
														<div class="col-md-6"><?php echo $model->tags; ?></div>
													</div>
													<br>
													<h3 class="tx-20 mg-b-0 tx-uppercase tx-inverse tx-bold ">DOWNLOAD MEDIA</h3>
													<br>

													<div class="row">
														<div class="col-md-12">
															<strong><a href="<?php echo $model->path.$model->filename; ?>" 
															download><i class="fa fa-download"></i> &nbsp;Download Link (<?php echo $model->filename; ?>) </a></strong>
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

			<label class="section-title">Upload your file here</label>
			<!-- <p class="mg-b-20 mg-sm-b-40">A basic form control with disabled and readonly mode.</p> -->
			<p class="mg-b-20 mg-sm-b-40"></p>


			<div class="row ">
				<div class="col-lg-12 mg-t-40 mg-lg-t-0">
					<div class="custom-file">
						<input id="input-b1" name="file" type="file" id="fileInput" class="file" data-browse-on-zone-click="true" 
						value="<?php echo $model->path.$model->filename; ?>">
						<span></span>
						<!-- <input type="file" class="custom-file-input" name="file" id="fileInput">
						<label class="custom-file-label custom-file-label-primary" for="customFile">Choose file</label> -->
					</div><!-- custom-file -->
				</div><!-- col -->
			</div><!-- row -->
			<div class="row">
				<div class="col-lg-12 mg-t-40 mg-lg-t-0">
					<!-- Progress bar -->
					<br>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<!-- Display upload status -->
					<div id="uploadStatus"></div>
				</div><!-- col -->
			</div><!-- row -->
			<div class="row mg-t-20">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => 'btn btn-primary btn-block mg-b-10']); ?>
		</div>


		</div><!-- section-wrapper -->


	</div>
</div>






<?php $this->endWidget(); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	$("#uploadForm").on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			xhr: function() {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function(evt) {
					if (evt.lengthComputable) {
						var percentComplete = ((evt.loaded / evt.total) * 100);
						$(".progress-bar").width(percentComplete + '%');
						$(".progress-bar").html(percentComplete + '%');
					}
				}, false);
				return xhr;
			},
			type: 'POST',
			// url: 'upload.php',
			url: '<?php echo $this->createUrl('fileUpload/UpdateTran'); ?>',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function() {
				$(".progress-bar").width('0%');
				$('#uploadStatus').html('<p style="color:green;">Uploading...</p>');
			},
			error: function(response) {
				// $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.'+JSON.stringify(response)+'</p>' );
				$('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
			},
			success: function(resp) {
				if (resp == 'ok') {
					$('#uploadForm')[0].reset();
					$('#uploadStatus').html('<p style="color:#28A74B;">Update has uploaded successfully!</p>');

					Swal.fire('Success',
						'File uploaded successfully',
						'success').then((result) => {
						// Reload the Page
						var request_url = "<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/admin"
						window.location.href = request_url;
						// location.reload();
					});
				} else if (resp == 'err') {
					$('#uploadStatus').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>');
				}
			}
		});
	});

	// File type validation
	// $("#fileInput").change(function() {
	// 	var allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.ms-office',
	// 		'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	// 		'image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'video/mp4', 'video/avi', 'video/mov'
	// 	];
	// 	var file = this.files[0];
	// 	var fileType = file.type;
	// 	if (!allowedTypes.includes(fileType)) {
	// 		alert('Please select a valid file (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF).');
	// 		$("#fileInput").val('');
	// 		return false;
	// 	}
	// });
</script>