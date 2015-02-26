<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
    /*
	public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
    */

    private $emailOrAlias;
    private $_id, $_email, $_level;

    /**
     * Constructor.
     * @param string $emailOrAlias email or alias
     * @param string $password password
     */
    public function __construct($emailOrAlias,$password)
    {
        $this->emailOrAlias=$emailOrAlias;
        $this->password=$password;
    }

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $criteria = new CDbCriteria;
        $criteria->compare('email',$this->emailOrAlias,false,'OR');
        $criteria->compare('alias',$this->emailOrAlias,false,'OR');
        $record = User::model()->find($criteria);
        if($record === null){
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif (!Bcrypt::match($this->password, $record->password)){
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id=$record->id;
            $this->_email=$record->email;
            $this->_level=$record->level;
            $this->setState('level', $record->level);
            $this->setState('firstName', $record->first_name);
            $this->setState('alias', $record->alias);
            if (!empty($record->picture)) $this->setState('profilePicture', Yii::app()->baseUrl.$record->picture->filename);
            else $this->setState('profilePicture',Yii::app()->baseUrl.'/images/default-user.png');
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

    public function getLevel() {
        return $this->_level;
    }

}