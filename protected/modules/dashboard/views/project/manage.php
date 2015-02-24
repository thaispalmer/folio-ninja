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
        <?php $this->widget('bootstrap.widgets.TbAlert'); ?>
        <?php echo TbHtml::tabs(array(
            array('label' => 'Manage project', 'url' => array('/dashboard/project/'.$model->id), 'active' => true),
            array('label' => 'Project information', 'url' => array('/dashboard/project/'.$model->id.'/edit'))
        )); ?>
    </div>
</div>

<div class="row-fluid">
    <div class="span4">
        <?php echo TbHtml::button('Add a picture', array(
            'url' => array('/dashboard/project/'.$model->id.'/add/picture'),
            'size' => TbHtml::BUTTON_SIZE_LARGE,
            'color' => TbHtml::BUTTON_COLOR_LINK,
            'style' => 'width: 100%'
        )); ?>
    </div>
    <div class="span4">
        <?php echo TbHtml::button('Add a video', array(
            'url' => array('/dashboard/project/'.$model->id.'/add/video'),
            'size' => TbHtml::BUTTON_SIZE_LARGE,
            'color' => TbHtml::BUTTON_COLOR_LINK,
            'style' => 'width: 100%'
        )); ?>
    </div>
    <div class="span4">
        <?php echo TbHtml::button('Add a link', array(
            'url' => array('/dashboard/project/'.$model->id.'/add/link'),
            'size' => TbHtml::BUTTON_SIZE_LARGE,
            'color' => TbHtml::BUTTON_COLOR_LINK,
            'style' => 'width: 100%'
        )); ?>
    </div>
</div>

<hr/>

<div class="row-fluid">
    <div class="span12">
        <h2>Pictures</h2>
        <ul class="pictureList">
            <?php
            if (empty($model->picturesPerProjects)) echo 'No pictures yet.';
            else foreach ($model->picturesPerProjects as $picture) {
                $this->renderPartial('_pictureList',array('picture'=>$picture));
            }
            ?>
        </ul>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <h2>Videos</h2>
        <ul class="videoList">
            <?php
            if (empty($model->videosPerProjects)) echo 'No videos yet.';
            else foreach ($model->videosPerProjects as $video) {
                $this->renderPartial('_videoList',array('video'=>$video));
            }
            ?>
        </ul>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <h2>Links</h2>
        <ul class="List">
            <?php
            if (empty($model->linksPerProjects)) echo 'No links yet.';
            else foreach ($model->linksPerProjects as $link) {
                $this->renderPartial('_linkList',array('link'=>$link));
            }
            ?>
        </ul>
    </div>
</div>