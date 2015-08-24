<?php
$this->breadcrumbs=array(
	'Empresas'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Empresa','url'=>array('index')),
array('label'=>'Create Empresa','url'=>array('create')),
array('label'=>'Update Empresa','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Empresa','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Empresa','url'=>array('admin')),
);
?>

<h1>View Empresa #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'cnpj',
		'razaoSocial',
		'nomeFantasia',
		'telefone01',
		'telefone02',
		'email',
		'endereco_id',
),
)); ?>
