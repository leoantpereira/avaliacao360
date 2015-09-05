<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'empresa-form',
    'enableAjaxValidation' => false,
        ));

$options = array(
    'id' => 'cidades',
    'prompt' => 'Selecione',
    'ajax' => array('type' => 'POST',
        'dataType' => 'json',
        'url' => CController::createUrl('endereco/getCidades'),
        'data' => array('uf' => 'js:$(this).val()'),
        'success' => "function(data) {
            var selectCidades = document.getElementById('Endereco_cidade_id');
            
            // limpa o select
            if (selectCidades.length > 0){
                $('#Endereco_cidade_id').empty();
            }
                        
            for (i = 0; i < data.nome.length; i++) {
                var option = document.createElement('option');
                option.text = data.nome[i].nome;
                option.value = data.nome[i].id;
 
                try {
                    selectCidades.options.add(option);
                } catch (e) {
                    alert(e);
                }
            }        
        }
",
    ),
);
?>

<p class="help-block">Campos marcados com <span class="required">*</span> são de preenchimento obrigatório.</p>

<?php echo $form->errorSummary(array($modelEmpresa, $modelEndereco, $modelFuncionario)); ?>

<?php echo $form->textFieldGroup($modelEmpresa, 'cnpj', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 14)))); ?>

<?php echo $form->textFieldGroup($modelEmpresa, 'razaoSocial', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 200)))); ?>

<?php echo $form->textFieldGroup($modelEmpresa, 'nomeFantasia', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 200)))); ?>

<?php echo $form->textFieldGroup($modelEmpresa, 'telefone01', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 11)))); ?>

<?php echo $form->textFieldGroup($modelEmpresa, 'telefone02', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 11)))); ?>

<?php echo $form->textFieldGroup($modelEmpresa, 'email', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>

<h2>Endereço</h2>

<?php echo $form->textFieldGroup($modelEndereco, 'logradouro', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 200)))); ?>

<?php echo $form->textFieldGroup($modelEndereco, 'numero', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 10)))); ?>

<?php echo $form->textFieldGroup($modelEndereco, 'complemento', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 10)))); ?>

<?php echo $form->textFieldGroup($modelEndereco, 'bairro', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>

<?php echo $form->textFieldGroup($modelEndereco, 'cep', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 8)))); ?>

<?php
echo $form->dropDownListGroup(
        $modelEndereco, 'estado', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'data' => $modelEndereco->estados,
        'htmlOptions' => $options,
    )
        )
);
?>

<?php
echo $form->dropDownListGroup(
        $modelEndereco, 'cidade_id', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'data' => array('Selecione'),
    )
        )
);
?>
<h2>Dados do administrador</h2>

<?php echo $form->textFieldGroup($modelFuncionario, 'nome', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>

<?php echo $form->textFieldGroup($modelFuncionario, 'email', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>

<?php echo $form->passwordFieldGroup($modelFuncionario, 'senha', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 10)))); ?>

<?php
echo $form->passwordFieldGroup(
        $modelFuncionario, 'repetirSenha', array(
    'widgetOptions' => array(
        'htmlOptions' => array(
            'class' => 'span5',
            'maxlength' => 20
        )
    )
        )
);
?>

<?php echo $form->fileFieldGroup($modelFuncionario, 'foto', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 100)))); ?>

<div class="form-actions">
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $modelEmpresa->isNewRecord ? 'Cadastrar' : 'Salvar',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
