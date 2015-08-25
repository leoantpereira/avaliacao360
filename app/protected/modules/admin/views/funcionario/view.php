<?php
$this->breadcrumbs = array(
    'Funcionário' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Cadastrar Novo', 'url' => array('create')),
    array('label' => 'Alterar', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Excluir', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Tem certeza que seja excluir este funcionário?')),
    array('label' => 'Gerenciar Funcionários', 'url' => array('admin')),
);
?>

<h1>Visualiação de Funcionário</h1>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'nome',
        'email',
        'foto',
    ),
));
?>
