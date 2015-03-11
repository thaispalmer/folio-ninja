<?php
/* @var $this DefaultController */
/* @var $model User */

$layoutsArray = array(
    'List'=>'List (default)',
    'Grid'=>'Grid'
);
?>

<div class="span12">
    <?php
    $this->widget('bootstrap.widgets.TbAlert');
    if ($model->hasErrors()) {
        echo TbHtml::errorSummary($model->portfolio,'<h4>Oh snap!</h4>');
    }
    ?>

    <?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL); ?>
    <fieldset>
        <legend>Appearance</legend>
        <?php
        echo TbHtml::activeDropDownListControlGroup($model->portfolio, 'layout', $layoutsArray);
        ?>
    </fieldset>
    <fieldset>
        <legend>Description</legend>
        <?php
        echo TbHtml::activeTextAreaControlGroup($model->portfolio, 'bio', array(
            'label'=>'Tell about yourself',
            'help' => 'Maximum 1000 characters.',
            'rows'=>5
        ));
        ?>
    </fieldset>
    <?php
    echo TbHtml::formActions(array(TbHtml::submitButton('Update', array('color' => TbHtml::BUTTON_COLOR_PRIMARY))));
    echo TbHtml::endForm();
    ?>
</div>