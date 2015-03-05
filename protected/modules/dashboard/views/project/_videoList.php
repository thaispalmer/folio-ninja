<?php
/* @var $this ProjectController */
/* @var $video VideosPerProject */
?>
<li>
    <div class="video-thumb">
        <a href="<?php echo $this->createUrl('/'.$video->project->user->alias.'/video/'.$video->id) ?>">
            <img src="<?php echo $video->getThumbnailUrl(); ?>"/>
        </a>
    </div>
    <?php if (!empty($video->title)): ?>
        <span class="title"><?php echo $video->title; ?></span>
    <?php endif; ?>
    <?php if (!empty($video->description)): ?>
        <p class="description"><?php echo Utilities::limitWords(nl2br($video->description),15); ?></p>
    <?php endif; ?>
    <div class="actions">
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
    </div>
</li>