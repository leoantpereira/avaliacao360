<?php
$this->breadcrumbs = array(
    'Questionários' => array('index'),
    'Cadastro',
);

$this->menu = array(
    array('label' => 'Gerenciar Questionários', 'url' => array('admin')),
);
?>

<h1>Cadastro de Questionário</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>