<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'endereco-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'logradouro', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 200)))); ?>

<?php echo $form->textFieldGroup($model, 'numero', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 10)))); ?>

<?php echo $form->textFieldGroup($model, 'complemento', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 10)))); ?>

<?php echo $form->textFieldGroup($model, 'bairro', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>

<?php echo $form->textFieldGroup($model, 'cep', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 8)))); ?>

<?php echo $form->textFieldGroup($model, 'cidade_id', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5')))); ?>

<div class="form-actions">
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
