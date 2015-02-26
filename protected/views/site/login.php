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
    $this->widget('bootstrap.widgets.TbAlert');
    if ($model->hasErrors()) {
        echo TbHtml::errorSummary($model,'<h4>Oh snap!</h4>');
    }
?>

<p>Please fill out the following form with your login credentials:</p>

<?php

    echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL);
    echo TbHtml::activeTextFieldControlGroup($model, 'emailOrAlias',
        array('label' => 'Email or Alias'));
    echo TbHtml::activePasswordFieldControlGroup($model, 'password', array(
        'value' => '',
        'label' => 'Password',
    ));
    echo TbHtml::activeCheckBoxControlGroup($model,'rememberMe', array(
        'label' => 'Remember me',
        'controlOptions' => array('after' => TbHtml::submitButton('Sign in')),
    ));
    echo TbHtml::endForm();

?>