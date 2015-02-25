<?php
/* @var $this DefaultController */
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

<div class="row">
    <div class="span4">
        <h4>You have on your portfolio:</h4>
        <p><?php echo count($model->projects) . ((count($model->projects) == 1) ? ' project' : ' projects'); ?> and
        <?php echo count($model->folders) . ((count($model->folders) == 1) ? ' folder' : ' folders'); ?>.</p>
        <?php echo TbHtml::linkButton('Manage now', array(
            'url' => array('/dashboard/projects'),
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
        )); ?>
    </div>
    <div class="span4">
        <h4>Your plan:</h4>
        Beta
    </div>
</div>