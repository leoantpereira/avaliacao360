<?php

class EmpresaController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'create'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
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
        $modelEmpresa = new Empresa;
        $modelEndereco = new Endereco;
        $modelFuncionario = new Funcionario;

        if (isset($_POST['Empresa']) &&
                isset($_POST['Endereco']) &&
                isset($_POST['Funcionario'])) {

            // ============= cadastro da empresa
            $modelEmpresa->attributes = $_POST['Empresa'];
            $modelEmpresa->validaCpfCnpj($modelEmpresa, PESSOA_JURIDICA);
            // ============= fim cadastro da empresa
            // ============= cadastro do endereço
            $modelEndereco->attributes = $_POST['Endereco'];
            // ============= fim cadastro do endereço
            // ============= cadastro do funcionário
            $modelFuncionario->attributes = $_POST['Funcionario'];
            $modelFuncionario->permissao = USER_ADMIN;
            $modelFuncionario->foto = CUploadedFile::getInstance($modelFuncionario, 'foto');
            // ============= fim cadastro do funcionário

            if ($modelEmpresa->validate(null, false) &&
                    $modelEndereco->validate() &&
                    $modelFuncionario->validate()) {

                Funcionario::model()->verificaSenhasCadastro($modelFuncionario);
                if (Funcionario::model()->findByAttributes(array('email' => $modelFuncionario->email))) {
                    $modelFuncionario->addError('email', 'E-mail já existe.');
                }
                if (!$modelFuncionario->getErrors()) {
                    if ($modelFuncionario->foto) {
                        $modelFuncionario->salvaImagem($modelFuncionario);
                    }

                    if ($modelEndereco->save()) {
                        $modelEmpresa->endereco_id = $modelEndereco->id;
                        if ($modelEmpresa->save()) {
                            $modelFuncionario->empresa_id = $modelEmpresa->id;
                            if ($modelFuncionario->save()) {
                                $_SESSION['empresa'] = $modelEmpresa;
                                $this->redirect(array('view', 'id' => $modelEmpresa->id));
                            }
                        }
                    }
                }
            }
        }

        $this->render('create', array(
            'modelEmpresa' => $modelEmpresa,
            'modelEndereco' => $modelEndereco,
            'modelFuncionario' => $modelFuncionario,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Empresa'])) {
            $model->attributes = $_POST['Empresa'];
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
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Empresa');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Empresa('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Empresa']))
            $model->attributes = $_GET['Empresa'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Empresa::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'empresa-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
