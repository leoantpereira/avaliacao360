<?php
$this->breadcrumbs = array(
    'Questões' => array('index'),
    'Cadastro',
);

$this->menu = array(
    array('label' => 'Gerenciamento de Questões', 'url' => array('admin')),
);
?>

<h1>Cadastro de Questão</h1>

<?php echo $this->renderPartial('_form', array('model' => $model, 'questionarios' => $questionarios)); ?>