<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>


<?php
/*
$form = new TbForm(array(
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    'elements' => array(
        'textField' => array(
            'name' => 'username',
            'type' => TbHtml::INPUT_TYPE_EMAIL
        ),
        'passwordField' => array(
            'name' => 'password',
            'type' => TbHtml::INPUT_TYPE_PASSWORD
        ),
        'checkbox' => array(
            'type' => TbHtml::INPUT_TYPE_CHECKBOX,
            'label' => 'Remember Me',
            'name' => 'rememberMe'
        )
    ),
    'buttons' => array(
        'submit' => array(
            'type' => TbHtml::BUTTON_TYPE_SUBMIT,
            'label' => 'Submit',
            'attributes' => array('color' => TbHtml::BUTTON_COLOR_PRIMARY),
        ),
    ),
), $model);
*/
?>




<?php

    echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL);
    echo TbHtml::activeEmailFieldControlGroup($model, 'username',
        array('label' => 'Email'));
    echo TbHtml::activePasswordFieldControlGroup($model, 'password',
        array('label' => 'Password'));
    echo TbHtml::activeCheckBoxControlGroup($model,'rememberMe', array(
        'label' => 'Remember me',
        'controlOptions' => array('after' => TbHtml::submitButton('Sign in')),
    ));
    echo TbHtml::endForm();

?>


<!--
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
		</p>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
