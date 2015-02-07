<?php
/* @var $this SiteController */
/* @var $model LoginForm */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<?php
    if ($model->hasErrors()) {
        echo TbHtml::errorSummary($model,'<h4>Oh snap!</h4>');
    }
?>

<p>Please fill out the following form with your login credentials:</p>

<?php

    echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL);
    echo TbHtml::activeEmailFieldControlGroup($model, 'email',
        array('label' => 'Email'));
    echo TbHtml::activePasswordFieldControlGroup($model, 'password',
        array('label' => 'Password'));
    echo TbHtml::activeCheckBoxControlGroup($model,'rememberMe', array(
        'label' => 'Remember me',
        'controlOptions' => array('after' => TbHtml::submitButton('Sign in')),
    ));
    //echo TbHtml::formActions(array(TbHtml::submitButton('Sign in', array('color' => TbHtml::BUTTON_COLOR_PRIMARY))));
    echo TbHtml::endForm();

?>