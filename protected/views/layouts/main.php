<?php
/* @var $this Controller */

Yii::app()->bootstrap->register();

if (Yii::app()->user->isGuest) {
    $rightMenu = array(
        TbHtml::navbarMenuDivider(),
        array('label' => 'Login', 'url' => array('/login'))
    );
}
else {
    $rightMenu = array(
        TbHtml::navbarMenuDivider(),
        '<li style="float: left">'.TbHtml::imageCircle('http://i.imgur.com/ghnHeMJ.png','',array(
            'style' => 'height: 30px; width: 30px; margin-top: 5px; float: left',
            'class' => 'visible-desktop'
        )).'</li>',
        array('label' => Yii::app()->user->firstName, 'items' => array(
            array('label' => 'Logout', 'url' => array('/logout'))
        ))
    );
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="language" content="en">
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/site.css"/>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>

<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'color' => TbHtml::NAVBAR_COLOR_INVERSE,
    'brandLabel' => CHtml::encode(Yii::app()->name),
    'display' => TbHtml::NAVBAR_DISPLAY_STATICTOP,
    'collapse' => true,
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.TbNav',
            'items' => array(
                array('label' => 'Home', 'url' => array('/site/index')),
                array('label' => 'About', 'url' => array('/site/page', 'view'=>'about'))
            )
        ),
        array(
            'class' => 'bootstrap.widgets.TbNav',
            'items' => $rightMenu,
            'htmlOptions' => array(
                'class' => 'pull-right'
            )
        )
    )
)); ?>

<div class="container" id="page">
    <?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => $this->breadcrumbs,
    )); ?>

	<?php echo $content; ?>

</div>

<footer>
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::app()->name,' ',date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

</body>
</html>
