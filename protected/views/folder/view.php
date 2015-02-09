<?php
/* @var $this FolderController */
/* @var $model Folder */

$this->breadcrumbs=array(
	'Folders'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Folder', 'url'=>array('index')),
	array('label'=>'Create Folder', 'url'=>array('create')),
	array('label'=>'Update Folder', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Folder', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Folder', 'url'=>array('admin')),
);
?>

<h1>View Folder #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'user_id',
		'team_id',
	),
)); ?>
