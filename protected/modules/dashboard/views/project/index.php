<?php
/* @var $this ProjectController */
/* @var $projects Project[] */
/* @var $folders Folder[] */

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
    <ul id="projectList">
        <?php
        foreach ($folders as $folder) {
            $this->renderPartial('_listProjects',array('projects'=>$folder->projects,'folder'=>$folder));
        }
        $this->renderPartial('_listProjects',array('projects'=>$projects));
        ?>
    </ul>
</div>