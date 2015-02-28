<?php
/* @var $this DefaultController */
/* @var $model User */
/* @var $projects Project[] */

$this->pageTitle=Yii::app()->name . ' - ' . $model->alias . ' Portfolio';
$this->breadcrumbs=array(
    $model->alias . ' Portfolio'
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
        <h1><?php echo $model->first_name; ?> Portfolio</h1>
    </div>
</div>

<div class="row-fluid">
    <ul id="projectList">
        <?php
        foreach ($model->folders as $folder) {
            $this->renderPartial('_listProjects',array('model'=>$model,'projects'=>$folder->projects,'folder'=>$folder));
        }
        $this->renderPartial('_listProjects',array('model'=>$model,'projects'=>$projects));
        ?>
    </ul>
</div>