<?php
/* @var $this ProjectController */
/* @var $model Folder */

$this->pageTitle=Yii::app()->name . ' - Dashboard';
$this->breadcrumbs=array(
    'Dashboard' => array('/dashboard'),
    'Project list' => array('/dashboard/projects'),
    $model->title
);
?>

<div class="row-fluid">
    <div class="span12">
        <h1><?php echo $model->title; ?></h1>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <?php
        $this->widget('bootstrap.widgets.TbAlert');
        if ($model->hasErrors()) {
            echo TbHtml::errorSummary($model,'<h4>Oh snap!</h4>');
        }
        ?>

        <?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL); ?>
        <fieldset>
            <legend>Remove Folder</legend>
            <p>Are you sure you want to remove the folder <b><?php echo $model->title; ?></b>?</p>
            <p>All the projects contained in this folder will be moved to the root.</p>
            <input type="hidden" name="remove" value="1"/>
        </fieldset>
        <?php
        echo TbHtml::formActions(array(
            TbHtml::submitButton('Remove', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
            TbHtml::linkButton('Cancel', array(
                'url' => array('/dashboard/projects')
            ))
        ));
        echo TbHtml::endForm();
        ?>
    </div>
</div>