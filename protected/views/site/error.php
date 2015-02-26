<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<p><?php echo CHtml::encode($message); ?></p>
</div>

<?php
    if (AccessLevel::isLogged()) {
        echo TbHtml::linkButton('Go to dashboard', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'url' => array('/dashboard')
        ));
    }
    elseif (AccessLevel::isGuest()) {
        echo TbHtml::linkButton('Go to home', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'url' => array('/')
        ));
    }
?>