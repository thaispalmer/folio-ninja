<?php
/* @var $this DefaultController */
/* @var $picture PicturesPerProject */
?>
<li>
    <?php
    echo TbHtml::imagePolaroid(Yii::app()->baseUrl . $picture->picture->getThumbnailFile());
    ?>
    <b><?php echo $picture->title; ?></b>
    <?php
    echo TbHtml::buttonGroup(array(
        array(
            'label' => 'View',
            'url' => array('/'.$picture->project->user->alias.'/picture/'.$picture->id),
            'size' => TbHtml::BUTTON_SIZE_MINI
        )
    ));
    ?>
</li>