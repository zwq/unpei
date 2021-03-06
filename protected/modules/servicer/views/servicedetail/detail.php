<?php $this->pageTitle = Yii::app()->name . ' - 经销商查看'; ?>
<link rel="stylesheet" type="text/css"  href="<?php echo F::themeUrl() ?>/css/jxsinfo.css">
<link href="<?php echo F::themeUrl() ?>/css/galleria.classic.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/css/companymanage.css">
<style>
    #make-car-m {border:2px solid #f2b303; }
    /*#make-car-m {border:2px solid #f2b303;left: 480.5px!important; top: 117px!important; }*/
    .right_A .makelist li.selected3{ background:#f2b303 }
    .right_A .makelist ul li.li_list:hover{background:#f2b303}
    .right_A .makelist ul li.li_top{color:#f2b303}
    .car_brand .left_A ul li a{color:#f2b303}
    .car_brand .left_A ul li a:hover { background:#f2b303}
</style>
<div class="wrap-contents">
    <div class="jxs_name">
        <div class="jxs_img"><?php echo $model['OrganName']; ?></div>
    </div>
    <div class="call">
        <p class="call_num float_l">
            <?php
            $telPhone = explode(',', $model->TelPhone);
            $tel = "";
            foreach ($telPhone as $key => $val) {
                if ($key == 3)
                    break;
                if (!empty($val)) {
                    $tel .= $val . ", ";
                }
            }
            $tel = trim($tel, ", ");
            echo $tel ? $tel : $model->Phone;
            ?>
        </p>
        <p class="call_list float_r"><a class="modelrequired" dealer="<?php echo $model->ID; ?>" href="<?php echo Yii::app()->createUrl('pap/sellerstore/index', array('id' => $model->ID)); ?>">商品列表</a></p>
    </div>
    <div class="jxs_detail">
        <p class="jxs_detail_lm">基础信息</p>
        <div class="txxx_info4" style="margin:10px;">
            <div class="float_l">
                <div class="gsxx_imgbox img_box">
                    <?php if (!empty($organphotos)): ?>
                        <?php $this->renderPartial('imagesgallery', array("pictures" => $organphotos)); ?>
                    <?php else: ?>
                        <img src="<?php echo F::baseUrl() . '/upload/dealer/'; ?>goods-img-big.jpg" width="459" height="345" />
                    <?php endif ?>   
                </div>
            </div>
            <div class="float_l width400 m_left20 gs_info">
                <p class=""><label>机构名称：</label><span><?php echo $model['OrganName']; ?></span></p>
                <p><label>成立年份：</label><span><?php echo $model['FoundDate']; ?>年</span></p>
                <p><label>年销售额：</label><span><?php echo $model['dealer']['SaleMoney']; ?></span></p>
                <p><label>店铺面积：</label><span><?php echo $model['dealer']['ShopArea']; ?></span></p>
                <p><label>公司规模：</label><span><?php echo $model['StoreSize']; ?></span></p>
                <p><label>经营地域：</label><span><?php echo Area::showCity($model['dealer']['SaleDomain']); ?></span></p>
                <p style="word-wrap:break-word; word-break:break-all;white-space:normal;"><label>机构简介：</label><span><?php echo $model['Introduction']; ?></span></p>
            </div>
            <div style="clear:both"></div> 
        </div>

    </div>
    <div class="jxs_detail">
        <p class="jxs_detail_lm">主营信息</p>
        <div class="jxs_detail2">
            <div>
                <div class="float_l f_weight width100">主营品类：</div>
                <div class="float_l width815">
                    <ul class="li_list" >
                        <?php
                        foreach ($showcpnames as $key => $val) {
                            echo '<li style="width:340px">' . $val['BigName'] . ' ' . $val['SubName'] . ' ' . $val['CpName'] . ',</li>';
                        }
                        ?>
                        <div style="clear:both"></div>
                    </ul>
                </div>
                <div style="clear:both"></div>

            </div>
            <div class=" m-top">
                <div class="float_l f_weight width100">主营车系：</div>
                <div class="float_l width815">
                    <ul class="li_list">
                        <?php
                        foreach ($dealerv as $key => $val) {
                            if (empty($val['Car'])) {
                                echo '<li>' . $val['Make'] . ' 全车系,</li>';
                            } elseif (empty($val['Year'])) {
                                echo '<li>' . $val['Make'] . ' ' . $val['Car'] . ' 全年款,</li>';
                            } elseif (empty($val['Model'])) {
                                echo '<li>' . $val['Make'] . ' ' . $val['Car'] . ' ' . $val['Year'] . ' 全车型,</li>';
                            } else {
                                echo '<li>' . $val['Make'] . ' ' . $val['Car'] . ' ' . $val['Year'] . ' ' . $val['Model'] . ',</li>';
                            }
                        }
                        ?>
                        <div style="clear:both"></div>
                    </ul>
                </div>
                <div style="clear:both"></div>

            </div>
            <div class=" m-top">
                <div class="float_l f_weight width100">主营品牌：</div>
                <div class="float_l width815">
                    <ul class="li_list">
                        <?php
                        foreach ($data as $key => $val) {
                            echo '<li>' . $val['brandname'] . '</li>';
                        }
                        ?>
                        <div style="clear:both"></div>
                    </ul>
                </div>
                <div style="clear:both"></div>

            </div>



        </div>

    </div>
    <div class="jxs_detail">
        <p class="jxs_detail_lm">联系方式</p>
        <div class="jxs_detail2">
            <p><label>手&nbsp;&nbsp;机：</label><span><?php echo $model->Phone; ?></span></p>
            <p><label>邮&nbsp;&nbsp;箱：</label><span><?php echo $model->Email; ?></span></p>
            <p><label>传&nbsp;&nbsp;真：</label><span><?php echo $model->Fax; ?></span></p>
            <p><label>qq&nbsp;&nbsp;号：</label><span><?php echo $model->QQ; ?></span></p>
            <p><label>座&nbsp;&nbsp;机：</label><span><?php echo $model->TelPhone; ?></span></p>
            <p><label>地&nbsp;&nbsp;址：</label><span><?php echo Area::showCity($model['Province']) . Area::showCity($model['City']) . Area::showCity($model['Area']) . $model->Address; ?></span></p>
        </div>
    </div>
    <div class="jxs_detail">
        <p class="jxs_detail_lm">营业执照</p>
        <div class="jxs_detail2">
            <p><label class="" style="margin-left:12px">注册号：</label><span><?php echo $model['Registration']; ?></span></p>
            <p><label style="vertical-align:top;">执照照片：</label>
                <span style="">
                    <?php if (!empty($model['BLPoto'])): ?>
                        <img src="<?php echo F::uploadUrl() . $model['BLPoto']; ?>" style="width:360px;height:240px;margin-top:5px"/>
                    <?php else: ?>
                        <img src="data:image/jpeg;base64,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" style="width:240px;height:240px;margin-top:5px"/>
                    <?php endif; ?>
                </span>
            </p>
        </div>
    </div>
    <div style="clear:both"></div>
    <link rel='stylesheet' href='<?php echo Yii::app()->theme->baseUrl ?>/css/detail.css'>
<!--    <div class='width998 content-rows auto_height'>
        <?php //$this->widget('widgets.default.WCustomerService'); ?>
    </div>-->
</div>



