<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pergunta')); ?>:</b>
	<?php echo CHtml::encode($data->pergunta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alternativa01')); ?>:</b>
	<?php echo CHtml::encode($data->alternativa01); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alternativa02')); ?>:</b>
	<?php echo CHtml::encode($data->alternativa02); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alternativa03')); ?>:</b>
	<?php echo CHtml::encode($data->alternativa03); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alternativa04')); ?>:</b>
	<?php echo CHtml::encode($data->alternativa04); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alternativa05')); ?>:</b>
	<?php echo CHtml::encode($data->alternativa05); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('resposta')); ?>:</b>
	<?php echo CHtml::encode($data->resposta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('questionario_id')); ?>:</b>
	<?php echo CHtml::encode($data->questionario_id); ?>
	<br />

	*/ ?>

</div>