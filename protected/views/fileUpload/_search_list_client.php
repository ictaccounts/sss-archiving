<?php
/* @var $this FileUploadController */
/* @var $model FileUpload */
/* @var $form CActiveForm */
?>

<div class="wide form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
	)); ?>
	<label class="section-label">Search Form and Filtering</label>
	<br>

	<div class="row">
		<div class="col-lg">
			<label class="section-title">Title</label>
			<?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
			<?php echo $form->error($model, 'title'); ?>
		</div><!-- col -->
		<div class="col-lg mg-t-10 mg-lg-t-0">
			<label class="section-title">Tags</label>
			<?php echo $form->textField($model, 'tags', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>
			<?php echo $form->error($model, 'tags'); ?>
		</div><!-- col -->
		<div class="col-lg mg-t-10 mg-lg-t-0">
			<label class="section-title">Category</label>
			<?php echo $form->dropDownList(
				$model,
				'filecategory',
				array('1' => 'Documents', '2' => 'Image', '3' => 'Video', '4' => 'Sound'),
				array('class' => 'form-control', 'empty' => '-Select-')
			); ?>
		</div><!-- col -->
		<div class="col-lg mg-t-10 mg-lg-t-0">
			<label class="section-title">Date From</label>
			<?php echo $form->dateField($model, 'datetranfrom', array('class' => 'form-control')); ?>
		</div><!-- col -->
		<div class="col-lg mg-t-10 mg-lg-t-0">
			<label class="section-title">Date To</label>
			<?php echo $form->dateField($model, 'datetranto', array('class' => 'form-control')); ?>
		</div><!-- col -->

	</div><!-- row -->


	<div class="row mg-t-20">
		<div class="col-lg-10">
		</div>
		<div class="col-lg-2">
			<?php echo CHtml::submitButton('Search', array('class' => 'btn btn-primary btn-sm btn-block mg-b-10')); ?>
		</div>
	</div>
	</div>
	<?php $this->endWidget(); ?>

</div>