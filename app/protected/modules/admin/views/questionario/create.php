<?php
$this->breadcrumbs=array(
	'Questionarios'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Questionario','url'=>array('index')),
array('label'=>'Manage Questionario','url'=>array('admin')),
);
?>

<h1>Create Questionario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>