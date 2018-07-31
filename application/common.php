<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * [getAppName 获取当前应用名]
 * @Author   Cungson
 * @DateTime 2018-07-27T23:25:09+0800
 */
function getAppName()
{
	$appPath = rtrim(APP_PATH,'/');
	$appName = pathinfo($appPath,PATHINFO_BASENAME);
	return $appName;
}
/**
 * [toTextCode 存储数组]
 * @Author   Cungson
 * @DateTime 2018-07-27T23:18:37+0800
 * @param
 * @param    [type]  array
 * @param    [type]  filename
 */
function toTextCode( $paramater,$fileName )
{
	$tab = "\t\t\t\t";
	$str = paramaterToString($paramater,$tab);
	$text = "<?php\n\nreturn\n\n".$tab.$str.';';
	return file_put_contents($fileName,$text);
}

/**
 * [paramaterToString 转译成文本代码]
 * @Author   Cungson
 * @DateTime 2018-07-27T23:19:31+0800
 * @param
 * @param    [type]  paramater  
 * @param    string  prepositionString
 */
function paramaterToString($input,$indent = '')
{
	switch (gettype($input)) {
		case 'string' :
			return "'" . str_replace(array("\\", "'"), array("\\\\", "\'"), $input) . "'";
		case 'array' :
			$output = "[\r\n";
			foreach ($input as $key => $value) {
				$output .= $indent . "\t" . paramaterToString($key, $indent . "\t") . ' => ' . paramaterToString($value, $indent . "\t");
				$output .= ",\r\n";
			}
			$output .= $indent . ']';
			return $output;
		case 'boolean' :
			return $input ? 'true' : 'false';
		case 'NULL' :
			return 'NULL';
		case 'integer' :
		case 'double' :
		case 'float' :
			return "'" . (string) $input . "'";
	}
	return 'NULL';
}