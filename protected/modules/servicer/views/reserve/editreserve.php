<?php
$this->pageTitle = Yii::app()->name . ' - 预约管理';
$this->breadcrumbs = array(
	'预约管理' => Yii::app()->createUrl("/servicer/reserve/index"),
    '预约登记',
);
$returnurl = Yii::app()->createUrl("servicer/reserve/index");
if(!empty(Yii::app()->request->urlReferrer)){
    $returnurl = Yii::app()->request->urlReferrer;
}
?>
<style>
    .items li{width:755px;border-bottom: 1px solid #e8e8e8;margin-bottom:5px;}
    .zwq_OE{display: none}
    .zwq_info{width:380px}
    .zwq_price{width:180px}
    .pager{ float:right;clear:both}
    .pager li a,.pager .goto a{ font-family: "微软雅黑"; padding: 2px 6px; border:1px solid #eee;}
    .pager span.goto{ font-family: "微软雅黑";}
    .pager li a {display:block;}
    .pager li a:hover{border:1px solid #ff6600}
    .pager li.selected a{ color:#ff6600; font-weight: bold}
    /*.pager .goto{float: none}*/
    .pager .input{margin:0; width:30px;height:22px;}
    .fenye{margin:2px 5px}
    .top_fenye ul li{ margin-top:0}
    .top_fenye ul li a{ padding: 2px 6px}
    .content2d #yw1 ul li{ float:left; width:auto}
    #make-car-m {border:2px solid #f2b303;}
    /*#make-car-m {border:2px solid #f2b303;left: 350.5px!important; top: 377px!important; }*/
    .right_A .makelist li.selected3{ background:#f2b303 }
    .right_A .makelist ul li.li_list:hover{background:#f2b303}
    .right_A .makelist ul li.li_top{color:#f2b303}
    .car_brand .left_A ul li a{color:#f2b303}
    .car_brand .left_A ul li a:hover { background:#f2b303}
	.ui-dialog{margin-left:20px}
    thead tr{height:28px;background: #EAB265;
        background: -moz-linear-gradient(top, #F1DAAE, #EAB265);
        background: -webkit-linear-gradient(top, #F1DAAE, #EAB265);
        background: -ms-linear-gradient(top, #F1DAAE, #EAB265);
        background: -o-linear-gradient(top, #F1DAAE, #EAB265);
    }
</style>
<link href="<?php echo F::themeUrl();?>/css/jpdata.css" type="text/css" rel="stylesheet">
<div id="reserve" class="bor_back m_top10">
	<p class="txxx txxx3">
		预约登记
                <a href="<?php echo $returnurl; ?>" style="font-weight:400;cursor: pointer; float: right;margin-right: 20px;">返回</a>
    </p>
    <div class="txxx_info4">
        <form action="" method="post"  target="_self">    
            <div>
            	<p class="m_left24 m-top5">
                    <label class="label1 m_left12">车牌号：</label>
                    <input class="width88 input" name="LicensePlate" value="<?php echo $model['LicensePlate'];?>" maxlength="10">
                </p>
                <p class="m_left24 m-top5">
                    <label class="label1 m_left12">联系人：</label>
                    <input class="width88 input" name="OwnerName" value="<?php echo $model['OwnerName'];?>" maxlength="10">
                </p>
                <p class="m_left24 m-top5">
                    <label class="label1">联系电话：</label>
                    <input class="width88 input" name="Phone" value="<?php echo $model['Phone'];?>" maxlength="10">
                </p>
                <p class="m_left24 m-top5">
                    <label class="label1">汽车品牌：</label>
                    <input class="input" id="make-select-index" name="Car" value="<?php echo $model['Car'];?>" maxlength="10" style="width: 265px;">
                    <?php $this->widget('widgets.default.WCarManageModel'); ?>
                </p>
                <p class="m_left24 m-top5">
                	<label class="label1">行驶里程：</label>
                    <input class="width88 input" name="Mileage" value="<?php echo $model['Mileage'];?>" maxlength="10">(km)
                    <input id="code" type="hidden" name="Code" value="<?php echo $model['Code'];?>">
                </p>
                <p class="m_left24 m-top5">
                	<label class="label1">上路时间：</label>
                	<?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'language' => 'zh_cn',
                            'name' => 'StartTime',
                            'value' => date("Y-m-d",$model['StartTime']),
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                        		'changeYear' => true,
                            ),
                            'htmlOptions' => array(
                                'class' => 'input width88',
                            ),
                        ));
                    ?>
                </p>
                <p class="m_left24 m-top5">
                	<label class="label1">预约时间：</label>
                	<?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'language' => 'zh_cn',
                            'name' => 'ReserveTime',
                            'value' => date("Y-m-d",$model['ReserveTime']),
                            'options' => array(
                                'minDate' => 'new Date()',
                                'dateFormat' => 'yy-mm-dd',
                        		'changeYear' => true,
                        		'yearRange'=>'-0:+50'
                            ),
                            'htmlOptions' => array(
                                'class' => 'input width88',
                            ),
                        ));
                    ?>
                    <label class="label1"></label>
                    <select name="BeginTime" class="select" style="width:60px;">
                        <?php 
                        for($i=0;$i<24;$i++){
                            if($i == $model['BeginTime']){
                                echo '<option value="'.$i.'" selected="selected">'.$i.':00</option>';
                            }  else {
                                echo '<option value="'.$i.'">'.$i.':00</option>';
                            }
                        }
                        ?>
                    </select>
                    <label class="label1"> - </label>
                    <select name="EndTime" class="select" style="width:60px;">
                    	<?php 
                        for($i=0;$i<24;$i++){
                            if($i == $model['EndTime']){
                                echo '<option value="'.$i.'" selected="selected">'.$i.':00</option>';
                            }  else {
                                echo '<option value="'.$i.'">'.$i.':00</option>';
                            }
                        }
                        ?>
                    </select>
                </p>
                <p class="m_left24 m-top5">
                    <label class="label1" style="vertical-align: top">备注信息：</label>
                    <textarea name="Remark" class="textarea textarea2" maxlength="128" cols="50" rows="50"><?php echo $model['Remark'];?></textarea>
                </p>
                <p class="m-top5">
                    <input type="hidden" id="reserveid" value="<?php echo $model['ID'];?>">
                    <input class='submit ml10' style="margin-left:150px;" type='button' id="edit_reserve" value='修改'>
                </p>
                <p class="m_top10">
                </p>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/reserve/reservemanage.js'></script>
