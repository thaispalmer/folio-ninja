<?php
/* @var $this PictureController */
/* @var $model PicturesPerProject */

$this->pageTitle=Yii::app()->name . ' - Dashboard';
$this->breadcrumbs=array(
    'Dashboard' => array('/dashboard'),
    'Project list' => array('/dashboard/projects'),
    $model->project->name => array('/dashboard/project/'.$model->project->id),
    'Remove picture' . ((!empty($model->title)) ? ': '.$model->title : '')
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
            <legend>Remove Picture<?php echo (!empty($model->title)) ? ': '.$model->title : ' '; ?></legend>
            <?php
            echo TbHtml::image(Yii::app()->baseUrl . $model->picture->filename,'',array('class'=>'editProjectPicture'));
            ?>
            <hr/>
            <p>Are you sure you want to remove the picture above?</p>
            <p><b>This can't be undone!</b></p>
            <input type="hidden" name="remove" value="1"/>
        </fieldset>
        <?php
        echo TbHtml::formActions(array(
            TbHtml::submitButton('Remove', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
            TbHtml::linkButton('Cancel', array(
                'url' => array('/dashboard/project/'.$model->project->id)
            ))
        ));
        echo TbHtml::endForm();
        ?>
    </div>
</div>