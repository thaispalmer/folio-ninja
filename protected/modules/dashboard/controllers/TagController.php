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
                'actions' => array('ajaxSearch', 'ajaxRemove'),
                'users' => array('@'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Search for tags.
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

    /**
     * Remove a tag placed on the project, photo, video or link
     */
    public function actionAjaxRemove()
    {
        header('Content-Type: application/json');

        if (empty($_GET['tag'])) {
            echo CJSON::encode(array(
                'status'=>'fail',
                'data' => array('message'=>'A tag is required')
            ));
            Yii::app()->end();
        }

        $tag = Tag::model()->findByAttributes(array('name'=>$_GET['tag']));
        if ($tag === null) {
            echo CJSON::encode(array(
                'status'=>'fail',
                'data' => array('message'=>"This tag doesn't exists")
            ));
            Yii::app()->end();
        }

        $params = array('tag_id'=>$tag->id);
        if (!empty($_GET['project_id'])) $params['project_id'] = $_GET['project_id'];
        elseif (!empty($_GET['picture_id'])) $params['picture_id'] = $_GET['picture_id'];
        elseif (!empty($_GET['video_id'])) $params['video_id'] = $_GET['video_id'];
        elseif (!empty($_GET['link_id'])) $params['link_id'] = $_GET['link_id'];
        else {
            echo CJSON::encode(array(
                'status'=>'fail',
                'data' => array('message'=>"A project, picture, video or link ID is required")
            ));
            Yii::app()->end();
        }

        $model = TagsPlacement::model()->findByAttributes($params);
        if (($model === null) || ($model->project->user_id != Yii::app()->user->id)) {
            echo CJSON::encode(array(
                'status'=>'error',
                'message'=>'Permission denied'
            ));
            Yii::app()->end();
        }

        if ($model->delete()) {
            if (count($tag->tagsPlacements) == 0) $tag->delete();
            echo CJSON::encode(array(
                'status'=>'success',
                'data' => null
            ));
            Yii::app()->end();
        }
    }
}