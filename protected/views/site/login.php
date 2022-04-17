<style type="text/css">
	body {
		background-image: url("<?php echo Yii::app()->request->baseUrl; ?>/images/loginpage.jpg");

		/* Full height */
		height: 100%;

		/* Center and scale the image nicely */
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}

	/* content {
		margin: 0 !important;
		font-family: "Roboto", "Helvetica Neue", Arial, sans-serif !important;
		font-size: 0.875rem !important;
		font-weight: 400 !important;
		line-height: 1.5 !important;
		color: #868ba1 !important;
		text-align: left !important;
		background-color: #f0f2f7 !important;
	}

	.signin-wrapper {
		min-height: 100vh !important;
		display: flex !important;
		align-items: center !important;
		justify-content: center !important;
		padding: 10px !important;
	} */
</style>
<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'login-form',
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
	)); ?>


	<div class="signin-wrapper">

		<div class="signin-box">

			<h2 class="signin-title-primary">Welcome back!</h2>
			<h3 class="signin-title-secondary">Sign in to continue.</h3>

			<div class="form-group">
				<!-- <input type="text" class="form-control" placeholder="Enter your email"> -->
				<?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Enter your email')); ?>
				<?php echo $form->error($model, 'username'); ?>
			</div><!-- form-group -->
			<div class="form-group mg-b-50">
				<!-- <input type="password" class="form-control" placeholder="Enter your password"> -->
				<?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Enter your password')); ?>
				<?php echo $form->error($model, 'password', array('style' => 'color:red')); ?>
			</div><!-- form-group -->
			<?php echo CHtml::submitButton('Sign In', array('class' => 'btn btn-primary btn-block btn-signin')); ?>

		</div><!-- signin-wrapper -->

		<?php $this->endWidget(); ?>
	</div><!-- form -->