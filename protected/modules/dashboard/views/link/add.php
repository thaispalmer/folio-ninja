<?php
/* @var $this LinkController */
/* @var $model LinksPerProject */
/* @var $project Project */

$this->pageTitle=Yii::app()->name . ' - Dashboard';
$this->breadcrumbs=array(
    'Dashboard' => array('/dashboard'),
    'Project list' => array('/dashboard/projects'),
    $project->name => array('/dashboard/project/'.$project->id),
    'Add new link'
);
?>

<div class="row-fluid">
    <div class="span12">
        <h1><?php echo $project->name; ?></h1>
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
            <legend>Add new link</legend>
            <?php
            echo TbHtml::activeTextFieldControlGroup($model, 'title');
            echo TbHtml::activeTextFieldControlGroup($model, 'url');
            echo TbHtml::activeTextAreaControlGroup($model, 'description', array('rows'=>5));
            ?>
        </fieldset>
        <?php
        echo TbHtml::formActions(array(
            TbHtml::submitButton('Add new link', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
            TbHtml::linkButton('Cancel', array(
                'url' => array('/dashboard/project/'.$project->id)
            ))
        ));
        echo TbHtml::endForm();
        ?>
    </div>
</div>