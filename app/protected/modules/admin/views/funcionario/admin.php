<?php
$this->breadcrumbs = array(
    'Funcionário' => array('index'),
    'Gerenciar',
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
$.fn.yiiGridView.update('funcionario-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Gerenciamento de Funcionários</h1>

<?php echo CHtml::link('Pesquisa avançada', '#', array('class' => 'search-button btn')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('booster.widgets.TbGridView', array(
    'id' => 'funcionario-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'nome',
        'email',
        array(
            'class' => 'booster.widgets.TbButtonColumn',
        ),
    ),
));
?>
