<?php
$this->breadcrumbs = array(
    'Questionários' => array('index'),
    'Gerenciamento',
);

$this->menu = array(
    array('label' => 'Cadastrar Novo', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('questionario-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Gerenciamento de Questionários</h1>

<?php
$this->widget('booster.widgets.TbGridView', array(
    'id' => 'questionario-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'descricao',
        array(
            'class' => 'booster.widgets.TbButtonColumn',
        ),
    ),
));
?>
