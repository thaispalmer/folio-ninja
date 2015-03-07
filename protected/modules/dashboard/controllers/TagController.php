<?php

class TagController extends Controller
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
                'actions' => array('ajaxSearch'),
                'users' => array('@'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Search for tags.
     * @param string $value the string to be used on search
     * @throws CHttpException
     */
    public function actionAjaxSearch()
    {
        header('Content-Type: application/json');

        if (empty($_GET['value'])) {
            echo CJSON::encode(array(
                'status'=>'fail',
                'data' => array('message'=>'A value is required')
            ));
            Yii::app()->end();
        }

        $match = addcslashes(strip_tags($_GET['value']), '%_');
        $criteria = new CDbCriteria();
        $criteria->addCondition('name LIKE :match');
        $criteria->params = array(':match'=>"$match%");
        $model = Tag::model()->findAll($criteria);

        if ($model === null) {
            echo CJSON::encode(array(
                'status'=>'fail',
                'data' => array('message'=>'No tags matched the criteria')
            ));
            Yii::app()->end();
        }

        $tagList = array();
        foreach ($model as $tag) {
            array_push($tagList,$tag->name);
        }
        echo CJSON::encode(array(
            'status'=>'success',
            'data' => array('tags'=>$tagList)
        ));
        Yii::app()->end();
    }
}