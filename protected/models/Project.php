<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $user_id
 * @property integer $team_id
 * @property integer $folder_id
 *
 * The followings are the available model relations:
 * @property LinksPerProject[] $linksPerProjects
 * @property PicturesPerProject[] $picturesPerProjects
 * @property VideosPerProject[] $videosPerProjects
 * @property Team $team
 * @property User $user
 * @property Folder $folder
 */
class Project extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, user_id', 'required'),
			array('user_id, team_id, folder_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, user_id, team_id, folder_id', 'safe', 'on'=>'search'),
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
			'linksPerProjects' => array(self::HAS_MANY, 'LinksPerProject', 'project_id'),
			'picturesPerProjects' => array(self::HAS_MANY, 'PicturesPerProject', 'project_id'),
            'videosPerProjects' => array(self::HAS_MANY, 'VideosPerProject', 'project_id'),
			'team' => array(self::BELONGS_TO, 'Team', 'team_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'folder' => array(self::BELONGS_TO, 'Folder', 'folder_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'user_id' => 'User',
			'team_id' => 'Team',
			'folder_id' => 'Folder',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('team_id',$this->team_id);
		$criteria->compare('folder_id',$this->folder_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
