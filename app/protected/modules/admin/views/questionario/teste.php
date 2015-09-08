<?php
$this->breadcrumbs = array(
    'Questionários' => array('index'),
    'Responder',
);
?>

<h1>Questionário</h1>

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'questionario-form',
    'enableAjaxValidation' => false,
        ));

$numQuestao = $_SESSION['numQuestao'];
$questao = $_SESSION['questoes'][$numQuestao];
$alternativas = array();

if (!empty($questao->alternativa01))
    $alternativas[1] = $questao->alternativa01;
if (!empty($questao->alternativa02))
    $alternativas[2] = $questao->alternativa02;
if (!empty($questao->alternativa03))
    $alternativas[3] = $questao->alternativa03;
if (!empty($questao->alternativa04))
    $alternativas[4] = $questao->alternativa04;
if (!empty($questao->alternativa05))
    $alternativas[5] = $questao->alternativa05;
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Pergunta <?php echo $numQuestao; ?></h3>
    </div>
    <div class="panel-body">
        <h4><?php echo $questao->pergunta; ?></h4>

        <?php
        echo $form->radioButtonListGroup(
                $avaliacao, 'resposta', array(
            'widgetOptions' => array(
                'data' => $alternativas,
                'htmlOptions' => array(
                ),
            )
                )
        );
        ?>
    </div>
</div>

<div class="form-actions">
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $avaliacao->isNewRecord ? 'Responder' : 'Salvar',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>