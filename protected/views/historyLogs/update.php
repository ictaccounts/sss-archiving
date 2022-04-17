<?php
/* @var $this HistoryLogsController */
/* @var $model HistoryLogs */

$this->breadcrumbs=array(
	'History Logs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List HistoryLogs', 'url'=>array('index')),
	array('label'=>'Create HistoryLogs', 'url'=>array('create')),
	array('label'=>'View HistoryLogs', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage HistoryLogs', 'url'=>array('admin')),
);
?>

<h1>Update HistoryLogs <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>