<?php
$this->breadcrumbs = array(
    'Questões' => array('index'),
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
$.fn.yiiGridView.update('questao-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Gerenciamento de Questões</h1>

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
    'id' => 'questao-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'pergunta',
        'questionario_id',
        array(
            'class' => 'booster.widgets.TbButtonColumn',
        ),
    ),
));
?>
