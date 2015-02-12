<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $folders Folder[] */

$foldersArray = array('none'=>'No folder');
foreach ($folders as $folder) {
    $foldersArray[$folder->id] = $folder->title;
}
echo TbHtml::activeDropDownListControlGroup($model, 'folder_id', $foldersArray, array(
    'label' => 'Put into',
    'class' => 'first-grayed',
    'controlOptions' => array(
        'after' => TbHtml::button('Create folder', array(
            'color' => TbHtml::BUTTON_COLOR_LINK,
            'onclick'=>'showCreateFolder()'
        )))
));