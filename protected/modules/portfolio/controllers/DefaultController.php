<?php

class DefaultController extends Controller
{
    public $layout='//layouts/portfolio';
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
                'actions' => array('index', 'project', 'picture', 'video'),
                'users'=>array('*'),
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($alias)
    {
        $model = User::model()->findByAttributes(array('alias'=>$alias));

        if ($model === null)
            throw new CHttpException(404,'The requested page does not exist.');

        $projects = Project::model()->findAllByAttributes(array('user_id'=>$model->id, 'team_id'=>null, 'folder_id'=>null),array('order'=>'name'));
        $this->render('index',array(
            'model'=>$model,
            'projects'=>$projects
        ));
    }

    /**
     * Displays the contents of a particular folder.
     * @param integer $id the ID of the folder to be displayed
     * @throws CHttpException
     */
    public function actionFolder($alias,$id)
    {
        $model = Folder::model()->findByPk($id);

        if (($model === null) || ($model->user->alias != $alias))
            throw new CHttpException(404,'The requested page does not exist.');

        $this->render('folder',array(
            'model'=>$model
        ));
    }

    /**
     * Displays a particular project.
     * @param integer $id the ID of the project to be displayed
     * @throws CHttpException
     */
    public function actionProject($alias,$id)
    {
        $model = Project::model()->findByPk($id);

        if (($model === null) || ($model->user->alias != $alias))
            throw new CHttpException(404,'The requested page does not exist.');

        $this->render('project',array(
            'model'=>$model
        ));
    }

    /**
     * Displays a particular project picture.
     * @param integer $id the ID of the picture to be displayed
     * @throws CHttpException
     */
    public function actionPicture($alias,$id)
    {
        $model = PicturesPerProject::model()->findByPk($id);

        if (($model === null) || ($model->project->user->alias != $alias))
            throw new CHttpException(404,'The requested page does not exist.');

        $this->render('picture',array(
            'model'=>$model
        ));
    }

    /**
     * Displays a particular project video.
     * @param integer $id the ID of the video to be displayed
     * @throws CHttpException
     */
    public function actionVideo($alias,$id)
    {
        $model = VideosPerProject::model()->findByPk($id);

        if (($model === null) || ($model->project->user->alias != $alias))
            throw new CHttpException(404,'The requested page does not exist.');

        $this->render('video',array(
            'model'=>$model
        ));
    }
}