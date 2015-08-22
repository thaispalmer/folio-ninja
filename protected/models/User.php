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
 * @property Folder[] $folders
 * @property Project[] $projects
 * @property Subscription[] $subscriptions
 * @property Picture $picture
 * @property UsersPerTeam[] $usersPerTeams
 * @property Portfolio $portfolio
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

    public $newPassword, $currentPassword, $confirmPassword, $verifyCode, $profilePicture;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, alias, email', 'required', 'on'=>'insert,profile'),
			array('password, confirmPassword', 'required', 'on'=>'insert'),

            array('first_name, last_name', 'length', 'max'=>50),
            array('alias, email', 'unique'),
			array('alias', 'length', 'max'=>32, 'min'=>4),
            array('alias', 'checkReserved'),
            array('email', 'length', 'max'=>255),
            array('confirmPassword', 'safe'),

            array('profilePicture', 'file', 'types'=>'jpg, jpeg, gif, png', 'allowEmpty'=>true, 'on'=>'profile'),

            array('password', 'length', 'max'=>32, 'min'=>6, 'on'=>'insert'),
            array('password', 'compare', 'compareAttribute'=>'confirmPassword', 'on'=>'insert'),
            array('password', 'match', 'pattern'=>'/^[a-zA-Z0-9]+$/', 'on'=>'insert'),

            array('currentPassword', 'required', 'on'=>'security'),
            array('currentPassword', 'validatePassword', 'on'=>'security'),
            array('newPassword, confirmPassword', 'required', 'on'=>'security'),
            array('newPassword', 'length', 'max'=>32, 'min'=>6, 'on'=>'security'),
            array('newPassword', 'compare', 'compareAttribute'=>'confirmPassword', 'on'=>'security'),
            array('newPassword', 'match', 'pattern'=>'/^[a-zA-Z0-9]+$/', 'on'=>'security'),

            array('verifyCode','captcha','allowEmpty' => ! CCaptcha::checkRequirements(), 'on'=>'insert'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, level, email, alias, first_name, last_name', 'safe', 'on'=>'search'),
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
			'folders' => array(self::HAS_MANY, 'Folder', 'user_id'),
			'projects' => array(self::HAS_MANY, 'Project', 'user_id'),
			'subscriptions' => array(self::HAS_MANY, 'Subscription', 'user_id'),
			'picture' => array(self::BELONGS_TO, 'Picture', 'picture_id'),
			'usersPerTeams' => array(self::HAS_MANY, 'UsersPerTeam', 'user_id'),
			'portfolio' => array(self::HAS_ONE, 'Portfolio', 'user_id'),
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
            'currentPassword' => 'Current Password',
            'newPassword' => 'New Password',
			'confirmPassword' => 'Confirm Password',
			'verifyCode' => 'Verify Code',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'picture_id' => 'Picture',
            'profilePicture' => 'Profile picture'
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

    /**
     * After validation function to check when it should encode the password.
     */
    public function afterValidate()
    {
        if ($this->scenario == 'insert') $this->password = Bcrypt::encode($this->password);
        if ($this->scenario == 'security') $this->password = Bcrypt::encode($this->newPassword);
        return parent::afterValidate();
    }

    /**
     * Before saving, strip all html tags and safe encode the text.
     */
    public function beforeSave() {
        $this->first_name = CHtml::encode(strip_tags($this->first_name));
        $this->last_name = CHtml::encode(strip_tags($this->last_name));
        $this->alias = CHtml::encode(strip_tags($this->alias));
        $this->email = CHtml::encode(strip_tags($this->email));
        return parent::beforeSave();
    }

    /**
     * After saving, if the user has been created now, we create the portfolio settings for it.
     */
    public function afterSave() {
        if ($this->scenario == 'insert') {
            $portfolio = new Portfolio;
            $portfolio->user_id = $this->id;
            $portfolio->save();
        }
        return parent::afterSave();
    }

    /**
     * Check if the current password matches the one on record.
     */
    public function validatePassword($attribute)
    {
        if ($this->$attribute && !Bcrypt::match($this->$attribute, $this->password))
            $this->addError($attribute, "Current password doesn't match.");
    }

    /**
     * Check if the alias is a reserved name or not, permitting to be registered.
     */
    public function checkReserved($attribute) {
        $reserved = array(
            'webmail',
            'dashboard',
            'site',
            'portfolio',
            'discover',
            'team',
            'logout',
            'index',
            'about',
            'login',
            'signup',
            'www',
            'beta',
            'mail',
            'blog',
            'dev',
        );
        if (in_array($this->$attribute,$reserved))
            $this->addError($attribute, "This alias can't be used.");
    }
}
