<?php

/**
 * This is the model class for table "questao".
 *
 * The followings are the available columns in table 'questao':
 * @property integer $id
 * @property string $pergunta
 * @property string $alternativa01
 * @property string $alternativa02
 * @property string $alternativa03
 * @property string $alternativa04
 * @property string $alternativa05
 * @property string $resposta
 * @property integer $questionario_id
 *
 * The followings are the available model relations:
 * @property Questionario $questionario
 */
class Questao extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'questao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pergunta, alternativa01, alternativa02, resposta, questionario_id', 'required'),
			array('questionario_id', 'numerical', 'integerOnly'=>true),
			array('pergunta, alternativa01, alternativa02, alternativa03, alternativa04, alternativa05, resposta', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pergunta, alternativa01, alternativa02, alternativa03, alternativa04, alternativa05, resposta, questionario_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'questionario' => array(self::BELONGS_TO, 'Questionario', 'questionario_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pergunta' => 'Pergunta',
			'alternativa01' => 'Alternativa01',
			'alternativa02' => 'Alternativa02',
			'alternativa03' => 'Alternativa03',
			'alternativa04' => 'Alternativa04',
			'alternativa05' => 'Alternativa05',
			'resposta' => 'Resposta',
			'questionario_id' => 'Questionario',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('pergunta',$this->pergunta,true);
		$criteria->compare('alternativa01',$this->alternativa01,true);
		$criteria->compare('alternativa02',$this->alternativa02,true);
		$criteria->compare('alternativa03',$this->alternativa03,true);
		$criteria->compare('alternativa04',$this->alternativa04,true);
		$criteria->compare('alternativa05',$this->alternativa05,true);
		$criteria->compare('resposta',$this->resposta,true);
		$criteria->compare('questionario_id',$this->questionario_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Questao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
