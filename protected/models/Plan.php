<?php

/**
 * This is the model class for table "plan".
 *
 * The followings are the available columns in table 'plan':
 * @property integer $id
 * @property string $title
 * @property string $sku
 * @property string $price
 * @property integer $duration_in_days
 * @property integer $projects
 * @property integer $pictures_per_project
 * @property integer $videos_per_project
 * @property integer $links_per_project
 * @property integer $teams
 * @property integer $users_per_team
 *
 * The followings are the available model relations:
 * @property Subscription[] $subscriptions
 */
class Plan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'plan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, sku, price, duration_in_days', 'required'),
			array('duration_in_days, projects, pictures_per_project, videos_per_project, links_per_project, teams, users_per_team', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>50),
			array('sku, price', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, sku, price, duration_in_days, projects, pictures_per_project, videos_per_project, links_per_project, teams, users_per_team', 'safe', 'on'=>'search'),
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
			'subscriptions' => array(self::HAS_MANY, 'Subscription', 'plan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'sku' => 'Sku',
			'price' => 'Price',
			'duration_in_days' => 'Duration In Days',
			'projects' => 'Projects',
			'pictures_per_project' => 'Pictures Per Project',
			'videos_per_project' => 'Videos Per Project',
			'links_per_project' => 'Links Per Project',
			'teams' => 'Teams',
			'users_per_team' => 'Users Per Team',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('sku',$this->sku,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('duration_in_days',$this->duration_in_days);
		$criteria->compare('projects',$this->projects);
		$criteria->compare('pictures_per_project',$this->pictures_per_project);
		$criteria->compare('videos_per_project',$this->videos_per_project);
		$criteria->compare('links_per_project',$this->links_per_project);
		$criteria->compare('teams',$this->teams);
		$criteria->compare('users_per_team',$this->users_per_team);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Plan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
