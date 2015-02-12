<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $folders Folder[] */

$foldersArray = array('none'=>'');
foreach ($folders as $folder) {
    //array_push($foldersArray,array($folder->id => $folder->title));
    $foldersArray[$folder->id] = $folder->title;
}
echo TbHtml::activeDropDownListControlGroup($model, 'folder_id', $foldersArray, array(
    'label' => 'Nest under',
    'class' => 'first-grayed',
    'controlOptions' => array(
        'after' => TbHtml::button('Create folder', array(
            'color' => TbHtml::BUTTON_COLOR_LINK,
            'onclick'=>'showCreateFolder()'
        )))
));