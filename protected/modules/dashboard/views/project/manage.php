<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->pageTitle=Yii::app()->name . ' - Dashboard';
$this->breadcrumbs=array(
    'Dashboard' => array('/dashboard'),
    'Project list' => array('/dashboard/projects'),
    $model->name
);
?>

<div class="row-fluid">
    <div class="span12">
        <h1><?php echo $model->name; ?></h1>
        <?php echo TbHtml::tabs(array(
            array('label' => 'Manage project', 'url' => array('/dashboard/project/'.$model->id), 'active' => true),
            array('label' => 'Project information', 'url' => array('/dashboard/project/'.$model->id.'/edit'))
        )); ?>
    </div>
</div>