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
                'actions' => array('escolher', 'view', 'admin', 'responder', 'getFuncAvaliados'),
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

    public function actionEscolher() {
        $modelQuestionario = new Questionario('escolher');

        if (isset($_POST['Questionario']['id']) && isset($_POST['Questionario']['idFuncAvaliado'])) {
            $modelQuestionario->id = $_POST['Questionario']['id'];
            $funcAvaliado = Funcionario::model()->findByPk($_POST['Questionario']['idFuncAvaliado']);
            $_SESSION['funcAvaliado'] = $funcAvaliado;

            if ($modelQuestionario->validate()) {
                // converte id questionário de string para integer
                $modelQuestionario->id = intval($modelQuestionario->id);

                $this->redirect(array('responder', 'avaliacao' => $modelQuestionario->id));
            } else {
                
            }
        }
        $idFuncLogado = Yii::app()->user->id;

        $criteria = new CDbCriteria();
        $criteria->condition = 'idAvaliador = :idAvaliador AND resposta IS NULL';
        $criteria->group = 'idAvaliacao';
        $criteria->params = array(':idAvaliador' => $idFuncLogado);
        $criteria->join = 'JOIN avaliacao AS a ON t.idAvaliacao = a.id';

        $avaliacoes = AvaliacaoHasFuncionario::model()->findAll($criteria);

        // se achar questionários a responder
        if (!empty($avaliacoes)) {
            foreach ($avaliacoes as $a) {
                $questAResponder[$a->idAvaliacao] = $a->idAvaliacao0->questionario->descricao;
            }

            $this->render('escolher', array(
                'questAResponder' => $questAResponder,
                'modelQuestionario' => $modelQuestionario,
            ));
        } else {
            throw new CHttpException(404, 'Não existem questionários a responder.');
        }
    }

    /**
     * Capturar nomes dos funcionários a serem avaliados.
     */
    public function actionGetFuncAvaliados() {
        $criteria = new CDbCriteria();

        $criteria->group = 'idFuncAvaliado';

        $avaliacoes = AvaliacaoHasFuncionario::model()->findAllByAttributes(array(
            'idAvaliacao' => $_POST['idAvaliacao']), $criteria);
        $funcionarios = array();

        foreach ($avaliacoes as $a) {
            $funcionarios[] = array('idFuncAvaliado' => $a->idFuncAvaliado0->id,
                'nomeFuncAvaliado' => $a->idFuncAvaliado0->nome);
        }

        echo CJSON::encode(array('funcionarios' => $funcionarios));
    }

    public function actionResponder() {
        if (isset($_POST['AvaliacaoHasFuncionario'])) {
            $avaliacao = Avaliacao::model()->findByPk($_GET['avaliacao']);
            $questoes = $_SESSION['questoes'];
            $numQuestResp = $_SESSION['numQuestao'];

            $questaoRespondida = AvaliacaoHasFuncionario::model()->findByPk(array(
                'idAvaliacao' => $avaliacao->id,
                'idFuncAvaliado' => $_SESSION['funcAvaliado']->id,
                'idQuestao' => $questoes[$numQuestResp]->id,
            ));

            $questaoRespondida->dataHora = date('Y-m-d H:i:s');
            $questaoRespondida->resposta = $_POST['AvaliacaoHasFuncionario']['resposta'];
            $questaoRespondida->scenario = 'responder';

            if ($questaoRespondida->validate()) {
                if ($questaoRespondida->save()) {
                    // respondeu a última questão
                    if (sizeof($questoes) == $numQuestResp + 1) {
                        $_SESSION['questoes'] = NULL;
                        $_SESSION['numQuestoes'] = NULL;
                        $_SESSION['funcAvaliado'] = NULL;
                        $this->render('final');
                    } else {
                        $_SESSION['numQuestao'] = $numQuestResp + 1;
                        $this->refresh();
                    }
                }
            } else {
                $this->render('responder', array(
                    'avaliacao' => $questaoRespondida,
                ));
            }
        } else {
            $avaliaHasFunc = new AvaliacaoHasFuncionario('responder');

            if (!isset($_SESSION['questoes'])) {
                $avaliacao = Avaliacao::model()->findByPk($_GET['avaliacao']);
                $questoes = Questao::model()->findAllByAttributes(array('questionario_id' => $avaliacao->questionario_id));
                $_SESSION['questoes'] = $questoes;
                $_SESSION['numQuestao'] = 0;
            }

            $this->render('responder', array(
                'avaliacao' => $avaliaHasFunc));
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
