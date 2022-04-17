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


<?php
$form = $this->beginWidget('CActiveForm', [
    'id' => 'uploadForm',
    'enableAjaxValidation' => false,
    'htmlOptions' => ['enctype' => 'multipart/form-data'],
    // 'method' => 'post',
]);
?>
<style>

.file-actions, .krajee-default .file-other-error {
    display: none !important;
}

.text-warning {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-warning-rgb),var(--bs-text-opacity))!important;
	display: none !important;
}
	</style>
<div class="slim-mainpanel">
	<div class="container">
		<div class="slim-pageheader">
			<ol class="breadcrumb slim-breadcrumb">
				<!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item"><a href="#">Forms</a></li>
				<li class="breadcrumb-item active" aria-current="page">Form Elements</li> -->
			</ol>
			<h6 class="slim-pagetitle">FILE UPLOADER</h6>
		</div><!-- slim-pageheader -->

		<div class="section-wrapper">
			<div class="row">
				<div class="col-lg">
					<label class="section-title">Title</label>
					<?php echo $form->textField($model, 'title', ['size' => 255, 'maxlength' => 255, 'class' => 'form-control']); ?>
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
					<?php echo $form->textField($model, 'tags', ['size' => 255, 'maxlength' => 255, 'class' => 'form-control']); ?>
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

			<label class="section-title">Upload your file here</label>
			<!-- <p class="mg-b-20 mg-sm-b-40">A basic form control with disabled and readonly mode.</p> -->
			<p class="mg-b-20 mg-sm-b-40"></p>


			<div class="row">
				<div class="col-lg-12 mg-t-40 mg-lg-t-0">
					<div class="custom-file">
						<input id="input-b1" name="file" type="file" id="fileInput" class="file" data-browse-on-zone-click="true">
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
			url: '<?php echo $this->createUrl('fileUpload/upload'); ?>',
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
					$('#uploadStatus').html('<p style="color:#28A74B;">File has uploaded successfully!</p>');

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
	$(document).ready(function() {
		$(".file-footer-buttons").hide()
});

</script>