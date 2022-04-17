<?php $user_type = Users::model()->get_type_by_email(Yii::app()->user->name); ?>
<?php if ($user_type == 1) { ?>
	<script>
	var url = document.location.hostname
	var request_url = "<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/admin"
	window.location.href = request_url;
	// alert("search " + request_url)
	</script>
<?php } ?>
<?php if ($user_type == 2) { ?>
	<script>
	var url = document.location.hostname
	var request_url = "<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/admin_client"
	window.location.href = request_url;
	// alert("search " + request_url)
	</script>
<?php } ?>

