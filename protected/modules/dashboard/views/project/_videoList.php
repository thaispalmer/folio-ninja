<?php
/* @var $this ProjectController */
/* @var $video VideosPerProject */
?>
<li>
    <?php
    echo TbHtml::imagePolaroid($video->getThumbnailUrl());
    ?>
    <b><?php echo $video->title; ?></b>
    <p><?php echo nl2br($video->description); ?></p>
    <?php
    echo TbHtml::buttonGroup(array(
        array(
            'icon'=>'pencil',
            'title'=>'Edit video',
            'url' => array('/dashboard/video/'.$video->id.'/edit'),
            'size' => TbHtml::BUTTON_SIZE_MINI
        ),
        array(
            'icon'=>'trash',
            'title'=>'Remove video',
            'url' => array('/dashboard/video/'.$video->id.'/delete'),
            'size' => TbHtml::BUTTON_SIZE_MINI
        )
    ));
    ?>
</li>