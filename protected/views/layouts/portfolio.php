<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="row-fluid">
    <?php if (!empty($this->user)): ?>
    <div class="span3">
        <div id="sideProfile">
            <div class="avatar">
                <?php echo TbHtml::imageCircle((empty($this->user->picture)) ? Yii::app()->baseUrl.'/images/default-user.png' : Yii::app()->baseUrl.$this->user->picture->filename,''); ?>
            </div>
            <div class="info">
                <span class="title"><?php echo $this->user->first_name . ' ' . $this->user->last_name; ?></span>

                <?php if(!empty($this->user->portfolio->bio)): ?>
                <p class="bio">
                    <?php echo nl2br($this->user->portfolio->bio); ?>
                </p>
                <?php endif; ?>

                <?php if ($this->user->portfolio->show_email || !empty($this->user->portfolio->linksPerPortfolios)): ?>
                <div class="well">
                    <?php if ($this->user->portfolio->show_email): ?>
                    <span class="email">
                        <?php echo TbHtml::icon(TbHtml::ICON_ENVELOPE) . ' ' . $this->user->email; ?>
                    </span>
                    <?php $separator = true; ?>
                    <?php endif; ?>

                    <?php if (!empty($this->user->portfolio->linksPerPortfolios)): ?>
                    <?php if ($separator) echo '<hr/>'; ?>
                    <ul class="links">
                        <?php foreach ($this->user->portfolio->linksPerPortfolios as $link): ?>
                        <li>
                            <?php echo TbHtml::icon(TbHtml::ICON_GLOBE); ?>
                            <a href="<?php echo CHtml::decode($link->url) ?>" target="_blank"><?php echo ($link->type) ? $link->type : $link->url; ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="span9">
        <?php echo $content; ?>
    </div>
</div>

<?php $this->endContent(); ?>