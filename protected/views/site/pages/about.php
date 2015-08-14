<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>About</h1>

<h4>Folio Ninja is an online portfolio service to suit your needs when you want to show your work to others.</h4>

<div class="row">
    <div class="span7">
        <p>Hi, my name is Athos and I'm a Graphic Designer and a <i>[hobbyist]</i> Programmer.</p>
        <p>This project started when I needed to make my portfolio, but I wasn't quite satisfied with some platforms around on the internet. At the same time, I wasn't in the mood to create just a nice website, I wanted to make something for the community. That's when creating Folio Ninja came to my mind.</p>
        <p>In early 2015 I developed a beta version of the platform and then showed to my friends that liked the idea. Now I decided to make it public and I really hope you like it.</p>
        <p><b>So.. Why don't you join us and <a href="<?php echo $this->createUrl('/signup'); ?>">Sign up now</a>?</b></p>
    </div>
</div>
