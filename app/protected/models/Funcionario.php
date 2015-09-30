<?php

// variáveis globais referentes as permissões dos funcionário
define('USER_CHEFE_DEPARTAMENTO', 1);
define('USER_NORMAL', 2);
define('USER_ADMIN', 3);

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
 * @property integer $departamento_id
 *
 * The followings are the available model relations:
 * @property Avaliacao[] $avaliacaos
 * @property Empresa $empresa
 */
class Funcionario extends CActiveRecord {

    public $repetirSenha;

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
            array('nome, email, senha, permissao, repetirSenha, departamento_id', 'required'),
            array('permissao, empresa_id', 'numerical', 'integerOnly' => true),
            array('nome, email, foto', 'length', 'max' => 100),
            array('email', 'email'),
            array('permissao', 'numerical', 'min' => 1, 'tooSmall' => 'Selecione a permissão.'),
            array('departamento_id', 'numerical', 'min' => 1, 'tooSmall' => 'Selecione o departamento.'),
            array('senha', 'length', 'min' => 6, 'max' => 10),
            array('foto', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => true),
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
            'departamento' => array(self::BELONGS_TO, 'Departamento', 'departamento_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Número',
            'nome' => 'Nome',
            'email' => 'E-mail',
            'senha' => 'Senha',
            'permissao' => 'Permissão',
            'foto' => 'Foto',
            'empresa_id' => 'Empresa',
            'departamento_id' => 'Departamento',
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

        if ($this->scenario == 'viewPerfil')
            $criteria->compare('id', '<>' . $this->id, true);
        else
            $criteria->compare('id', $this->id, true);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('senha', $this->senha, true);
        $criteria->compare('permissao', $this->permissao);
        $criteria->compare('foto', $this->foto, true);
        $criteria->compare('empresa_id', $this->empresa_id);
        $criteria->compare('departamento_id', $this->departamento_id);

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

    public static function pesqTodosNomes($idEmpresa) {
        $funcionarios = Funcionario::model()->findAllByAttributes(array(
            'empresa_id' => $idEmpresa,
        ));
        $nomesTodosFunc = array('Selecione');

        foreach ($funcionarios as $func) {
            $nomesTodosFunc[$func->id] = $func->id . ' - ' . $func->nome;
        }

        return $nomesTodosFunc;
    }

    public static function verificaUserAdmin($funcionario) {
        if ($funcionario->permissao == USER_ADMIN)
            return array($funcionario->email);
        return array(null);
    }

    /**
     * Verifica se o usuário digitou as senhas iguais nos dois campos na hora do cadastro.
     * 
     * @param Funcionario $model Funcionário
     */
    public static function verificaSenhasCadastro($model) {
        if (isset($model->senha)) {
            if ($model->senha != $model->repetirSenha) {
                $model->addError('repetirSenha', 'Senhas não conferem.');
            }
        }
    }

    public function salvaImagem($model) {
        $path = Yii::getPathOfAlias('webroot') . '/images/funcionarios/' . $model->empresa->cnpj . '/';
        if (!file_exists($path)) {
            mkdir($path);
        }
        $numeros = '0123456789';
        $arquivo = explode(".", $model->foto->getName());
        $nomeFoto = $arquivo[0];
        $extensaoFoto = $arquivo[1];

        $nomeArquivo = str_shuffle($nomeFoto . $numeros) . '.' . $extensaoFoto;
        $model->foto->saveAs($path . $nomeArquivo);
        $model->foto = $nomeArquivo;
    }

    public static function setaAutorizacao($funcionario) {
        $auth = Yii::app()->authManager;

        //Funcionario::model()->criaAutorizacoes();

        if ($funcionario->permissao == USER_ADMIN)
            $auth->assign('admin', $funcionario->id);
        else if ($funcionario->permissao == USER_CHEFE_DEPARTAMENTO)
            $auth->assign('chefeDepartamento', $funcionario->id);
        else
            $auth->assign('funcionario', $funcionario->id);
    }

    public static function criaAutorizacoes() {
        $auth = Yii::app()->authManager;

        // funcionários
        $auth->createOperation('createFuncionario', 'Cadastro de funcionário.');
        $auth->createOperation('viewFuncionario', 'Visualização de funcionário.');
        $auth->createOperation('deleteFuncionario', 'Exclusão de funcionário.');
        $auth->createOperation('adminFuncionario', 'Área administrativa de funcionários.');
        $auth->createOperation('updateFuncionario', 'Alteração de funcionário.');
        // avaliações
        $auth->createOperation('createAvaliacao', 'Cadastro de avaliação.');
        $auth->createOperation('viewAvaliacao', 'Visualização de avaliação.');
        $auth->createOperation('deleteAvaliacao', 'Exclusão de avaliação.');
        $auth->createOperation('adminAvaliacao', 'Área administrativa de avaliações.');
        $auth->createOperation('updateAvaliacao', 'Alteração de avaliação.');
        // departamentos
        $auth->createOperation('createDepartamento', 'Cadastro de departamento.');
        $auth->createOperation('viewDepartamento', 'Visualização de departamento.');
        $auth->createOperation('deleteDepartamento', 'Exclusão de departamento.');
        $auth->createOperation('adminDepartamento', 'Área administrativa de departamentos.');
        $auth->createOperation('updateDepartamento', 'Alteração de departamento.');
        // questões
        $auth->createOperation('createQuestao', 'Cadastro de questão.');
        $auth->createOperation('viewQuestao', 'Visualização de questão.');
        $auth->createOperation('deleteQuestao', 'Exclusão de questão.');
        $auth->createOperation('adminQuestao', 'Área administrativa de questões.');
        $auth->createOperation('updateQuestao', 'Alteração de questão.');
        // questionários
        $auth->createOperation('createQuestionario', 'Cadastro de questionário.');
        $auth->createOperation('viewQuestionario', 'Visualização de questionário.');
        $auth->createOperation('deleteQuestionario', 'Exclusão de questionário.');
        $auth->createOperation('adminQuestionario', 'Área administrativa de questionários.');
        $auth->createOperation('updateQuestionario', 'Alteração de questionário.');
        $auth->createOperation('responderQuestionario', 'Resposta a um questionário.');

        $task = $auth->createTask('tarefaEdicao', 'Esta é uma tarefa de edição.');
        $task->addChild('updateFuncionario');
        $task->addChild('updateAvaliacao');
        $task->addChild('updateDepartamento');
        $task->addChild('updateQuestao');
        $task->addChild('updateQuestionario');

        $task = $auth->createTask('tarefaCriacao', 'Esta é uma tarefa de criação.');
        $task->addChild('createFuncionario');
        $task->addChild('createAvaliacao');
        $task->addChild('createDepartamento');
        $task->addChild('createQuestao');
        $task->addChild('createQuestionario');

        $task = $auth->createTask('tarefaVisualizacao', 'Esta é uma tarefa de visualização.');
        $task->addChild('viewFuncionario');
        $task->addChild('viewAvaliacao');
        $task->addChild('viewDepartamento');
        $task->addChild('viewQuestao');
        $task->addChild('viewQuestionario');

        $task = $auth->createTask('tarefaAdministracao', 'Esta é uma tarefa de administração.');
        $task->addChild('adminFuncionario');
        $task->addChild('adminAvaliacao');
        $task->addChild('adminDepartamento');
        $task->addChild('adminQuestao');
        $task->addChild('adminQuestionario');

        $task = $auth->createTask('tarefaExclusao', 'Esta é uma tarefa de exclusão.');
        $task->addChild('deleteFuncionario');
        $task->addChild('deleteAvaliacao');
        $task->addChild('deleteDepartamento');
        $task->addChild('deleteQuestao');
        $task->addChild('deleteQuestionario');

        $task = $auth->createTask('tarefaResponder', 'Esta é uma tarefa de resposta.');
        $task->addChild('responderQuestionario');

        $role = $auth->createRole('admin');
        // funcionários
        $role->addChild('createFuncionario');
        $role->addChild('viewFuncionario');
        $role->addChild('deleteFuncionario');
        $role->addChild('adminFuncionario');
        $role->addChild('updateFuncionario');
        // avaliações
        $role->addChild('createAvaliacao');
        $role->addChild('viewAvaliacao');
        $role->addChild('deleteAvaliacao');
        $role->addChild('adminAvaliacao');
        $role->addChild('updateAvaliacao');
        // departamentos
        $role->addChild('createDepartamento');
        $role->addChild('viewDepartamento');
        $role->addChild('deleteDepartamento');
        $role->addChild('adminDepartamento');
        $role->addChild('updateDepartamento');
        // questões
        $role->addChild('createQuestao');
        $role->addChild('viewQuestao');
        $role->addChild('deleteQuestao');
        $role->addChild('adminQuestao');
        $role->addChild('updateQuestao');
        // questionários
        $role->addChild('createQuestionario');
        $role->addChild('viewQuestionario');
        $role->addChild('deleteQuestionario');
        $role->addChild('adminQuestionario');
        $role->addChild('updateQuestionario');

        $role = $auth->createRole('chefeDepartamento');
        // funcionários
        $role->addChild('viewFuncionario');
        // avaliações
        $role->addChild('viewAvaliacao');
        // questões
        $role->addChild('viewQuestao');
        $role->addChild('updateQuestao');
        // questionários
        $role->addChild('responderQuestionario');
        $role->addChild('viewQuestionario');

        $role = $auth->createRole('funcionario');
        // avaliações
        $role->addChild('viewAvaliacao');
        // questões
        $role->addChild('viewQuestao');
        $role->addChild('updateQuestao');
        // questionários
        $role->addChild('responderQuestionario');
        $role->addChild('viewQuestionario');
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
