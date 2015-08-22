<?php

class DefaultController extends Controller
{
    public $layout='//layouts/column1';
    public $user;

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform these actions
                'actions' => array('index'),
                'users'=>array('*'),
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        if (isset($_GET['search'])) {
            // TODO: search
        }
        else {
            $latestProjects = Project::model()->findAll(array('order'=>'id DESC', 'limit'=>4));
            $latestPictures = PicturesPerProject::model()->findAll(array('order'=>'id DESC', 'limit'=>4));
            $latestVideos = VideosPerProject::model()->findAll(array('order'=>'id DESC', 'limit'=>4));
            $latestLinks = LinksPerProject::model()->findAll(array('order'=>'id DESC', 'limit'=>4));
            $this->render('index',array(
                'latestProjects'=>$latestProjects,
                'latestPictures'=>$latestPictures,
                'latestVideos'=>$latestVideos,
                'latestLinks'=>$latestLinks,
            ));
        }
    }
}