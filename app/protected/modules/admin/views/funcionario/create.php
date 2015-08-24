<?php
$this->breadcrumbs = array(
    'Funcionário' => array('index'),
    'Cadastro',
);

$this->menu = array(
    array('label' => 'List Funcionario', 'url' => array('index')),
    array('label' => 'Manage Funcionario', 'url' => array('admin')),
);
?>

<h1>Cadastro de Funcionário</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>