<?php

/**
 * This is the model class for table "videos_per_project".
 *
 * The followings are the available columns in table 'videos_per_project':
 * @property integer $id
 * @property integer $project_id
 * @property string $url
 * @property string $title
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Project $project
 */
class VideosPerProject extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'videos_per_project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_id, url', 'required'),
			array('project_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>50),
			array('description', 'safe'),
            array('url', 'serviceValidator'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, url, title, description', 'safe', 'on'=>'search'),
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
			'project_id' => 'Project',
			'url' => 'Video URL',
			'title' => 'Title',
			'description' => 'Description',
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
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('url',$this->url,true);
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
	 * @return VideosPerProject the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Before saving, strip all html tags and safe encode the text.
     */
    public function beforeSave() {
        if (!empty($this->title)) $this->title = CHtml::encode(strip_tags($this->title));
        if (!empty($this->description)) $this->description = CHtml::encode(strip_tags($this->description));
        return parent::beforeSave();
    }

    /**
     * Check if the model's url belongs to one of the services supported:
     * - Youtube
     * - Vimeo
     * @return array[] [0] string service name, [1] string the ID of the video - null if not supported
     */
    public function verifyOrigin($url = null) {
        if (!$url) $url = $this->url;

        // Youtube
        preg_match("/^http[s]?:\/\/(www.)?(youtube).com\/(watch\?v=|embed\/|v\/)([0-9a-zA-Z-_]+)(&.*+|\?.*+)?$/",$url,$match);
        if (!empty($match)) return array($match[2],$match[4]);

        // Vimeo
        preg_match("/^http[s]?:\/\/(www.)?(vimeo).com\/([0-9]+)\/?$/",$url,$match);
        if (!empty($match)) return array($match[2],$match[3]);

        return null;
    }

    /**
     * Custom validator to check if the url is a valid url from the services supported.
     */
    public function serviceValidator($attribute) {
        if (!VideosPerProject::verifyOrigin($this->$attribute))
            $this->addError($attribute, 'Please insert a valid video URL from one of the supported services.');
    }

    /**
     * Render embedded video depending of it's service.
     * @return string the HTML of the player.
     */
    public function renderPlayer() {
        $video = $this->verifyOrigin();
        if (empty($video)) return 'Invalid Video';

        // Youtube
        if ($video[0] == 'youtube') {
            return "
<div id=\"ytplayer\"></div>
<script>
  // Load the IFrame Player API code asynchronously.
  var tag = document.createElement('script');
  tag.src = \"https://www.youtube.com/player_api\";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  // Replace the 'ytplayer' element with an <iframe> and
  // YouTube player after the API code downloads.
  var player;
  function onYouTubePlayerAPIReady() {
    player = new YT.Player('ytplayer', {
      width: '100%',
      videoId: '".$video[1]."',
      playerVars: { autohide: 1 }
    });
  }
</script>
";
        }

        // Vimeo
        elseif ($video[0] == 'vimeo') {
            return '<iframe src="//player.vimeo.com/video/'.$video[1].'" width="100%" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        }

        return null;
    }

    /**
     * Gets the thumbnail url based on it's service.
     * @return string url of the thumbnail.
     */
    public function getThumbnailUrl() {
        $video = $this->verifyOrigin();
        if (empty($video)) return null;

        // Youtube
        if ($video[0] == 'youtube') return 'http://img.youtube.com/vi/'.$video[1].'/default.jpg';

        // Vimeo
        elseif ($video[0] == 'vimeo') {
            $hash = unserialize(file_get_contents('http://vimeo.com/api/v2/video/'.$video[1].'.php'));
            return $hash[0]['thumbnail_small'];
        }

        return null;
    }
}
