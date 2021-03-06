<?php 
/**
 * 批量导入服务项目
 */
class ServiceImport
{	
	// 促销商品批量上传
	public static $itemsRows = array(
		'项目名称（必填）'=>'ItemName',
		'项目报价（必填）'=>'ItemQuote',
		'服务说明'=>'ItemIntro'
	);
	function parse($excelfile,$template,$data=array())
	{
           
		try{
			//获取上传文件的文件名扩展名
			$extend = strtolower(strrchr($excelfile,'.'));
			$readerType = ($extend == '.xlsx')?'Excel2007':'Excel5';
			$objReader = new PHPExcel();
			$objReader = PHPExcel_IOFactory::createReader($readerType);//use Excel5 for 5fromat ,use excel2007 for 2007 format
			$objPHPExcel = $objReader->load($excelfile);
			if(!$objPHPExcel){
				$error = '加载Excel出错';
				return array('success'=>false,'error'=>$error);
			}
			$objWorksheet = $objPHPExcel->getActiveSheet();	//取得活动sheet
			if(!$objWorksheet){
				$error = '加载Excel出错';
				return array('success'=>false,'error'=>$error);
			}			
			$title = $objWorksheet->getTitle();				//取得sheet名称
			$highestRow = $objWorksheet->getHighestRow();	//取得总行数
			
			$highestColumn = $objWorksheet->getHighestColumn(); //取得总列数
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);	//总列数
			//执行结果
			$error = "";
			$first_row = array();
			for ($col = 0;$col<$highestColumnIndex;$col++)
			{
				$first_row[$col] = $objWorksheet->getCellByColumnAndRow($col, 1)->getValue();
			}
			//验证表结构，表名称和字段列表
			if(!$this->validateExcel($template, $first_row)){
				$error = "Excel内容与模板不符合";
				return array('success'=>false,'error'=>$error);
			}
                        for ($row = 2;$row <= $highestRow; $row++)
			{
				//每行的第一、二列不能为空
				$first_value = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
                                $second_value = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
				if(empty($first_value)||empty($second_value)){
                                    $error = "项目名称和项目报价不能为空!";
                                    return array('success'=>false,'error'=>$error);
				}
                        }
			//生成插入语句的头部
			$sql_header = $this->generateSqlHeader($template, $first_row);
			if($sql_header == ""){
				$error = "SQL语句头部生成失败";
				return array('success'=>false,'error'=>$error);
			}
			//生成SQL语句
			$sql = $sql_header;
			for ($row = 2;$row <= $highestRow; $row++)
			{
				$data_new = array();
				$sql_data = '(';
				////注意highestColumnIndex的列数索引从0开始
				for ($col = 0;$col<$highestColumnIndex;$col++)
				{
					$data_new[$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
					$sql_data .= "'".trim($data_new[$col])."',";
				}
				if ($template == "serviceitems"){
					$sql_data .= "'".$data['OrganID']."'";
				}
				$sql_data .= ")";		
				$sql .= $sql_data . ','; 
			}
			$sql = rtrim($sql,",").";";
			//返回结果数据
			$success = false;
			if($error == "" && $sql != ""){
				$success = true;
			}
		}catch(Exception $e) {
			$success = false;
			$error = '解析Excel出错'.$e->getMessage();
		}    
		return array('success'=>$success,'error'=>$error,'sql'=>$sql);
	}
	
	//验证Excel的格式是否正确
	function validateExcel($template, $rows){
		$templaterRows = array();
		if ($template == 'serviceitems')	// 促销商品
		{
			$templaterRows = ServiceImport::$itemsRows;
		}		
		$keys = array_keys($templaterRows);
		//比较数组长度是否一致
		if(!is_array($rows) || (count($rows) != count($keys))){
			return false;
		}
		//比较数组值是否一致
		$diff = array_diff($rows, $keys);
		if(count($diff) != 0){
			return false;
		}
		return true;
	}
	
	//依据Excel的第一行构建插入的SQL语句头部
	function generateSqlHeader($template, $rows){
		$tablename = "";
		if ($template == 'serviceitems'){	 // 当模版是促销商品时
			$tablename = "tbl_service_items_temp";	//临时存放数据
			$templaterRows = ServiceImport::$itemsRows;
			$sql_header = "INSERT INTO `$tablename` (";
			for($i=0; $i<count($rows); $i++){
				//取列名称
				$column = $templaterRows[$rows[$i]];
				$sql_header .= '`'.$column.'`';
				if($i < count($rows)-1){
					$sql_header .= ',';
				}
			}
			$sql_header .= ',`OrganID`';
			$sql_header .= ') values ';	
		}
		return $sql_header;
	}
}