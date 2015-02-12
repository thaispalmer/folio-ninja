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
    <?php
    echo TbHtml::formActions(array(TbHtml::submitButton('Update', array('color' => TbHtml::BUTTON_COLOR_PRIMARY))));
    echo TbHtml::endForm();
    ?>
</div>