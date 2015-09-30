<?php
$this->breadcrumbs = array(
    'teste'
);

$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'form-relatorios',
    'enableAjaxValidation' => false,
        ));

$options = array(
    'id' => 'funcionarios',
    //'prompt' => 'Selecione',
    'ajax' => array('type' => 'POST',
        'dataType' => 'json',
        'url' => CController::createUrl('relatorios/getQuestionarios'),
        'data' => array('funcionario' => 'js:$(this).val()'),
        'success' => "function(data) {
            var selectFuncionario = document.getElementById('Relatorios_questionario');
            
            // limpa o select
            if (selectFuncionario.length > 0){
                $('#Relatorios_questionario').empty();
            }
                        
            for (i = 0; i < data.questionarios.length; i++) {
                var option = document.createElement('option');
                option.text = data.questionarios[i].descricao;
                option.value = data.questionarios[i].id;
 
                try {
                    selectFuncionario.options.add(option);
                } catch (e) {
                    alert(e);
                }
            }        
        }
",
    ),
);
?>

<h1>Relatórios</h1>

<?php
echo $form->dropDownListGroup(
        $model, 'nomeFuncionario', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'data' => $nomesFuncionarios,
        'htmlOptions' => $options,
    ),
        )
);

echo $form->dropDownListGroup(
        $model, 'questionario', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'data' => array(),
        'htmlOptions' => array(),
    )
        )
);
?>

<div class="form-actions">
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => 'Gerar relatório',
    ));
    ?>
</div>

<?php
$this->endWidget();
?>