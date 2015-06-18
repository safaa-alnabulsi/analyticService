<?php

/**
 * This is the main controller which represents the ws api
 *
 * Class EndpointController
 */
class EndpointController extends Controller
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
                'actions' => array(),
                'users' => array('*'),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('input', 'index', 'chart', 'data'),
                'users' => array('@'),
            ),
            array(
                'deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Add a new event .
     * If creation is successful, the browser will show a success image, and if not, it will show error image.
     */
    public function actionInput($eventName, $eventValue)
    {
        //Uncomment these lines if you want your service to be accessible privately
        //if (Yii::app()->user->checkAccess('Endpoint.Input')) {
        $model = new Endpoint;

        if (isset($eventName) && isset($eventValue)) {
            $model->name = $eventName;
            $model->value = $eventValue;
            $model->referrer_url = Yii::app()->request->urlReferrer == null ? "No Referrer" : Yii::app()->request->urlReferrer;
            $model->datetime = date('Y-m-d H:i:s');
            if ($model->save()) {
                $result = "success";
            } else {
                $result = "error";
            }
        }
//        }else {
//
//            //user has no access to this
//            $result = "stop";
//        }

        Endpoint::displayResult($result);
    }

    /**
     * Displays a chart .
     */
    public function actionChart()
    {
        $model = new Endpoint('search');
        $this->render('chart', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $model = new Endpoint('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Endpoint'])) {
            $model->attributes = $_GET['Endpoint'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Show Data Grouped By columns.
     */
    public function actionData()
    {
        $this->render('data');
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Endpoint the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Endpoint::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Endpoint $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'endpoint-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
