<?php
$this->breadcrumbs=array(
	'Questionarios'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Questionario','url'=>array('index')),
array('label'=>'Create Questionario','url'=>array('create')),
array('label'=>'Update Questionario','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Questionario','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Questionario','url'=>array('admin')),
);
?>

<h1>View Questionario #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'descricao',
),
)); ?>
