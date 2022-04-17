<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print"> -->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<!-- Vendor css -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/lib/Ionicons/css/ionicons.css" rel="stylesheet">

	<!-- Slim CSS -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/slim.css">

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/lib/select2/css/select2.min.css" rel="stylesheet">

	<title>SSS Archiving System</title>
</head>

<body>
	<?php $user_type = Users::model()->get_type_by_email(Yii::app()->user->name); ?>

	<?php if (!Yii::app()->user->isGuest) { ?>

		<div class="slim-header with-sidebar">
			<div class="container">
				<div class="slim-header-left">
					<img src="images/sss-logo.png" alt="" style="width:20%; height: auto">

					<!-- <h2 class="slim-logo"><a href="index.html">SSS Archiving System<span></span></a></h2> -->

				</div><!-- slim-header-left -->
				<div class="slim-header-right">

					<div class="dropdown dropdown-c">
						<a href="#" class="logged-user" data-toggle="dropdown">
							<?php if ($user_type == 1) { ?>
								<img src="https://gravatar.com/avatar/eb40c555eee9a95032b131cfea6ff5cd?s=400&d=robohash&r=x" alt="">
							<?php } else { ?>
								<img src="https://gravatar.com/avatar/2566481f281cf59e1daed65b52e36da7?s=400&d=robohash&r=x" alt="">
							<?php } ?>

							<span><?php echo Users::model()->get_type_by_fullname(Yii::app()->user->name); ?></span>
							<i class="fa fa-angle-down"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<nav class="nav">
								<a href="<?php echo Yii::app()->createUrl('/site/logout') ?>" class="nav-link"><i class="icon ion-forward"></i> Sign Out</a>
							</nav>
						</div><!-- dropdown-menu -->
					</div><!-- dropdown -->
				</div><!-- header-right -->
			</div><!-- container -->
		</div><!-- slim-header -->



		<div class="slim-navbar">
			<div class="container">
				<ul class="nav">

					<?php if ($user_type == 1) { ?>
						<li class="nav-item ">
							<a class="nav-link" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/admin">
								<i class="icon ion-ios-home-outline"></i>
								<span>Dashboard</span>
							</a>
						</li>

						<li class="nav-item with-sub ">
							<a class="nav-link" href="#" data-toggle="dropdown">
								<i class="icon ion-ios-gear-outline"></i>
								<span>Users</span>
							</a>
							<div class="sub-item">
								<ul>
									<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=users/admin">Manage Users</a></li>
									<li><a href="form-layouts.html">Add/Edit Administrative and Client User</a></li>
								</ul>
							</div><!-- dropdown-menu -->
						</li>

						<li class="nav-item with-sub ">
							<a class="nav-link" href="#" data-toggle="dropdown">
								<i class="icon ion-ios-analytics-outline"></i>
								<span>Projects</span>
							</a>
							<div class="sub-item">
								<ul>
									<li><a href="form-elements.html">Main post type for archive files</a></li>
									<li class="active"><a href="form-layouts.html">Secured Link File from Workstation Server</a></li>
									<li class="active"><a href="form-layouts.html">Manage Default Metadata</a></li>
									<li class="active"><a href="form-layouts.html">Secured Download Links</a></li>
								</ul>
							</div><!-- dropdown-menu -->
						</li>
					<?php } ?>

					<?php if ($user_type == 2) { ?>
						<li class="nav-item with-sub">
							<a class="nav-link" href="#">
								<i class="icon ion-ios-home-outline"></i>
								<span>Dashboard</span>
							</a>
							<div class="sub-item">
								<ul>
									<li><a href="index.html">Overview</a></li>
									<li><a href="index2.html">List of Files</a></li>
									<li><a href="index3.html">Category</a></li>
									<li><a href="index3.html">Search Form</a></li>
									<li><a href="index3.html">File Viewer and Downloader</a></li>
									<li><a href="index3.html">History Logs</a></li>
								</ul>
							</div><!-- sub-item -->
						</li>

						<li class="nav-item with-sub ">
							<a class="nav-link" href="#" data-toggle="dropdown">
								<i class="icon ion-ios-gear-outline"></i>
								<span>Profile</span>
							</a>
							<div class="sub-item">
								<ul>
									<li><a href="form-elements.html">Account Info Overview</a></li>
									<li class="active"><a href="form-layouts.html">Edit Password and Information</a></li>
								</ul>
							</div><!-- dropdown-menu -->
						</li>
					<?php } ?>

				</ul>
			</div><!-- container -->
		</div><!-- slim-navbar -->


	<?php
	}

	echo $content;
	?>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/lib/jquery/js/jquery.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/lib/popper.js/js/popper.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/lib/bootstrap/js/bootstrap.js"></script>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/slim.js"></script>


	<script src="<?php echo Yii::app()->request->baseUrl; ?>/lib/jquery.cookie/js/jquery.cookie.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/lib/select2/js/select2.min.js"></script>

	<script>
		$(function() {
			'use strict'

			$('.form-layout .form-control').on('focusin', function() {
				$(this).closest('.form-group').addClass('form-group-active');
			});

			$('.form-layout .form-control').on('focusout', function() {
				$(this).closest('.form-group').removeClass('form-group-active');
			});

			// Select2
			$('.select2').select2({
				minimumResultsForSearch: Infinity
			});

			$('#select2-a, #select2-b').select2({
				minimumResultsForSearch: Infinity
			});

			$('#select2-a').on('select2:opening', function(e) {
				$(this).closest('.form-group').addClass('form-group-active');
			});

			$('#select2-a').on('select2:closing', function(e) {
				$(this).closest('.form-group').removeClass('form-group-active');
			});

		});
	</script>
</body>

</html>