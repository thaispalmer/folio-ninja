<?php
/* @var $this SiteController */
/* @var $model User */

$this->pageTitle=Yii::app()->name . ' - Dashboard';
$this->breadcrumbs=array(
    'Dashboard'
);
/*
$this->menu=array(
    array('label'=>'List User', 'url'=>array('index')),
    array('label'=>'Manage User', 'url'=>array('admin')),
);
*/
?>

<div class="row">
    <div class="span12">
        <h1>Welcome <?php echo Yii::app()->user->firstName; ?></h1>
    </div>
</div>