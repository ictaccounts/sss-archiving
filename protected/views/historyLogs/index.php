<?php
/* @var $this HistoryLogsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'History Logs',
);

$this->menu=array(
	array('label'=>'Create HistoryLogs', 'url'=>array('create')),
	array('label'=>'Manage HistoryLogs', 'url'=>array('admin')),
);
?>

<h1>History Logs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
