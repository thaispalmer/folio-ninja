<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="row">
    <div class="span9">
        <?php echo $content; ?>
    </div>
    <div class="span3">
        <?php if (!empty($this->menu)): ?>
        <div class="well" style="padding: 8px 0;">
            <?php echo TbHtml::navList($this->menu); ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php $this->endContent(); ?>