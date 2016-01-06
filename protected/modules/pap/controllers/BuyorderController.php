<?php

class BuyorderController extends PapmallController {

//    public function actionIndex() {
//        $this->render("index");
//    }  
    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'minLength' => 4,
                'maxLength' => 4,
                'backColor' => 0xFFFFFF,
                'width' => 60,
                'height' => 40
            )
        );
    }

    //验证验证码
    public function actionCheckcode() {
        $codetxt = Yii::app()->request->getParam('code');
        $code = $this->createAction('captcha')->getVerifyCode();
        if (trim($codetxt) == $code) {
            $cookie = Yii::app()->request->getCookies();
            unset($cookie['mallcheckcode']);
            unset(Yii::app()->session['mallquery']);
            echo json_encode(array('msg' => 'code success', 'success' => 1));
        } else {
            echo json_encode(array('msg' => 'code fail', 'success' => 2));
        }
    }

    public function actionCart() {
        if ($_POST) {
            $cart = Yii::app()->request->getParam('cart');
            $cartIDs = $cart ? $cart : explode(",", Yii::app()->session['var']);
            
            Yii::app()->session['cart'] = implode(',', $cartIDs);
            $this->redirect(array('delivery'));
        } else {
            $this->pageTitle = Yii::app()->name . '购物车';
            //购物车清单
            $cart = BuyGoodsService::getcart($cartids = array(), $payment = null);
            // $cart=RPCClient::call('BuyGoodsService_getcart');
            //支付方式折扣率
            $data = array('carlist' => $cart);
        }
        $this->render('cart', $data);
    }

    //修改购物车商品数量
    public function actionEditquan() {
        $ID = Yii::app()->request->getParam('ID');
        $Quantity = Yii::app()->request->getParam('Quantity');
        $res = RPCClient::call('BuyGoodsService_updatequan', array('ID' => $ID, 'Quantity' => $Quantity));
        echo $res;
    }

    //删除购物车商品
    public function actionDelgoods() {
        $ID = Yii::app()->request->getParam('ID');
        $res = RPCClient::call('BuyGoodsService_delgood', array('ID' => $ID));
        echo $res;
    }

    //收货地址
    public function actionDelivery() {
        $this->pageTitle = Yii::app()->name . '选择收货地址';
        $organID = Yii::app()->user->getOrganID();
        $purchase = Yii::app()->request->getParam('purchase'); //判断是否从采购单中进来
        $purchasekey = rtrim(Yii::app()->request->getParam('purchasekey'), ",");
        if (!empty($purchasekey)) {
            $cartIDs = explode(",", $purchasekey);
        } else {
            $cartIDs = explode(",", Yii::app()->session['cart']);
        }
        if (Yii::app()->request->getParam('payment')) {
            $payment = Yii::app()->request->getParam('payment');
        } else {
            $payment = 1;
        }
        if ($purchase) {
            $list = BuyGoodsService::getpurchase($cartIDs, $payment);
        } else {
            $list = BuyGoodsService::getcart($cartIDs, $payment);
        }
        if (empty($list)) {
            $this->redirect(array('/pap/home/index'));
        }
        if (!empty(Yii::app()->session['cart']) || !empty($purchasekey)) {
            $model = new JpdReceiveAddress();
            //获取服务店收货地址
            //山东省收货地置顶
            $firstaddress = JpdReceiveAddress::model()->findAll('OrganID=:organID and State=:State order by CreateTime DESC', array(':organID' => $organID, ':State' => '370000'));
            $address = JpdReceiveAddress::model()->findAll('OrganID=:organID and State!=:State order by CreateTime DESC', array(':organID' => $organID, ':State' => '370000'));
            $address = array_merge($firstaddress, $address);
            //获取我的优惠券
            $dataProvider = BuyGoodsService::mycoupon();
            $arr = array('address' => $address, 'result' => $list, 'cartIDs' => $cartIDs,
                'model' => $model, 'payment' => $payment, 'purchase' => $purchase, 'dataProvider' => $dataProvider);
            $this->render('delivery', $arr);
        } else {
            $this->redirect(array('/pap/home/index'));
        }
    }

    public function actionDeli() {
        if (Yii::app()->request->getParam('payment')) {
            $payment = Yii::app()->request->getParam('payment');
        } else {
            $payment = 1;
        }
        $list = BuyGoodsService::getcart($cartIDs, $payment);
        echo json_encode($list);
    }

    /**
     * 立即购买
     */
    public function actionBuynow() {
        $goodsId = Yii::app()->request->getParam('goodsid');
        if (!$goodsId) {
            $this->redirect(array('/pap/home/index'));
        }
        $this->pageTitle = Yii::app()->name . '-收货地址';
        $organID = Yii::app()->user->getOrganID();
        $payment = Yii::app()->request->getParam("payment");
        if ($payment) {
            $payment = Yii::app()->request->getParam("payment");
        } else {
            $payment = 1;
        }

        //获取商品信息
        $goods = MallService::getGoodByID($goodsId, $payment);
        if (!$goods) {
            $this->redirect(array('/pap/home/index'));
        }
        //获取该商品经销商订单最小交易额
        $turnover = PapOrderMinTurnover::model()->find("OrganID=:ID", array(":ID" => $goods['OrganID']));
        if ($turnover) {
            $goods["MinTurnover"] = $turnover['MinTurnover'];
        }
        //获取我的优惠券
        $dataProvider = BuyGoodsService::mycoupon();
        $model = new JpdReceiveAddress();
        $address = JpdReceiveAddress::model()->findAll('OrganID=:organID order by CreateTime DESC', array(':organID' => $organID));
        $amount = intval(Yii::app()->request->getParam("goods_amout")) > 0 ? intval(Yii::app()->request->getParam("goods_amout")) : 1;
        $data = array('goods' => $goods, 'address' => $address, "amount" => $amount, 'model' => $model, 'dataProvider' => $dataProvider);
        $this->render('buynow', $data);
    }

    //添加收货地址
    public function actionAddaddress() {
        $model = new JpdReceiveAddress();
        $this->performAjaxValidation($model);

        if (isset($_POST)) {
            if ($_POST['key'] != '') {
                $model = JpdReceiveAddress::model()->findbyPk($_POST['key']);
            }
            $model->ContactName = $_POST['name'];
            $model->State = $_POST['province'];
            $model->City = $_POST['city'];
            $model->District = $_POST['area'];
            $model->Address = $_POST['address'];
            $model->Phone = $_POST['phone'];
            $model->ZipCode = $_POST['zipcode'];
            if ($model->validate()) {
                if ($model->save()) {
                    echo json_encode(array('success' => '1'));
                } else {
                    echo json_encode(array('success' => '2'));
                }
            }
        }
    }

    //修改收货地址
    public function actionUpdateaddress() {
        $id = Yii::app()->request->getParam('id');
        $address = array();
        $address = JpdReceiveAddress::model()->findByPk($id)->attributes;
        echo json_encode($address);
    }

    //表单验证
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'address-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * 立即购买一件商品生成订单
     */
    public function actionBuynoworder() {
        $goodsId = Yii::app()->request->getParam("goodsid");
        if (!$goodsId) {
            $this->redirect(array('/pap/home/index'));
        }
        $payment = Yii::app()->request->getParam("payment");
        if ($payment) {
            $payment = Yii::app()->request->getParam("payment");
        } else {
            $payment = 1;
        }

        if (!$payment) {
            $this->redirect(array('/pap/home/index'));
        }
        //获取物流  前台页面input name属性
        $ShipLogis = Yii::app()->request->getParam("logistics");
        $quantity = Yii::app()->request->getParam("quantity");
        if (!$quantity) {
            $this->redirect(array('/pap/home/index'));
        }
        $addressId = Yii::app()->request->getParam("addr");

        if (!$addressId) {
            $this->redirect(array('/pap/home/index'));
        }

        $ship = $this->getShip($addressId);
        if (!$ship) {
            $this->redirect(array('/pap/home/index'));
        }

        $goods = MallService::getGoodByID($goodsId, $payment);
        $locate = Yii::app()->request->getParam('locate');
        //优惠券减免金额
        $lottid = Yii::app()->request->getParam("lott");
        $PromoID = Yii::app()->request->getParam('PromoID');
        $usecouponID = Yii::app()->request->getParam('usecouponID');
        /*
         * 方法参数:$goods：商品信息 $payment:支付方式 $ShipLogis:物流公司 $ship:收货地址
         */
        $params = array('goods' => $goods, 'payment' => $payment, 'shiplogis' => $ShipLogis, 'ship' => $ship,
            'quantity' => $quantity, 'locate' => $locate, 'usecouponID' => $usecouponID
        );
        $orderId = BuyGoodsService::createbuynoworder($params);
         if($orderId&&$lottid&&$PromoID){
             $this->redirect(array("payment", "id" => $orderId,'lottid'=>$lottid,'promoid'=>$PromoID));
        }
        $this->redirect(array("payment", "id" => $orderId));
    }

    //生成订单
    public function actionAddorder() {
        $IDs = Yii::app()->request->getParam('cartIDs');
        $purchase = Yii::app()->request->getParam('purchase');
        //使用优惠券ID
        $usecouponID = Yii::app()->request->getParam('usecouponID');
        $lottid = Yii::app()->request->getParam("lott");
        $PromoID = Yii::app()->request->getParam('PromoID');
        if (!$IDs) {
            $this->redirect('/pap/home/index');
        }
        $cartIDs = str_replace(' ', '', $IDs);
        $cartIdAtrr = explode(",", $cartIDs);
        if (!$cartIdAtrr) {
            $this->redirect(array('/pap/home/index'));
        }
        //获取支付方式
        $payment = Yii::app()->request->getParam("payment");

        if (!$payment) {
            $this->redirect(array('/pap/home/index'));
        }
        //获取商品信息
        if ($purchase) {
            $cartsGoods = BuyGoodsService::getpurchase($cartIdAtrr, $payment);
        } else {
            $cartsGoods = BuyGoodsService::getcart($cartIdAtrr, $payment);
        }

        if (!$cartsGoods || count($cartsGoods) == 0) {
            $this->redirect(array('/pap/home/index'));
        }

        //获取收货地址,物流input name值
        $ShipLogis = Yii::app()->request->getParam("logistics");
        $addressID = Yii::app()->request->getParam("addr");
        if (!$addressID) {
            $this->redirect(array('/pap/home/index'));
        }
        $ship = $this->getShip($addressID);

        if (!$ship) {
            $this->redirect(array('/pap/home/index'));
        }
        //生成订单
        if ($purchase) {
            $orderIdStr = RPCClient::call('BuyGoodsService_createorderFromPurchase', array('purchaseGoods' => $cartsGoods,
                        'payment' => $payment, 'ShipLogis' => $ShipLogis, 'ship' => $ship));
        } else {
            $orderIdStr = RPCClient::call('BuyGoodsService_createorder', array('cartsGoods' => $cartsGoods,
                        'payment' => $payment, 'ShipLogis' => $ShipLogis, 'ship' => $ship,
                        'usecouponID' => $usecouponID));
        }
        if($orderIdStr&&$lottid&&$PromoID){
             $this->redirect(array("payment", "id" => $orderIdStr,'lottid'=>$lottid,'promoid'=>$PromoID));
        }
        $this->redirect(array("payment", "id" => $orderIdStr));
    }

    //获取收货地址
    public static function getShip($id) {
        //$model=  OrderService::getship($id);
        $model = JpdReceiveAddress::model()->findByPk($id)->attributes;
        return $model;
    }

    //支付
    public function actionPayment() {
        if (!$_GET['id']) {
            $this->redirect(array('index'));
        }
        $this->pageTitle = Yii::app()->name . '-' . "选择付款方式";
        $result = array();
        $ids = explode(',', $_GET['id']);
        $lottid=Yii::app()->request->getParam('lottid');
        $promoid=Yii::app()->request->getParam('promoid');
        foreach ($ids as $orderId) {
            $orderArr = OrderService::order($orderId);
            if (!$orderArr) {
                $this->redirect(array('index'));
            }
            $result[] = $orderArr;
        }
        $this->render('payment', array('result' => $result,'lottid'=>$lottid,'promoid'=>$promoid));
    }

    /**
     * 支付宝点击付款
     */
    public function actionPayOrder() {
        $orderid = Yii::app()->request->getParam('id');
        $result = OrderService::paypal($orderid);
        $alipay = Yii::app()->alipay;
        $request = new AlipayGuaranteeRequest();
        foreach ($result as $k => $rs) {
            $request->$k = $rs;
        }
        $request->logistics_payment = "BUYER_PAY";
        $request->logistics_type = "EXPRESS";
        $request->quantity = 1;
        //构建支付表单
        echo $alipay->buildForm($request);
    }

    /*
     * 获取购物车数量
     */

    public function actionGetcount() {
        echo OrderService::getCartCount();
    }

    //获取登录账户是否存在支付宝帐号
    public function actionGetaccount() {
        $orderid = Yii::app()->request->getParam('orderid');
        $order = PapOrder::model()->findByPk($orderid)->attributes;
        //获取卖家支付宝帐号
        // $paypal = JpdFinancialPaypal::model()->find('OrganID=:ID ', array(':ID' => $order['SellerID']));
        $account = JpdFinancialPaypal::model()->find('OrganID=:organID and Status=:stu', array(':organID' => $order['SellerID'], ':stu' => 0));
        if (isset($account['PaypalAccount']) && !empty($account['PaypalAccount'])) {
            PapOrder::model()->UpdateByPk($orderid, array('AlipayTN' => 1));
            echo json_encode(array('success' => 1));
        } else {
            $message = $order['SellerName'] . ' ,还未设置收款支付宝帐号,暂时不能支付';
            echo json_encode(array('failed' => $message));
        }
    }

    //根据优惠券编号查询优惠券金额
    public function actionCoupon() {
        $couponID = Yii::app()->request->getParam('couponID');
        $data = BuyGoodsService::couponbyID($couponID);
        echo json_encode($data);
    }
    //翻牌
    public function actionLott(){
        $organID=Yii::app()->user->getOrganID();
        $coupon=BuyGoodsService::get_lott_value();
        $promoid=Yii::app()->request->getParam('promoid');
        if(!empty($coupon)&&is_array($coupon)){
            $minamount=$coupon['MinAmount'];
            $maxamount=$coupon['MaxAmount'];
        }
         $prize=mt_rand($minamount, $maxamount);
         if($prize){
              $organID = Yii::app()->user->getOrganID();
                $cou_arr = array(
                    'CouponSn' => OrderService::gen_coupon_sn(),
                    'PromoID' => $promoid,
                    'OwnerID' => $organID,
                    'IsUse' => 0,
                    'CreateTime' => time(),
                    'Amount' =>$prize,
                    'Valid' => $coupon['Valid']
                );
                //插入抽奖获得的优惠券金额信息
                BuyGoodsService::insert_coupon_manage($cou_arr);
         }
         echo json_encode($prize);
    }
}
