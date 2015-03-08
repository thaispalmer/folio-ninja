<?php
/* @var $this ProjectController */
/* @var $tags TagsPlacement[] */

foreach ($tags as $tag)
    echo '<li data-exists="1"><span class="name">'.$tag->tag->name.'</span><span class="remove" onclick="removeTag(this)"></span></li>';