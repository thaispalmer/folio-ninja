<?php
/* @var $this DefaultController */
/* @var $model User */

$layoutsArray = array(
    'List'=>'List (default)',
    'Grid'=>'Grid'
);
?>

<div class="span12">
    <?php
    $this->widget('bootstrap.widgets.TbAlert');
    if ($model->hasErrors()) {
        echo TbHtml::errorSummary($model->portfolio,'<h4>Oh snap!</h4>');
    }
    ?>

    <?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL); ?>
    <fieldset>
        <legend>Appearance</legend>
        <?php
        echo TbHtml::activeDropDownListControlGroup($model->portfolio, 'layout', $layoutsArray);
        ?>
    </fieldset>
    <fieldset>
        <legend>Description</legend>
        <?php
        echo TbHtml::activeTextAreaControlGroup($model->portfolio, 'bio', array(
            'label'=>'Tell about yourself',
            'help' => 'Maximum 1000 characters.',
            'rows'=>5
        ));
        echo TbHtml::activeDropDownListControlGroup($model->portfolio, 'show_email', array(
            '0'=>'No (default)',
            '1'=>'Yes'
        ));
        ?>
    </fieldset>
    <fieldset>
        <legend>Social and external links</legend>
        <ul id="portfolioLinkList" class="portfolioLinkList"><?php $this->renderPartial('_portfolioLinks',array('links'=>$model->portfolio->linksPerPortfolios)); ?></ul>
        <div class="control-group">
            <label class="control-label" for="">New link</label>
            <div class="controls">
                <?php
                echo TbHtml::dropDownList('',0,array(
                    'External Link',
                    'Facebook', 'Google Plus', 'LinkedIn',
                    'YouTube', 'Vimeo',
                ),array(
                    'id'=>'linkType',
                ));
                ?>
                <?php
                echo TbHtml::textField('','',array(
                    'id'=>'linkUrl',
                    'placeholder'=>'Url'
                ));
                ?>
                <?php echo TbHtml::button('Add link',array('onclick'=>'addLink()')); ?>
            </div>
        </div>
    </fieldset>
    <?php
    echo TbHtml::formActions(array(TbHtml::submitButton('Update', array('color' => TbHtml::BUTTON_COLOR_PRIMARY))));
    echo TbHtml::endForm();
    ?>
    <script>
        function removeLink(target) {
            if ($(target).parent().data('exists') == 1) {
                var data = {
                    link_id: $(target).parent().data('id')
                };
                console.log(data);
                $.get('<?php echo $this->createUrl('/dashboard/default/ajaxRemoveLink') ?>',data);
            }
            $(target).parent().remove();
        }
        function addLink() {
            var linkUrl = $('#linkUrl').val();
            var linkType = $('#linkType option:selected').text();
            if (linkUrl.length > 0) {
                var link = $('<li></li>');
                link.append('<span class="type">'+linkType+'</span>');
                link.append('<a class="url" target="_blank" href="'+linkUrl+'">'+linkUrl+'</a>');
                link.append('<input type="hidden" name="addLink[type][]" value="' + linkType + '"/>');
                link.append('<input type="hidden" name="addLink[url][]" value="' + linkUrl + '"/>');
                link.append('<span class="remove" onclick="removeLink(this)"></span>');
                link.appendTo('#portfolioLinkList');
                $('#linkUrl').val('');
                $('#linkType').val(0);
            }
        }
    </script>
</div>