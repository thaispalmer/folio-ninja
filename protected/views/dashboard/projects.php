<?php
/* @var $this DashboardController */
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
            array('label' => 'Add new project', 'url' => array('/dashboard/project/add'))
        )); ?>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <?php

        $projectList = Array();
        foreach($projects as $project) {
            array_push($projectList,array(
                'image' => $project->picture->filename,
                'heading' => $project->name,
                'content' => $project->description . '<br/>' .
                    TbHtml::splitButtonDropdown('Actions',array(
                        'Edit' => array('/dashboard/project',array('edit'=>$project->id)),
                        'Remove' => array('/dashboard/project',array('remove'=>$project->id))
                    )),
            ));
        }

        echo TbHtml::mediaList($projectList);

        ?>
    </div>
</div>