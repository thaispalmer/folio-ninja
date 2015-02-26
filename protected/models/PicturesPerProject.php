<?php

/**
 * This is the model class for table "pictures_per_project".
 *
 * The followings are the available columns in table 'pictures_per_project':
 * @property integer $id
 * @property integer $picture_id
 * @property integer $project_id
 * @property string $title
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Picture $picture
 * @property Project $project
 */
class PicturesPerProject extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pictures_per_project';
	}

    public $pictureUpload;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_id', 'required'),
            array('picture_id', 'required', 'on'=>'update'),
			array('picture_id, project_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>50),
			array('description', 'safe'),

            array('pictureUpload', 'file', 'types'=>'jpg, jpeg, gif, png', 'allowEmpty'=>false, 'on'=>'insert'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, picture_id, project_id, title, description', 'safe', 'on'=>'search'),
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
			'picture' => array(self::BELONGS_TO, 'Picture', 'picture_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'picture_id' => 'Picture',
			'project_id' => 'Project',
			'title' => 'Title',
			'description' => 'Description',
            'pictureUpload' => 'Picture',
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
		$criteria->compare('picture_id',$this->picture_id);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PicturesPerProject the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * After deleting an entry on the database, remove the picture linked to it.
     */
    public function afterDelete() {
        $this->picture->delete();
        return parent::afterDelete();
    }
}
