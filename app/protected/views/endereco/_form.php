<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'endereco-form',
    'enableAjaxValidation' => false,
        ));
?>

<h2>Endereço</h2>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'logradouro', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 200)))); ?>

<?php echo $form->textFieldGroup($model, 'numero', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 10)))); ?>

<?php echo $form->textFieldGroup($model, 'complemento', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 10)))); ?>

<?php echo $form->textFieldGroup($model, 'bairro', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>

<?php echo $form->textFieldGroup($model, 'cep', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 8)))); ?>

<?php
echo $form->dropDownListGroup(
        $model, 'estado', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'data' => $model->estados,
        'htmlOptions' => array(),
    )
        )
);
?>

<?php echo $form->textFieldGroup($model, 'cidade_id', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5')))); ?>

<?php $this->endWidget(); ?>