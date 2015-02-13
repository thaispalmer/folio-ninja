<?php

class ProjectController extends Controller
{
    public $layout='//layouts/column2';

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
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'create'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
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
        $projects = Project::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id, 'team_id'=>null, 'folder_id'=>null),array('order'=>'name'));
        $folders = Folder::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id, 'team_id'=>null),array('order'=>'title'));
        $this->render('index',array(
            'projects'=>$projects,
            'folders'=>$folders
        ));
    }

    /**
     * Creates a new project.
     * If creation is successful, the browser will be redirected to the 'index' page.
     */
    public function actionCreate()
    {
        $model=new Project;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Project']))
        {
            if ($_POST['Project']['folder_id'] == 'none') unset($_POST['Project']['folder_id']);
            $model->attributes = $_POST['Project'];
            $model->user_id = Yii::app()->user->id;

            if ($model->validate()) {
                if ($_POST['createFolder'] == 1) {
                    $folder=new Folder;
                    $folder->user_id = $model->user_id;
                    $folder->title = $_POST['folderName'];
                    if ($folder->save()) {
                        $model->folder_id = $folder->id;
                    }
                }
                if ($model->save())
                    $this->redirect(array('/dashboard/projects'));
            }
        }

        $folders = Folder::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id, 'team_id'=>null));
        $this->render('create',array(
            'model'=>$model,
            'folders'=>$folders
        ));
    }
}