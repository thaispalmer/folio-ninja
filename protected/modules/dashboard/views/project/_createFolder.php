<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $folders Folder[] */

echo TbHtml::textFieldControlGroup('folderName', '', array(
    'label' => 'Put into',
    'placeholder' => 'New folder name',
    'controlOptions' => array(
        'after' => TbHtml::button('Select existing folder', array(
            'color' => TbHtml::BUTTON_COLOR_LINK,
            'onclick' => 'showSelectFolder()'
        )))
));
echo '<input type="hidden" name="createFolder" value="0"/>';