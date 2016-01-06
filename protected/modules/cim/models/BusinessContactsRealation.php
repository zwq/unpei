<?php

/**
 * This is the model class for table "{{business_contacts_relation}}".
 *
 * The followings are the available columns in table '{{business_contacts_relation}}':
 * @property integer $ID
 * @property integer $ContactsID
 * @property string $GroupID
 */
class BusinessContactsRealation extends JPDActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BusinessContactsRealation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{business_contacts_relation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ContactsID', 'numerical', 'integerOnly'=>true),
			array('GroupID', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ContactsID, GroupID', 'safe', 'on'=>'search'),
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
			'ContactsID' => 'Contacts',
			'GroupID' => 'Group',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('ContactsID',$this->ContactsID);
		$criteria->compare('GroupID',$this->GroupID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}