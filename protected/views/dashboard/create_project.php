<?php
/* @var $this DashboardController */
/* @var $model Project */
/* @var $folders Folder[] */

$this->pageTitle=Yii::app()->name . ' - Dashboard';
$this->breadcrumbs=array(
    'Dashboard' => array('/dashboard'),
    'Project list'
);
?>

<div class="row-fluid">
    <div class="span12">
        <h1>Project List</h1>
        <?php echo TbHtml::tabs(array(
            array('label' => 'Manage projects', 'url' => array('/dashboard/projects')),
            array('label' => 'Add new project', 'url' => array('/dashboard/project/create'), 'active' => true)
        )); ?>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <?php
        $this->widget('bootstrap.widgets.TbAlert');
        if ($model->hasErrors()) {
            echo TbHtml::errorSummary($model,'<h4>Oh snap!</h4>');
        }
        ?>

        <?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL); ?>
        <fieldset>
            <legend>Project Information</legend>
            <?php
            echo TbHtml::activeTextFieldControlGroup($model, 'name');
            echo TbHtml::activeTextAreaControlGroup($model, 'description', array('rows'=>5));

            // @TODO Fazer a criação de pastas aqui ou em outro lugar?
            $foldersArray = array('none'=>'');
            foreach ($folders as $folder) {
                $foldersArray[$folder->id] = $folder->title;
            }
            echo TbHtml::activeDropDownListControlGroup($model, 'folder_id', $foldersArray, array(
                'label' => 'Nest under',
                'controlOptions' => array(
                    'after' => '<br/>'.TbHtml::popover('Create folder', 'New folder',
                        TbHtml::textField('folder_name')))
            ));

            ?>
        </fieldset>
        <?php
        echo TbHtml::formActions(array(TbHtml::submitButton('Create new project', array('color' => TbHtml::BUTTON_COLOR_PRIMARY))));
        echo TbHtml::endForm();
        ?>
    </div>
</div>