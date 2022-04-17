<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 *
 * @property int    $id
 * @property string $user_fullname
 * @property string $user_company
 * @property string $user_email
 * @property string $user_password
 * @property int    $user_role
 * @property string $created_at
 */
class Users extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['user_role', 'numerical', 'integerOnly' => true],
            ['user_fullname', 'length', 'max' => 255],
            ['user_company,user_password_decrypt,user_department, user_email, user_password', 'length', 'max' => 100],
            ['created_at', 'safe'],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, user_fullname, user_department, user_password_decrypt, user_company, user_email, user_password, user_role, created_at', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array relational rules
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_fullname' => 'User Fullname',
            'user_company' => 'User Company',
            'user_email' => 'User Email',
            'user_password' => 'User Password',
            'user_role' => 'User Role',
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
        // print_r($data);

        $criteria = new CDbCriteria();

        $criteria->compare('id', $this->id);
        $criteria->compare('user_fullname', $data['Users']['user_fullname'], true);
        $criteria->compare('user_company', $data['Users']['user_company'], true);
        $criteria->compare('user_email', $data['Users']['user_email'], true);
        $criteria->compare('user_role', $data['Users']['user_role'], true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

    public function get_fullname_by_id($id)
    {
        $sql = $this::model()->findByAttributes(['id' => $id]);

        return $sql->user_fullname;
    }

    public function get_type_by_email($username)
    {
        $sql = $this::model()->findByAttributes(['user_email' => $username]);

        return $sql->user_role;
    }

    public function get_type_by_fullname($username)
    {
        $sql = $this::model()->findByAttributes(['user_email' => $username]);

        return $sql->user_fullname;
    }

    public function get_id_by_email($username)
    {
        $sql = $this::model()->findByAttributes(['user_email' => $username]);

        return $sql->id;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name
     *
     * @return Users the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
