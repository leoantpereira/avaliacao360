<?php
$this->breadcrumbs = array(
    'Funcionário' => array('index'),
    'Cadastro',
);

$this->menu = array(
    array('label' => 'Gerenciar Funcionários', 'url' => array('admin')),
);
?>

<h1>Cadastro de Funcionário</h1>

<?php
echo $this->renderPartial('_form', array(
    'model' => $model,
    'departamentos' => $departamentos));
?>