<?php
/* @var $this ThumbnailController */
/* @var $model Thumbnail */

$this->breadcrumbs=array(
	'Thumbnails'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Thumbnail', 'url'=>array('index')),
	array('label'=>'Create Thumbnail', 'url'=>array('create')),
	array('label'=>'Update Thumbnail', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Thumbnail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Thumbnail', 'url'=>array('admin')),
);
?>

<h1>View Thumbnail #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'file_id',
		'path',
		'filename',
	),
)); ?>
