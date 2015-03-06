<?php

/**
 * This is the model class for table "tags_placement".
 *
 * The followings are the available columns in table 'tags_placement':
 * @property integer $id
 * @property integer $tag_id
 * @property integer $project_id
 * @property integer $picturepp_id
 * @property integer $videopp_id
 * @property integer $linkpp_id
 *
 * The followings are the available model relations:
 * @property Tag $tag
 * @property Project $project
 * @property PicturesPerProject $picturesPerProject
 * @property VideosPerProject $videosPerProject
 * @property LinksPerProject $linksPerProject
 */
class TagsPlacement extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tags_placement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
        return array(
            array('tag_id', 'required'),
            array('tag_id, project_id, picturepp_id, videopp_id, linkpp_id', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, tag_id, project_id, picturepp_id, videopp_id, linkpp_id', 'safe', 'on'=>'search'),
        );
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tag' => array(self::BELONGS_TO, 'Tag', 'tag_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'picturesPerProject' => array(self::BELONGS_TO, 'PicturePerProject', 'picturepp_id'),
			'videosPerProject' => array(self::BELONGS_TO, 'VideosPerProject', 'videopp_id'),
			'linksPerProject' => array(self::BELONGS_TO, 'LinksPerProject', 'linkpp_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
        return array(
            'id' => 'ID',
            'tag_id' => 'Tag ID',
            'project_id' => 'Project ID',
            'picturepp_id' => 'Picture ID',
            'videopp_id' => 'Video ID',
            'linkpp_id' => 'Link ID',
        );
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('tag_id',$this->tag_id);
        $criteria->compare('project_id',$this->project_id);
        $criteria->compare('picturepp_id',$this->picturepp_id);
        $criteria->compare('videopp_id',$this->videopp_id);
        $criteria->compare('linkpp_id',$this->linkpp_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TagsPlacement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
