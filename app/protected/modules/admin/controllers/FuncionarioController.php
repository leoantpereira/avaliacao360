<?php

session_start();
require_once 'Funcoes.php';

class FuncionarioController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $funcoes;
    public $erros = array();

    public function init() {
        $this->funcoes = new Funcoes();
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('view', 'admin', 'perfil'),
                'roles' => array('chefeDepartamento'),
            ),
            array('allow',
                'actions' => array('create', 'update', 'delete', 'view', 'admin', 'index'),
                'roles' => array('admin')
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Funcionario;
        $departamentos = Departamento::model()->pesqTodosNomes($_SESSION['funcLogado']->empresa_id);

        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if (isset($_POST['Funcionario'])) {
            $model->attributes = $_POST['Funcionario'];
            $funcLogado = $_SESSION['funcLogado'];
            $model->empresa_id = $funcLogado->empresa_id;
            $model->foto = CUploadedFile::getInstance($model, 'foto');

            if ($model->validate()) {
                $model->verificaSenhasCadastro($model);
                if (Funcionario::model()->findByAttributes(array('email' => $model->email))) {
                    $model->addError('email', 'E-mail já existe.');
                }
                if (!$model->getErrors()) {
                    if ($model->foto) {
                        $model->salvaImagem($model);
                    }
                    if ($model->save()) {
                        Funcionario::model()->setaAutorizacao($model);
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
            'departamentos' => $departamentos,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $departamentos = Departamento::model()->pesqTodosNomes($_SESSION['funcLogado']->empresa_id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Funcionario'])) {
            $model->attributes = $_POST['Funcionario'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
            'departamentos' => $departamentos,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Funcionario('search');
        $model->unsetAttributes();  // clear any default values
        $funcLogado = $_SESSION['funcLogado'];
        $model->empresa_id = $funcLogado->empresa_id;
        $model->id = intval($funcLogado->id);

        if ($funcLogado->permissao == USER_CHEFE_DEPARTAMENTO)
            $model->departamento_id = $funcLogado->departamento_id;

        if (isset($_GET['Funcionario']))
            $model->attributes = $_GET['Funcionario'];

        //var_dump($model);
        //exit();

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionPerfil() {
        $this->render('perfil', array('model'=>$_SESSION['funcLogado']));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Funcionario::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        else if ($model->empresa_id != $_SESSION['funcLogado']->empresa_id)
            throw new CHttpException(401, 'Você não está autorizado a realizar esta operação.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'funcionario-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
