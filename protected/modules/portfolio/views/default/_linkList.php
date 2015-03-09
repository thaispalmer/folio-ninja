<?php
/* @var $this DefaultController */
/* @var $link LinksPerProject */
?>
<li>
    <span class="title">
        <?php echo TbHtml::link((!empty($link->title) ? $link->title : $link->url),$link->url,array(
            'title' => $link->url,
            'target' => '_blank'
        )); ?>
    </span>
    <span class="url"><?php echo $link->url; ?></span>
    <?php if (!empty($link->description)): ?>
        <p class="description"><?php echo nl2br($link->description); ?></p>
        <?php if (!empty($link->tagsPlacements)): ?>
        <ul class="tagList">Tags: <?php $this->renderPartial('_existingTags', array('tags'=>$link->tagsPlacements)) ?></ul>
        <?php endif; ?>
    <?php endif; ?>
</li>