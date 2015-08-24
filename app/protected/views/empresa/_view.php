<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cnpj')); ?>:</b>
	<?php echo CHtml::encode($data->cnpj); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('razaoSocial')); ?>:</b>
	<?php echo CHtml::encode($data->razaoSocial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nomeFantasia')); ?>:</b>
	<?php echo CHtml::encode($data->nomeFantasia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefone01')); ?>:</b>
	<?php echo CHtml::encode($data->telefone01); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefone02')); ?>:</b>
	<?php echo CHtml::encode($data->telefone02); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('endereco_id')); ?>:</b>
	<?php echo CHtml::encode($data->endereco_id); ?>
	<br />

	*/ ?>

</div>