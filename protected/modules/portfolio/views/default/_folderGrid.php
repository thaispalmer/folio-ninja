<?php
/* @var $this DefaultController */
/* @var $user User */
/* @var $folder Folder */
?>

<li class="folder-item">
    <a href="<?php echo $this->createUrl('/'.$user->alias.'/folder/'.$folder->id) ?>">
        <?php echo $folder->title; ?>
        <span class="bottom">
            <?php echo TbHtml::icon(TbHtml::ICON_FOLDER_OPEN); ?>
        </span>
    </a>
</li>