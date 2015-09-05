<h1>Cadastro de Empresa</h1>

<?php
echo $this->renderPartial('_form', array(
    'modelEmpresa' => $modelEmpresa,
    'modelEndereco' => $modelEndereco,
    'modelFuncionario' => $modelFuncionario));
?>