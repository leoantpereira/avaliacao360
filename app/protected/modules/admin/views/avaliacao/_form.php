<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'avaliacao-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Campos marcados com <span class="required">*</span> são de preenchimento obrigatório.</p>

<?php echo $form->errorSummary($model); ?>

<?php
// Select para escolha do avaliador
echo $form->dropDownListGroup(
        $model, 'idAvaliador', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'data' => $nomesTodosFunc,
        'htmlOptions' => array(
        ),
    ),
        )
);
?>

<?php
// Select para escolha do questionário
echo $form->dropDownListGroup(
        $model, 'questionario_id', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'data' => $questionarios,
        'htmlOptions' => array(
        ),
    ),
        )
);
?>

<?php
echo $form->select2Group(
        $model, 'funcAvaliados', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'asDropDownList' => false,
        'options' => array(
            'tags' => $nomesAvaliados,
            'placeholder' => 'clique para selecionar os funcionários!',
            /* 'width' => '40%', */
            'tokenSeparators' => array(',', ' ')
        )
    )
        )
);
?>

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
