<?php

class FileUploadController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     *             using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        ];
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return [
            [
                'allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => ['index', 'view'],
                'users' => ['*'],
            ],
            [
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => ['create', 'update'],
                'users' => ['@'],
            ],
            [
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => ['deletePermTran','admin', 'delete', 'upload', 'ViewDetails', 'deletetran', 'UpdateTran', 'admin_client', 'admin_trash', 'restoreTran', 'insertlog', 'AdminListClient'],
                'users' => ['@'],
            ],
            [
                'deny',  // deny all users
                'users' => ['*'],
            ],
        ];
    }

    public function actionInsertlog()
    {
        $modelHistory = new HistoryLogs();
        if ($_POST['type'] == 1) {
            $modelHistory->logs = 'View File with the title of "'.FileUpload::model()->get_title($_POST['id']).'" ';
        }
        if ($_POST['type'] == 2) {
            $modelHistory->logs = 'Downloaded File with the title of "'.FileUpload::model()->get_title($_POST['id']).'" ; Filename Downloaded : "'.FileUpload::model()->get_filename($_POST['id']).'"';
        }
        $modelHistory->created_at = date('Y-m-d H:i:s');
        $modelHistory->created_by = Users::model()->get_id_by_email(Yii::app()->user->name);
        $modelHistory->save();
    }

    public function actionViewDetails()
    {
    }

    public function actionUpload()
    {
        $upload = 'err';
        if (!empty($_FILES['file'])) {
            // File upload configuration
            $targetDir = 'uploads/';
            $allowTypes = [
                'pdf', 'odt', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt',
                'jpg', 'png', 'jpeg', 'gif', 'mp4', 'avi', 'mov', 'm4a', 'flac', 'mp3', 'wav', 'wma', 'aac',
                'rdf', 'fnt', 'app', 'cfg', 'word', 'vcd', 'dat', 'vts', 'ifo', 'dat', 'psd',
            ];

            $fileName = basename($_FILES['file']['name']);
            $targetFilePath = $targetDir.$fileName;

            $arrayfileName = explode('.', $_FILES['image']['name']);
            $extensionfileName = end($arrayfileName);

            $size = filesize($_FILES['file']['tmp_name']); // bytes
            $filesize = FileUpload::model()->formatSizeUnits($size); // megabytes with 1 digit

            // Check whether file type is valid
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to the server
                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                    $upload = 'ok';

                    $model = new FileUpload();
                    $model->title = trim($_POST['FileUpload']['title']);
                    $model->company = trim($_POST['FileUpload']['company']);
                    $model->type = trim($_POST['FileUpload']['type']);
                    $model->product = trim($_POST['FileUpload']['product']);
                    $model->description = trim($_POST['FileUpload']['description']);
                    $model->tags = trim($_POST['FileUpload']['tags']);
                    $model->filelength = trim($_POST['FileUpload']['filelength']);
                    $model->date_transaction = trim($_POST['FileUpload']['date_transaction']);
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->created_by = Users::model()->get_id_by_email(Yii::app()->user->name);
                    $model->filecategory = FileUpload::model()->imageType($fileType);
                    $model->filesize = $filesize;
                    $model->filesizeraw = $size;
                    $model->path = $targetDir;
                    $model->filename = $fileName;
                    $model->format = $fileType;

                    $model->save();

                    $modelHistory = new HistoryLogs();
                    $modelHistory->logs = 'Upload File with the title of "'.trim($_POST['FileUpload']['title']).'"';
                    $modelHistory->created_at = date('Y-m-d H:i:s');
                    $modelHistory->created_by = Users::model()->get_id_by_email(Yii::app()->user->name);
                    $modelHistory->save();

                    // echo json_encode($model->getErrors());
                }
            }
        }
        echo $upload;

        // $model=new FileUpload;

        // // Uncomment the following line if AJAX validation is needed
        // // $this->performAjaxValidation($model);

        // if(isset($_POST['FileUpload']))
        // {
        // 	$model->attributes=$_POST['FileUpload'];
        // 	if($model->save())
        // 		$this->redirect(array('view','id'=>$model->id));
        // }

        // $this->render('create',array(
        // 	'model'=>$model,
        // ));
    }

    public function mime_type($filename)
    {
        $mime_types = [
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'css' => 'text/css',
            'json' => ['application/json', 'text/json'],
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            'hqx' => 'application/mac-binhex40',
            'cpt' => 'application/mac-compactpro',
            'csv' => ['text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel'],
            'bin' => 'application/macbinary',
            'dms' => 'application/octet-stream',
            'lha' => 'application/octet-stream',
            'lzh' => 'application/octet-stream',
            'exe' => ['application/octet-stream', 'application/x-msdownload'],
            'class' => 'application/octet-stream',
            'so' => 'application/octet-stream',
            'sea' => 'application/octet-stream',
            'dll' => 'application/octet-stream',
            'oda' => 'application/oda',
            'ps' => 'application/postscript',
            'smi' => 'application/smil',
            'smil' => 'application/smil',
            'mif' => 'application/vnd.mif',
            'wbxml' => 'application/wbxml',
            'wmlc' => 'application/wmlc',
            'dcr' => 'application/x-director',
            'dir' => 'application/x-director',
            'dxr' => 'application/x-director',
            'dvi' => 'application/x-dvi',
            'gtar' => 'application/x-gtar',
            'gz' => 'application/x-gzip',
            'php' => 'application/x-httpd-php',
            'php4' => 'application/x-httpd-php',
            'php3' => 'application/x-httpd-php',
            'phtml' => 'application/x-httpd-php',
            'phps' => 'application/x-httpd-php-source',
            'js' => ['application/javascript', 'application/x-javascript'],
            'sit' => 'application/x-stuffit',
            'tar' => 'application/x-tar',
            'tgz' => ['application/x-tar', 'application/x-gzip-compressed'],
            'xhtml' => 'application/xhtml+xml',
            'xht' => 'application/xhtml+xml',
            'bmp' => ['image/bmp', 'image/x-windows-bmp'],
            'gif' => 'image/gif',
            'jpeg' => ['image/jpeg', 'image/pjpeg'],
            'jpg' => ['image/jpeg', 'image/pjpeg'],
            'jpe' => ['image/jpeg', 'image/pjpeg'],
            'png' => ['image/png', 'image/x-png'],
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'shtml' => 'text/html',
            'text' => 'text/plain',
            'log' => ['text/plain', 'text/x-log'],
            'rtx' => 'text/richtext',
            'rtf' => 'text/rtf',
            'xsl' => 'text/xml',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'word' => ['application/msword', 'application/octet-stream'],
            'xl' => 'application/excel',
            'eml' => 'message/rfc822',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => ['application/x-zip', 'application/zip', 'application/x-zip-compressed'],
            'rar' => 'application/x-rar-compressed',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mid' => 'audio/midi',
            'midi' => 'audio/midi',
            'mpga' => 'audio/mpeg',
            'mp2' => 'audio/mpeg',
            'mp3' => ['audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3'],
            'aif' => 'audio/x-aiff',
            'aiff' => 'audio/x-aiff',
            'aifc' => 'audio/x-aiff',
            'ram' => 'audio/x-pn-realaudio',
            'rm' => 'audio/x-pn-realaudio',
            'rpm' => 'audio/x-pn-realaudio-plugin',
            'ra' => 'audio/x-realaudio',
            'rv' => 'video/vnd.rn-realvideo',
            'wav' => ['audio/x-wav', 'audio/wave', 'audio/wav'],
            'mpeg' => 'video/mpeg',
            'mpg' => 'video/mpeg',
            'mpe' => 'video/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',
            'avi' => 'video/x-msvideo',
            'movie' => 'video/x-sgi-movie',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => ['image/vnd.adobe.photoshop', 'application/x-photoshop'],
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => ['application/excel', 'application/vnd.ms-excel', 'application/msexcel'],
            'ppt' => ['application/powerpoint', 'application/vnd.ms-powerpoint'],

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        ];

        $ext = explode('.', $filename);
        $ext = strtolower(end($ext));

        if (array_key_exists($ext, $mime_types)) {
            return (is_array($mime_types[$ext])) ? $mime_types[$ext][0] : $mime_types[$ext];
        } elseif (function_exists('finfo_open')) {
            if (file_exists($filename)) {
                $finfo = finfo_open(FILEINFO_MIME);
                $mimetype = finfo_file($finfo, $filename);
                finfo_close($finfo);

                return $mimetype;
            }
        }

        return 'application/octet-stream';
    }

    /**
     * Displays a particular model.
     *
     * @param int $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', [
            'model' => $this->loadModel($id),
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new FileUpload();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['FileUpload'])) {
            $model->attributes = $_POST['FileUpload'];
            if ($model->save()) {
                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id the ID of the model to be updated
     */
    public function actionUpdateTran()
    {
        // print_r($_FILES['file']['name']);
        if (isset($_POST['FileUpload'])) {
            $data = FileUpload::model()->getDataExist($_POST['FileUpload']['id']);

            $title = '';
            $company = '';
            $type = '';
            $product = '';
            $description = '';
            $tags = '';
            $date_transaction = '';
            $filesizeexist = '';

            foreach ($data->getData() as $val) {
                if ($val['title'] != trim($_POST['FileUpload']['title'])) {
                    $title = 'Change Title "'.$val['title'].'" to "'.trim($_POST['FileUpload']['title']).'";';
                }
                if ($val['company'] != trim($_POST['FileUpload']['company'])) {
                    $company = 'Change Company "'.$val['company'].'" to "'.trim($_POST['FileUpload']['company']).'";';
                }
                if ($val['type'] != trim($_POST['FileUpload']['type'])) {
                    $type = 'Change Type "'.$val['type'].'" to "'.trim($_POST['FileUpload']['type']).'";';
                }
                if ($val['product'] != trim($_POST['FileUpload']['product'])) {
                    $product = 'Change Product "'.$val['product'].'" to "'.trim($_POST['FileUpload']['product']).'";';
                }
                if ($val['description'] != trim($_POST['FileUpload']['description'])) {
                    $description = 'Change Description "'.$val['description'].'" to "'.trim($_POST['FileUpload']['description']).'";';
                }
                if ($val['tags'] != trim($_POST['FileUpload']['tags'])) {
                    $tags = 'Change Tags "'.$val['tags'].'" to "'.trim($_POST['FileUpload']['tags']).'";';
                }
                if ($val['date_transaction'] != trim(date('Y-m-d', strtotime($_POST['FileUpload']['date_transaction'])))) {
                    $date_transaction = 'Change Date "'.$val['date_transaction'].'" to "'.trim($_POST['FileUpload']['date_transaction']).'";';
                }
                if ($val['date_transaction'] != trim(date('Y-m-d', strtotime($_POST['FileUpload']['date_transaction'])))) {
                    $date_transaction = 'Change Date "'.$val['date_transaction'].'" to "'.trim($_POST['FileUpload']['date_transaction']).'";';
                }
                $filesizeexist = $val['filesize'];
            }

            if ($_FILES['file']['name'] == '') {
                // echo 'update only'.$_FILES['name'];

                $update = Yii::app()->db->createCommand()
                    ->update(
                        'file_upload',
                        [
                'title' => trim($_POST['FileUpload']['title']),
                'company' => trim($_POST['FileUpload']['company']),
                'type' => trim($_POST['FileUpload']['type']),
                'product' => trim($_POST['FileUpload']['product']),
                'description' => trim($_POST['FileUpload']['description']),
                'tags' => trim($_POST['FileUpload']['tags']),
                'date_transaction' => trim(date('Y-m-d', strtotime($_POST['FileUpload']['date_transaction']))),
                    ],
                        'id=:id',
                        [':id' => $_POST['FileUpload']['id']]
                    );

                $modelHistory = new HistoryLogs();
                $modelHistory->logs = 'Update File with the title of "'.trim($_POST['FileUpload']['title']).'" ; '.
                    $title.
                    $company.
                    $type.
                    $product.
                    $description.
                    $tags.
                    $date_transaction;
                $modelHistory->created_at = date('Y-m-d H:i:s');
                $modelHistory->created_by = Users::model()->get_id_by_email(Yii::app()->user->name);
                $modelHistory->save();

                $upload = 'ok';
                echo $upload;
            } else {
                // echo 'update with file'.$_FILES['name'];

                $upload = 'err';
                if (!empty($_FILES['file'])) {
                    // File upload configuration
                    $targetDir = 'uploads/';
                    $allowTypes = [
                                'pdf', 'odt', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt',
                                'jpg', 'png', 'jpeg', 'gif', 'mp4', 'avi', 'mov', 'm4a', 'flac', 'mp3', 'wav', 'wma', 'aac',
                                'rdf', 'fnt', 'app', 'cfg', 'word', 'vcd', 'dat', 'vts', 'ifo', 'dat', 'psd',
                            ];

                    $fileName = basename($_FILES['file']['name']);
                    $targetFilePath = $targetDir.$fileName;

                    $arrayfileName = explode('.', $_FILES['image']['name']);
                    $extensionfileName = end($arrayfileName);

                    $size = filesize($_FILES['file']['tmp_name']); // bytes
                            $filesize = FileUpload::model()->formatSizeUnits($size); // megabytes with 1 digit

                            // Check whether file type is valid
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                    if (in_array($fileType, $allowTypes)) {
                        // Upload file to the server
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                            $upload = 'ok';

                            $update = Yii::app()->db->createCommand()
                        ->update(
                            'file_upload',
                            [
                    'title' => trim($_POST['FileUpload']['title']),
                    'company' => trim($_POST['FileUpload']['company']),
                    'type' => trim($_POST['FileUpload']['type']),
                    'product' => trim($_POST['FileUpload']['product']),
                    'description' => trim($_POST['FileUpload']['description']),
                    'tags' => trim($_POST['FileUpload']['tags']),
                    'filelength' => trim($_POST['FileUpload']['filelength']),
                    'filecategory' => FileUpload::model()->imageType($fileType),
                    'filesize' => $filesize,
                    'path' => $targetDir,
                    'filename' => $fileName,
                    'format' => $fileType,
                    'date_transaction' => trim(date('Y-m-d', strtotime($_POST['FileUpload']['date_transaction']))),
                        ],
                            'id=:id',
                            [':id' => $_POST['FileUpload']['id']]
                        );

                            $modelHistory = new HistoryLogs();
                            $modelHistory->logs = 'Update File with the title of "'.trim($_POST['FileUpload']['title']).'" ; '.
                            $title.
                            $company.
                            $type.
                            $product.
                            $description.
                            $tags.
                            $date_transaction;
                            $modelHistory->created_at = date('Y-m-d H:i:s');
                            $modelHistory->created_by = Users::model()->get_id_by_email(Yii::app()->user->name);
                            $modelHistory->save();

                            if ($filesizeexist != $filesize) {
                                $modelHistory1 = new HistoryLogs();
                                $modelHistory1->logs = 'Update File with the title of "'.trim($_POST['FileUpload']['title']).'" ; Changed Uploaded file';
                                $modelHistory1->created_at = date('Y-m-d H:i:s');
                                $modelHistory1->created_by = Users::model()->get_id_by_email(Yii::app()->user->name);
                                $modelHistory1->save();
                            }

                            // echo json_encode($model->getErrors());
                        }
                    }
                }
                echo $upload;
            }
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param int $id the ID of the model to be deleted
     */
    public function actionRestoreTran()
    {
        $update = Yii::app()->db->createCommand()
        ->update(
            'file_upload',
            [
    'deleted_at' => null,
    'restored_date' => date('Y-m-d H:i:s'),
        ],
            'id=:id',
            [':id' => $_POST['id']]
        );

        if (!isset($_GET['ajax'])) {
            $modelHistory = new HistoryLogs();
            $modelHistory->logs = 'Restored File with the title of "'.FileUpload::model()->get_title($_POST['id']).'" ';
            $modelHistory->created_at = date('Y-m-d H:i:s');
            $modelHistory->created_by = Users::model()->get_id_by_email(Yii::app()->user->name);
            $modelHistory->save();
        }
    }

    public function actionDeletetran()
    {
        // $this->loadModel($id)->delete();
        // echo $_POST['id'];

        // $this->loadModel($_POST['id'])->delete();

        $update = Yii::app()->db->createCommand()
        ->update(
            'file_upload',
            [
    'deleted_at' => date('Y-m-d H:i:s'),
        ],
            'id=:id',
            [':id' => $_POST['id']]
        );

        if (!isset($_GET['ajax'])) {
            $modelHistory = new HistoryLogs();
            $modelHistory->logs = 'Deleted Transaction with the title of "'.FileUpload::model()->get_title($_POST['id']).'" ';
            $modelHistory->created_at = date('Y-m-d H:i:s');
            $modelHistory->created_by = Users::model()->get_id_by_email(Yii::app()->user->name);
            $modelHistory->save();
        }
    }

    public function actionDeletePermTran()
    {
        // $this->loadModel($id)->delete();
        // echo $_POST['id'];

         $this->loadModel($_POST['id'])->delete();


        if (!isset($_GET['ajax'])) {
            $modelHistory = new HistoryLogs();
            $modelHistory->logs = 'Permanently Deleted Transaction with the title of "'.FileUpload::model()->get_title($_POST['id']).'" ';
            $modelHistory->created_at = date('Y-m-d H:i:s');
            $modelHistory->created_by = Users::model()->get_id_by_email(Yii::app()->user->name);
            $modelHistory->save();
        }
    }

    public function actionDelete($id)
    {
        // $this->loadModel($id)->delete();
        echo $id;
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        // if (!isset($_GET['ajax'])) {
        //     $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
        // }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('FileUpload');
        $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new FileUpload('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['FileUpload'])) {
            $model->attributes = $_GET['FileUpload'];
        }

        $this->render('admin', [
            'model' => $model,
        ]);
    }

    public function actionAdminListClient()
    {
        $model = new FileUpload('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['FileUpload'])) {
            $model->attributes = $_GET['FileUpload'];
        }

        $this->render('admin_list_client', [
            'model' => $model,
        ]);
    }

    public function actionAdmin_trash()
    {
        $model = new FileUpload('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['FileUpload'])) {
            $model->attributes = $_GET['FileUpload'];
        }

        $this->render('admin_trash', [
            'model' => $model,
        ]);
    }

    public function actionAdmin_client()
    {
        $model = new FileUpload('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['FileUpload'])) {
            $model->attributes = $_GET['FileUpload'];
        }

        $this->render('admin_client', [
            'model' => $model,
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param int $id the ID of the model to be loaded
     *
     * @return FileUpload the loaded model
     *
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = FileUpload::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param FileUpload $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'file-upload-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
