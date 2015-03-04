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

<?php if ($model->portfolio->layout == 'List'): ?>
<div class="row-fluid">
    <ul id="projectList">
        <?php
        foreach ($model->folders as $folder) {
            $this->renderPartial('_listProjects',array('user'=>$model,'projects'=>$folder->projects,'folder'=>$folder));
        }
        $this->renderPartial('_listProjects',array('user'=>$model,'projects'=>$projects));
        ?>
    </ul>
</div>
<?php elseif ($model->portfolio->layout == 'Grid'): ?>
<div class="row-fluid">
    <ul id="projectGrid">
        <?php
        foreach ($model->folders as $folder)
            $this->renderPartial('_folderGrid',array('user'=>$model,'folder'=>$folder));

        foreach ($projects as $project)
            $this->renderPartial('_projectGrid',array('user'=>$model,'project'=>$project));
        ?>
    </ul>
</div>
<?php endif; ?>