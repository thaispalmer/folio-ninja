<?php
/* @var $this DefaultController */
/* @var $links LinksPerPortfolio[] */

foreach ($links as $link)
    echo '<li data-exists="1" data-id="'.$link->id.'"><span class="type">'.(($link->type != null) ? $link->type : 'External Link').'</span><a class="url" target="_blank" href="'.$link->url.'">'.$link->url.'</a><span class="remove" onclick="removeLink(this)"></span></li>';