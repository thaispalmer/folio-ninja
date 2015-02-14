<?php

class DefaultController extends Controller
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
                'actions' => array('index', 'settings'),
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
        $this->render('index');
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
            var_dump($_POST);
            if ($_POST['removePicture'][0] == '1') {
                $model->picture_id = null;
                // @TODO: apagar a foto na pasta de upload
            }
            if ($uploaded = CUploadedFile::getInstance($model,'profilePicture')) {
                $picture = new Picture;
                $picture->instance = $uploaded;
                $picture->scenario = 'profile';
                if ($picture->save()) {
                    $model->picture_id = $picture->id;
                }
            }
            if ($model->save()) {
                if ($model->scenario == 'profile') {
                    Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'<h4>All right!</h4> Profile updated sucessfully.');

                }
                elseif ($model->scenario == 'security') Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'<h4>All right!</h4> Password changed sucessfully.');
            }
        }

        $this->render('settings',array(
            'model'=>$model,
            'page'=>$page
        ));
    }
}