<?php
/* @var $this HistoryLogsController */
/* @var $model HistoryLogs */

$this->breadcrumbs=array(
	'History Logs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List HistoryLogs', 'url'=>array('index')),
	array('label'=>'Create HistoryLogs', 'url'=>array('create')),
	array('label'=>'Update HistoryLogs', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete HistoryLogs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HistoryLogs', 'url'=>array('admin')),
);
?>

<h1>View HistoryLogs #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'logs',
		'created_by',
		'created_at',
	),
)); ?>
