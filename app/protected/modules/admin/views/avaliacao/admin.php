<?php
$this->breadcrumbs = array(
    'Avaliações' => array('index'),
    'Gerenciamento',
);

$this->menu = array(
    array('label' => 'Cadastrar Nova', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('avaliacao-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Gerenciamento de Avaliações</h1>

<?php
$this->widget('booster.widgets.TbGridView', array(
    'id' => 'avaliacao-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        array(
            'name'=>'funcAvaliador',
            'value'=>'$data->idAvaliador0->nome',
        ),        
        'questionario_id',
        array(
            'class' => 'booster.widgets.TbButtonColumn',
        ),
    ),
));
?>