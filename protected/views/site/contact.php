<?php
/* @var $this SiteController */
/* @var $model ContactForm */

$this->pageTitle=Yii::app()->name . ' - Contact us';
$this->breadcrumbs=array(
    'Contact us',
);
?>

    <h1>Contact us</h1>

<?php
$this->widget('bootstrap.widgets.TbAlert');
if ($model->hasErrors()) {
    echo TbHtml::errorSummary($model,'<h4>Oh snap!</h4>');
}
?>
    <p>Please fill out the following form to contact us. Fields with <span class="required">*</span> are required.</p>
<?php
echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL);
echo TbHtml::activeTextFieldControlGroup($model, 'name');
echo TbHtml::activeEmailFieldControlGroup($model, 'email');
echo TbHtml::activeTextFieldControlGroup($model, 'subject');
echo TbHtml::activeTextAreaControlGroup($model, 'message', array('rows'=>5));
echo TbHtml::activeTextFieldControlGroup($model, 'verifyCode',
    array(
        'value' => '',
        'controlOptions' => array(
            'before' => $this->widget('CCaptcha', array(
                    'buttonOptions' => array('class' => 'btn-refresh-captcha')
                ),true).'<br/>'
        )
    )
);
Yii::app()->clientScript->registerScript('refresh-captcha',
    '$(document).ready(function(){$(".btn-refresh-captcha").click()});');
echo TbHtml::formActions(array(TbHtml::submitButton('Send your message', array('color' => TbHtml::BUTTON_COLOR_PRIMARY))));
echo TbHtml::endForm();
?>