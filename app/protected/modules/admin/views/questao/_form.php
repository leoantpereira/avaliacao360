<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'questao-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Campos marcados com <span class="required">*</span> são de preenchimento obrigatório.</p>

<?php echo $form->errorSummary($model); ?>

<?php
// desabilita a alteração do questionário caso esteja fazendo uma alteração
if (!$model->isNewRecord)
    $options['disabled'] = true;
else
    $options = array();

// Select para escolha do questionário
echo $form->dropDownListGroup(
        $model, 'questionario_id', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'data' => $questionarios,
        'htmlOptions' => $options,
    ),
        )
);
?>


<?php echo $form->textFieldGroup($model, 'pergunta', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 500)))); ?>

<?php echo $form->textFieldGroup($model, 'alternativa01', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 500)))); ?>

<?php echo $form->textFieldGroup($model, 'alternativa02', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 500)))); ?>

<?php echo $form->textFieldGroup($model, 'alternativa03', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 500)))); ?>

<?php echo $form->textFieldGroup($model, 'alternativa04', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 500)))); ?>

<?php echo $form->textFieldGroup($model, 'alternativa05', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 500)))); ?>

<?php
// Select para escolha do questionário
echo $form->dropDownListGroup(
        $model, 'alternativaCorreta', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'data' => array(
            'Selecione', 'Alternativa 01', 'Alternativa 02', 'Alternativa 03',
            'Alternativa 04', 'Alternativa 05',
        ),
        'htmlOptions' => array(
        ),
    ),
        )
);
?>

<?php echo $form->textFieldGroup($model, 'resposta', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 500)))); ?>

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
