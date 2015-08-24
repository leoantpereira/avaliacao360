<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'empresa-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Campos marcados com <span class="required">*</span> são de preenchimento obrigatório.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'cnpj', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 14)))); ?>

<?php echo $form->textFieldGroup($model, 'razaoSocial', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 200)))); ?>

<?php echo $form->textFieldGroup($model, 'nomeFantasia', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 200)))); ?>

<?php echo $form->textFieldGroup($model, 'telefone01', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 11)))); ?>

<?php echo $form->textFieldGroup($model, 'telefone02', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 11)))); ?>

<?php echo $form->textFieldGroup($model, 'email', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>

<div class="form-actions">
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $model->isNewRecord ? 'Cadastrar' : 'Salvar',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
