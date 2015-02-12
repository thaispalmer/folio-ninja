<?php
/* @var $this DashboardController */
/* @var $model Project */
/* @var $folders Folder[] */

echo TbHtml::textFieldControlGroup('newFolder', '', array(
    'label' => 'Nest under',
    'controlOptions' => array(
        'after' => TbHtml::button('Select existing folder',
            array('color' => TbHtml::BUTTON_COLOR_LINK),
            array('onclick'=>'showSelectFolder')))
));