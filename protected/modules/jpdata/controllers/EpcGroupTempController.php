<?php

class EpcGroupTempController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/jpdata';

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
//  	$modelId = Yii::app()->request->getParam('ep_ml');
// 		$modelInfo = array();
// 		if($modelId) {
// 			// 获取epc车型信息
// 			$modelInfo = RPCClient::call('VehicleService_queryEpcModelInfo',array('modelId'=>$modelId));
// 		}
		$model = new EpcGroupTemp('create');
		//var_dump($model);die;
		$this->render('index',array(
			'model'=>$model //,'epcModel'=>$modelInfo
		));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionList()
	{
		$criteria = new CDbCriteria();
		//$criteria->index = "id";
		$criteria->order = "id desc";
		$count = EpcGroupTemp::model()->count($criteria);
		$pages = new CPagination($count);
		$pages->pageSize = $_GET['rows'];
		$pages->applyLimit($criteria);
		//EpcGroupTemp::model()->scenario='list';
		$models = EpcGroupTemp::model()->findAll($criteria);
		// 转换成数组
		$rows = array();
		foreach ($models as $model) {
			$rows[] = $model->attributes;
		}
		$rs = array('total'=>$count,'rows'=>$rows);
		echo CJSON::encode($rs);
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function _actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{	
		//var_dump($_POST);die;
		$EpcGroupTemp = Yii::app()->request->getParam("EpcGroupTemp");
	
		$model=new EpcGroupTemp('create');
		$action = 'epc/group';
		$isPost = false;
		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
		
		if(isset($_POST['EpcGroupTemp']))
		{	
			$isPost = true;
			$model->attributes = $EpcGroupTemp;
			$model->ModelID = $EpcGroupTemp['modelId'];

						// 校验表单
// 			if ($model->validate()) {
				// file handling
				$imageUploadFile = CUploadedFile::getInstance($model, 'picture');
				if ($imageUploadFile !== null) { // only do if file is really uploaded
					$imageFileExt = $imageUploadFile->extensionName;
						
					$save_path = dirname(Yii::app()->basePath) . '/upload/' . $action . '/';
					if (!file_exists($save_path)) {
						mkdir($save_path, 0777, true);
					}
					$ymd = date("Ymd");
					$save_path .= $ymd . '/';
					if (!file_exists($save_path)) {
						mkdir($save_path, 0777, true);
					}
					$img_prefix = date("YmdHis") . '_' . rand(10000, 99999);
					$imageFileName = $img_prefix . '.' . $imageFileExt;
					$model->picture = $imageFileName;
					$model->picturePath = 'upload/' . $action . '/'.$ymd;
					$save_path .= $imageFileName;
				}
				// 获取epc车型信息
				$modelId = $model->ModelID;
				$modelInfo = RPCClient::call('VehicleService_queryEpcModelInfo',array('modelId'=>$modelId));
				if($modelInfo){
					$model->ModelName = $modelInfo['modelName'];
				}

				// 获取主组信息
				$groupId = $model->GroupPid;
				$groupInfo = RPCClient::call('PartsService_queryGroupInfo',array('groupId'=>$groupId));
				if($groupInfo){
					$model->GroupPname = $groupInfo['name'];
				}

				if ($model->save()) {
					if ($imageUploadFile !== null) { // validate to save file
						$imageUploadFile->saveAs($save_path);
					}
                                        echo 'success';die;
				}
		
		// 获取参数
		if($isPost){
			$modelId = $model->ModelID;
		}else{
			$modelId = Yii::app()->request->getParam('ep_ml');
		}
		// 获取epc车型信息
		$modelInfo = array();
		if($modelId) {
			$modelInfo = RPCClient::call('VehicleService_queryEpcModelInfo',array('modelId'=>$modelId));
		}
		
		Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
		echo $this->renderPartial('_form',array(
			'model'=>$model,
			'action'=>Yii::app()->createUrl('jpdata/epcGroupTemp/create'),
			'epcModel'=>$modelInfo
		),false,true);
	}
 	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function _actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EpcGroupTemp']))
		{
			$model->attributes=$_POST['EpcGroupTemp'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function _actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function _actionAdmin()
	{
		$model=new EpcGroupTemp('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EpcGroupTemp']))
			$model->attributes=$_GET['EpcGroupTemp'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=EpcGroupTemp::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='epc-group-temp-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
