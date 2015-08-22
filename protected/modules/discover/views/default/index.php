<?php
/* @var $this DefaultController */
/* @var $model User */
/* @var $latestProjects Project[] */
/* @var $latestPictures PicturesPerProject[] */
/* @var $latestVideos VideosPerProject[] */
/* @var $latestLinks LinksPerProject[] */

$this->pageTitle=Yii::app()->name . ' - Discover projects and people';
$this->breadcrumbs=array(
    'Discover'
);
?>

    <div class="row-fluid">
        <div class="span12">
            <h1>Discover projects and people</h1>
            <?php
            /*
                echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_SEARCH, array('/discover/default/index'), 'GET');
                echo TbHtml::searchQueryField('search') . ' ' . TbHtml::submitButton('Search', array('name'=>''));
                echo TbHtml::endForm();
            */
            ?>
        </div>
    </div>

    <hr/>

    <div class="row-fluid">
        <div class="span12">
            <h4>Latest Projects</h4>
            <ul class="projectList discover">
                <?php
                if (empty($latestProjects)) {
                    echo 'No projects to display.';
                }
                else {
                    foreach ($latestProjects as $project) {
                        $this->renderPartial('_projectList', array('project' => $project));
                    }
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12">
            <h4>Latest Pictures</h4>
            <ul class="pictureList discover">
                <?php
                if (empty($latestPictures)) {
                    echo 'No pictures to display.';
                }
                else {
                    foreach ($latestPictures as $picture) {
                        $this->renderPartial('_pictureList', array('picture' => $picture));
                    }
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12">
            <h4>Latest Videos</h4>
            <ul class="videoList discover">
                <?php
                if (empty($latestVideos)) {
                    echo 'No videos to display.';
                }
                else {
                    foreach ($latestVideos as $video) {
                        $this->renderPartial('_videoList', array('video' => $video));
                    }
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12">
            <h4>Latest Links</h4>
            <ul class="linkList discover">
                <?php
                if (empty($latestLinks)) {
                    echo 'No links to display.';
                }
                else {
                    foreach ($latestLinks as $link) {
                        $this->renderPartial('_linkList', array('link' => $link));
                    }
                }
                ?>
            </ul>
        </div>
    </div>