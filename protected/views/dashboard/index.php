<?php
/* @var $this SiteController */
/* @var $model User */

$this->pageTitle=Yii::app()->name . ' - Dashboard';
$this->breadcrumbs=array(
    'Dashboard'
);
?>

<div class="row">
    <div class="span12">
        <h1>Welcome <?php echo Yii::app()->user->firstName; ?></h1>
    </div>
</div>