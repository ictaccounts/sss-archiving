<?php
/* @var $this ThumbnailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Thumbnails',
);

$this->menu=array(
	array('label'=>'Create Thumbnail', 'url'=>array('create')),
	array('label'=>'Manage Thumbnail', 'url'=>array('admin')),
);
?>

<h1>Thumbnails</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
