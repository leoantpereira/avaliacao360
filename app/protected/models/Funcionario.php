<?php

/**
 * This is the model class for table "funcionario".
 *
 * The followings are the available columns in table 'funcionario':
 * @property integer $id
 * @property string $nome
 * @property string $email
 * @property string $senha
 * @property integer $permissao
 * @property string $foto
 * @property integer $empresa_id
 *
 * The followings are the available model relations:
 * @property Avaliacao[] $avaliacaos
 * @property Avaliacao[] $avaliacaos1
 * @property Empresa $empresa
 * @property Departamento[] $departamentos
 */
class Funcionario extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'funcionario';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nome, email, senha, permissao, empresa_id', 'required'),
            array('permissao, empresa_id', 'numerical', 'integerOnly' => true),
            array('nome, email, foto', 'length', 'max' => 100),
            array('senha', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nome, email, senha, permissao, foto, empresa_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'avaliacaos' => array(self::HAS_MANY, 'Avaliacao', 'idFuncAvaliado'),
            'avaliacaos1' => array(self::HAS_MANY, 'Avaliacao', 'idAvaliador'),
            'empresa' => array(self::BELONGS_TO, 'Empresa', 'empresa_id'),
            'departamentos' => array(self::MANY_MANY, 'Departamento', 'funcionario_has_departamento(funcionario_id, departamento_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nome' => 'Nome',
            'email' => 'Email',
            'senha' => 'Senha',
            'permissao' => 'Permissao',
            'foto' => 'Foto',
            'empresa_id' => 'Empresa',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('senha', $this->senha, true);
        $criteria->compare('permissao', $this->permissao);
        $criteria->compare('foto', $this->foto, true);
        $criteria->compare('empresa_id', $this->empresa_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Funcionario the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Pesquisa pelo campo 'e-mail' (nome de usuário de login) da tabela Funcionario.
     * 
     * @param String $email
     * @return Funcionario Retorna o funcionario que contém o campo 'email' informado.
     * Caso não encontre retorna null.
     */
    public function pesqPorEmail($email) {
        $criteria = new CDbCriteria();

        $criteria->select = '*';
        $criteria->condition = 'email LIKE :email';
        $criteria->params = array(':email' => $email);
        return Funcionario::model()->find($criteria);
    }

    /**
     * Método executado antes de salvar um registro (no momento da validação dos dados)
     * 
     */
    protected function beforeSave() {

        // verifica se é um novo registro
        if ($this->isNewRecord) {
            $this->senha = md5($this->senha);
        } else { // está alterando o usuário
            $modelBD = $this->find();
            if (md5($this->senha) !== $modelBD->senha) {
                $this->addError('senha', 'Senha não confere.');
                return false;
            }
        }

        return parent::beforeSave();
    }

}