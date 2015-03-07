<?php
/* @var $this ProjectController */
/* @var $tags TagsPlacement[] */

foreach ($tags as $tag)
    echo '<li data-exists="1">'.$tag->tag->name.'<span class="remove" onclick="removeTag(this)"></span></li>';