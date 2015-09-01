<?php

/**
 * This is the model class for table "questionario".
 *
 * The followings are the available columns in table 'questionario':
 * @property integer $id
 * @property string $descricao
 * @property integer $empresa_id
 *
 * The followings are the available model relations:
 * @property Avaliacao[] $avaliacaos
 * @property Questao[] $questaos
 * @property Empresa $empresa
 */
class Questionario extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'questionario';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('descricao, empresa_id', 'required'),
            array('empresa_id', 'numerical', 'integerOnly' => true),
            array('descricao', 'length', 'max' => 500),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, descricao, empresa_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'avaliacaos' => array(self::HAS_MANY, 'Avaliacao', 'questionario_id'),
            'questaos' => array(self::HAS_MANY, 'Questao', 'questionario_id'),
            'empresa' => array(self::BELONGS_TO, 'Empresa', 'empresa_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Número',
            'descricao' => 'Descrição',
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
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('empresa_id', $this->empresa_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Questionario the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function findAllDescricao() {
        $questionarios = Questionario::model()->findAll();
        $descricoes = array('Selecione');

        foreach ($questionarios as $questionario) {
            $descricoes[$questionario->id] = $questionario->descricao;
        }

        return $descricoes;
    }

}
