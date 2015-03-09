<?php
/* @var $this LinkController */
/* @var $model LinksPerProject */

$model->url = CHtml::decode($model->url);
$model->title = CHtml::decode($model->title);
$model->description = CHtml::decode($model->description);

$this->pageTitle=Yii::app()->name . ' - Dashboard';
$this->breadcrumbs=array(
    'Dashboard' => array('/dashboard'),
    'Project list' => array('/dashboard/projects'),
    $model->project->name => array('/dashboard/project/'.$model->project->id),
    'Edit link' . ((!empty($model->title)) ? ': '.$model->title : '')
);
?>

<div class="row-fluid">
    <div class="span12">
        <h1><?php echo $model->project->name; ?></h1>
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
            <legend>Edit link<?php echo (!empty($model->title)) ? ': '.$model->title : ' '; ?></legend>
            <?php
            echo TbHtml::activeTextFieldControlGroup($model, 'title');
            echo TbHtml::activeTextFieldControlGroup($model, 'url');
            echo TbHtml::activeTextAreaControlGroup($model, 'description', array('rows'=>5));
            ?>
        </fieldset>
        <fieldset>
            <legend>Tags</legend>
            <ul id="tagList" class="tagList"><?php $this->renderPartial('_manageTags', array('tags'=>$model->tagsPlacements)) ?></ul>
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
        echo TbHtml::formActions(array(
            TbHtml::submitButton('Save', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
            TbHtml::linkButton('Discard changes', array(
                'url' => array('/dashboard/project/'.$model->project->id)
            ))
        ));
        echo TbHtml::endForm();
        ?>
        <script>
            function removeTag(target) {
                if ($(target).parent().data('exists') == 1) {
                    var data = {
                        tag: $(target).parent().find('.name').text(),
                        linkpp_id: <?php echo $model->id ?>
                    };
                    $.get('<?php echo $this->createUrl('/dashboard/tag/ajaxRemove') ?>',data);
                }
                $(target).parent().remove();
            }
            function addTag() {
                var tagName = $('#tagName').val();
                if (tagName.length > 0) {
                    var tag = $('<li></li>');
                    tag.append('<span class="name">'+tagName+'</span>');
                    tag.append('<input type="hidden" name="addTag[]" value="' + tagName + '"/>');
                    tag.append('<span class="remove" onclick="removeTag(this)"></span>');
                    tag.appendTo('#tagList');
                    $('#tagName').val('');
                }
            }
        </script>
    </div>
</div>