<?phpclass SiteController extends Controller {    //public $layout = '//layouts/column2'; //房地产、政信类、小贷/ABS类、二级市场、PE、其他创新        /**     * Declares class-based actions.     */    public function actions() {        return array(            // captcha action renders the CAPTCHA image displayed on the contact page            'captcha' => array(                'class' => 'CCaptchaAction',                'foreColor' => 0xdd7a36,                'backColor' => 0xfbfbfb, //背景颜色                'minLength' => 4, //最短为4位                'maxLength' => 4, //是长为4位                'width' => 70, //图片宽度                'height' => 30, //图片高度                'offset' => 2, //字符间偏移量。默认是-2                'padding' => 2, //文字周边填充大小。默认为2                'testLimit' => 1, //验证码失效次数,默认是3次            //'transparent'=>true,  //显示为透明            //'fixedVerifyCode'=>'' //固定的验证码,自动测试中想每次返回 相同的验证码值时会用到            ),            // page action renders "static" pages stored under 'protected/views/site/pages'            // They can be accessed via: index.php?r=site/page&view=FileName            'page' => array(                'class' => 'CViewAction',            ),        );    }    public function directionTypes($text)    {//         public static $directionTypes = array(//        1 => '房地产',//        2 => '政信类',//        3 => '小贷/ABS类',//        4 => '二级市场',//        5 => 'PE',//        6 => '其他创新'//    );//    //产品部/歌斐、产品部/歌斐（特供）、独立引入//    public static $productSourceTypes = array(//        0 => '无',//        1 => '产品部/歌斐',//        2 => '产品部/歌斐（特供）',//        3 => '独立引入'//    );        switch ($text)        {              case '房地产':                 $text =1;                break;              case '政信类':                  $text= 2;                  break;             //  case '小贷/ABS类':              case '小贷/ABS类':                  $text= 3;                  break;               case '二级市场':                  $text= 4;                  break;               case 'PE':                  $text= 5;                  break;              case '其他创新':                  $text= 6;                  break;        }      return $text;    }        public function productSourceTypes($text)    {        switch (trim($text))        {              case '产品部/歌斐':                $text =1;                break;              case '产品部/歌斐（特供）':                  $text= 2;                  break;               case '独立引入':                  $text= 3;                  break;        }        return $text;    }    public function productType($texts)    {        $texts = trim($texts);        if($texts=='类固定')        {            $texts= 0;                    }        elseif($texts=='二级市场')        {            $texts = 1;        }        elseif($texts=='PE')        {            $texts = 2;        }        return $texts;    }         public function Type($texts)    {        $texts = trim($texts);        if($texts=='其他')        {            $texts= 6;                    }                elseif($texts=='PE')        {            $texts = 5;        }        return $texts;    }    public function filters() {        return array(        );    }    /**     * This is the default 'index' action that is invoked     * when an action is not explicitly requested by users.     */    public function actionIndex() {        // renders the view file 'protected/views/site/index.php'        // using the default layout 'protected/views/layouts/main.php'        $excelFile = 'E:\wamp\www\unipei\upload\product7.xls';                    $phpexcel = new PHPExcel;                 $excelReader = PHPExcel_IOFactory::createReader('Excel5');                 $phpexcel = $excelReader -> load($excelFile) -> getSheet(1);                              $highestRow = $phpexcel->getHighestRow(); //取得总行数                         $highestColumn = $phpexcel->getHighestColumn(); //取得总列数            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); //总列数            //$highestColumnIndex= 606;            //执行结果               $head = array();            for ($col =0; $col < $highestColumnIndex; $col++) {                    $head[$col] = $phpexcel->getCellByColumnAndRow($col, 1)->getValue();            }                      $first_row = array();                     $a ='';            for ($col =0; $col < $highestColumnIndex; $col++) {                           for ($row = 2; $row <= $highestRow; $row++) {               // if($phpexcel->getCellByColumnAndRow($col, $row)->getValue()!=null)                        //$first_row[$row][$col] = $phpexcel->getCellByColumnAndRow($col, $row)->getValue();//                        if(in_array($col,array(0,3,5,6)))//                        {                             if(in_array($col,array(0,4)))                        {                                                                    // $first_row[$row][$col] = $phpexcel->getCellByColumnAndRow($col, $row)->getValue();                             if($col==0)                                {                               $first_row[$row][$col] = intval($phpexcel->getCellByColumnAndRow($col, $row)->getValue());                             }//                                                         $first_row[$row][$col] = $first_row[$row][$col] = $phpexcel->getCellByColumnAndRow($col, $row)->getValue();//                            if($col==3)//                            {//                               $first_row[$row][$col]= $this->productType($phpexcel->getCellByColumnAndRow($col, $row)->getValue());//                            }//                            if($col==6)//                            {//                            $first_row[$row][$col] = $this->directionTypes($phpexcel->getCellByColumnAndRow($col, $row)->getValue());//                            }//                           //                            if($col==5)//                            {//                            $first_row[$row][$col] = $this->productSourceTypes($phpexcel->getCellByColumnAndRow($col, $row)->getValue());//                            }                             if($col=4)                            {                            $first_row[$row][$col] = $this->Type($phpexcel->getCellByColumnAndRow($col, $row)->getValue());                            }                                                    }                        if($row>40)                        {                            break;                        }            }            }            var_dump($head);die;                      //         public static $directionTypes = array(//        1 => '房地产',//        2 => '政信类',//        3 => '小贷/ABS类',//        4 => '二级市场',//        5 => 'PE',//        6 => '其他创新'//    );//    //产品部/歌斐、产品部/歌斐（特供）、独立引入//    public static $productSourceTypes = array(//        0 => '无',//        1 => '产品部/歌斐',//        2 => '产品部/歌斐（特供）',//        3 => '独立引入'//    );                       // $data = array_values($first_row);            echo '<pre>';            print_r($first_row);            echo '</pre>';die;         echo '<pre>';                  foreach($data as $key=>$value)         {             $arr0[] = $value[0];             if($value[4]==5)             {                 $arr1[] = $value[0];             }             else if($value[4]==6)             {                 $arr2[] = $value[0];             }         }         var_dump($arr1);die;        echo count($arr1).'PE';           echo count($arr2).'其他';                 die;//         //db.parent_product.find({isSnapshot:0,ppid:{$in:[1324]}}).forEach(function(p){p.state=3;db.parent_product.save(p);});//         //         foreach($data as $key=>$value)//         {//            //            print_r( "db.parent_product.find({isSnapshot:0,ppid:{in:[$value[0]]}}).forEach(function(p){p.directionType=$value[8],p.productSource=$value[9]];db.parent_product.save(p);});<br>");//          //              }//     //         echo '<pre/>';die;//            echo '<pre>';print_r($data);echo '</pre>';exit;          foreach($data as $key=>$value)          {//              foreach($value as $ke=>$va)//              {                 $fi0[] = $value[0];                  if($value[6]==1 && $value[5]==1)                  {                                                               $fi[]= $value[0];                     // echo  implode(',',$fi);                                                               }                   if($value[6]==1 && $value[5]==2)                  {                      $fi1[]=  $value[0];                   }                   if($value[6]==1 && $value[5]==3)                  {                      $fi2[]=  $value[0];                   }                   if($value[6]==2 && $value[5]==1)                  {                      $fi3[]=  $value[0];                   }                   if($value[6]==2 && $value[5]==2)                  {                      $fi4[]=  $value[0];                   }                    if($value[6]==2 && $value[5]==3)                  {                      $fi5[]=  $value[0];                   }                   if($value[6]==3 && $value[5]==1)                  {                      $fi6[]= $value[0];                   }                   if($value[6]==3 && $value[5]==2)                  {                      $fi7[]= $value[0];                   }                    if($value[6]==3 && $value[5]==3)                  {                      $fi8[]= $value[0];                   }                   if($value[6]==4 && $value[5]==1)                  {                                   $fi9[]= $value[0];                  }                   if($value[6]==4 && $value[5]==2)                  {                      $fi10[]= $value[0];                   }                    if($value[6]==4 && $value[5]==3)                  {                      $fi11[]= $value[0];                   }                   if($value[6]==5 && $value[5]==1)                  {                      $fi12[]= $value[0];                   }                   if($value[6]==5 && $value[5]==2)                  {                      $fi13[]= $value[0];                  }                    if($value[6]==5 && $value[5]==3)                  {                      $fi14[]=$value[0];                   }                   if($value[6]==6 && $value[5]==1)                  {                      $fi15[]= $value[0];                  }                   if($value[6]==6 && $value[5]==2)                  {                      $fi16[]= $value[0];                   }                    if($value[6]==6 && $value[5]==3)                  {                      $fi17[]= $value[0];                  }//                  if($value[3]==0 && $value[8]==1 && $value[9]==1)//                  {//                       $fi[]= $data[$key];//                  }//                  if($value[3]==0 && $value[8]==1 && $value[9]==2)//                  {//                       $fi2[]= $data[$key];//                  }//                   if($value[3]==0 && $value[8]==1 && $value[9]==3)//                  {//                       $fi3[]= $data[$key];//                  }//                  if($value[3]==0 && $value[8]==2&& $value[9]==1)//                  {//                       $fi4[]= $data[$key];//                  }//                    if($value[3]==0 && $value[8]==2&& $value[9]==2)//                  {//                       $fi5[]= $data[$key];//                  }//                    if($value[3]==0 && $value[8]==2&& $value[9]==3)//                  {//                       $fi6[]= $data[$key];//                  }//                    if($value[3]==1 && $value[8]==1&& $value[9]=1)//                  {//                       $fi7[]= $data[$key];//                  }//                 if(($ke==3 && $va ==0)) //                     $fi[]= $data[$key];                                 //              }          }        //         echo '<pre>';//         print_r($fi0);//         echo '</pre>';die;           echo implode(',',$fi0).'<p>';          echo implode(',',$fi).'<p>';          echo implode(',',$fi1)."<br>";           echo implode(',',$fi3)."<br>";            echo implode(',',$fi6)."<br>";             echo implode(',',$fi8)."<br>";             echo implode(',',$fi9)."<br>";              echo implode(',',$fi11)."<br>";                echo implode(',',$fi15)."<br>";                  echo implode(',',$fi17)."<br>";            echo "<pre>总条数:".count($fi0).'<br>';            echo count($fi).'==0==<br>';            echo count($fi1).'==1==<br>';             echo count($fi2).'==2==<br>';              echo count($fi3).'==3==<br>';              echo count($fi4).'==4==<br>';              echo count($fi5).'==5==<br>';              echo count($fi6).'==6==<br>';               echo count($fi7).'==7==<br>';               echo count($fi8).'==8==<br>';               echo count($fi9).'==9==<br>';               echo count($fi10).'==10==<br>';               echo count($fi11).'==11==<br>';               echo count($fi12).'==12==<br>';               echo count($fi13).'==13==<br>';               echo count($fi14).'==14==<br>';               echo count($fi15).'==15==<br>';               echo count($fi16).'==16==<br>';               echo count($fi17).'==17==<br>';                       echo "</pre>";die;          // print_r($fi);               $sheetData = $phpexcel->toArray();                     //  for ($row = 2; $row <= $highestRow; $row++) {//                 for ($col = 0; $col < $highestColumn; $col++) {//                   $data_new[$col] = $phpexcel->getCellByColumnAndRow($col, $row)->getValue();//                 }                                //每行的第一列数据不能为空                $first_value = $phpexcel->getCellByColumnAndRow(3, $row)->getValue();//                         // $GoodsNO_value = $phpexcel->getCellByColumnAndRow(0, $row)->getValue();               //                 $array=$sheetData[$row - 1];//                $array=array_filter($array);//                if (!empty($array)) {//                    $Sdata[$i] = $sheetData[$row - 1];//                    $list[$i] = $GoodsNO_value;//                    $i++;//                    $success = true;//                    $error = '';//                }       //     }                           $this->layout = '//layouts/login';        if (Yii::app()->user->isGuest) {            $model = new UserLogin;            $this->render('application.modules.user.views.user.newlogin', array('model' => $model));            Yii::app()->end();        }        if (Yii::app()->user->isMaker()) {            $this->redirect(array('/maker'));        } else if (Yii::app()->user->isDealer()) {            $this->redirect(array('/dealer'));        } else if (Yii::app()->user->isServicer()) {            $this->redirect(array('/servicer'));        } else {            // 首页不跳转            Yii::app()->user->logout();            $this->redirect(Yii::app()->user->loginUrl);        }    }    /*      public function actionEmail() {      $message = 'Hello World!';      Yii::app()->mailer->Host = 'smtp.gmail.com';      Yii::app()->mailer->IsSMTP();      Yii::app()->mailer->SMTPAuth = true; //設定SMTP需要驗證      Yii::app()->mailer->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線      Yii::app()->mailer->Port = 465;  //Gamil的SMTP主機的SMTP埠位為465埠。      Yii::app()->mailer->CharSet = "big5"; //設定郵件編碼      Yii::app()->mailer->Username = "yhxxlm@gmail.com"; //設定驗證帳號      Yii::app()->mailer->Password = ""; //設定驗證密碼      Yii::app()->mailer->From = 'yhxxlm@gmail.com';      Yii::app()->mailer->FromName = 'yhxxlm';      Yii::app()->mailer->AddReplyTo('yhxxlm@gmail.com');      Yii::app()->mailer->AddAddress('yhxxlm@foxmail.com');      Yii::app()->mailer->Subject = 'Yii rulez!';      Yii::app()->mailer->Body = $message;      Yii::app()->mailer->Send();      }     */    /**     * This is the action to handle external exceptions.     */    public function actionError() {        if ($error = Yii::app()->errorHandler->error) {            //Yii::log($msg,$level,$category);            if (Yii::app()->request->isAjaxRequest)                echo $error['message'];            else {                if ($error && $error['code'] == '404') {                    $this->layout = false;                    $this->render('404', $error);                    Yii::app()->end();                } else {                    $this->render('error', $error);                }            }        }    }    public function actionPromition() {        //活动借宿//        $this->redirect(Yii::app()->user->loginUrl);        $this->pageTitle = Yii::app()->name . '迎新春献礼';        $this->layout = false;        $this->render('promition');    }        public function actionTable()    {         $this->layout = false;        $sql = "SELECT  COLUMN_NAME,DATA_TYPE,COLUMN_COMMENT,COLUMN_DEFAULT FROM information_schema.columns where table_schema='ht' and table_name ='insure_company' order by TABLE_NAME";        $res = Yii::app()->db->createCommand($sql)->queryAll();                $this->render('table',array('res'=>$res));    }    /**     * Displays the contact page     */    /*      public function actionContact() {      $model = new ContactForm;      if (isset($_POST['ContactForm'])) {      $model->attributes = $_POST['ContactForm'];      if ($model->validate()) {      $headers = "From: {$model->email}\r\nReply-To: {$model->email}";      mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);      Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');      $this->refresh();      }      }      $this->render('contact', array('model' => $model));      }     */    /**     * Displays the login page     */    /*      public function actionLogin() {      $model = new LoginForm;      // if it is ajax validation request      if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {      echo CActiveForm::validate($model);      Yii::app()->end();      }      // collect user input data      if (isset($_POST['LoginForm'])) {      $model->attributes = $_POST['LoginForm'];      // validate user input and redirect to the previous page if valid      if ($model->validate() && $model->login())      $this->redirect(Yii::app()->user->returnUrl);      }      // display the login form      $this->render('login', array('model' => $model));      }      public function actionLogout() {      Yii::app()->user->logout();      $this->redirect(Yii::app()->homeUrl);      }      public function actionCart() {      $this->render('cart');      }     */}