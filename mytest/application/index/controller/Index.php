<?php
namespace app\index\controller;
use think\Loader;
class Index
{
    /**
     * @return string
     */
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }

    /**
     *
     */
    public function excel()
    {

//        Loader::import('cc/PHPExcel');
//        Loader::import('PHPExcel.PHPExcel.IOFactory');
//        Loader::import('PHPExcel.PHPExcel.Reader.Excel5');
        vendor('PHPExcel.PHPExcel');
        $excel = new \PHPExcel();


//Excel表格式,这里简略写了8列
        $letter = array('A', 'B', 'C', 'D', 'E', 'F', 'F', 'G');
//表头数组
        $tableheader = array('ID', '标题', '内容');
//填充表头信息
        for ($i = 0; $i < count($tableheader); $i++) {
            $excel->getActiveSheet()->setCellValue("$letter[$i]1", "$tableheader[$i]");
        }
        //在这里调用你要导出的数据
//        $MsgModel = M("Msg"); // 实例化Msg对象
//        $list = $MsgModel->select();

//        表格数组
                $data = array(
                        array('1', '小王', '男', '20', '100'),
                        array('2', '小李', '男', '20', '101'),
                        array('3', '小张', '女', '20', '102'),
                        array('4', '小赵', '女', '20', '103')
                );
//        $data = $list;
//填充表格信息
        for ($i = 2; $i <= count($data) + 1; $i++) {
            $j = 0;
            foreach ($data[$i - 2] as $key => $value) {
                $excel->getActiveSheet()->setCellValue("$letter[$j]$i", "$value");
                $j++;
            }
        }
        //创建Excel输入对象
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
}
