<?php
/* @var $this ProjectController */
/* @var $picture PicturesPerProject */
?>
<li>
    <div class="picture-thumb">
        <img src="<?php echo Yii::app()->baseUrl . $picture->picture->getThumbnailFile(); ?>"/>
    </div>
    <?php if (!empty($picture->title)): ?>
    <span class="title"><?php echo $picture->title; ?></span>
    <?php endif; ?>
    <?php if (!empty($picture->description)): ?>
    <p class="description"><?php echo nl2br($picture->description); ?></p>
    <?php endif; ?>
    <div class="actions">
        <?php
        echo TbHtml::buttonGroup(array(
            array(
                'icon'=>'pencil',
                'title'=>'Edit picture',
                'url' => array('/dashboard/picture/'.$picture->id.'/edit'),
                'size' => TbHtml::BUTTON_SIZE_MINI
            ),
            array(
                'icon'=>'trash',
                'title'=>'Remove picture',
                'url' => array('/dashboard/picture/'.$picture->id.'/delete'),
                'size' => TbHtml::BUTTON_SIZE_MINI
            )
        ));
        ?>
    </div>
</li>