<?php
namespace Common\Model;

use Think\Model;

class ExcelModel extends \Think\Model
{

    protected $tableName = 'game_log';
    // 导入数据方法
    /*将文件导入数据库
     * $filename:文件名,
     *  $exts = 'xls', 
     *  $in_kay_word:导入数据对应表字段, 
     *  $table：要导入的数据表,
     *  $nodouble：表中不可重复字段
     * */
    function goods_import($filename, $exts = 'xls', $in_kay_word, $table, $nodouble = [])
    {
        // 导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        Vendor("phpexcel.PHPExcel");
        Vendor("phpexcel.PHPExcel.IOFactory");
        // 如果excel文件后缀名为.xls，导入这个类
        if ($exts == 'xls') {
            // import("Org.Util.PHPExcel.Reader.Excel5");
            $PHPReader = \PHPExcel_IOFactory::createReader('Excel5');
        } else 
            if ($exts == 'xlsx') {
                $PHPReader = \PHPExcel_IOFactory::createReader('Excel2007');
            }
        // 载入文件
        $PHPExcel = $PHPReader->load($filename);
        // 获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet = $PHPExcel->getSheet(0);
        // 获取总列数
        $allColumn = $currentSheet->getHighestColumn();
        // 获取总行数
        $allRow = $currentSheet->getHighestRow();
        
        $ok = 0;
        
        for ($currentRow = 2; $currentRow <= $allRow; $currentRow ++) {
            $data = [];
            // 从哪列开始，A表示第一列
            foreach ($in_kay_word as $k => $v) {
                // 数据坐标
                $address = $v . $currentRow;
                // 读取到的数据，保存到数组$arr中
                $cell = $currentSheet->getCell($address)->getValue();
                // $cell = $data[$currentRow][$currentColumn];
                if ($cell instanceof PHPExcel_RichText) {
                    $cell = $cell->__toString();
                }
                $data[$k] = trim($cell);
            }
            if ($nodouble) {
                $where = [];
                
                foreach ($nodouble as $val) {
                    $where[$val] = $data[$val];
                }
                if ($where) {
                    $ret = M($table)->where($where)->find();
                    if ($ret) {
                        continue;
                    }
                }
            }
            $re = M($table)->add($data);
            if ($re)
                $ok ++;
        }
        unlink($filename);
        rmdir("./Uploads/card/" . date("Y-m-d"));
        return [
            "allrow" => $allRow-1,
            "ok" => $ok
        ];
    }

    public function exportExcel($expTitle, $expCellName, $expTableData)
    {
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle); // 文件名称
        $fileName = $expTitle . date('YmdHis'); // or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel.PHPExcel");
        
        $objPHPExcel = new \PHPExcel();
        $cellName = array(
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'H',
            'I',
            'J',
            'K',
            'L',
            'M',
            'N',
            'O',
            'P',
            'Q',
            'R',
            'S',
            'T',
            'U',
            'V',
            'W',
            'X',
            'Y',
            'Z',
            'AA',
            'AB',
            'AC',
            'AD',
            'AE',
            'AF',
            'AG',
            'AH',
            'AI',
            'AJ',
            'AK',
            'AL',
            'AM',
            'AN',
            'AO',
            'AP',
            'AQ',
            'AR',
            'AS',
            'AT',
            'AU',
            'AV',
            'AW',
            'AX',
            'AY',
            'AZ'
        );
        
        // $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.' Export time:'.date('Y-m-d H:i:s'));
        for ($i = 0; $i < $cellNum; $i ++) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i] . '1', $expCellName[$i][1]);
        }
        // Miscellaneous glyphs, UTF-8
        for ($i = 0; $i < $dataNum; $i ++) {
            for ($j = 0; $j < $cellNum; $j ++) {
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j] . ($i + 2), $expTableData[$i][$expCellName[$j][0]]);
            }
        }
        
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="' . $xlsTitle . '.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls"); // attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }

    function getfiles($dir)
    {
        $date=[];
        if (is_dir($dir)) {
            $dh = opendir($dir);
            if ($dh) {
                while (($file = readdir($dh)) !== false) {
                    if(filetype($dir . "/" . $file)!="dir"){
                        $date[]=[
                            "name"=>$file,
                            "src"=>"/".$dir . "/" . $file,
                        ];
                    }
                }
            }
        }
        return $date;
    }
}   