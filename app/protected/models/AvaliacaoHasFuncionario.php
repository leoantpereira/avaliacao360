<?php

/**
 * This is the model class for table "avaliacao_has_funcionario".
 *
 * The followings are the available columns in table 'avaliacao_has_funcionario':
 * @property integer $idAvaliacao
 * @property integer $idFuncAvaliado
 * @property integer $idQuestao
 * @property string $resposta
 * @property string $dataHora
 *
 * The followings are the available model relations:
 * @property Avaliacao $idAvaliacao0
 * @property Funcionario $idFuncAvaliado0
 * @property Questao $idQuestao0
 */
class AvaliacaoHasFuncionario extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'avaliacao_has_funcionario';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idAvaliacao, idFuncAvaliado, idQuestao', 'required'),
            array('resposta', 'required', 'on' => 'responder'),
            array('idAvaliacao, idFuncAvaliado, idQuestao', 'numerical', 'integerOnly' => true),
            array('idAvaliacao', 'numerical', 'min' => 1, 'tooSmall' => 'Selecione a avaliação.'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idAvaliacao, idFuncAvaliado, idQuestao, resposta, dataHora', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idAvaliacao0' => array(self::BELONGS_TO, 'Avaliacao', 'idAvaliacao'),
            'idFuncAvaliado0' => array(self::BELONGS_TO, 'Funcionario', 'idFuncAvaliado'),
            'idQuestao0' => array(self::BELONGS_TO, 'Questao', 'idQuestao'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idAvaliacao' => 'Questionário',
            'idFuncAvaliado' => 'Funcionário Avaliado',
            'idQuestao' => 'Questão',
            'resposta' => 'Resposta',
            'dataHora' => 'Data',
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

        $criteria->compare('idAvaliacao', $this->idAvaliacao);
        $criteria->compare('idFuncAvaliado', $this->idFuncAvaliado);
        $criteria->compare('idQuestao', $this->idQuestao);
        $criteria->compare('resposta', $this->resposta, true);
        $criteria->compare('dataHora', $this->dataHora, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AvaliacaoHasFuncionario the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
