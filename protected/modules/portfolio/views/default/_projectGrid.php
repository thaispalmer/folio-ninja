<?php
/* @var $this DefaultController */
/* @var $user User */
/* @var $project Project */
?>

<li class="project-item">
    <a href="<?php echo $this->createUrl('/'.$user->alias.'/project/'.$project->id) ?>">
        <?php echo $project->name; ?>
        <span class="bottom">
            <span class="item"><?php echo TbHtml::icon(TbHtml::ICON_PICTURE) . ' ' . count($project->picturesPerProjects); ?></span>
            <span class="item"><?php echo TbHtml::icon(TbHtml::ICON_FILM) . ' ' . count($project->videosPerProjects); ?></span>
            <span class="item"><?php echo TbHtml::icon(TbHtml::ICON_GLOBE) . ' ' . count($project->linksPerProjects); ?></span>
        </span>
    </a>
</li>