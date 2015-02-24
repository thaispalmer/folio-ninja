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
            <legend>Edit Folder Information</legend>
            <?php echo TbHtml::activeTextFieldControlGroup($model, 'title'); ?>
        </fieldset>
        <?php
        echo TbHtml::formActions(array(
            TbHtml::submitButton('Save', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
            TbHtml::linkButton('Discard changes', array(
                'url' => array('/dashboard/projects')
            ))
        ));
        echo TbHtml::endForm();
        ?>
    </div>
</div>