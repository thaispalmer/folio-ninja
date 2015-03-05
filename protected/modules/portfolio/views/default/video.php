<?php
/* @var $this DefaultController */
/* @var $model VideosPerProject */

$this->pageTitle=Yii::app()->name . ' - ' . $model->project->user->alias . ' Portfolio';
$this->breadcrumbs=array(
    $model->project->user->alias . ' Portfolio' => array('/'.$model->project->user->alias),
    $model->project->name => array('/'.$model->project->user->alias.'/project/'.$model->project_id),
    'View video' . ((!empty($model->title)) ? ': '.$model->title : '')
);
?>

<div class="row-fluid">
    <div class="span12">
        <h3><?php echo $model->project->user->first_name; ?> Portfolio</h3>
        <h1><?php echo $model->project->name; ?></h1>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <fieldset>
            <legend><?php echo (!empty($model->title)) ? $model->title : ''; ?></legend>
            <?php echo $model->renderPlayer(); ?>
            <hr/>
            <?php if (!empty($model->title)): ?>
                <h4><?php echo $model->title; ?></h4>
            <?php endif; ?>
            <?php echo nl2br($model->description); ?>
        </fieldset>
    </div>
</div>