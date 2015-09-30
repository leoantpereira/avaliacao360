<?php

class Relatorios extends CFormModel {

    public $nomeFuncionario;
    public $questionario;

    public function rules() {
        return array(
            array('nomeFuncionario, questionario', 'required'),
        );
    }

    public function attributeLabels() {
        return array(
            'nomeFuncionario' => 'Funcionário',
            'questionario' => 'Questionário',
        );
    }

}
