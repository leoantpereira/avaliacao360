<?php
$this->breadcrumbs = array(
    'Questões' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Alteração',
);

$this->menu = array(
    array('label' => 'Cadastrar Nova', 'url' => array('create')),
    array('label' => 'Visualizar', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Gerenciamento de Questões', 'url' => array('admin')),
);
?>

<h1>Alteração de Questão</h1>

<?php echo $this->renderPartial('_form', array('model' => $model, 'questionarios' => $questionarios)); ?>