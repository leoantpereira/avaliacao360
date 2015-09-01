<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idAvaliador')); ?>:</b>
	<?php echo CHtml::encode($data->idAvaliador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('questionario_id')); ?>:</b>
	<?php echo CHtml::encode($data->questionario_id); ?>
	<br />


</div>