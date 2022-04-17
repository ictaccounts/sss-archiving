<?php
/* @var $this FileUploadController */
/* @var $model FileUpload */

$this->breadcrumbs=array(
	'File Uploads'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List FileUpload', 'url'=>array('index')),
	array('label'=>'Create FileUpload', 'url'=>array('create')),
	array('label'=>'Update FileUpload', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FileUpload', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FileUpload', 'url'=>array('admin')),
);
?>

<h1>View FileUpload #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'reference',
		'title',
		'path',
		'filename',
		'format',
		'created_by',
		'created_at',
	),
)); ?>
