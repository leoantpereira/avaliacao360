<?php

session_start();

class RelatoriosController extends Controller {

    public function actionIndex() {
        $model = new Relatorios;

        if (isset($_POST['Relatorios'])) {
            $model->attributes = $_POST['Relatorios'];

            $questoes = Questao::model()->findAllByAttributes(array(
                'questionario_id' => $model->questionario,
            ));

            $questionario = Questionario::model()->findByPk($model->questionario);
            $respostas = array();
            $cs = Yii::app()->clientScript;
            $qtdQuestoes = 0;
            $script = "$(function() {
                            Morris.Bar({
                                element: 'morris-bar-chart',
                                data: [";

            foreach ($questoes as $q) {
                $respostas[] = AvaliacaoHasFuncionario::model()->findAllByAttributes(array(
                    'idFuncAvaliado' => $model->nomeFuncionario,
                    'idQuestao' => $q->id,
                ));
                $qtdResp = 0;
                $script = $script . "{ y: 'questao " . ($qtdQuestoes + 1) . "', ";
                foreach ($respostas[$qtdQuestoes] as $r) {
                    $script = $script . "resposta" . ($qtdResp+1) . ": " . $r->resposta . ", ";
                    $qtdResp++;
                }
                $script = $script . "},";
                $qtdQuestoes++;
            }
            $script = $script . "],
                                    xkey: 'y',";
            $w = 0;
            $script = $script . "ykeys: [";
            while ($qtdResp != $w) {
                $script = $script . "'resposta" . ($w+1) . "', ";
                $w++;
            }

            $w = 0;
            $script = $script . "], labels: [";
            while ($qtdResp != $w) {
                $script = $script . "'Resposta " . ($w+1) . "', ";
                $w++;
            }
            
            $script = $script . "],
                                    resize: true,
                                    });
                                    });";

            $cs->registerScript('morris-data', $script, CClientScript::POS_READY);

            $this->render('gerar', array(
                'questionario' => $questionario,
                'questoes' => $questoes));
        } else {

            $nomesFuncionarios = Funcionario::pesqTodosNomes($_SESSION['funcLogado']->empresa_id);

            $this->render('index', array(
                'nomesFuncionarios' => $nomesFuncionarios,
                'model' => $model));
        }
    }

    public function actionGetQuestionarios() {
        $funcionario = $_POST['funcionario'];
        $data = Yii::app()->db->createCommand("SELECT qt.descricao, qt.id "
                        . "FROM avaliacao_has_funcionario AS af "
                        . "INNER JOIN questao AS q "
                        . "INNER JOIN questionario as qt "
                        . "WHERE qt.id=q.questionario_id "
                        . "AND af.idFuncAvaliado=2 "
                        . "AND q.id=af.idQuestao "
                        . "GROUP BY qt.descricao")->queryAll(true);

        echo CJSON::encode(array('questionarios' => $data));
    }

}
