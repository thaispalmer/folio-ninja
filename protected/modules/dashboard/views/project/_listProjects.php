<?php
/* @var $this ProjectController */
/* @var $projects Project[] */
/* @var $folder Folder */

Project::sortByName($projects);
?>

<?php if (!empty($folder)): ?>
<li class="folder-item">
    <span class="title">
        <?php echo TbHtml::icon(TbHtml::ICON_FOLDER_OPEN) . ' ' . $folder->title; ?>
        <span class="actions">
            <?php echo TbHtml::buttonGroup(array(
                array(
                    'icon'=>'pencil',
                    'url' => array('/dashboard/folder/'.$folder->id.'/edit'),
                    'size' => TbHtml::BUTTON_SIZE_MINI
                ),
                array(
                    'icon'=>'trash',
                    'url' => array('/dashboard/folder/'.$folder->id.'/delete'),
                    'size' => TbHtml::BUTTON_SIZE_MINI
                ),
            )); ?>
        </span>
    </span>
    <ul class="folder-group">
<?php endif; ?>

<?php foreach($projects as $project): ?>
    <li class="project-item">
        <?php if (!empty($project->picture)): ?>
        <span class="thumbnail">
            <img src="<?php echo Yii::app()->baseUrl . $project->picture->getThumbnailFile() ?>"/>
        </span>
        <?php endif; ?>
        <span class="actions">
            <?php echo TbHtml::buttonGroup(array(
                array(
                    'icon'=>'file',
                    'url' => array('/dashboard/project/'.$project->id),
                ),
                array(
                    'icon'=>'pencil',
                    'url' => array('/dashboard/project/'.$project->id.'/edit'),
                ),
                array(
                    'icon'=>'trash',
                    'url' => array('/dashboard/project/'.$project->id.'/delete'),
                ),
            )); ?>
        </span>
        <span class="title"><?php echo $project->name; ?></span>
        <span class="description"><?php echo $project->description; ?></span>
        <span class="count">
            <span class="item"><?php echo TbHtml::icon(TbHtml::ICON_PICTURE) . ' ' . count($project->picturesPerProjects); ?></span>
            <span class="item"><?php echo TbHtml::icon(TbHtml::ICON_FILM) . ' ' . count($project->videosPerProjects); ?></span>
            <span class="item"><?php echo TbHtml::icon(TbHtml::ICON_GLOBE) . ' ' . count($project->linksPerProjects); ?></span>
        </span>
    </li>
<?php endforeach; ?>

<?php if (!empty($folder)): ?>
    </ul>
</li>
<?php endif; ?>