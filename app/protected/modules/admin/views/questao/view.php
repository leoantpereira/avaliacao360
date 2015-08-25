<?php
$this->breadcrumbs = array(
    'Questões' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Cadastrar Nova', 'url' => array('create')),
    array('label' => 'Alterar', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Excluir', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Gerenciamento de Questões', 'url' => array('admin')),
);
?>

<h1>Visualização de Questão</h1>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'pergunta',
        'alternativa01',
        'alternativa02',
        'alternativa03',
        'alternativa04',
        'alternativa05',
        'alternativaCorreta',
        'resposta',
        array(
            'label' => 'Questionário',
            'value' => $model->questionario->descricao,
        ),
    ),
));
?>
