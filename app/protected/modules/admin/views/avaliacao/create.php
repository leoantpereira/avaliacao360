<?php
$this->breadcrumbs = array(
    'Avaliações' => array('index'),
    'Cadastro',
);

$this->menu = array(
    array('label' => 'Gerenciamento de Avaliações', 'url' => array('admin')),
);
?>

<h1>Cadastro de Avaliação</h1>

<?php echo $this->renderPartial('_form', array('model' => $model, 
    'nomesTodosFunc' => $nomesTodosFunc, 
    'nomesAvaliados' => $nomesAvaliados,
    'questionarios' => $questionarios)); ?>