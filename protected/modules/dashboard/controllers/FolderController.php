<?php

class FolderController extends Controller
{
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
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
                'actions' => array('edit', 'delete'),
                'users' => array('@'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Edit a particular folder.
     * @param integer $id the ID of the folder to be edited
     * @throws CHttpException
     */
    public function actionEdit($id)
    {
        $model = Folder::model()->findByPk($id);

        if (($model === null) || ($model->user_id != Yii::app()->user->id))
            throw new CHttpException(404,'The requested page does not exist.');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Folder']))
        {
            $model->attributes = $_POST['Folder'];
            if ($model->save()) {
                Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS, '<h4>All right!</h4> Folder updated sucessfully.');
                $this->redirect(array('/dashboard/projects'));
            }
            else {
                $model->refresh();
            }
        }

        $this->render('edit',array(
            'model'=>$model
        ));
    }

    /**
     * Prompts and deletes a particular folder.
     * @param integer $id the ID of the folder to be deleted
     * @throws CHttpException
     */
    public function actionDelete($id)
    {
        $model = Folder::model()->findByPk($id);

        if (($model === null) || ($model->user_id != Yii::app()->user->id))
            throw new CHttpException(404,'The requested page does not exist.');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['remove']))
        {
            if ($model->delete()) {
                Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS, '<h4>All right!</h4> Folder removed sucessfully.');
                $this->redirect(array('/dashboard/projects'));
            }
        }

        $this->render('delete',array(
            'model'=>$model
        ));
    }
}