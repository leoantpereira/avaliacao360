<?php
$this->breadcrumbs=array(
	'Empresas',
);

$this->menu=array(
array('label'=>'Create Empresa','url'=>array('create')),
array('label'=>'Manage Empresa','url'=>array('admin')),
);
?>

<h1>Empresas</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
