<?php

class PictureController extends Controller
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
                'actions' => array('add', 'edit', 'delete'),
                'users' => array('@'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Add a picture to a particular project.
     * @param integer $id the ID of the project
     * @throws CHttpException
     */
    public function actionAdd($id)
    {
        $model = new PicturesPerProject;
        $project = Project::model()->findByPk($id);

        if (($project === null) || ($project->user_id != Yii::app()->user->id))
            throw new CHttpException(404,'The requested page does not exist.');

        if (isset($_POST['PicturesPerProject'])) {
            $model->attributes = $_POST['PicturesPerProject'];
            $model->project_id = $id;
            if (($model->validate()) && ($uploaded = CUploadedFile::getInstance($model,'pictureUpload'))) {
                $picture = new Picture;
                $picture->instance = $uploaded;
                $picture->scenario = 'portfolio';
                if ($picture->save()) {
                    $model->picture_id = $picture->id;
                    if ($model->save()) {
                        if (!empty($_POST['addTag'])) {
                            foreach ($_POST['addTag'] as $newTag) {
                                $tag = Tag::model()->findByAttributes(array('name'=>$newTag));
                                if ($tag === null) {
                                    $tag = new Tag;
                                    $tag->name = $newTag;
                                    if ($tag->save()) {
                                        $placeTag = new TagsPlacement();
                                        $placeTag->tag_id = $tag->id;
                                        $placeTag->picturepp_id = $model->id;
                                        $placeTag->save();
                                    }
                                }
                                else {
                                    $placeTag = new TagsPlacement();
                                    $placeTag->tag_id = $tag->id;
                                    $placeTag->picturepp_id = $model->id;
                                    $placeTag->save();
                                }
                            }
                        }
                        Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'<h4>All right!</h4> Picture added sucessfully.');
                        $this->redirect(array('/dashboard/project/' . $project->id));
                    }
                }
                else $model->addErrors($picture->getErrors());
            }
        }

        $this->render('add',array(
            'model'=>$model,
            'project'=>$project
        ));
    }

    /**
     * Edit a particular project picture.
     * @param integer $id the ID of the picture to be edited
     * @throws CHttpException
     */
    public function actionEdit($id)
    {
        $model = PicturesPerProject::model()->findByPk($id);

        if (($model === null) || ($model->project->user_id != Yii::app()->user->id))
            throw new CHttpException(404,'The requested page does not exist.');

        if(isset($_POST['PicturesPerProject']))
        {
            $model->attributes = $_POST['PicturesPerProject'];
            if ($model->save()) {
                if (!empty($_POST['addTag'])) {
                    foreach ($_POST['addTag'] as $newTag) {
                        $tag = Tag::model()->findByAttributes(array('name'=>$newTag));
                        if ($tag === null) {
                            $tag = new Tag;
                            $tag->name = $newTag;
                            if ($tag->save()) {
                                $placeTag = new TagsPlacement();
                                $placeTag->tag_id = $tag->id;
                                $placeTag->picturepp_id = $model->id;
                                $placeTag->save();
                            }
                        }
                        else {
                            $placeTag = new TagsPlacement();
                            $placeTag->tag_id = $tag->id;
                            $placeTag->picturepp_id = $model->id;
                            $placeTag->save();
                        }
                    }
                }
                Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,'<h4>All right!</h4> Picture updated sucessfully.');
                $this->redirect(array('/dashboard/project/' . $model->project->id));
            }
        }

        $this->render('edit',array(
            'model'=>$model
        ));
    }

    /**
     * Prompts and deletes a particular project picture.
     * @param integer $id the ID of the picture to be deleted
     * @throws CHttpException
     */
    public function actionDelete($id)
    {
        $model = PicturesPerProject::model()->findByPk($id);

        if (($model === null) || ($model->project->user_id != Yii::app()->user->id))
            throw new CHttpException(404,'The requested page does not exist.');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['remove']))
        {
            if ($model->delete()) {
                Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS, '<h4>All right!</h4> Picture removed sucessfully.');
                $this->redirect(array('/dashboard/project/' . $model->project->id));
            }
        }

        $this->render('delete',array(
            'model'=>$model
        ));
    }
}