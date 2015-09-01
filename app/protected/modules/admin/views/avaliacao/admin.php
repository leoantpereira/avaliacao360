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

<?php echo CHtml::link('Pesquisa Avançada', '#', array('class' => 'search-button btn')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('booster.widgets.TbGridView', array(
    'id' => 'avaliacao-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'idAvaliador',
        'questionario_id',
        array(
            'class' => 'booster.widgets.TbButtonColumn',
        ),
    ),
));
?>