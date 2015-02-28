<?php
/* @var $this DefaultController */
/* @var $link LinksPerProject */
?>
<li>
    <b><?php echo TbHtml::link((!empty($link->title) ? $link->title : $link->url),$link->url,array(
            'title' => $link->url,
            'target' => '_blank'
        )); ?></b>
    <?php if (!empty($link->description)): ?>
    <p><?php echo nl2br($link->description); ?></p>
    <?php endif; ?>
</li>