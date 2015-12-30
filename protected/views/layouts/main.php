<?php
/* @var $this Controller */

Yii::app()->bootstrap->register();

if (Yii::app()->user->isGuest) {
    $leftMenu = array(
        array('label' => 'Home', 'url' => array('/site/index')),
        array('label' => 'About', 'url' => array('/site/page', 'view'=>'about')),
        array('label' => 'Discover', 'url' => array('/discover')),
        array('label' => 'Contact us', 'url' => array('/site/contact'))
    );
    $rightMenu = array(
        // TbHtml::navbarSearchForm(array('/discover/default/index'), 'GET'),
        TbHtml::navbarMenuDivider(),
        array('label' => 'Log in', 'url' => array('/site/login')),
        array('label' => 'Sign up', 'url' => array('/site/signup'))
    );
}
else {
    $leftMenu = array(
        array('label' => 'Dashboard', 'url' => array('/dashboard/default/index')),
        array('label' => 'My Projects', 'url' => array('/dashboard/project/index')),
        array('label' => 'Discover', 'url' => array('/discover')),
        array('label' => 'Contact us', 'url' => array('/site/contact'))
    );
    $rightMenu = array(
        // TbHtml::navbarSearchForm(array('/discover/default/index'), 'GET'),
        TbHtml::navbarMenuDivider(),
        array(
            'label' => TbHtml::imageCircle(Yii::app()->user->profilePicture,'',array(
                    'style' => 'height: 30px; width: 30px; margin: -5px 10px 0 0; float: left'
                )).Yii::app()->user->firstName,
            'items' => array(
                array('label' => TbHtml::icon(TbHtml::ICON_USER).' Account settings', 'url' => array('/dashboard/default/settings/')),
                array('label' => TbHtml::icon(TbHtml::ICON_BOOK).' View Portfolio', 'url' => array('/'.Yii::app()->user->alias)),
                ((Yii::app()->user->level == 'Admin') ? array('label' => TbHtml::icon(TbHtml::ICON_WRENCH).' Admin Area', 'url' => array('/admin')) : ''),
                TbHtml::menuDivider(),
                array('label' => 'Logout ('.Yii::app()->user->alias.')', 'url' => array('/logout'))
            )
        )
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
<!-- Hotjar Tracking Code for http://folio.ninja -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:126803,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>
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
            'items' => $leftMenu
        ),
        array(
            'class' => 'bootstrap.widgets.TbNav',
            'items' => $rightMenu,
            'encodeLabel' => false,
            'htmlOptions' => array(
                'class' => 'pull-right'
            )
        )
    )
)); ?>

<div class="container" id="page">
    <?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => $this->breadcrumbs,
        'encodeLabel' => false
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
