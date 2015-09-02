<?php

class Funcoes {

    public static function pesqEmailFuncAdmin($empresa_id) {
        $funcionarios = Funcionario::model()->findAllByAttributes(array(
            'empresa_id' => $empresa_id,
            'permissao' => USER_ADMIN));
        $emails = array();
       
        foreach ($funcionarios as $func) {
            $emails[] = $func->email;
        }

        return $emails;
    }

}

?>