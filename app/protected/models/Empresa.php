<?php

/**
 * This is the model class for table "empresa".
 *
 * The followings are the available columns in table 'empresa':
 * @property integer $id
 * @property string $cnpj
 * @property string $razaoSocial
 * @property string $nomeFantasia
 * @property string $telefone01
 * @property string $telefone02
 * @property string $email
 * @property integer $endereco_id
 *
 * The followings are the available model relations:
 * @property Endereco $endereco
 * @property Funcionario[] $funcionarios
 */
class Empresa extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'empresa';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cnpj, razaoSocial, nomeFantasia, endereco_id', 'required'),
            array('endereco_id', 'numerical', 'integerOnly' => true),
            array('cnpj', 'length', 'max' => 14),
            array('razaoSocial, nomeFantasia', 'length', 'max' => 200),
            array('telefone01, telefone02', 'length', 'max' => 11),
            array('email', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, cnpj, razaoSocial, nomeFantasia, telefone01, telefone02, email, endereco_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'endereco' => array(self::BELONGS_TO, 'Endereco', 'endereco_id'),
            'funcionarios' => array(self::HAS_MANY, 'Funcionario', 'empresa_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Número',
            'cnpj' => 'CNPJ',
            'razaoSocial' => 'Razão Social',
            'nomeFantasia' => 'Nome Fantasia',
            'telefone01' => 'Telefone',
            'telefone02' => 'Fax/Celular',
            'email' => 'E-mail',
            'endereco_id' => 'Endereco',
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
        $criteria->compare('cnpj', $this->cnpj, true);
        $criteria->compare('razaoSocial', $this->razaoSocial, true);
        $criteria->compare('nomeFantasia', $this->nomeFantasia, true);
        $criteria->compare('telefone01', $this->telefone01, true);
        $criteria->compare('telefone02', $this->telefone02, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('endereco_id', $this->endereco_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Empresa the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
