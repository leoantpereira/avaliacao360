<?php
$this->breadcrumbs = array(
    'Avaliações' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Cadastrar Nova', 'url' => array('create')),
    array('label' => 'Alterar', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Excluir', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Gerenciar Avaliações', 'url' => array('admin')),
);
?>

<h1>Visualização de Avaliação</h1>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        array(
            'name' => 'funcAvaliador',
            'value' => $model->idAvaliador0->nome,
        ),
        'questionario_id',
    ),
));
?>
