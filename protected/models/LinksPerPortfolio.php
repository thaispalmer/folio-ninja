<?php

/**
 * This is the model class for table "links_per_portfolio".
 *
 * The followings are the available columns in table 'links_per_portfolio':
 * @property integer $id
 * @property integer $portfolio_id
 * @property string $type
 * @property string $url
 *
 * The followings are the available model relations:
 * @property Portfolio $portfolio
 */
class LinksPerPortfolio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'links_per_portfolio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('portfolio_id, url', 'required'),
			array('portfolio_id', 'numerical', 'integerOnly'=>true),
            array('url', 'url', 'defaultScheme'=>'http'),
            array('type', 'in', 'range'=>array(
                'Facebook', 'Google Plus', 'LinkedIn',
                'YouTube', 'Vimeo',
            ),'allowEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, portfolio_id, type, url', 'safe', 'on'=>'search'),
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
			'portfolio' => array(self::BELONGS_TO, 'Portfolio', 'portfolio_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'portfolio_id' => 'Portfolio',
			'type' => 'Type',
			'url' => 'Url',
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
		$criteria->compare('portfolio_id',$this->portfolio_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LinksPerPortfolio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Before saving, strip all html tags and safe encode the text.
     */
    public function beforeSave() {
        $this->url = CHtml::encode(strip_tags($this->url));
        return parent::beforeSave();
    }
}
