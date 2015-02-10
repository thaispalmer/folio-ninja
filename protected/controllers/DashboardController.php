<?php

class DashboardController extends Controller
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
                'actions' => array('index', 'settings', 'projects'),
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
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Shows the user settings
     */
    public function actionSettings($page='profile')
    {
        $model = User::model()->findByPk(Yii::app()->user->id);
        $model->scenario = $page;

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                if ($model->scenario == 'profile') Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'<h4>All right!</h4> Profile updated sucessfully.');
                elseif ($model->scenario == 'security') Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'<h4>All right!</h4> Password changed sucessfully.');
            }
        }

        $this->render('settings',array(
            'model'=>$model,
            'page'=>$page
        ));
    }

    /**
     * Shows the user portfolio projects
     */
    public function actionProjects()
    {
        $projects = Project::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id, 'team_id'=>null));
        $this->render('projects',array(
            'projects'=>$projects
        ));
    }
}