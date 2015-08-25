<?php

/**
 * EPhpExcelReader class file.
 *
 * @author jerry2801 <jerry2801@gmail.com>
 * @version alpha 2 2010-5-18 14:26
 *
 * A typical usage of JPhpExcelReader is as follows:
 * <pre>
 * Yii::import('ext.phpexcelreader.EPhpExcelReader');
 * $data=new EPhpExcelReader('example.xls');
 * echo $data->dump(true,true);
 * </pre>
 */

error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1); 

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'excel_reader2.php';

class EPhpExcelReader extends Spreadsheet_Excel_Reader
{
}