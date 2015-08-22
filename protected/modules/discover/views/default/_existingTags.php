<?php
/* @var $tags TagsPlacement[] */

foreach ($tags as $tag)
    echo '<li><span class="name">'.$tag->tag->name.'</span></li>';