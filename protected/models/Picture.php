<?php

/**
 * This is the model class for table "picture".
 *
 * The followings are the available columns in table 'picture':
 * @property integer $id
 * @property string $filename
 *
 * The followings are the available model relations:
 * @property PicturesPerProject[] $picturesPerProjects
 * @property Team[] $teams
 * @property User[] $users
 */
class Picture extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'picture';
	}

    public $instance;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('filename', 'required'),
            array('instance', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, filename', 'safe', 'on'=>'search'),
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
			'picturesPerProjects' => array(self::HAS_MANY, 'PicturesPerProject', 'picture_id'),
			'teams' => array(self::HAS_MANY, 'Team', 'picture_id'),
			'users' => array(self::HAS_MANY, 'User', 'picture_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'filename' => 'Filename',
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
		$criteria->compare('filename',$this->filename,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Picture the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Before Validate function, to define uploaded image destination.
     */
    public function beforeValidate()
    {
        if (!empty($this->instance)) {
            $this->filename = Yii::app()->params['uploadFolder'] . uniqid($this->scenario . '_') . '.' . $this->instance->extensionName;
        }
        return parent::beforeValidate();
    }

    /**
     * After Validate function, to save the picture to the right location.
     * @TODO: resize images by scenario/user plan. *doing this*
     */
    public function afterValidate() {
        if (!$this->hasErrors()) {
            switch ($this->scenario) {
                case 'profile':
                    $reducedImage = new ResizeImage();
                    $reducedImage->originalFile = $this->instance->tempName;
                    $reducedImage->saveThumbnail(Yii::app()->basePath . '/../' . $this->filename,150,150);
                    break;

                case 'portfolio':
                    $reducedImage = new ResizeImage();
                    $reducedImage->originalFile = $this->instance->tempName;
                    $reducedImage->saveThumbnail(Yii::app()->basePath . '/../' . $this->getThumbnailFile(),100,100);
                    $reducedImage->maximumSize = 800;
                    $reducedImage->resize();
                    $reducedImage->save(Yii::app()->basePath . '/../' . $this->filename);
                    break;

                default:
                    $this->instance->saveAs(Yii::app()->basePath . '/../' . $this->filename);
            }
        }
        return parent::beforeValidate();
    }

    /**
     * After delete entry on the database, remove the actual file.
     */
    public function afterDelete() {
        unlink(Yii::app()->basePath . '/../' . $this->filename);
        if (file_exists(Yii::app()->basePath . '/../' . $this->getThumbnailFile())) unlink(Yii::app()->basePath . '/../' . $this->getThumbnailFile());
        return parent::afterDelete();
    }

    /**
     * Gets the thumbnail file location based on it's original filename.
     * @return string filename of the thumbnail file.
     */
    public function getThumbnailFile() {
        return Yii::app()->params['uploadFolder'] . 'thumb_' . substr($this->filename,strlen(Yii::app()->params['uploadFolder']));
    }

}