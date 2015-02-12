<?php
/* @var $this ProjectController */
/* @var $projects Project[] */

$this->pageTitle=Yii::app()->name . ' - Dashboard';
$this->breadcrumbs=array(
    'Dashboard' => array('/dashboard'),
    'Project list'
);
?>

<div class="row-fluid">
    <div class="span12">
        <h1>Project List</h1>
        <?php echo TbHtml::tabs(array(
            array('label' => 'Manage projects', 'url' => array('/dashboard/projects'), 'active' => true),
            array('label' => 'Add new project', 'url' => array('/dashboard/project/create'))
        )); ?>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <?php

        $projectList = Array();
        foreach($projects as $project) {
            array_push($projectList,array(
                'image' => (!empty($project->picture->filename)) ? $project->picture->filename : '',
                'heading' => $project->name,
                'content' => $project->description . '<br/>' .
                    TbHtml::buttonGroup(array(
                        array('label'=>'Edit', 'url'=>array('/dashboard/project/edit/'.$project->id)),
                        array('label'=>'Remove', 'url'=>array('/dashboard/project/delete/'.$project->id))
                    )),
            ));
        }

        echo TbHtml::mediaList($projectList);

        ?>
    </div>
</div>