<?php
/* @var $this ProjectController */
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
            ?>
            <div id="folderSelection" class="active">
                <?php $this->renderPartial('_selectFolder', array('model'=>$model,'folders'=>$folders)) ?>
            </div>
            <div id="folderCreation">
                <?php $this->renderPartial('_createFolder', array('model'=>$model)) ?>
            </div>
        </fieldset>
        <fieldset>
            <legend>Tags</legend>
            <ul id="tagList"></ul>
            <div class="control-group">
                <label class="control-label" for="">Add tag</label>
                <div class="controls">
                    <?php
                    $this->widget('bootstrap.widgets.TbTypeAhead', array(
                        'name' => '',
                        'minLength' => 3,
                        'source' => new CJavaScriptExpression('function (query, process) {
                                        var longEnough = query.length >= this.options.minLength;
                                        if (longEnough && (query != this.search)) {
                                            this.search = query;
                                            $.ajax({
                                                url: "'.$this->createUrl('/dashboard/tag/ajaxSearch').'?value=" + query,
                                                type: "GET",
                                                success: function(result) {
                                                    if (result.status == "success")
                                                        process(result.data.tags);
                                                }
                                            });
                                        }
                                    }'),
                        'htmlOptions' => array(
                            'id'=>'tagName',
                            'placeholder' => '',
                            'onkeydown' => 'javascript:if(event.keyCode == 13) return false;',
                        ),
                    ));
                    ?>
                    <?php echo TbHtml::button('Add tag',array('onclick'=>'addTag()')); ?>
                </div>
            </div>
        </fieldset>
        <?php
        echo TbHtml::formActions(array(TbHtml::submitButton('Create new project', array('color' => TbHtml::BUTTON_COLOR_PRIMARY))));
        echo TbHtml::endForm();
        ?>
        <script>
            function showCreateFolder() {
                $('#folderSelection').removeClass('active');
                $('#folderCreation').addClass('active');
                $('input[name=createFolder]').val('1');
            }
            function showSelectFolder() {
                $('#folderSelection').addClass('active');
                $('#folderCreation').removeClass('active');
                $('input[name=newFolder]').val('');
                $('input[name=createFolder]').val('0');
            }
            function removeTag(target) {
                $(target).parent().remove();
            }
            function addTag() {
                var tagName = $('#tagName').val();
                if (tagName.length > 2) {
                    var tag = $('<li></li>');
                    tag.append(tagName);
                    tag.append('<input type="hidden" name="addTag[]" value="' + tagName + '"/>');
                    tag.append('<span class="remove" onclick="removeTag(this)"></span>');
                    tag.appendTo('#tagList');
                    $('#tagName').val('');
                }
            }
        </script>
    </div>
</div>