<div class="easyui-panel" id="tab1panel" style="width:648px;height:310px">	
    <table id="inquirydg" class="easyui-datagrid"  style="width:648px;height:310px"
           data-options="rownumbers:true,
           region:'center',
           pagination:true,
           singleSelect:true,
           method:'get',
           url:'<?php echo Yii::app()->createUrl('mall/quotations/list'); ?>',
           view: myview,
           emptyMsg: '暂无数据',
           onClickRow:clickrow
           ">
        <thead>
            <tr>
                <th data-options="field:'InquirySn',width:170">询价单编号</th>
                <th data-options="field:'ServiceName',width:120">发起方</th>
                <th data-options="field:'CreateTime',width:135">询价时间</th>
                <th data-options="field:'Status',width:90">状态</th>
                <th data-options="field:'detail',width:100">询价单详情</th>
            </tr>
        </thead>
    </table>
</div>

<script type="text/javascript">
function clickrow()
{
		location.href=Yii_baseUrl+'/mall/quotations/index'
}
</script>