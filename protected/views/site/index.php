<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<div class="row">
    <div class="span12">
<?php $this->widget('bootstrap.widgets.TbHeroUnit', array(
    'heading' => 'Welcome to <i>'.CHtml::encode(Yii::app()->name).'</i>',
    'content' => '<p>Your perfect choice for online portfolio.</p>' .
        TbHtml::linkButton('Sign up now', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
            'url' => array('/site/signup')
        )) . ' ' .
        TbHtml::linkButton('Learn more', array(
            'color' => TbHtml::BUTTON_COLOR_INVERSE,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
            'url' => array('/site/page', 'view'=>'learn-more')
        ))
)); ?>
    </div>
</div>


<div class="row">
    <div class="span4">
        <h3 class="text-center">It's free!</h3>
        <p class="text-center">You don't need to pay anything to use!</p>
    </div>
    <div class="span4">
        <h3 class="text-center">For your needs</h3>
        <p class="text-center">Organize your portfolio and projects the way you want. Insert videos, pictures and links!</p>
    </div>
    <div class="span4">
        <h3 class="text-center">Customization</h3>
        <p class="text-center">Choose from different layouts to make your portfolio look the way you want. With more customizations to come.</p>
    </div>
</div>
