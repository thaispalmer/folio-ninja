<?php
/* @var $this DefaultController */
/* @var $video VideosPerProject */
?>
<li>
    <?php
    echo TbHtml::imagePolaroid($video->getThumbnailUrl());
    ?>
    <b><?php echo $video->title; ?></b>
    <?php
    echo TbHtml::buttonGroup(array(
        array(
            'label'=>'View',
            'url' => array('/'.$video->project->user->alias.'/video/'.$video->id),
            'size' => TbHtml::BUTTON_SIZE_MINI
        )
    ));
    ?>
</li>