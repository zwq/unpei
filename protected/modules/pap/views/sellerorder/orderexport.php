<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/unipei/themes/default/css/galleria.classic.css">
        <link rel="stylesheet" href="<?php echo F::themeUrl() ?>/css/common.css">
        <!--<link rel="stylesheet" type="text/css" href="/unipei/assets/c-JkwdgyB84EQPZ03RgWcyNA.css?1401325826" />-->
        <!--[if gte IE 7]><link rel="stylesheet" type="text/css" href="/unipei/themes/default/css/ie67.css" /><![endif]-->
        <script type="text/javascript" src="<?php echo F::themeUrl() ?>/js/jQuery.min.js"></script>
        <script type="text/javascript" src="<?php echo F::themeUrl() ?>/js/jquery.js"></script>
        <script type="text/javascript" src="/unipei/assets/s-0-H-96P2ByY-U-Z48n5GBNpg.js?1400833216"></script>
        <title>由你配服务平台-销售订单总览</title>
        <meta content="IE=EmulateIE8" http-equiv="X-UA-Compatible">
        <meta content="text/html;charset=utf-8" http-equiv="content-type">
        <link rel="icon" href="/unipei/themes/default/images/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="/unipei/themes/default/images/favicon.ico" type="image/x-icon" />
        <style media="screen">
            body,p {padding: 0; margin: 0; }
            body,html{height: 100%;}

            #outer {height: 100%; position: relative;width: 100%; background:#777;  }
            /*#outer[id] {display: black; }*/
            #middle {padding-top:30px} /* for explorer only*/
            /*#middle[id] {display: table-cell; vertical-align: middle; position: static;}*/
            #inner {*left:0;position: relative; ;margin: 0 auto;vertical-align: middle; background:#fff;z-index:2; margin:0 auto}

            div.greenBorder {  width:650px; height:auto; border:1px solid #ccc}
            *+html #outer[id]{position: relative;}
            *+html #middle[id]{position: absolute; }
            #con{ width:630px; height:auto; background:#FFF; margin:0 auto; margin-top:10px; }
            .xqlm{ font-size:14px;  height:30px; line-height:30px;color:#39af39; background:url(images/line_Img06.gif) repeat-x}
            .xqlm_info{ margin-left:20px; font-size:20px; font-weight:bold}
            .add{font-size:12px; height:auto;color:#777 ; width:630px; border:1px solid #ccc; background:#F7F7F7 }
            .dd{ height:20px; line-height:20px; margin-bottom:-10px; margin-top:5px}
            .add1{ font-size:14px;font-weight:bold; color:#676767;}
            .wlxx{ margin-top:20px; margin-left:10px}
            .info{ width:630px; border:1px solid #ccc; height:30px; line-height:30px; margin-top:10px; font-size:12px}
            .tb_bg{ background-color:#f7f7f7;}
            td{ height:30px; text-align:center; font-size:12px}
            .tb_bo{ border-right: 1px solid #ccc}
            .ft_cl{color:#777; margin-left:20px}
            .ft_cl2{color:#777;}
            .bo_top{ border-top:1px solid #ccc}
            .bg,.popIframe {
                background-color: #666; display:block;
                width: 100%;
                height: 100%;
                left:0;
                top:0;/*FF IE7*/
                filter:alpha(opacity=50);/*IE*/
                opacity:0.5;/*FF*/
                z-index:1;
                position:fixed!important;/*FF IE7*/
                position:absolute;/*IE6*/
                _top:       expression(eval(document.compatMode &&
                    document.compatMode=='CSS1Compat') ?
                    documentElement.scrollTop + (document.documentElement.clientHeight-this.offsetHeight)/2 :/*IE6*/
                    document.body.scrollTop + (document.body.clientHeight - this.clientHeight)/2);
            }
            .popIframe {
                filter:alpha(opacity=0);/*IE*/
                opacity:0;/*FF*/
            }
            .wid{ width:100px;}
            .add2{ height:auto; line-height:25px;padding-left:30px}
            .add3{ margin-top:5px}
            .m_l{ margin-left:50px;font-size:12px; color:#777}
            .m_ll{font-size:14px; color:#000;}
            .m_r{ margin-left:20px}
            .ma_lr{ margin-left:10px; margin-right:10px}
            .ma_l{ margin-left:30px; margin-right:10px}
        </style>
        <style media="print">
            body{background: white;color:#000; font-family:"微软雅黑"}
            #inner{position: relative; margin: 0 auto;vertical-align: middle; background:#fff;z-index:2; margin:0 auto;}
            div.greenBorder {  width:160mm; height:138mm; margin-left:-10px}
            *+html #outer[id]{position: relative;}
            *+html #middle[id]{position: absolute; }
            #con{ width:160mm; height:auto; background:#FFF; margin:0 auto; margin-top:2mm; }
            .xqlm{ font-size:14px;  height:8mm; line-height:8mm;color:#39af39; border-bottom:2px solid #000}
            .xqlm_info{ margin-left:20px; font-size:20px; font-weight:bold; text-align:center}
            .add{font-size:14px; height:auto; width:160mm; border-bottom:1px  dashed #000; }
            .dd{ height:8mm; line-height:8mm; margin-bottom:-10px; margin-top:5px}
            .add1{ font-size:14px;font-weight:bold; }
            .wlxx{ margin-top:8mm; margin-left:10px}
            .info{ width:160mm; border-top:1px solid #000;border-bottom:1px solid #000; height:8mm; line-height:8mm; margin-top:10px; font-size:12px}
            .tb_bg{ background-color:#f7f7f7;}
            td{ height:8mm; text-align:center; font-size:14px}
            .tb_bo{ /*border-right: 2px solid #ccc*/}
            .ft_cl{ margin-left:20px}
            .ft_cl2{}
            .bo_top{ /*border-top:2px solid #ccc*/}
            .bg,.popIframe {
                background-color: #666; display:block;
                width: 100%;
                height: 100%;
                left:0;
                top:0;/*FF IE7*/
                filter:alpha(opacity=50);/*IE*/
                opacity:0.5;/*FF*/
                z-index:1;
                position:fixed!important;/*FF IE7*/
                position:absolute;/*IE6*/
                _top:       expression(eval(document.compatMode &&
                    document.compatMode=='CSS1Compat') ?
                    documentElement.scrollTop + (document.documentElement.clientHeight-this.offsetHeight)/2 :/*IE6*/
                    document.body.scrollTop + (document.body.clientHeight - this.clientHeight)/2);
            }
            .popIframe {
                filter:alpha(opacity=0);/*IE*/
                opacity:0;/*FF*/
            }
            .wid{ width:100px;}
            .add2{ height:5mm; line-height:5mm; margin-left:3mm}
            .add3{ margin-top:2mm}
            .m_l{ font-size:12px; color:#000; margin-left:10mm}
            .m_ll{font-size:14px; color:#000;}
            .m_r{ margin-left:20px}
            .ma_lr{ margin-left:20px; margin-right:20px}
            .ma_l{ margin-left:10px; margin-right:10px; }
            #tb{ display:none}
            hr{ display:none}
            .b_top{ border-top:1px dashed #ccc}
            .ma_lr{ display:none}
        </style>
    </head>
    <body>
        <?php $count = count($row['goods']) / 10; ?>
        <div id="outer" style="display:block;<?php
        if ($count > 1) {
            echo 'height:auto';
        }
        ?>">
            <div id="middle">
                <div id="inner" class="greenBorder" >
                    <p class="xqlm" align="center"><span class="xqlm_info"><?php echo $row['SellerName'] ?>发货单</span><span class="m_ll">(联系电话：<?php echo $row['ContactPhone'] ?>)</span></p>

                    <div id="con">


                        <?php for ($i = 0; $i < $count; $i++): ?>
                            <div class="add">
                                <p class="add2">买家:   <span class="m_r"><?php echo $row['BuyerName'] ?></span><span class="m_r">物流公司:<?php echo $row['ShipLogis'] ?></span> </p>
                                <p class="add2 add3"><span>订单编号：<?php echo $row['OrderSN'] ?></span><span class="ma_lr">/</span>&nbsp;下单日期：<?php echo $row['CreateTime'] ?><span class="ma_lr">/</span>&nbsp;支付方式：<?php echo $row['Payment'] ?></span></p>
                                <p class="add2">收货地址:   <span><?php echo $row['Consignee'] ?></span> ,<span> <?php echo $row['Mobile'] ?></span> ,<span><?php echo $row['Delivery'] ?></span> , <span><?php echo $row['ZipCode'] ?></span></p>
                                 <!-- <p class="add2">收货地址: 刘丽<span class="ma_l">/</span> 1389099012<span class="ma_l">/</span>021-8988933<span class="ma_l">/</span>湖北省武汉市江汉区江汉路1800号<span class="ma_l">/</span>430000</p>-->


                            </div>

                            <p class="add1 wlxx">商品详情</p>
                            <table class="info info_no"  cellpadding="0" cellspacing="0" style="margin-bottom:10px;width: 100%" >
                                <tr style="width: 100%" >
                                    <td class="tb_bo tb_bg" >编号</td>
                                    <td class="tb_bo tb_bg" >商品名称</td>
                                    <td class="tb_bo tb_bg" >商品编号</td>

                                    <td class="tb_bo tb_bg" >品牌</td>
                                    <td class="tb_bo tb_bg">单价（元）</td>
                                    <td class="tb_bo tb_bg" >数量</td>
                                    <td class=" tb_bg">金额（元）</td>
                                </tr>
                                <?php foreach ($row['goods'] as $key => $value): ?>
                                    <?php if ($key < ($i + 1) * 10 && $key >= $i * 10): ?>
                                        <tr class="">
                                            <td class="tb_bo ft_cl2 bo_top"><?php echo $key + 1 ?></td>
                                            <td class="tb_bo ft_cl2 bo_top"><?php echo $value['GoodsName'] ?></td>
                                            <td class="tb_bo ft_cl2 bo_top"><?php echo $value['GoodsNum'] ?></td>

                                            <td class="tb_bo ft_cl2 bo_top"><?php echo $value['Brand'] ?></td>
                                            <td class="tb_bo ft_cl2 bo_top"><?php echo $value['editPrice'] ?></td>
                                            <td class="tb_bo ft_cl2 bo_top"><?php echo $value['Quantity'] ?></td>
                                            <td class="  ft_cl2 bo_top"><?php echo $value['GoodsAmount']; ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <?php
                                $a = $i;
                                if (($a + 1) < $count):
                                    ?>
                                </table>

                                <div style="page-break-after: always;"></div>
                            <?php else: ?>

                                <tr align="right" ><td colspan="8" class="bo_top pr b_top" style="text-align:right;"><span style="margin-right:20px">总计：<?php echo $row['TotalAmount'] ?>元</span></td></tr>
                                </table>

                            <?php endif; ?>
                        <?php endfor; ?>











                        <OBJECT id=WebBrowser classid=CLSID:8856F961-340A-11D0-A96B-00C04FD705A2 height=0 width=0 ></OBJECT><table  cellpadding="0" cellspacing="0" border="0"  width="630px"; style="margin-top:10px" id="tb"><tr><td style="text-align:right; "><span style="margin-right:20px">
           <!--                             <input id="dayin" type="submit" value="打印预览" onclick="document.all.WebBrowser.ExecWB(7,1)" >
                                        <input type="submit" value="打印" onclick="document.all.WebBrowser.ExecWB(6,1)"  style="margin-left:20px">-->
                                        <input type="submit" value="打印" onclick="print()">
                                        <input type="submit" value="关闭" onclick="closeDiv()">
                                        <input type="button" class="dayin" value="清空页脚页眉" onclick='pagesetup_null()'>
                                        <input type="button" class="dayin" value="恢复页脚页眉" onclick='pagesetup_default()'>
                                    </span></td></tr></table>


                    </div>










                </div>
            </div>
        </div>

    </body>



    <script language="JavaScript">
        var hkey_root,hkey_path,hkey_key
        hkey_root="HKEY_CURRENT_USER"
        hkey_path="\\Software\\Microsoft\\Internet Explorer\\PageSetup\\"
        //设置网页打印的页眉页脚为空
        
        $(document).ready(function(){
            try{
                var RegWsh = new ActiveXObject("WScript.Shell")
                hkey_key="header" 
                RegWsh.RegWrite(hkey_root+hkey_path+hkey_key,"")
                hkey_key="footer"
                RegWsh.RegWrite(hkey_root+hkey_path+hkey_key,"")
            }catch(e){}
        })
        
        function pagesetup_null(){
            try{
                var RegWsh = new ActiveXObject("WScript.Shell");
                console.log(RegWsh);
                hkey_key="header" 
                RegWsh.RegWrite(hkey_root+hkey_path+hkey_key,"")
                hkey_key="footer"
                RegWsh.RegWrite(hkey_root+hkey_path+hkey_key,"")
            }catch(e){
                alert("调用的控件被浏览器禁止，请在Internet选项中取消对activeX的禁止");
            }
        }
        //设置网页打印的页眉页脚为默认值
        function pagesetup_default(){
            try{
                var RegWsh = new ActiveXObject("WScript.Shell")
                hkey_key="header" 
                RegWsh.RegWrite(hkey_root+hkey_path+hkey_key,"&w&b页码，&p/&P")
                hkey_key="footer"
                RegWsh.RegWrite(hkey_root+hkey_path+hkey_key,"&u&b&d")
            }catch(e){
                alert("调用的控件被浏览器禁止，请在Internet选项中取消对activeX的禁止");
            }
        }
        
        $(document).ready(function(){
            //    print();
            var varsion = $.browser.version;
            if(varsion>=6.0 && varsion<=11.0){
                $(".dayin").show();
            }else{
                $(".dayin").hide();
            }
        })
        function closeDiv(){
            window.history.go(-1);
        }
    </script>
</html>