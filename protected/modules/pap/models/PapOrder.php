<?php

/**
 * This is the model class for table "{{order}}".
 *
 * The followings are the available columns in table '{{order}}':
 * @property string $ID
 * @property integer $OrganID
 * @property string $OrderName
 * @property string $OrderSN
 * @property string $BuyerID
 * @property string $BuyerName
 * @property string $SellerID
 * @property string $SellerName
 * @property string $ShipSn
 * @property string $ShipLogis
 * @property integer $Payment
 * @property string $PayStatus
 * @property string $AlipayTN
 * @property string $GoodsAmount
 * @property string $ShipCost
 * @property string $TotalAmount
 * @property integer $Status
 * @property string $PayTime
 * @property string $AccountTime
 * @property string $DeliveryTime
 * @property string $ReceiptTime
 * @property string $CreateTime
 * @property string $UpdateTime
 * @property integer $IsDelete
 * @property integer $IsUnusual
 * @property string $PN
 * @property string $ReShipSn
 * @property string $ReShipLogis
 * @property integer $OrderType
 * @property string $RealPrice
 */
class PapOrder extends JPDActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PapOrder the static model class
     */
    public $BuyerPhone;
    public $SellerPhone;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return CDbConnection database connection
     */
    public function getDbConnection() {
        return Yii::app()->papdb;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{order}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('OrganID, OrderSN, BuyerID, SellerID, CreateTime, UpdateTime', 'required'),
            array('OrganID, Payment, Status, IsDelete, IsUnusual, OrderType, ReturnStatus, EvaStatus', 'numerical', 'integerOnly' => true),
            array('OrderName, BuyerName, SellerName, ShipSn, ShipLogis, PayStatus, AlipayTN, ReShipSn, ReShipLogis', 'length', 'max' => 64),
            array('OrderSN', 'length', 'max' => 24),
            array('BuyerID, SellerID', 'length', 'max' => 11),
            array('GoodsAmount, ShipCost, TotalAmount, RealPrice', 'length', 'max' => 11),
            array('PayTime, AccountTime, DeliveryTime, ReceiptTime, CreateTime, UpdateTime', 'length', 'max' => 13),
            array('PN', 'length', 'max' => 200),
            array('Discount', 'length', 'max' => 20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, OrganID, OrderName, OrderSN, BuyerID, BuyerName, SellerID, SellerName, ShipSn, ShipLogis, Payment, PayStatus, AlipayTN, GoodsAmount, ShipCost, TotalAmount, Status, PayTime, AccountTime, DeliveryTime, ReceiptTime, CreateTime, ConfirmTime,UpdateTime, IsDelete, IsUnusual, PN, ReShipSn, ReShipLogis, OrderType, RealPrice, ReturnStatus, Discount, EvaStatus', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'goodsinfo' => array(self::HAS_MANY, 'PapOrderGoods', 'OrderID', 'condition' => 'goodsinfo.IsDelete=0'),
            'goods' => array(self::HAS_MANY, 'PapOrderGoods', 'OrderID', 'condition' => 'goods.IsDelete=0'),
                //'goodsinfo' => array(self::HAS_MANY, 'PapOrderGoods', '', 'on' => 't.ID=goodsinfo.OrderID','condition'=>'goodsinfo.IsDelete=0'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'OrganID' => 'Organ',
            'OrderName' => 'Order Name',
            'OrderSN' => 'Order Sn',
            'BuyerID' => 'Buyer',
            'BuyerName' => 'Buyer Name',
            'SellerID' => 'Seller',
            'SellerName' => 'Seller Name',
            'ShipSn' => 'Ship Sn',
            'ShipLogis' => 'Ship Logis',
            'Payment' => 'Payment',
            'PayStatus' => 'Pay Status',
            'AlipayTN' => 'Alipay Tn',
            'GoodsAmount' => 'Goods Amount',
            'ShipCost' => 'Ship Cost',
            'TotalAmount' => 'Total Amount',
            'Status' => 'Status',
            'PayTime' => 'Pay Time',
            'AccountTime' => 'Account Time',
            'DeliveryTime' => 'Delivery Time',
            'ReceiptTime' => 'Receipt Time',
            'CreateTime' => 'Create Time',
            'ConfirmTime' => 'Confirm Time',
            'UpdateTime' => 'Update Time',
            'IsDelete' => 'Is Delete',
            'IsUnusual' => 'Is Unusual',
            'PN' => 'Pn',
            'ReShipSn' => 'Re Ship Sn',
            'ReShipLogis' => 'Re Ship Logis',
            'OrderType' => 'Order Type',
            'RealPrice' => 'Real Price',
            'ReturnStatus' => 'Return Status',
            'Discount' => 'Discount',
            'EvaStatus' => 'Eva Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria = new CDbCriteria;

        $criteria->compare('ID', $this->ID, true);
        $criteria->compare('OrganID', $this->OrganID);
        $criteria->compare('OrderName', $this->OrderName, true);
        $criteria->compare('OrderSN', $this->OrderSN, true);
        $criteria->compare('BuyerID', $this->BuyerID, true);
        $criteria->compare('BuyerName', $this->BuyerName, true);
        $criteria->compare('SellerID', $this->SellerID, true);
        $criteria->compare('SellerName', $this->SellerName, true);
        $criteria->compare('ShipSn', $this->ShipSn, true);
        $criteria->compare('ShipLogis', $this->ShipLogis, true);
        $criteria->compare('Payment', $this->Payment);
        $criteria->compare('PayStatus', $this->PayStatus, true);
        $criteria->compare('AlipayTN', $this->AlipayTN, true);
        $criteria->compare('GoodsAmount', $this->GoodsAmount, true);
        $criteria->compare('ShipCost', $this->ShipCost, true);
        $criteria->compare('TotalAmount', $this->TotalAmount, true);
        $criteria->compare('Status', $this->Status);
        $criteria->compare('PayTime', $this->PayTime, true);
        $criteria->compare('AccountTime', $this->AccountTime, true);
        $criteria->compare('DeliveryTime', $this->DeliveryTime, true);
        $criteria->compare('ReceiptTime', $this->ReceiptTime, true);
        $criteria->compare('CreateTime', $this->CreateTime, true);
        $criteria->compare('ConfirmTime', $this->ConfirmTime);
        $criteria->compare('UpdateTime', $this->UpdateTime, true);
        $criteria->compare('IsDelete', $this->IsDelete);
        $criteria->compare('IsUnusual', $this->IsUnusual);
        $criteria->compare('PN', $this->PN, true);
        $criteria->compare('ReShipSn', $this->ReShipSn, true);
        $criteria->compare('ReShipLogis', $this->ReShipLogis, true);
        $criteria->compare('OrderType', $this->OrderType);
        $criteria->compare('RealPrice', $this->RealPrice, true);
        $criteria->compare('ReturnStatus', $this->ReturnStatus);
        $criteria->compare('Discount', $this->Discount, true);
        $criteria->compare('EvaStatus', $this->EvaStatus);
        $criteria->addCondition('IsDelete=0');
        $criteria->compare('BuyerName', $_GET['PapOrder']['BuyerPhone'], true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
