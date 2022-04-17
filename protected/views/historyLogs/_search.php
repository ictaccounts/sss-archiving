<?php
/* @var $this HistoryLogsController */
/* @var $model HistoryLogs */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form = $this->beginWidget('CActiveForm', [
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
]); ?>

<div class="section-wrapper">

	<div class="row">
		<div class="col-lg">
			<label class="section-title">Logs</label>
			<?php echo $form->textField($model, 'logs', ['size' => 60, 'maxlength' => 255, 'class' => 'form-control']); ?>
			<?php echo $form->error($model, 'logs'); ?>
		</div><!-- col -->
		<div class="col-lg">
			<label class="section-title">Log Date From</label>
			<?php echo $form->dateField($model, 'from', ['class' => 'form-control']); ?>
		</div><!-- col -->
		<div class="col-lg">
			<label class="section-title">Log Date To</label>
			<?php echo $form->dateField($model, 'to', ['class' => 'form-control']); ?>
		</div><!-- col -->
	</div><!-- row -->
	<div class="row mg-t-20">
			<?php echo CHtml::submitButton('Search', ['class' => 'btn btn-primary btn-block mg-b-10']); ?>
		</div>
</div>
	


<?php $this->endWidget(); ?>

</div><!-- search-form -->