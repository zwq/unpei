<?php

/**
 * This is the model class for table "{{make_goods_vehicle}}".
 *
 * The followings are the available columns in table '{{make_goods_vehicle}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property integer $UserID
 * @property integer $GoodsID
 * @property string $VersionName
 * @property string $Name
 * @property string $PinYin
 * @property integer $CreateTime
 * @property integer $UpdateTime
 */
class MakeGoodsVehicle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{make_goods_vehicle}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID, UserID, GoodsID, Name, PinYin', 'required'),
			array('OrganID, UserID, GoodsID, CreateTime, UpdateTime', 'numerical', 'integerOnly'=>true),
			array('VersionName, PinYin', 'length', 'max'=>20),
			array('Name', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, OrganID, UserID, GoodsID, VersionName, Name, PinYin, CreateTime, UpdateTime', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'OrganID' => 'Organ',
			'UserID' => 'User',
			'GoodsID' => 'Goods',
			'VersionName' => 'Version Name',
			'Name' => 'Name',
			'PinYin' => 'Pin Yin',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('GoodsID',$this->GoodsID);
		$criteria->compare('VersionName',$this->VersionName,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('PinYin',$this->PinYin,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MakeGoodsVehicle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
