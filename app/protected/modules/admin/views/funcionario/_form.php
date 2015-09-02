<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'funcionario-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<p class="help-block">Campos marcados com <span class="required">*</span> são de preenchimento obrigatório.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'nome', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>

<?php echo $form->textFieldGroup($model, 'email', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>

<?php echo $form->passwordFieldGroup($model, 'senha', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 10)))); ?>

<?php
// verifica se está cadastrando novo usuário
if ($model->isNewRecord) {
    echo $form->passwordFieldGroup(
            $model, 'repetirSenha', array(
        'widgetOptions' => array(
            'htmlOptions' => array(
                'class' => 'span5',
                'maxlength' => 20
            )
        )
            )
    );
}
?>

<?php
// Select para permissão do usuário
echo $form->dropDownListGroup(
        $model, 'permissao', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'data' => array(
            'Selecione', 'Chefe de departamento', 'Funcionário'
        ),
        'htmlOptions' => array(
        ),
    ),
        )
);
?>

<?php
// Select para escolha do departamento
echo $form->dropDownListGroup(
        $model, 'departamento', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'data' => $departamentos,
        'htmlOptions' => array(
        ),
    ),
        )
);
?>

<?php echo $form->fileFieldGroup($model, 'foto', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>

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
