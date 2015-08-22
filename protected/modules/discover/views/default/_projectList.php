<?php
/* @var $this DefaultController */
/* @var $project Project */
?>
<li>
    <?php if (!empty($project->picture)): ?>
    <div class="picture-thumb">
        <a href="<?php echo $this->createUrl('/'.$project->user->alias.'/project/'.$project->id) ?>">
            <img src="<?php echo Yii::app()->baseUrl . $project->picture->getThumbnailFile(); ?>"/>
        </a>
    </div>
    <?php endif; ?>
    <span class="title">
        <a href="<?php echo $this->createUrl('/'.$project->user->alias.'/project/'.$project->id) ?>">
            <?php echo $project->name; ?>
        </a>
    </span>
    <?php if (!empty($project->description)): ?>
    <p class="description"><?php echo Utilities::limitWords(nl2br($project->description),15); ?></p>
    <?php endif; ?>
    <?php if (!empty($project->tagsPlacements)): ?>
    <ul class="tagList">Tags: <?php $this->renderPartial('_existingTags', array('tags'=>$project->tagsPlacements)) ?></ul>
    <?php endif; ?>
</li>