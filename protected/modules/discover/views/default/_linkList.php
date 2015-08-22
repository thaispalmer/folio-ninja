<?php
/* @var $this DefaultController */
/* @var $link LinksPerProject */
?>
<li>
    <span class="project"><?php echo $link->project->name; ?></span>
    <span class="title">
        <?php echo TbHtml::link((!empty($link->title) ? $link->title : $link->url),$link->url,array(
            'title' => $link->url,
            'target' => '_blank'
        )); ?>
    </span>
    <span class="url"><?php echo $link->url; ?></span>
    <?php if (!empty($link->description)): ?>
        <p class="description"><?php echo Utilities::limitWords(nl2br($link->description),15); ?></p>
    <?php endif; ?>
    <?php if (!empty($link->tagsPlacements)): ?>
        <ul class="tagList">Tags: <?php $this->renderPartial('_existingTags', array('tags'=>$link->tagsPlacements)) ?></ul>
    <?php endif; ?>
    <div class="actions portfolio">
        <?php
        echo TbHtml::buttonGroup(array(
            array(
                'label'=>'View Project',
                'url' => array('/'.$link->project->user->alias.'/project/'.$link->project->id),
                'size' => TbHtml::BUTTON_SIZE_MINI
            )
        ));
        ?>
    </div>
</li>