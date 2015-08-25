<?php
$this->breadcrumbs = array(
    'Questionários' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Cadastrar Novo', 'url' => array('create')),
    array('label' => 'Alterar', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Excluir', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Gerenciamento de Questionários', 'url' => array('admin')),
);
?>

<h1>Visualização de Questionário</h1>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'descricao',
    ),
));
?>
