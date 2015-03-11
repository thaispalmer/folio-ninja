<?php
/* @var $this DefaultController */
/* @var $model Folder */

$this->pageTitle=Yii::app()->name . ' - ' . $model->user->alias . ' Portfolio';
$this->breadcrumbs=array(
    $model->user->alias . ' Portfolio' => array('/'.$model->user->alias),
    $model->title
);
$this->user=$model->user;
?>

<div class="row-fluid">
    <div class="span12">
        <h3><?php echo $model->user->alias; ?> Portfolio</h3>
        <h1><?php echo $model->title; ?></h1>
    </div>
</div>

<?php if ($model->user->portfolio->layout == 'List'): ?>
<div class="row-fluid">
    <ul id="projectList">
        <?php
        $this->renderPartial('_listProjects',array('user'=>$model->user,'projects'=>$model->projects));
        ?>
    </ul>
</div>
<?php elseif ($model->user->portfolio->layout == 'Grid'): ?>
<div class="row-fluid">
    <ul id="projectGrid">
        <li class="folder-item">
            <a href="<?php echo $this->createUrl('/'.$model->user->alias) ?>">

                <span class="bottom">
                    Go back
                </span>
            </a>
        </li>
        <?php
        foreach ($model->projects as $project)
            $this->renderPartial('_projectGrid',array('user'=>$model->user,'project'=>$project));
        ?>
    </ul>
</div>
<?php endif; ?>