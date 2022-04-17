<?php

class ThumbnailController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array(
				'allow',  // allow all users to perform 'index' and 'view' actions
				'actions' => array('index', 'view'),
				'users' => array('*'),
			),
			array(
				'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('create', 'update'),
				'users' => array('@'),
			),
			array(
				'allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array('admin', 'delete', 'upload'),
				'users' => array('@'),
			),
			array(
				'deny',  // deny all users
				'users' => array('*'),
			),
		);
	}

	public function actionUpload()
	{
		$targetDir = 'thumbnail/';
		$fileName = basename($_FILES['fileToUpload']['name']);
		$targetFilePath = $targetDir . $fileName;
		$getthumbnailid = Thumbnail::model()->get_exist($_POST['fileToUploadID']);

		// print_r($_FILES);
		// print_r($_POST);

		if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFilePath)) {

			echo "store successfully";

			if ($getthumbnailid == "") {
				$model = new Thumbnail;

				$model->file_id = $_POST['fileToUploadID'];
				$model->path = $targetDir;
				$model->filename = $fileName;
				$model->save();
			} else {

				$update = Yii::app()->db->createCommand()
					->update(
						'thumbnail',
						[
							'path' => $targetDir,
							'filename' => $fileName,
						],
						'file_id=:file_id',
						[':file_id' => $_POST['fileToUploadID']]
					);
			}

			echo "targetDir : " . $targetDir;
			echo "fileName : " . $fileName;
			echo "ID : " . $_POST['fileToUploadID'];
		} else {
			echo "error asdasd";
		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Thumbnail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Thumbnail'])) {
			$model->attributes = $_POST['Thumbnail'];
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
		}

		$this->render('create', array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Thumbnail'])) {
			$model->attributes = $_POST['Thumbnail'];
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
		}

		$this->render('update', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Thumbnail');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Thumbnail('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Thumbnail']))
			$model->attributes = $_GET['Thumbnail'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Thumbnail the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Thumbnail::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Thumbnail $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'thumbnail-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
