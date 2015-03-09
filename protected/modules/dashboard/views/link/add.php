<?php
/* @var $this LinkController */
/* @var $model LinksPerProject */
/* @var $project Project */

$this->pageTitle=Yii::app()->name . ' - Dashboard';
$this->breadcrumbs=array(
    'Dashboard' => array('/dashboard'),
    'Project list' => array('/dashboard/projects'),
    $project->name => array('/dashboard/project/'.$project->id),
    'Add new link'
);
?>

<div class="row-fluid">
    <div class="span12">
        <h1><?php echo $project->name; ?></h1>
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
            <legend>Add new link</legend>
            <?php
            echo TbHtml::activeTextFieldControlGroup($model, 'title');
            echo TbHtml::activeTextFieldControlGroup($model, 'url');
            echo TbHtml::activeTextAreaControlGroup($model, 'description', array('rows'=>5));
            ?>
        </fieldset>
        <fieldset>
            <legend>Tags</legend>
            <ul id="tagList" class="tagList"></ul>
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
            TbHtml::submitButton('Add new link', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
            TbHtml::linkButton('Cancel', array(
                'url' => array('/dashboard/project/'.$project->id)
            ))
        ));
        echo TbHtml::endForm();
        ?>
        <script>
            function removeTag(target) {
                $(target).parent().remove();
            }
            function addTag() {
                var tagName = $('#tagName').val();
                if (tagName.length > 2) {
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