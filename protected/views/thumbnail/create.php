<?php
/* @var $this ThumbnailController */
/* @var $model Thumbnail */

$this->breadcrumbs=array(
	'Thumbnails'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Thumbnail', 'url'=>array('index')),
	array('label'=>'Manage Thumbnail', 'url'=>array('admin')),
);
?>

<h1>Create Thumbnail</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>