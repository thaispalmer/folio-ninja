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
            'url' => array('signup')
        )) . ' ' .
        TbHtml::linkButton('Learn more', array(
            'color' => TbHtml::BUTTON_COLOR_INVERSE,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
            'url' => array('site/page/view/learn-more')
        ))
)); ?>
    </div>
</div>

<!--
<div class="row">
    <div class="span4">
        <h3 class="text-center">Chamada</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in viverra velit. Pellentesque cursus interdum velit, vel efficitur purus pulvinar vel. Morbi vestibulum metus sapien, ut aliquet erat aliquet in. Aliquam in ex at massa laoreet tristique sit amet quis augue. Praesent ac diam ut nisl fermentum tristique a vel sapien. Curabitur id libero rhoncus, efficitur purus vehicula, eleifend tortor. Nulla facilisi.</p>
    </div>
    <div class="span4">
        <h3 class="text-center">Chamada</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in viverra velit. Pellentesque cursus interdum velit, vel efficitur purus pulvinar vel. Morbi vestibulum metus sapien, ut aliquet erat aliquet in. Aliquam in ex at massa laoreet tristique sit amet quis augue. Praesent ac diam ut nisl fermentum tristique a vel sapien. Curabitur id libero rhoncus, efficitur purus vehicula, eleifend tortor. Nulla facilisi.</p>
    </div>
    <div class="span4">
        <h3 class="text-center">Chamada</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in viverra velit. Pellentesque cursus interdum velit, vel efficitur purus pulvinar vel. Morbi vestibulum metus sapien, ut aliquet erat aliquet in. Aliquam in ex at massa laoreet tristique sit amet quis augue. Praesent ac diam ut nisl fermentum tristique a vel sapien. Curabitur id libero rhoncus, efficitur purus vehicula, eleifend tortor. Nulla facilisi.</p>
    </div>
</div>
-->