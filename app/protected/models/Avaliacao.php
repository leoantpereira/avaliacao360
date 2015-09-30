<?php

/**
 * This is the model class for table "avaliacao".
 *
 * The followings are the available columns in table 'avaliacao':
 * @property integer $id
 * @property integer $idAvaliador
 * @property integer $questionario_id
 *
 * The followings are the available model relations:
 * @property Funcionario $idAvaliador0
 * @property Questionario $questionario
 * @property AvaliacaoHasFuncionario[] $avaliacaoHasFuncionarios
 */
class Avaliacao extends CActiveRecord {

    public $funcAvaliados;
    public $funcAvaliador;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'avaliacao';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idAvaliador, questionario_id, funcAvaliados', 'required'),
            array('idAvaliador, questionario_id', 'numerical', 'integerOnly' => true),
            array('idAvaliador', 'numerical', 'min' => 1, 'tooSmall' => 'Selecione o avaliador.'),
            array('questionario_id', 'numerical', 'min' => 1, 'tooSmall' => 'Selecione o questionário.'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, idAvaliador, questionario_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idAvaliador0' => array(self::BELONGS_TO, 'Funcionario', 'idAvaliador'),
            'questionario' => array(self::BELONGS_TO, 'Questionario', 'questionario_id'),
            'avaliacaoHasFuncionarios' => array(self::HAS_MANY, 'AvaliacaoHasFuncionario', 'idAvaliacao'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Número',
            'idAvaliador' => 'Avaliador',
            'questionario_id' => 'Questionario',
            'funcAvaliados' => 'Funcionários Avaliados',
            'funcAvaliador' => 'Avaliador',
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
        $criteria->compare('idAvaliador', $this->idAvaliador);
        $criteria->compare('questionario_id', $this->questionario_id);
        $criteria->compare('idAvaliador0.nome', $this->funcAvaliador);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Avaliacao the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
