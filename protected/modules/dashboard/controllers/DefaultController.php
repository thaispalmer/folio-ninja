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
            array('allow',  // allow all logged to perform these actions
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
        $model = User::model()->findByPk(Yii::app()->user->id);
        $this->render('index',array('model'=>$model));
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
            if ((!empty($_POST['removePicture'])) && ($_POST['removePicture'][0] == '1')) {
                $picture = $model->picture;
                $model->picture_id = null;
                if ($model->save())
                    $picture->delete();
            }
            if ($uploaded = CUploadedFile::getInstance($model,'profilePicture')) {
                $picture = new Picture;
                $picture->instance = $uploaded;
                $picture->scenario = 'profile';
                if ($picture->save()) {
                    if (!empty($model->picture_id)) {
                        $oldPicture = $model->picture;
                        $model->picture_id = null;
                        if ($model->save())
                            $oldPicture->delete();
                    }
                    $model->picture_id = $picture->id;
                }
                else $model->addErrors($picture->getErrors());
            }
            $errors = $model->getErrors();
            if (empty($errors) && $model->save()) {
                if ($model->scenario == 'profile') {
                    if (!empty($picture->id)) Yii::app()->user->setState('profilePicture', Yii::app()->baseUrl.$picture->filename);
                    if ($model->picture_id == null) Yii::app()->user->setState('profilePicture',Yii::app()->baseUrl.'/images/default-user.png');
                    Yii::app()->user->setState('firstName', $model->first_name);
                    Yii::app()->user->setState('alias', $model->alias);
                    Yii::app()->user->setState('email', $model->email);
                    Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'<h4>All right!</h4> Profile updated sucessfully.');
                }
                elseif ($model->scenario == 'security') Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'<h4>All right!</h4> Password changed sucessfully.');
            }
        }

        if (isset($_POST['Portfolio'])) {

            $model->portfolio->layout = $_POST['Portfolio']['layout'];
            if ($model->portfolio->save()) {
                Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'<h4>All right!</h4> Portfolio settings updated sucessfully.');
            }

/*
            $portfolio = Portfolio::model()->findByAttributes(array('user_id'=>$model->id));
            $portfolio->attributes = $_POST['Portfolio'];
            echo $portfolio->layout;
            echo $_POST['Portfolio']['layout'];
            if ($portfolio->save()) {
                Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'<h4>All right!</h4> Portfolio settings updated sucessfully.');
            }
*/
        }

        $this->render('settings',array(
            'model'=>$model,
            'page'=>$page
        ));
    }
}