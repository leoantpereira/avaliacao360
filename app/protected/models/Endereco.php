<?php

/**
 * This is the model class for table "endereco".
 *
 * The followings are the available columns in table 'endereco':
 * @property integer $id
 * @property string $logradouro
 * @property string $numero
 * @property string $complemento
 * @property string $bairro
 * @property string $cep
 * @property integer $cidade_id
 *
 * The followings are the available model relations:
 * @property Empresa[] $empresas
 * @property Cidade $cidade
 */
class Endereco extends CActiveRecord {

    public $estado;
    public $estados = array(
        '1' => 'AC',
        '2' => 'AL',
        '3' => 'AM',
        '4' => 'AP',
        '5' => 'BA',
        '6' => 'CE',
        '7' => 'DF',
        '8' => 'ES',
        '9' => 'GO',
        '10' => 'MA',
        '11' => 'MG',
        '12' => 'MS',
        '13' => 'MT',
        '14' => 'PA',
        '15' => 'PB',
        '16' => 'PE',
        '17' => 'PI',
        '18' => 'PR',
        '19' => 'RJ',
        '20' => 'RN',
        '21' => 'RO',
        '22' => 'RR',
        '23' => 'RS',
        '24' => 'SC',
        '25' => 'SE',
        '26' => 'SP',
        '27' => 'TO');

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'endereco';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('logradouro, numero, bairro, cep, cidade_id, estado', 'required'),
            array('cidade_id', 'numerical', 'integerOnly' => true),
            array('logradouro', 'length', 'max' => 200),
            array('numero, complemento', 'length', 'max' => 10),
            array('bairro', 'length', 'max' => 100),
            array('cep', 'length', 'max' => 8),
            array('cidade_id', 'numerical', 'min' => 1, 'tooSmall' => 'Selecione a cidade.'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, logradouro, numero, complemento, bairro, cep, cidade_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'empresas' => array(self::HAS_MANY, 'Empresa', 'endereco_id'),
            'cidade' => array(self::BELONGS_TO, 'Cidade', 'cidade_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'logradouro' => 'Logradouro',
            'numero' => 'Número',
            'complemento' => 'Complemento',
            'bairro' => 'Bairro',
            'cep' => 'CEP',
            'cidade_id' => 'Cidade',
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
        $criteria->compare('logradouro', $this->logradouro, true);
        $criteria->compare('numero', $this->numero, true);
        $criteria->compare('complemento', $this->complemento, true);
        $criteria->compare('bairro', $this->bairro, true);
        $criteria->compare('cep', $this->cep, true);
        $criteria->compare('cidade_id', $this->cidade_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Endereco the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
