<?php

/**
 * This is the model class for table "history_logs".
 *
 * The followings are the available columns in table 'history_logs':
 *
 * @property int    $id
 * @property string $logs
 * @property int    $created_by
 * @property string $created_at
 */
class HistoryLogs extends CActiveRecord
{
    public $from;
    public $to;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'history_logs';
    }

    /**
     * @return array validation rules for model attributes
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['created_by', 'numerical', 'integerOnly' => true],
            ['created_at,logs', 'safe'],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, logs, created_by, created_at, from, to', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array relational rules
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'logs' => 'Logs',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
        ];
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
     *                             based on the search/filter conditions
     */
    public function search($data)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria();

        // $criteria->compare('id', $this->id);
        // $criteria->compare('logs', $this->logs, true);
        // $criteria->compare('created_by', $this->created_by);
        // $criteria->compare('created_at', $this->created_at, true);
        if ($data['HistoryLogs']['logs'] != '') {
            $criteria->addCondition('logs like "%'.$data['HistoryLogs']['logs'].'%"');
        }
        if ($data['HistoryLogs']['from'] != '' || $data['HistoryLogs']['to'] != '') {
            $criteria->addCondition('created_at >= "'.date('Y-m-d', strtotime($data['HistoryLogs']['from'])).' 00:00:00" and created_at <= "'.date('Y-m-d', strtotime($data['HistoryLogs']['to'])).' 23:59:59" ');
        }
        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

    public function search_client($data)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $id = Users::model()->get_id_by_email(Yii::app()->user->name);

        $criteria = new CDbCriteria();

        // $criteria->compare('id', $this->id);
        // $criteria->compare('logs', $this->logs, true);
        // $criteria->compare('created_by', $this->created_by);
        // $criteria->compare('created_at', $this->created_at, true);
        if ($data['HistoryLogs']['logs'] != '') {
            $criteria->addCondition('logs like "%'.$data['HistoryLogs']['logs'].'%"');
        }
        if ($data['HistoryLogs']['from'] != '' || $data['HistoryLogs']['to'] != '') {
            $criteria->addCondition('created_at >= "'.date('Y-m-d', strtotime($data['HistoryLogs']['from'])).' 00:00:00" and created_at <= "'.date('Y-m-d', strtotime($data['HistoryLogs']['to'])).' 23:59:59" ');
        }
        $criteria->addCondition('created_by = "'.$id.'"');

        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name
     *
     * @return HistoryLogs the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
