<?php
$this->breadcrumbs = array(
    'Questionários' => array('index'),
    'Responder',
);
?>

<h1>Responder Questionário</h1>

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'questionario-form',
    'enableAjaxValidation' => false,
        ));

$optionsFuncAvaliados = array(
    'id' => 'funcAvaliado',
    'prompt' => 'Selecione',
    'ajax' => array('type' => 'POST',
        'dataType' => 'json',
        'url' => CController::createUrl('questionario/getFuncAvaliados'),
        'data' => array('idAvaliacao' => 'js:$(this).val()'),
        'success' => "function(data) {
            var funcAvalidos = document.getElementById('Questionario_idFuncAvaliado');
            
            // limpa o select
            if (funcAvalidos.length > 0){
                $('#Questionario_idFuncAvaliado').empty();
            }
                   
            for (i = 0; i < data.funcionarios.length; i++) {
                var option = document.createElement('option');
                option.text = data.funcionarios[i].nomeFuncAvaliado;
                option.value = data.funcionarios[i].idFuncAvaliado;
 
                try {
                    funcAvalidos.options.add(option);
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

<?php echo $form->errorSummary($modelQuestionario); ?>

<?php
echo $form->dropDownListGroup(
        $modelQuestionario, 'id', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'data' => $questAResponder,
        'htmlOptions' => $optionsFuncAvaliados,
    ),
        )
);

echo $form->dropDownListGroup(
        $modelQuestionario, 'idFuncAvaliado', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'data' => array(
            'Selecione'
        ),
        'htmlOptions' => array(),
    ),
        )
);
?>

<div class="form-actions">
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $modelQuestionario->isNewRecord ? 'Responder' : 'Salvar',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
