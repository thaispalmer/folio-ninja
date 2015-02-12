<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $folders Folder[] */

echo TbHtml::textFieldControlGroup('newFolder', '', array(
    'label' => 'Nest under',
    'placeholder' => 'New folder name',
    'controlOptions' => array(
        'after' => TbHtml::button('Select existing folder', array(
            'color' => TbHtml::BUTTON_COLOR_LINK,
            'onclick' => 'showSelectFolder()'
        )))
));