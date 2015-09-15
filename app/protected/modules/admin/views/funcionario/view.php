<?php
$this->breadcrumbs = array(
    'Funcionário' => array('index'),
    $model->id,
);


$this->menu = array(
    array('label' => 'Cadastrar Novo', 'url' => array('create'), 'visible' => Yii::app()->authManager->checkAccess('createFuncionario', Yii::app()->user->id)),
    array('label' => 'Alterar', 'url' => array('update', 'id' => $model->id), 'visible' => Yii::app()->authManager->checkAccess('updateFuncionario', Yii::app()->user->id)),
    array('label' => 'Excluir', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Tem certeza que seja excluir este funcionário?'), 'visible' => Yii::app()->authManager->checkAccess('deleteFuncionario', Yii::app()->user->id)),
    array('label' => 'Gerenciar Funcionários', 'url' => array('admin'), 'visible' => Yii::app()->authManager->checkAccess('adminFuncionario', Yii::app()->user->id)),
);
?>

<h1>Visualiação de Funcionário</h1>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'nome',
        'email',
        'foto',
    ),
));
?>
