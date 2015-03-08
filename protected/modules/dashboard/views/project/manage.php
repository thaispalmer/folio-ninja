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

<div class="row-fluid projectControls">
    <div class="span4">
        <?php echo TbHtml::linkButton('Add a picture', array(
            'url' => array('/dashboard/picture/add/'.$model->id),
            'size' => TbHtml::BUTTON_SIZE_LARGE,
            'color' => TbHtml::BUTTON_COLOR_LINK,
            'class' => 'projectActions'
        )); ?>
    </div>
    <div class="span4">
        <?php echo TbHtml::linkButton('Add a video', array(
            'url' => array('/dashboard/video/add/'.$model->id),
            'size' => TbHtml::BUTTON_SIZE_LARGE,
            'color' => TbHtml::BUTTON_COLOR_LINK,
            'class' => 'projectActions'
        )); ?>
    </div>
    <div class="span4">
        <?php echo TbHtml::linkButton('Add a link', array(
            'url' => array('/dashboard/link/add/'.$model->id),
            'size' => TbHtml::BUTTON_SIZE_LARGE,
            'color' => TbHtml::BUTTON_COLOR_LINK,
            'class' => 'projectActions'
        )); ?>
    </div>
</div>

<hr/>

<?php if (!empty($model->description)): ?>
<div class="row-fluid">
    <div class="span12">
        <h4>Description</h4>
        <p>
            <?php echo nl2br($model->description); ?>
        </p>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($model->tagsPlacements)): ?>
    <div class="row-fluid">
        <div class="span12">
            <h4>Tags for this project</h4>
            <ul id="tagList"><?php $this->renderPartial('_existingTags', array('tags'=>$model->tagsPlacements)) ?></ul>
        </div>
    </div>
<?php endif; ?>

<div class="row-fluid">
    <div class="span12">
        <h3>Pictures</h3>
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
        <h3>Videos</h3>
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
        <h3>Links</h3>
        <ul class="linkList">
            <?php
            if (empty($model->linksPerProjects)) echo 'No links yet.';
            else foreach ($model->linksPerProjects as $link) {
                $this->renderPartial('_linkList',array('link'=>$link));
            }
            ?>
        </ul>
    </div>
</div>