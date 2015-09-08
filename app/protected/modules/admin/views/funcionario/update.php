<?php
$this->breadcrumbs = array(
    'Funcionário' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Alteração',
);

$this->menu = array(
    array('label' => 'Cadastrar Novo', 'url' => array('create')),
    array('label' => 'Visualizar', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Gerenciar', 'url' => array('admin')),
);
?>

<h1>Alteração de Funcionário</h1>

<?php echo $this->renderPartial('_form', array('model' => $model, 'departamentos' => $departamentos)); ?>