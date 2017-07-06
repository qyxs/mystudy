<?php
/**
 * Created by PhpStorm.
 * User: qyxs
 * Date: 2017/7/5
 * Time: 9:59
 */

namespace app\excel\controller;


use think\Controller;

class Excel extends Controller
{
    public function index(){
        vendor('PHPExcel.PHPExcel');
        $excel=new \PHPExcel();
        $letter=['A','B','C','D','E','F'];
        $tabel_header=['编号','姓名','性别','年龄','分数'];
        $data=[
            ['1', '小王', '男', '20', '100'],
            ['2', '小李', '男', '20', '101'],
            ['3', '小张', '女', '20', '102'],
            ['4', '小赵', '女', '20', '103']
        ];
        for($i=0;$i<count($tabel_header);$i++){
            $excel->getActiveSheet()->setCellValue("$letter[$i]1",$tabel_header[$i]);
        }
        for($i=0;$i<count($data);$i++){
            $num=$i+2;
            for($j=0;$j<count($data[$i]);$j++){
                $excel->getActiveSheet()->setCellValue("$letter[$j]$num",$data[$i][$j]);
            }
        }
        $write = new \PHPExcel_Writer_Excel5($excel);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header('Content-Disposition:attachment;filename="testdata.xls"');
        header("Content-Transfer-Encoding:binary");
        $write->save('php://output');
    }
    public function importExcel(){
        vendor('PHPExcel.PHPExcel');
        $excel=new \PHPExcel();
        $file=STATIC_PATH."testdata.xls";
        $PHPReader = new \PHPExcel_Reader_Excel2007();
        if (!$PHPReader->canRead($file)) {
            $PHPReader = new \PHPExcel_Reader_Excel5();
            if (!$PHPReader->canRead($file)){
                return false;
            }
        }

        $E = $PHPReader->load($file);
        $cur = $E->getSheet(1);  // 读取第一个表
        $end = $cur->getHighestColumn(); // 获得最大的列数
        $line = $cur->getHighestRow(); // 获得最大总行数
        // 获取数据数组
        $info = array();
        for ($row = 1; $row <= $line; $row ++) {
            for ($column = 'A'; $column <= $end; $column ++) {
                $val = $cur->getCellByColumnAndRow(ord($column) - 65, $row)->getValue();
                $info[$row][] = $val;
            }
        }
        dump($info);
    }
}