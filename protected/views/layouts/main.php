<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Twitter -->
	<meta name="twitter:site" content="@themepixels">
	<meta name="twitter:creator" content="@themepixels">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="Slim">
	<meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
	<meta name="twitter:image" content="http://themepixels.me/slim/img/slim-social.png">

	<!-- Facebook -->
	<meta property="og:url" content="http://themepixels.me/slim">
	<meta property="og:title" content="Slim">
	<meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

	<meta property="og:image" content="http://themepixels.me/slim/img/slim-social.png">
	<meta property="og:image:secure_url" content="http://themepixels.me/slim/img/slim-social.png">
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="600">

	<!-- Meta -->
	<meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
	<meta name="author" content="ThemePixels">

	<title>SSS Archiving</title>

	<!-- vendor css -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/lib/Ionicons/css/ionicons.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/lib/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">

	<!-- Slim CSS -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/slim.css">

</head>

<body>
<?php $user_type = Users::model()->get_type_by_email(Yii::app()->user->name); ?>

	<?php if (!Yii::app()->user->isGuest) { ?>
		
		<div class="slim-header with-sidebar" style="background-color: #31487A;">
			<div class="container-fluid">
				<div class="slim-header-left">
					<div>
						<img src="images/ssslogobar2.jpg" alt="" style="width:25%; height: auto">
					</div>

					<!-- <a href="" id="slimSidebarMenu" class="slim-sidebar-menu"><span></span></a> -->
					<?php if ($user_type == 1) { ?>
					<div class="search-box">
						<input type="text" class="form-control" id="searchtags" placeholder="Search TAGS/TITLE">
						<button class="btn btn-primary" onclick="search()"><i class="fa fa-search"></i></button>
					</div><!-- search-box -->
					<?php } ?>
				</div><!-- slim-header-left -->
				<div class="slim-header-right">
					<div class="dropdown dropdown-c" style="color:white">
						<a href="#" class="logged-user" data-toggle="dropdown" style="color:white">
							<?php if ($user_type == 1) { ?>
								<img src="https://gravatar.com/avatar/eb40c555eee9a95032b131cfea6ff5cd?s=400&d=robohash&r=x" alt="" style="color:white">
							<?php } else { ?>
								<img src="https://gravatar.com/avatar/2566481f281cf59e1daed65b52e36da7?s=400&d=robohash&r=x" alt="" style="color:white">
							<?php } ?>

							<span style="color:white"><?php echo Users::model()->get_type_by_fullname(Yii::app()->user->name); ?></span>
							<i class="fa fa-angle-down" style="color:white"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
						<nav class="nav">
								<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=users/admin_profile" class="nav-link"><i class="icon ion-person"></i> Profile</a>
							</nav>
							<nav class="nav">
								<a href="<?php echo Yii::app()->createUrl('/site/logout'); ?>" class="nav-link"><i class="icon ion-forward"></i> Sign Out</a>
							</nav>
						</div><!-- dropdown-menu -->
					</div><!-- dropdown -->
				</div><!-- header-right -->
			</div><!-- container-fluid -->
		</div><!-- slim-header -->

		<div class="slim-body">




			<div class="slim-sidebar">
				<label class="sidebar-label">Navigation</label>

				<ul class="nav nav-sidebar">
					<?php if ($user_type == 1) { ?>
						<li class="sidebar-nav-item">
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/admin" class="sidebar-nav-link">
								<i class="icon ion-ios-home-outline"></i> Overview</a>
						</li>
						<li class="sidebar-nav-item">
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/adminListClient" class="sidebar-nav-link">
								<i class="icon ion-ios-list-outline"></i> List of Files</a>
						</li>
						<li class="sidebar-nav-item">
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=users/admin" class="sidebar-nav-link">
								<i class="icon ion-ios-person"></i> Users</a>
						</li>
						<li class="sidebar-nav-item">
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=historyLogs/admin" class="sidebar-nav-link">
								<i class="icon ion-ios-eye-outline"></i> Activity Logs</a>
						</li>
						<li class="sidebar-nav-item">
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/admin_trash" class="sidebar-nav-link">
								<i class="icon ion-ios-trash-outline"></i> Recycle Bin/Trash</a>
						</li>
					<?php } ?>

					<?php if ($user_type == 2) { ?>
						<li class="sidebar-nav-item">
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/admin_client" class="sidebar-nav-link">
								<i class="icon ion-ios-home-outline"></i> Overview</a>
						</li>
						<li class="sidebar-nav-item">
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/adminListClient" class="sidebar-nav-link">
								<i class="icon ion-ios-list-outline"></i> List of Files</a>
						</li>
						<li class="sidebar-nav-item">
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=historyLogs/admin_client" class="sidebar-nav-link">
								<i class="icon ion-ios-eye-outline"></i> Activity Logs</a>
						</li>
						

					<?php } ?>
				</ul>
			</div><!-- slim-sidebar -->

			<div class="slim-mainpanel">
				<?php
#
                echo $content;
                ?>
				<div class="slim-footer mg-t-0" style="background-color: #31487A;color:white">
					<div class="container-fluid">
			<!-- <span>
			</span>
			<span>
			<img src="images/Picture2.png" alt="" style="width:10%; height: auto">

			</span> -->
			<p>Copyright 2022 &copy; All Rights Reserved. SSS ARCHIVING SYSTEM</p>
						<p align="right"><a href="">	<img src="images/Picture2.png" alt="" style="width:40%; height: auto">
</a></p>



			
					</div><!-- slim-header-left -->
					</div><!-- container-fluid -->
				</div><!-- slim-footer -->
			</div><!-- slim-mainpanel -->

		</div><!-- slim-body -->

	<?php
    } else {
        echo $content;
    }

    ?>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/lib/jquery/js/jquery.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/lib/popper.js/js/popper.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/lib/bootstrap/js/bootstrap.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/lib/jquery.cookie/js/jquery.cookie.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/slim.js"></script>

	<script>
		function search() {

			var url = document.location.hostname
			var idsearch = $("#searchtags").val()
			var request_url = "<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=fileUpload/admin&fileUpload%5Btags%5D=" + idsearch
			window.location.href = request_url;
			//  alert("s/earch " + request_url)
		}
	</script>
</body>

</html>