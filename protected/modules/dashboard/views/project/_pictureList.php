<?php
/* @var $this ProjectController */
/* @var $picture PicturesPerProject */
?>
<li>
    <?php
    echo TbHtml::imagePolaroid(Yii::app()->baseUrl . $picture->picture->getThumbnailFile());
    ?>
    <b><?php echo $picture->title; ?></b>
    <p><?php echo nl2br($picture->description); ?></p>
    <?php
    echo TbHtml::buttonGroup(array(
        array(
            'icon'=>'pencil',
            'url' => array('/dashboard/picture/'.$picture->id.'/edit'),
            'size' => TbHtml::BUTTON_SIZE_MINI
        ),
        array(
            'icon'=>'trash',
            'url' => array('/dashboard/picture/'.$picture->id.'/delete'),
            'size' => TbHtml::BUTTON_SIZE_MINI
        )
    ));
    ?>
</li>