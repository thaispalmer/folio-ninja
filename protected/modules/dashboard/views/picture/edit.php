<?php
/* @var $this ProjectController */
/* @var $model PicturesPerProject */

$this->pageTitle=Yii::app()->name . ' - Dashboard';
$this->breadcrumbs=array(
    'Dashboard' => array('/dashboard'),
    'Project list' => array('/dashboard/projects'),
    $model->project->name => array('/dashboard/project/'.$model->project->id),
    'Edit picture' . ((!empty($model->title)) ? ': '.$model->title : '')
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

        <?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL,null,null,array('enctype' => 'multipart/form-data')); ?>
        <fieldset>
            <legend>Edit picture<?php echo (!empty($model->title)) ? ': '.$model->title : ' '; ?></legend>
            <?php
            echo TbHtml::image(Yii::app()->baseUrl . $model->picture->filename,'',array('class'=>'editProjectPicture'));
            ?>
            <hr/>
            <?php
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