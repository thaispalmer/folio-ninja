<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $level
 * @property string $email
 * @property string $alias
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property integer $picture_id
 *
 * The followings are the available model relations:
 * @property Group[] $groups
 * @property Project[] $projects
 * @property Subscription[] $subscriptions
 * @property Picture $picture
 * @property UsersPerTeam[] $usersPerTeams
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, alias, password, first_name, last_name', 'required'),
			array('picture_id', 'numerical', 'integerOnly'=>true),
			array('level', 'length', 'max'=>5),
			array('email', 'length', 'max'=>255),
			array('alias, password', 'length', 'max'=>32),
			array('first_name, last_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, level, email, alias, password, first_name, last_name, picture_id', 'safe', 'on'=>'search'),
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
			'groups' => array(self::HAS_MANY, 'Group', 'user_id'),
			'projects' => array(self::HAS_MANY, 'Project', 'user_id'),
			'subscriptions' => array(self::HAS_MANY, 'Subscription', 'user_id'),
			'picture' => array(self::BELONGS_TO, 'Picture', 'picture_id'),
			'usersPerTeams' => array(self::HAS_MANY, 'UsersPerTeam', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'level' => 'Level',
			'email' => 'Email',
			'alias' => 'Alias',
			'password' => 'Password',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'picture_id' => 'Picture',
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
		$criteria->compare('level',$this->level,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('picture_id',$this->picture_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
