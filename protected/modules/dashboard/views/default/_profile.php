<?php
/* @var $this DefaultController */
/* @var $model User */
?>

<div class="span12">
    <?php
    $this->widget('bootstrap.widgets.TbAlert');
    if ($model->hasErrors()) {
        echo TbHtml::errorSummary($model,'<h4>Oh snap!</h4>');
    }
    ?>

    <?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL,null,null,array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend>Personal Information</legend>
        <?php
        echo TbHtml::activeTextFieldControlGroup($model, 'first_name');
        echo TbHtml::activeTextFieldControlGroup($model, 'last_name');
        echo TbHtml::activeTextFieldControlGroup($model, 'alias',array(
            'help' => 'Only letters and numbers. From 3 to 32 characters.',
        ));
        echo TbHtml::activeEmailFieldControlGroup($model, 'email');
        ?>
    </fieldset>
    <fieldset>
        <legend>Profile Picture</legend>
        <?php
        if (!empty($model->picture_id)) {
            echo TbHtml::customControlGroup(
                TbHtml::image(Yii::app()->baseUrl.$model->picture->filename,'',array('class'=>'profile-avatar')),
                '', array('label'=>'Current picture')
            );
            echo TbHtml::inlineCheckBoxListControlGroup('removePicture', '', array('1'=>'Remove profile picture'));
        }
        else {
            echo TbHtml::customControlGroup(
                TbHtml::image(Yii::app()->baseUrl.'/images/default-user.png','',array('class'=>'profile-avatar')),
                '', array('label'=>'No profile picture yet.')
            );
        }
        echo TbHtml::activeFileFieldControlGroup($model, 'profilePicture', array(
            'label'=>'Upload picture'
        ));
        ?>
    </fieldset>
    <?php
    echo TbHtml::formActions(array(TbHtml::submitButton('Update', array('color' => TbHtml::BUTTON_COLOR_PRIMARY))));
    echo TbHtml::endForm();
    ?>
</div>