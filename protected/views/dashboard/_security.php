<?php
/* @var $this DashboardController */
/* @var $model User */
?>

<div class="span12">
    <?php
    $this->widget('bootstrap.widgets.TbAlert');
    if ($model->hasErrors()) {
        echo TbHtml::errorSummary($model,'<h4>Oh snap!</h4>');
    }
    ?>

    <?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL); ?>
    <fieldset>
        <legend>Change password</legend>
        <?php
        echo TbHtml::activePasswordFieldControlGroup($model, 'currentPassword', array('value'=>''));
        echo TbHtml::activePasswordFieldControlGroup($model, 'newPassword', array(
            'value' => '',
            'help' => 'Only letters and numbers. From 6 to 32 characters.'
        ));
        echo TbHtml::activePasswordFieldControlGroup($model, 'confirmPassword', array('value'=>''));
        ?>
    </fieldset>
    <?php
    echo TbHtml::formActions(array(TbHtml::submitButton('Change password', array('color' => TbHtml::BUTTON_COLOR_PRIMARY))));
    echo TbHtml::endForm();
    ?>
</div>