<?php
/* @var $this ThumbnailController */
/* @var $model Thumbnail */

$this->breadcrumbs=array(
	'Thumbnails'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Thumbnail', 'url'=>array('index')),
	array('label'=>'Create Thumbnail', 'url'=>array('create')),
	array('label'=>'View Thumbnail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Thumbnail', 'url'=>array('admin')),
);
?>

<h1>Update Thumbnail <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>