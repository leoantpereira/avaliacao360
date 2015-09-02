<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'departamento-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Campos marcados com <span class="required">*</span> são de preenchimento obrigatório.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'nome', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>

<?php echo $form->textFieldGroup($model, 'descricao', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 500)))); ?>

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
