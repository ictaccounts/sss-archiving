<?php

class UsersController extends Controller
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
                'actions' => ['admin', 'delete', 'admin_profile', 'deleteTran'],
                'users' => ['@'],
            ],
            [
                'deny',  // deny all users
                'users' => ['*'],
            ],
        ];
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

    public function actionDeletetran()
    {
        $name = Users::model()->get_fullname_by_id($_POST['id']);
        $this->loadModel($_POST['id'])->delete();

        if (!isset($_GET['ajax'])) {
            $modelHistory = new HistoryLogs();
            $modelHistory->logs = 'Delete User Fullname : "'.$name.'"';
            $modelHistory->created_at = date('Y-m-d H:i:s');
            $modelHistory->created_by = Users::model()->get_id_by_email(Yii::app()->user->name);
            $modelHistory->save();
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Users();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            $model->user_password = md5($_POST['Users']['user_password']);
            $model->user_password_decrypt = trim($_POST['Users']['user_password']);

            $modelHistory = new HistoryLogs();
            $modelHistory->logs = 'Added User Fullname : "'.$_POST['Users']['user_fullname'].'"';
            $modelHistory->created_at = date('Y-m-d H:i:s');
            $modelHistory->created_by = Users::model()->get_id_by_email(Yii::app()->user->name);
            $modelHistory->save();

            if ($model->save()) {
                $this->redirect(['admin']);
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
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            $model->user_password = md5($_POST['Users']['user_password']);
            if ($model->save()) {
                $this->redirect(['admin']);
            }
        }

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
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Users');
        $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Users('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Users'])) {
            $model->attributes = $_GET['Users'];
        }

        $this->render('admin', [
            'model' => $model,
        ]);
    }

    public function actionAdmin_profile()
    {
        $model = new Users('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Users'])) {
            $model->attributes = $_GET['Users'];
        }

        $this->render('admin_profile', [
            'model' => $model,
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param int $id the ID of the model to be loaded
     *
     * @return Users the loaded model
     *
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Users::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param Users $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
