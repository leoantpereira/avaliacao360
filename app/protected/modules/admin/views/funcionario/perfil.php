<?php
$this->breadcrumbs = array(
    'Funcionário' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Alterar', 'url' => array('update', 'id' => $model->id), 'visible' => Yii::app()->authManager->checkAccess('updateFuncionario', Yii::app()->user->id)),
);
?>

<h1>Meu Perfil</h1>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'nome',
        'email',
        array('label'=>'Foto', 'type'=>'raw', 'value'=> html_entity_decode(CHtml::image(Yii::app()->baseUrl.'/images/funcionarios/'.$model->empresa->cnpj.'/'.$model->foto,'alt',array('width'=>100,'height'=>150)))),
        array('label' => 'Departamento',
            'name' => 'departamento.nome'),
    ),
));

?>