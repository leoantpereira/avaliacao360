<?php
$this->breadcrumbs=array(
	'Funcionarios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Funcionario','url'=>array('index')),
	array('label'=>'Create Funcionario','url'=>array('create')),
	array('label'=>'View Funcionario','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Funcionario','url'=>array('admin')),
	);
	?>

	<h1>Update Funcionario <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>