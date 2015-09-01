<?php
$this->breadcrumbs=array(
	'Avaliacaos',
);

$this->menu=array(
array('label'=>'Create Avaliacao','url'=>array('create')),
array('label'=>'Manage Avaliacao','url'=>array('admin')),
);
?>

<h1>Avaliacaos</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
