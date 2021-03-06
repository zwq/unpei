<?php 
$this->pageTitle = Yii::app()->name . ' - ' . "公司信息管理"; 
$this->breadcrumbs = array(
    '用户中心' => Yii::app()->createUrl("common/memberlist"),
    '公司信息管理',
);
?>
<style>
.txxx_info4{ margin:15px 10px 15px  20px} 
.uploadify-button-text{color:#fff}
.m_left68{ margin-left:68px;}
</style>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/css/companymanage.css">
<script type="text/javascript" src="<?php echo F::themeUrl();?>/js/companymanage.js"></script>
<div class="contents2">
	<div id="show" class='cont' style="display: block">
		<div class="bor_back m-top">
            <p class="txxx">基础信息<span id="modif" style="display:block; float:right; width:60px; height:35px; background:url(<?php echo F::themeUrl();?>/images/tubiao2.png) no-repeat -2px -26px ; line-height:35px"><a href="javascript:void(0)" style="margin-left:5px; font-weight:400">修改</a></span></p>
            <div class="txxx_info4">
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
                      <?php if (!empty($model['service'])):?>
                      <p><label>工 位 数：</label><span><?php echo $model['service']['PositionCount']; ?></span></p>
                      <p><label>技师人数：</label><span><?php echo $model['service']['TechnicianCount']; ?></span></p>
                      <p><label>停车位数：</label><span><?php echo $model['service']['ParkingDigits']; ?></span></p>
                      <p><label>工 位 数：</label><span><?php echo $model['service']['PositionCount']; ?></span></p>
                      <p><label>预约模式：</label><span><?php echo $model['service']['ReservationMode']; ?></span></p>
                      <p><label>店铺面积：</label><span><?php echo $model['service']['ShopArea']; ?></span></p>
                      <p><label>营业时间：</label><span><?php echo $opentime['0'].'至'.$opentime['1'].' ('.$opentime['2'].'-'.$opentime['3'].')'; ?></span></p>
                      <p style="word-wrap:break-word; white-space:normal;"><label style="display:inline-block;">机构简介：</label><span><?php echo $model['Introduction']; ?></span></p>
               		<?php else:?>
               		  <p><label>工 位 数：</label><span></span></p>
                      <p><label>技师人数：</label><span></span></p>
                      <p><label>停车位数：</label><span></span></p>
                      <p><label>工 位 数：</label><span></span></p>
                      <p><label>预约模式：</label><span></span></p>
                      <p><label>店铺面积：</label><span></span></p>
                      <p><label>营业时间：</label><span></span></p>
                      <p><label>机构简介：</label><span></span></p>
               		<?php endif;?>
                </div>
             <div style="clear:both"></div> 
            </div>
          </div>
          <div class="m-top bor_back">
             <p class="txxx">联系方式</p>
            <div class="txxx_info4">
               <div class=" m_left80 gs_info">
                      <p><label>手&nbsp;&nbsp;机：</label><span><?php echo $model->Phone; ?></span></p>
                      <p><label>邮&nbsp;&nbsp;箱：</label><span><?php echo $model->Email; ?></span></p>
                      <p><label>传&nbsp;&nbsp;真：</label><span><?php echo $model->Fax; ?></span></p>
                      <p><label>qq&nbsp;&nbsp;号：</label><span><?php echo $model->QQ; ?></span></p>
                      <p><label>座&nbsp;&nbsp;机：</label><span><?php echo $model->TelPhone; ?></span></p>
                      <p><label>地&nbsp;&nbsp;址：</label><span><?php echo Area::showCity($model['Province']).Area::showCity($model['City']).Area::showCity($model['Area']).$model->Address; ?></span></p>
                     
                </div>
             </div>
          </div>
          <div class="m-top bor_back">
             <p class="txxx">营业执照</p>
            <div class="txxx_info4">
               <div class=" m_left68 gs_info">
                      <p><label class="m_left12">注册号：</label><span><?php echo $model['Registration']; ?></span></p>
                      <p><label style="vertical-align:top;">执照照片：</label>
                      	<span>
                      	<?php if (!empty($model['BLPoto'])): ?>
                      		<img src="<?php echo F::uploadUrl() . $model['BLPoto']; ?>" style="width:360px;height:240px;"/>
                      	<?php else:?>
                      		<img src="data:image/jpeg;base64,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" style="width:240px;height:240px;"/>
                      	<?php endif;?>
                      	</span>
                      </p>
                </div>
             </div>
          </div>
      </div>
      <!-- -----------------------------------以上为信息展示--------------------------------------- -->
	<?php echo $this->renderPartial("edit",array("model"=> $model, "organphotos"=>$organphotos, "opentime"=>$opentime));?>
</div>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/uploadify/jquery.uploadify.js'></script>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify1.css">
<script type="text/javascript"><!--
    $(document).ready(function(){
        var url="<?php echo Yii::app()->request->baseUrl; ?>";
        var j = "<?php echo $j;?>";
        $("#addTel").click(function(){
            if(j==0)j=1;
            if(j>=4){alert("座机号码最多只能添加4个！");return false;}
            $("input:text[key="+j+"]").css('display','inline-block');
            j++;
        })
        $("#Organ_Province").change(function(){
            if($(this).val()){
                var province=$(this).val();
                $.getJSON(url+'/common/dynamicarea',{province:province},function(data){
                    if(data!=''){
                        $("#Organ_Area").empty();
                        $.each(data, function(key,val){      
                            jQuery("<option value='"+key+"'>"+val+"</option>").appendTo("#Organ_Area");
                        }); 
                    }
                });
            }else{
                $("#Organ_Area").empty();
                $("<option value=''>请选择地区</option>").appendTo("#Organ_Area");
            }
        });
        $("#storeUrl").focus(function(){
            $("#storeerror").html("");
        });
        $("#modify").live('click',function(){
            window.location.href="<?php echo Yii::app()->createUrl('servicer/servicecompany/index'); ?>/flag/update";
        })
        $("#return").live('click',function(){
            window.location.href="<?php echo Yii::app()->createUrl('servicer/servicecompany/index'); ?>";
        })
        $("#save").click(function(){
            var name=$("#Organ_OrganName").val();
            var mobilephone=$("#Organ_Phone").val();
            var email=$("#Organ_Email").val();
            $.getJSON(Yii_baseUrl+'/servicer/servicecompany/checkorgan',{
                name:name,
                mobilephone:mobilephone,
                email:email
            },function(result){
                if(result.result){
                	if($("#Organ_OrganName").val()==""){
                        alert("机构名称不能为空！");
                        return false;
                    }
                	if($("#Organ_Phone").val()==""){
                        alert("手机号码不能为空！");
                        return false;
                    }
                    if(!$("#Organ_Phone").val().match(/^1[3|4|5|8][0-9]\d{4,8}$/)){
                        alert("请正确填写手机号码，例如:13412341234");
                        return false;
                    }
                    if($("#Organ_Email").val()==""){
                        alert("邮箱地址不能为空！");
                        return false;
                    }
                    if(!$("#Organ_Email").val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){
                        alert("请正确填写邮箱地址，例如:123456789@qq.com");
                        return false;
                    }
                    if(!$("#Organ_Registration").val()=="" && !$("#Organ_Registration").val().match(/^\d{15}$/)){
                        alert("请正确填写15位数字注册号，例如:123451234512345");
                        return false;
                    }
                    if(!$("#Organ_QQ").val()=="" && !$("#Organ_QQ").val().match(/^\d{5,10}$/)){
                        alert("请正确填写QQ号码，例如:15764179");
                        return false;
                    }
                    //$.messager.confirm('提示框', '您确定要保存吗?',function(result){
                    //    if(result){
                			if(!confirm('你确定要保存吗？')) return false;
                            $("#serviceformdata").submit();
                    //    }
                    //});
                }else{
                	alert(result.message);
                    //$.messager.alert('提示', result.message, 'info');
                }
            });
            
        })
        //删除图片事件
        $("#delfile").live('click',function(){
        	$("#file_upload").uploadify('disable',false);
            var photoId=$(this).attr('keyid');
            if(typeof(photoId) != "undefined"){
                var phIds=$("#photoId").val();
                if(phIds!=''){
                    var photoIds=phIds+','+photoId;
                }else{
                    var photoIds=photoId;
                }
                $("#photoId").val(photoIds);
            }
            $(this).parent().remove();
        });
        $("table tbody tr").removeClass("bg-green-light");
        $("table tbody tr").live({
            mouseout: function() {
                $(this).removeClass("tr-hover");
            },
            mouseover: function() {
                $(this).removeClass("tr-hover");
            }
        });
    });
--></script>
<script>
    $(function(){
		<?php $organID = Yii::app()->user->getOrganID(); ?>
		<?php $identity = Organ::model()->findByPK($organID); ?>
        var fileClass =  <?php echo $organID; ?>;
        var identity=<?php echo $identity['Identity']; ?>;
        $("#file_upload").uploadify({
            'auto'	: true,
            'queueId'	: 'some_file+queue',
            'swf'	: Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
            'uploader'	: Yii_baseUrl + '/upload/uploadify',
            'buttonText': '上传机构图片',
            //  'width'     : 82,//flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
            'height'    : 25,//flash高
            'method'    : 'post',
            'formData'  :{'fileClass':fileClass,'role':identity},
            'fileTypeExts' : '*.gif; *.jpg; *.png; *.jpeg',
            'queueSizeLimit' : 1,                         //上传数量  
            'fileSizeLimit':'2MB',                         //上传文件的大小限制
            'onSWFReady': function(){
            	if($("#showimglist").find("li").length>=5){
                	$("#file_upload").uploadify('disable',true);
            	}
            },
            'onUploadSuccess':function(file, data, response){//每个文件上传完成时执行的函数 response是服务器返回的数据
                var responeseDataObj = eval("(" + data + ")");
                var errorinfo = '';
                if(responeseDataObj && responeseDataObj.code == 200){
					<?php $organID = Yii::app()->user->getOrganID(); ?> 
                    var src_1 = "<?php echo F::uploadUrl() ?>";
                    var src = src_1+responeseDataObj.filename;
                    var span = "<li><img  style='width:80px;height:80px;' src="+src+"><span id='delfile' keyid="+responeseDataObj.filename+" class='guanbi3'><img src='<?php echo F::themeUrl(); ?>/images/guanbi3.png'></span><input type='hidden' name='goodsImages[]' value="+responeseDataObj.filename+"></li>";
                    $("#showimglist").append(span);
                }else{
                    errorinfo += '文件上传失败！错误原因：' + responeseDataObj.msg + '<br />';
                    $("#file-upload-errorinfo").show();
                    $("#file-upload-errorinfo span").append(errorinfo);
                }
            	if($("#showimglist").find("li").length==5){
                	$("#file_upload").uploadify('disable',true);
            	}
            }
        });
    })
   
</script>
<script>$(function(){
    $("textarea[maxlength]").keyup(function(){
        var area=$(this);
        var max=parseInt(area.attr("maxlength"),10); //获取maxlength的值
        if(max>0){
            if(area.val().length>max){ //textarea的文本长度大于maxlength
                area.val(area.val().substr(0,max)); //截断textarea的文本重新赋值
            }
        }
    });
    //复制的字符处理问题
    $("textarea[maxlength]").blur(function(){
        var area=$(this);
        var max=parseInt(area.attr("maxlength"),10); //获取maxlength的值
        if(max>0){
            if(area.val().length>max){ //textarea的文本长度大于maxlength
                area.val(area.val().substr(0,max)); //截断textarea的文本重新赋值
            }
        }
    }); 
    var num = $('.photos-list li').length;
    // 大于4张图片 显示左右按钮
    if(num>3){
        var sl = $('.jgcx.photos .arr-l'),
        sr = $('.jgcx.photos .arr-r'),
        ul = $('.photos-list ul');
        sl.show();
        sr.show();
        // ul 宽度
        var length = num*230;
        ul.css({
            "width":length
        });
        //左右滚动
        sl.on('click',function(){
            if(!sr.is(":visible")){
                sr.show();
            }
            var left = parseInt(ul.css('left'))-230;
            ul.animate({
                left:left
            });
            if(length+left<=660){
                ul.css({
                    left:length-230
                });
                sl.hide();
            }
        });
        sr.on('click',function(){
            if(!sl.is(":visible")){
                sl.show();
            }
            var left = parseInt(ul.css('left'))+230;
            ul.animate({
                left:left
            });
            if(left >= 0){
                ul.css({
                    left:0
                });
                sr.hide();
            }
        });
    }
});

</script>