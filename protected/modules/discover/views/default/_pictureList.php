<?php
/* @var $this DefaultController */
/* @var $picture PicturesPerProject */
?>
<li>
    <div class="picture-thumb">
        <a href="<?php echo $this->createUrl('/'.$picture->project->user->alias.'/picture/'.$picture->id) ?>">
            <img src="<?php echo Yii::app()->baseUrl . $picture->picture->getThumbnailFile(); ?>"/>
        </a>
    </div>
    <?php if (!empty($picture->title)): ?>
        <span class="title"><?php echo $picture->title; ?></span>
    <?php endif; ?>
    <?php if (!empty($picture->description)): ?>
        <p class="description"><?php echo Utilities::limitWords(nl2br($picture->description),15); ?></p>
    <?php endif; ?>
    <?php if (!empty($picture->tagsPlacements)): ?>
        <ul class="tagList">Tags: <?php $this->renderPartial('_existingTags', array('tags'=>$picture->tagsPlacements)) ?></ul>
    <?php endif; ?>
</li>