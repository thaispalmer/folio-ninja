<?php
/* @var $this DashboardController */
/* @var $model User */
/* @var $page string View */

$this->pageTitle=Yii::app()->name . ' - Dashboard';
$this->breadcrumbs=array(
    'Dashboard' => array('/dashboard'),
    'Account Settings'
);
?>

<div class="row-fluid">
    <div class="span12">
        <h1>Account Settings</h1>
        <?php echo TbHtml::tabs(array(
            array('label' => 'Profile', 'url' => array('/dashboard/settings/profile'), 'active' => ($page == 'profile') ? true : false),
            array('label' => 'Security', 'url' => array('/dashboard/settings/security'), 'active' => ($page == 'security') ? true : false)
        )); ?>
    </div>
</div>

<div class="row-fluid">
    <?php $this->renderPartial('_'.$page,array('model'=>$model)); ?>
</div>