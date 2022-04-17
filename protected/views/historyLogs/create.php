<?php
/* @var $this HistoryLogsController */
/* @var $model HistoryLogs */

$this->breadcrumbs=array(
	'History Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HistoryLogs', 'url'=>array('index')),
	array('label'=>'Manage HistoryLogs', 'url'=>array('admin')),
);
?>

<h1>Create HistoryLogs</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>