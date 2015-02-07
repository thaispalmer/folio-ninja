<?php
/* @var $this SiteController */
/* @var $model User */

$this->pageTitle=Yii::app()->name . ' - Sign up';
$this->breadcrumbs=array(
    'Sign up',
);
?>

<h1>Sign up</h1>

<?php
if ($model->hasErrors()) {
    echo TbHtml::errorSummary($model,'<h4>Oh snap!</h4>');
}
?>

    <p>Please fill out the following form with your information. Fields with <span class="required">*</span> are required.</p>

    <?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL); ?>
    <fieldset>
        <legend>Personal Informations</legend>
    <?php
    echo TbHtml::activeTextFieldControlGroup($model, 'first_name');
    echo TbHtml::activeTextFieldControlGroup($model, 'last_name');
    echo TbHtml::activeTextFieldControlGroup($model, 'alias',array(
        'help' => 'Only letters and numbers. From 3 to 36 characters.',
    ));
    ?>
    </fieldset>
    <fieldset>
        <legend>Credentials</legend>
    <?php
    echo TbHtml::activeEmailFieldControlGroup($model, 'email');
    echo TbHtml::activePasswordFieldControlGroup($model, 'password', array('value'=>''));
    echo TbHtml::activePasswordFieldControlGroup($model, 'confirmPassword', array('value'=>''));
    ?>
    </fieldset>
    <br/>
    <?php
    echo TbHtml::activeTextFieldControlGroup($model, 'verifyCode',
        array('controlOptions'=>array(
            'before' => $this->widget('CCaptcha', array(),true).'<br/>'
        ))
    );
    echo TbHtml::formActions(array(TbHtml::submitButton('Sign up', array('color' => TbHtml::BUTTON_COLOR_PRIMARY))));
    ?>
    <?php echo TbHtml::endForm(); ?>