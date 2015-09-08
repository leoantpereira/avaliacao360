<?php

class QuestionarioController extends Controller {

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
                'actions' => array('index', 'view', 'create', 'update', 'delete', 'admin'),
                'roles' => array('admin'),
            ),
            array('allow',
                'actions' => array('responder', 'view', 'admin', 'teste', 'getFuncAvaliados'),
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
        $model = new Questionario;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Questionario'])) {
            $model->attributes = $_POST['Questionario'];
            $funcLogado = $_SESSION['funcLogado'];
            $model->empresa_id = $funcLogado->empresa_id;
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
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Questionario'])) {
            $model->attributes = $_POST['Questionario'];
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
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Questionario('search');
        $model->unsetAttributes();  // clear any default values
        $model->empresa_id = $_SESSION['funcLogado']->empresa_id;

        if (isset($_GET['Questionario']))
            $model->attributes = $_GET['Questionario'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionResponder() {
        $modelQuestionario = new Questionario;

        if (isset($_POST['Questionario'])) {
            $modelQuestionario->id = $_POST['Questionario']['id'];

            if ($modelQuestionario->validate()) {
                // converte id questionário de string para integer
                $modelQuestionario->id = intval($modelQuestionario->id);

                $this->redirect(array('teste', 'questionario' => $modelQuestionario->id));
            } else {
                
            }
        } else {
            $idFuncLogado = Yii::app()->user->id;

            $criteria = new CDbCriteria();
            $criteria->condition = 'idAvaliador = :idAvaliador';
            $criteria->group = 'idAvaliacao';
            $criteria->params = array(':idAvaliador' => $idFuncLogado);
            $criteria->join = 'JOIN avaliacao AS a ON t.idAvaliacao = a.id';

            $avaliacoes = AvaliacaoHasFuncionario::model()->findAll($criteria);


            $questAResponder = array('Selecione');

            foreach ($avaliacoes as $a) {
                $questAResponder[$a->idAvaliacao0->questionario->id] = $a->idAvaliacao0->questionario->descricao;
            }
        }

        $this->render('responder', array(
            'questAResponder' => $questAResponder,
            'modelQuestionario' => $modelQuestionario,
        ));
    }

    /**
     * Capturar nomes dos funcionários a serem avaliados.
     */
    public function actionGetFuncAvaliados() {               
        $avaliacoes = AvaliacaoHasFuncionario::model()->findAllByAttributes(array(
            'idAvaliacao' => $_POST['idAvaliacao'],
        ));
        $funcionarios = array();
        
        foreach($avaliacoes as $a){
            $funcionarios[$a->idFuncAvalido0->id] = $a->idFuncAvalido0->nome;
        }
        var_dump($avaliacoes);
        exit();
        
        echo CJSON::encode(array('funcionarios' => $funcionarios));
    }

    public function actionTeste() {
        if (isset($_POST['AvaliacaoHasFuncionario'])) {
            $questaoRespondida = new AvaliacaoHasFuncionario;
            $questaoRespondida->attributes = $_POST['AvaliacaoHasFuncionario'];

            $idQuestionario = $_GET['questionario'];
            $questionario = Questionario::model()->findByPk($idQuestionario);

            $avaliacao = Avaliacao::model()->findByAttributes(array(
                'questionario_id' => $questionario->id,
            ));

            $questaoRespondida->idAvaliacao = $avaliacao->id;
            $questaoRespondida->idFuncAvaliado = $_SESSION['funcAvaliado']->id;

            $questoes = $_SESSION['questoes'];
            $numQuestResp = $_SESSION['numQuestao'];
            $questaoRespondida->idQuestao = $questoes[$numQuestResp]->id;

            if ($questaoRespondida->validate()) {
                echo 'entrei 1';
                exit();
                if ($questaoRespondida->save()) {
                    echo 'entrei 2';
                    exit();
                    $questoes = $_SESSION['questoes'];
                    $numQuestao = $_SESSION['numoQuestao'];

                    // respondeu a última qusetão
                    if (sizeof($questoes) == $numQuestao) {
                        echo 'entrei 3';
                        exit();
                    } else {
                        echo 'entrei 4';
                        exit();
                        $numQuestao++;
                        $this->refresh();
                    }
                }
            }
        } else {
            $avalicao = new AvaliacaoHasFuncionario;
            $questoes = Questao::model()->findAllByAttributes(array('questionario_id' => $_GET['questionario']));
            $_SESSION['questoes'] = $questoes;
            $_SESSION['numQuestao'] = 1;

            $this->render('teste', array('questoes' => $questoes,
                'avaliacao' => $avalicao));
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Questionario::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'questionario-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
