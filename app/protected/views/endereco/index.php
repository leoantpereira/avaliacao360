<?php
$this->breadcrumbs=array(
	'Enderecos',
);

$this->menu=array(
array('label'=>'Create Endereco','url'=>array('create')),
array('label'=>'Manage Endereco','url'=>array('admin')),
);
?>

<h1>Enderecos</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
