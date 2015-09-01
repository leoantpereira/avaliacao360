<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $funcLogado = Funcionario::model()->findByAttributes(array('email' => $this->username));

        if ($funcLogado === null) { // usuário inválido
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            $this->errorMessage = 'E-mail inválido.';
        } else if ($funcLogado->senha != $this->password) { // senha inválida
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            $this->errorMessage = 'Senha inválida.';
        } else {
            $this->_id = $funcLogado->id;
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

}
