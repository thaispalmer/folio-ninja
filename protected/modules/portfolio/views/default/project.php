<?php
/* @var $this DefaultController */
/* @var $model Project */

$this->pageTitle=Yii::app()->name . ' - ' . $model->user->alias . ' Portfolio';
$this->breadcrumbs=array(
    $model->user->alias . ' Portfolio' => array('/'.$model->user->alias),
    $model->name
);
$this->user=$model->user;
?>

<div class="row-fluid">
    <div class="span12">
        <h3><?php echo $model->user->alias; ?> Portfolio</h3>
        <h1><?php echo $model->name; ?></h1>
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
            <ul class="tagList"><?php $this->renderPartial('_existingTags', array('tags'=>$model->tagsPlacements)) ?></ul>
        </div>
    </div>
<?php endif; ?>

<?php if (!empty($model->picturesPerProjects)): ?>
<div class="row-fluid">
    <div class="span12">
        <h3>Pictures</h3>
        <ul class="pictureList">
            <?php
            foreach ($model->picturesPerProjects as $picture) {
                $this->renderPartial('_pictureList',array('picture'=>$picture));
            }
            ?>
        </ul>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($model->videosPerProjects)): ?>
<div class="row-fluid">
    <div class="span12">
        <h3>Videos</h3>
        <ul class="videoList">
            <?php
            foreach ($model->videosPerProjects as $video) {
                $this->renderPartial('_videoList',array('video'=>$video));
            }
            ?>
        </ul>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($model->linksPerProjects)): ?>
<div class="row-fluid">
    <div class="span12">
        <h3>Links</h3>
        <ul class="linkList">
            <?php
            foreach ($model->linksPerProjects as $link) {
                $this->renderPartial('_linkList',array('link'=>$link));
            }
            ?>
        </ul>
    </div>
</div>
<?php endif; ?>

<?php if (empty($model->picturesPerProjects) && empty($model->videosPerProjects) && empty($model->linksPerProjects)): ?>
<div class="row-fluid">
    <div class="span12">
        <p>No items yet.</p>
    </div>
</div>
<?php endif; ?>