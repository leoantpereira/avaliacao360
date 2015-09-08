<?php

session_start();
require_once 'Funcoes.php';

class AvaliacaoController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
                'actions' => array('index', 'create', 'update', 'delete', 'view', 'admin'),
                'roles' => array('admin'),
            ),
            array('allow',
                'actions' => array('view', 'admin'),
                'roles' => array('chefeDepartamento', 'funcionario'),
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
        $model = new Avaliacao;
        $funcLogado = $_SESSION['funcLogado'];
        $nomesTodosFunc = Funcionario::pesqTodosNomes($funcLogado->empresa_id);
        $questionarios = Questionario::model()->findAllDescricao($funcLogado->empresa_id);

        /** organiza o nomes dos funcionários a serem avaliados,
         * retirando o primeiro elemento "selecione" e renumerando os 
         * índices. * */
        $nomesAvaliados = $nomesTodosFunc;
        unset($nomesAvaliados[0]);
        $nomesAvaliados = array_values($nomesAvaliados);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Avaliacao'])) {
            $model->attributes = $_POST['Avaliacao'];

            if ($model->save()) {
                $funcAvaliadosSel = explode(',', $model->funcAvaliados);
                $idFuncAvalSel = array();

                foreach ($funcAvaliadosSel as $func) {
                    $questoesQuestionario = Questao::model()->findAllByAttributes(array('questionario_id' => $model->questionario_id));

                    foreach ($questoesQuestionario as $quest) {
                        $avalHASfunc = new AvaliacaoHasFuncionario;
                        $avalHASfunc->idFuncAvaliado = explode(' -', $func)[0];
                        $avalHASfunc->idAvaliacao = $model->id;
                        $avalHASfunc->idQuestao = $quest->id;
                        $avalHASfunc->save();
                    }
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'nomesTodosFunc' => $nomesTodosFunc,
            'nomesAvaliados' => $nomesAvaliados,
            'questionarios' => $questionarios,
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

        if (isset($_POST['Avaliacao'])) {
            $model->attributes = $_POST['Avaliacao'];
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
        echo 'id usuário: ' . Yii::app()->user->id;
        if (Yii::app()->authManager->checkAccess('viewAvaliacao', Yii::app()->user->id))
            echo 'tem acesso';
        else
            echo 'não tem acesso';
        exit();
        $dataProvider = new CActiveDataProvider('Avaliacao');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Avaliacao('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Avaliacao']))
            $model->attributes = $_GET['Avaliacao'];

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
        $model = Avaliacao::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'avaliacao-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
