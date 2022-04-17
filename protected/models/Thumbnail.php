<?php

/**
 * This is the model class for table "thumbnail".
 *
 * The followings are the available columns in table 'thumbnail':
 * @property integer $id
 * @property integer $file_id
 * @property string $path
 * @property string $filename
 */
class Thumbnail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'thumbnail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file_id', 'numerical', 'integerOnly' => true),
			array('path', 'length', 'max' => 50),
			array('filename', 'length', 'max' => 500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, file_id, path, filename', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'file_id' => 'File',
			'path' => 'Path',
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('file_id', $this->file_id);
		$criteria->compare('path', $this->path, true);
		$criteria->compare('filename', $this->filename, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function get_exist($id)
	{

		$sql = $this->model()->findBySql('
		SELECT file_id AS file_id FROM thumbnail a
        WHERE file_id = "' . $id . '"
		
		');

		return $sql->file_id;
	}

	public function get_thumbnail($id)
	{

		$sql = $this->model()->findBySql('
		SELECT path AS path,filename AS filename FROM thumbnail a
        WHERE file_id = "' . $id . '"
		
		');

		return $sql->path . $sql->filename;
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Thumbnail the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
