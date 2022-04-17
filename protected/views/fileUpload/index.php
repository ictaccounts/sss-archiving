<?php
/* @var $this FileUploadController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'File Uploads',
);

$this->menu=array(
	array('label'=>'Create FileUpload', 'url'=>array('create')),
	array('label'=>'Manage FileUpload', 'url'=>array('admin')),
);
?>

<h1>File Uploads</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
