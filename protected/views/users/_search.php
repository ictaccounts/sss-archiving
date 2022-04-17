<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="wide form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
	)); ?>
	<div class="section-wrapper">

		<div class="row">
			<div class="col-lg">
				<label class="section-title">Name</label>
				<?php echo $form->textField($model, 'user_fullname', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'user_fullname'); ?>
			</div><!-- col -->
			<div class="col-lg mg-t-10 mg-lg-t-0">
				<label class="section-title">Company</label>
				<?php echo $form->textField($model, 'user_company', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'user_company'); ?>
			</div><!-- col -->
			<div class="col-lg mg-t-10 mg-lg-t-0">
				<label class="section-title">Email</label>
				<?php echo $form->textField($model, 'user_email', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'user_email'); ?>
			</div><!-- col -->
		</div><!-- row -->
		<div class="row mg-t-20">
			<div class="col-lg">
				<label class="section-title">Password</label>
				<?php echo $form->passwordField($model, 'user_password', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
				<?php echo $form->error($model, 'user_password'); ?>
			</div><!-- col -->
			<div class="col-lg mg-t-10 mg-lg-t-0">
				<label class="section-title">Role</label>
				<?php echo $form->dropDownList(
					$model,
					'user_role',
					array('1' => 'Administrator', '2' => 'Client'),
					array('class' => 'form-control', 'maxlength' => 60, 'empty' => '-Select-')
				); ?>
				<?php echo $form->error($model, 'user_role'); ?>
			</div><!-- col -->
		</div><!-- row -->
		<div class="row mg-t-20">
			<?php echo CHtml::submitButton('Search', array('class' => 'btn btn-primary btn-block mg-b-10')); ?>
		</div>

	</div>
		<?php $this->endWidget(); ?>

	</div><!-- search-form -->