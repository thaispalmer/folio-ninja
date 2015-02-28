<?php
/* @var $this VideoController */
/* @var $model VideosPerProject */

$this->pageTitle=Yii::app()->name . ' - Dashboard';
$this->breadcrumbs=array(
    'Dashboard' => array('/dashboard'),
    'Project list' => array('/dashboard/projects'),
    $model->project->name => array('/dashboard/project/'.$model->project->id),
    'Edit video' . ((!empty($model->title)) ? ': '.$model->title : '')
);
?>

<div class="row-fluid">
    <div class="span12">
        <h1><?php echo $model->project->name; ?></h1>
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
            <legend>Edit video<?php echo (!empty($model->title)) ? ': '.$model->title : ' '; ?></legend>
            <?php echo $model->renderPlayer(); ?>
            <hr/>
            <?php
            echo TbHtml::activeTextFieldControlGroup($model, 'url', array(
                'help' => 'Only videos from Youtube and Vimeo for now.'
            ));
            echo TbHtml::activeTextFieldControlGroup($model, 'title');
            echo TbHtml::activeTextAreaControlGroup($model, 'description', array('rows'=>5));
            ?>
        </fieldset>
        <?php
        echo TbHtml::formActions(array(
            TbHtml::submitButton('Save', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
            TbHtml::linkButton('Discard changes', array(
                'url' => array('/dashboard/project/'.$model->project->id)
            ))
        ));
        echo TbHtml::endForm();
        ?>
    </div>
</div>