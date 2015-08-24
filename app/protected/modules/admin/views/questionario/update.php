<?php
$this->breadcrumbs=array(
	'Questionarios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Questionario','url'=>array('index')),
	array('label'=>'Create Questionario','url'=>array('create')),
	array('label'=>'View Questionario','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Questionario','url'=>array('admin')),
	);
	?>

	<h1>Update Questionario <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>