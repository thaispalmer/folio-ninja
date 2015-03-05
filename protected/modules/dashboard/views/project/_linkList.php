<?php
/* @var $this ProjectController */
/* @var $link LinksPerProject */
?>
<li>
    <div class="actions">
        <?php
        echo TbHtml::buttonGroup(array(
            array(
                'icon'=>'pencil',
                'title'=>'Edit link',
                'url' => array('/dashboard/link/'.$link->id.'/edit'),
                'size' => TbHtml::BUTTON_SIZE_MINI
            ),
            array(
                'icon'=>'trash',
                'title'=>'Remove link',
                'url' => array('/dashboard/link/'.$link->id.'/delete'),
                'size' => TbHtml::BUTTON_SIZE_MINI
            )
        ));
        ?>
    </div>
    <span class="title">
        <?php echo TbHtml::link((!empty($link->title) ? $link->title : $link->url),$link->url,array(
            'title' => $link->url,
            'target' => '_blank'
        )); ?>
    </span>
    <span class="url"><?php echo $link->url; ?></span>
    <?php if (!empty($link->description)): ?>
    <p class="description"><?php echo Utilities::limitWords(nl2br($link->description),15); ?></p>
    <?php endif; ?>
</li>