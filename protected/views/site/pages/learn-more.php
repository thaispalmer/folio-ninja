<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Learn more';
$this->breadcrumbs=array(
	'Learn more',
);
?>
<h1>Learn more</h1>

<p>Here at Folio Ninja, things are easy to use.</p>
<p>Your portfolio is divided by <b>Projects</b> like "Cat love", and they can be organized by <b>Folders</b> like "Photo sessions". Inside each project you can upload images, insert videos (from YouTube and Vimeo) and add external links. Each one with their own description and tags</p>
<p>With that, you can organize your work the way you want! Check some ideas below:</p>
<ul>
    <li>Do you like to draw? Put your "Concept arts", "Quick sketches", "Finished Drawings" and "Comissions" inside your "Drawings" folder.</li>
    <li>If you want to show the websites you've create, you can create different projects for each website, then insert screenshot images and a link to the website. Then, put those projects inside a folder called "Websites I made"</li>
    <li>You can even write poems on a project and then organize them inside a "My beloved poems" folder.</li>
</ul>
<p><b>What are you waiting for? <a href="<?php echo $this->createUrl('/signup'); ?>">Sign up now</a> and try for yourself!</b></p>