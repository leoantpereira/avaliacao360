<?php
$this->breadcrumbs = array(
    'Questionários' => array('index'),
    'Gerenciamento',
);

$this->menu = array(
    array('label' => 'Cadastrar Novo', 'url' => array('create')),
);
?>

<h1>Gerenciamento de Questionários</h1>

<?php
$this->widget('booster.widgets.TbGridView', array(
    'id' => 'questionario-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'descricao',
        array(
            'class' => 'booster.widgets.TbButtonColumn',
        ),
    ),
));
?>
