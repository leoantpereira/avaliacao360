<?php
$this->breadcrumbs = array(
    'Questionários' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Alteração',
);

$this->menu = array(
    array('label' => 'Cadastrar Novo', 'url' => array('create')),
    array('label' => 'Visualizar', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Gerenciamento de Questionários', 'url' => array('admin')),
);
?>

<h1>Alteração de Questionário</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>