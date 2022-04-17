<?php

/**
 * This is the model class for table "file_upload".
 *
 * The followings are the available columns in table 'file_upload':
 *
 * @property int    $id
 * @property string $reference
 * @property string $title
 * @property string $path
 * @property string $filename
 * @property string $format
 * @property int    $created_by
 * @property string $created_at
 */
class FileUpload extends CActiveRecord
{
    // public $filecategory;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'file_upload';
    }

    public $datetranfrom;
    public $datetranto;
    /**
     * @return array validation rules for model attributes
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['created_by,filecategory,filesizeraw', 'numerical', 'integerOnly' => true],
            ['reference', 'length', 'max' => 100],
            ['title', 'length', 'max' => 255],
            ['path, filename, type, product', 'length', 'max' => 155],
            ['format,filesize', 'length', 'max' => 50],
            ['tags, filelength,company', 'length', 'max' => 500],
            ['created_at,description,date_transaction,restored_date,deleted_at', 'safe'],

            ['datetranfrom, datetranto, id, reference, title,filecategory,company, date_transaction, restored_date, deleted_at, filesizeraw,path, filename, format, created_by, type, product,tags, filesize, filelength,description', 'safe', 'on' => 'search'],
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
            'reference' => 'Reference',
            'title' => 'Title',
            'path' => 'Path',
            'filename' => 'Filename',
            'format' => 'Format',
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
    public function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public function categoryname($type)
    {
        if ($type == 1) {
            return "Documents"; //Document
        }
        if ($type == 2) {
            return "Image"; //Document
        }
        if ($type == 3) {
            return "Sound"; //Document
        }
        if ($type == 4) {
            return "Video"; //Document
        }
    }
    public function imageType($type)
    {
        if (
            $type == 'pdf' || $type == 'odt' || $type == 'doc' || $type == 'docx' || $type == 'xls' || $type == 'xlsx' || $type == 'ppt' || $type == 'pptx' || $type == 'txt'
            || $type == 'rdf' || $type == 'fnt' || $type == 'app' || $type == 'cfg' || $type == 'word' || $type == 'vcd' || $type == 'dat' || $type == 'vts' || $type == 'ifo' || $type == 'dat' || $type == 'psd'
        ) {
            return 1; //Document
        }
        if ($type == 'jpg' || $type == 'png' || $type == 'jpeg' || $type == 'gif') {
            return 2; //Image
        }
        if ($type == 'mp4' || $type == 'avi' || $type == 'mov') {
            return 3; //Video
        }
        if ($type == 'm4a' || $type == 'flac' || $type == 'mp3' || $type == 'wav' || $type == 'wma' || $type == 'aac') {
            return 4; //Sound
        }
    }

    public function getDataExist($id)
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('id = ' . $id . ' ');

        // print_r($criteria);
        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

    public function search_list_client($data)
    {
        $criteria = new CDbCriteria();

        if($data['yt0'] == "" && $data['FileUpload']['pagination'] == ""){
            $pagesizes = 10;
            // echo "pagesizes" . $pagesizes;
        }else{
            if ($data['FileUpload']['pagination'] == "") {
                $pagesizes = 50000;
            } else {
                $pagesizes = $data['FileUpload']['pagination'];
            }
      
        }

    

        if ($data['FileUpload']['title'] != '') {
            $criteria->addCondition('title = ' . $data['FileUpload']['title'] . '');
        }
        if ($data['FileUpload']['tags'] != '') {
            $criteria->addCondition('tags like "%' . $data['FileUpload']['tags'] . '%"');
        }
        if ($data['FileUpload']['filecategory'] != '') {
            $criteria->addCondition('filecategory = ' . $data['FileUpload']['filecategory'] . '');
        }
        if ($data['FileUpload']['datetranfrom'] != '' || $data['FileUpload']['datetranto'] != '') {
            $criteria->addCondition('date_transaction >= "' . $data['FileUpload']['datetranfrom'] . '" and date_transaction <= "' . $data['FileUpload']['datetranto'] . '"');
        }

        $criteria->addCondition('deleted_at is null');

        // print_r($criteria);
        $criteria->order = 'id DESC, ABS(title) ASC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => $pagesizes
            ),
        ]);
    }

    public function search($data)
    {
        $criteria = new CDbCriteria();

        if ($data['fileUpload']['filecategory'] != '') {
            if ($data['fileUpload']['filecategory'] == '100') {
                $criteria->addCondition('filecategory in (1,2,3,4)');
            } else {
                $criteria->addCondition('filecategory = ' . $data['fileUpload']['filecategory'] . '');
            }
        }
        if ($data['fileUpload']['tags'] != '') {
            $criteria->addCondition('tags like "%' . $data['fileUpload']['tags'] . '%" or title like "%' . $data['fileUpload']['tags'] . '%"');
        }

        $criteria->addCondition('deleted_at is null');

        // print_r($criteria);
        $criteria->order = 'id DESC, ABS(title) ASC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

    public function search_delete($data)
    {
        $criteria = new CDbCriteria();
        // echo 'asdasd'.$data['fileUpload']['filecategory'];
        // $criteria->compare('id', $this->id);
        // $criteria->compare('reference', $this->reference, true);
        // $criteria->compare('title', $this->title, true);
        // $criteria->compare('path', $this->path, true);
        // $criteria->compare('filename', $this->filename, true);
        // $criteria->compare('format', $this->format, true);
        // $criteria->compare('created_by', $this->created_by);
        if ($data['fileUpload']['filecategory'] != '') {
            if ($data['fileUpload']['filecategory'] == '100') {
                $criteria->addCondition('filecategory in (1,2,3,4)');
            } else {
                $criteria->addCondition('filecategory = ' . $data['fileUpload']['filecategory'] . '');
            }
        }
        if ($data['fileUpload']['tags'] != '') {
            $criteria->addCondition('tags like "%' . $data['fileUpload']['tags'] . '%" or title like "%' . $data['fileUpload']['tags'] . '%"');
        }

        $criteria->addCondition('deleted_at is not null');

        // print_r($criteria);
        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => false,
        ]);
    }

    public function search_client($data)
    {

        if ($data['fileUpload']['pagination'] == "") {
            $pagesize = 10;
        } else {
            $pagesize = $data['fileUpload']['pagination'];
        }
        $criteria = new CDbCriteria();
        if ($data['fileUpload']['filecategory'] != '') {
            if ($data['fileUpload']['filecategory'] == '100') {
                $criteria->addCondition('filecategory in (1,2,3,4)');
            } else {
                $criteria->addCondition('filecategory = ' . $data['fileUpload']['filecategory'] . '');
            }
        }
        if ($data['fileUpload']['tags'] != '') {
            $criteria->addCondition('tags like "%' . $data['fileUpload']['tags'] . '%" or title like "%' . $data['fileUpload']['tags'] . '%"');
        }
        $criteria->addCondition('deleted_at is null');

        // print_r($criteria);
        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'pagination' => ['pageSize' => $pagesize],
        ]);
    }

    public function get_recent_project($email)
    {
        $user_type = Users::model()->get_type_by_email(Yii::app()->user->name);

        if ($user_type != 1) {
            $emailcon = ' and b.user_email = "' . $email . '"';
        }

        $datenow = date('Y-m-d');

        $sql = $this->model()->findBySql('
		SELECT COUNT(a.id) AS reference FROM file_upload a
		LEFT JOIN users b ON b.id = a.created_by
		WHERE a.id is not null 
        #' . $emailcon . ' 
        and a.created_at >= "' . date('Y-m-d', strtotime($datenow . ' - 3 days')) . ' 00:00:00"
        and deleted_at is null
		');

        return $sql->reference;
    }

    public function get_all_project($email)
    {
        $datenow = date('Y-m-d');

        if ($user_type != 1) {
            $emailcon = ' WHERE b.user_email = "' . $email . '"';
        }

        $sql = $this->model()->findBySql('
		SELECT COUNT(a.id) AS reference FROM file_upload a
        WHERE deleted_at is null

		#LEFT JOIN users b ON b.id = a.created_by
		#' . $emailcon . '
		
		');

        return $sql->reference;
    }

    public function get_disk_usage($email)
    {
        $datenow = date('Y-m-d');

        $sql = $this->model()->findBySql('
		SELECT SUM(a.filesizeraw) AS reference FROM file_upload a
        WHERE deleted_at is null
		#LEFT JOIN users b ON b.id = a.created_by
		#WHERE b.user_email = "' . $email . '" 
		');

        return $this->formatSizeUnits($sql->reference);
    }

    public function get_all_file_type($email, $data)
    {
        if ($data['fileUpload']['tags'] != '') {
            $criteriaCond = ' and (tags like "%' . $data['fileUpload']['tags'] . '%" or title like "%' . $data['fileUpload']['tags'] . '%")';
        }

        $sql = $this->model()->findBySql('
		SELECT count(a.id) AS reference FROM file_upload a
        WHERE deleted_at is null
		#LEFT JOIN users b ON b.id = a.created_by
		' . $criteriaCond . '
        #b.user_email = "' . $email . '" 
		');

        return $sql->reference;
    }

    public function get_diff_file_type($email, $type, $data)
    {
        if ($data['fileUpload']['tags'] != '') {
            $criteriaCond = ' and (tags like "%' . $data['fileUpload']['tags'] . '%" or title like "%' . $data['fileUpload']['tags'] . '%")';
        }
        $sql = $this->model()->findBySql('
		SELECT count(a.id) AS reference FROM file_upload a
		#LEFT JOIN users b ON b.id = a.created_by
		WHERE 
        #b.user_email = "' . $email . '" 
        a.filecategory = ' . $type . ' ' . $criteriaCond . '
        and deleted_at is null
		
		');

        return $sql->reference;
    }

    public function get_title($id)
    {
        $sql = $this::model()->findByAttributes(['id' => $id]);

        return $sql->title;
    }

    public function get_filename($id)
    {
        $sql = $this::model()->findByAttributes(['id' => $id]);

        return $sql->filename;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name
     *
     * @return FileUpload the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
