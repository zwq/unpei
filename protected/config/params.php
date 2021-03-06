<?php

// this contains the application parameters that can be maintained via GUI
return array(
// this is displayed in the header section
    'title' => '嘉配服务平台',
    // this is used in error pages
    'adminEmail' => 'webmaster@jiaparts.com',
    // the copyright information displayed in the footer section
    'copyrightInfo' => 'Copyright &copy; 2013 by Jiaparts.',
    // YII表单校验参数
    'clientOptions' => array(
        'validateOnSubmit' => true,
        //'errorCssClass' => 'error',
//'successCssClass' => 'success',
//'validatingCssClass' => '',
        'afterValidateAttribute' => "js:function(form, attribute, data, hasError){
	        var id = attribute.id;
			var rowObj = $('#'+id).parent();
			var succObj = rowObj.find('.for-form-success');
		    if(hasError){
				succObj.hide();
		    }else{
				if(succObj.length == 0) {
					var succHtml = \"<div class='display-ib for-form-success'></div>\";
					rowObj.append(succHtml).show();
				}else {
					succObj.show();
				}
			}
        }",
    ),
    // 图片链接加密
    'imgencode' => array(
        'enable' => false, //是否启用加密
        'dir' => 'image/', //图片根目录
        'key' => 'Thwm2pyB!', //base64加密密钥
        'expiry' => 0, //加密串过期时间，单位秒
        'ckey_len' => 0, //变化密钥的长度，大于0时每次生产的加密串都不同
        'prefix' => 'j_'  //加密串前缀，用于apache进行URL重写
    ),
    // 图片服务器地址
    'imgserver' => array(
// 主域名
        'domain' => 'http://www.unipei.com/image/',
        'path' => '',
        // 小图路径信息，可配置独立域名，domain为空时使用主域名
        'vehicle_small' => array(
            'domain' => '',
            'path' => 'small/',
        ),
        // 缩略图路径信息，可配置独立域名，domain为空时使用主域名
        'vehicle_thumb' => array(
            'domain' => '',
            'path' => 'thumb/',
        ),
    ),
    // 上传文件的存放目录
    'uploadPath' => dirname(dirname(dirname(__FILE__))) . '/upload/',
// 信息缓存时间，单位为秒，小于等于0时不使用缓存
    'cache' => array(
        'menuCachingDuration' => 0,
        'jpdataCachingDuration' => 0,
        'defaultCachingDuration' => 0,
    ),
    'PartsLevel' => array(
        'A' => '原厂',
        'B' => '高端品牌',
        'C' => '经济实用',
        'D' => '下线',
        'E' => '拆车',
    ),
    'sendEmail' => array(
        'send' => false,
        'email' => array('luojy@jiaparts.com ', 'hehh@jiaparts.com', 'fuq@jiaparts.com'),
    ),
    
    'ftpserver' => array(
        // 主域名
        'hostname' => '172.23.3.29',
        'port' => 21,
        'username' => 'ftpuser',
        'passwd' => 'ftpuser',
        'visiturl' => 'http://172.23.3.29/upload/'
    ),
   'fsockopen' => array(
        'open' => false,
        'host' => '172.23.3.29',
        'port' => 80,
        'timeout' => 30,
    ),
    'SMS' => array('open' => false),  //不允许发送短信
	'DealerRemind' => array('DD' => array('Name' => '订单', 'children' => array(1 => '待付款', 2 => '待发货')),
        'XJD' => array('Name' => '询价单', 'children' => array(3 => '待报价')),
        'THD' => array('Name' => '退货单', 'children' => array(4 => '待审核', 5 => '待收货'))
    ),
    'ServiceRemind' => array('DD' => array('Name' => '订单', 'children' => array(1 => '待付款', 2 => '待收货')),
        'BJD' => array('Name' => '报价单', 'children' => array(3 => '待确认')),
        'THD' => array('Name' => '退货单', 'children' => array(4 => '未通过', 5 => '待发货'))
    ),
    //iosocket路径
    'iosocketPath' => 'http://localhost:3000',
);
