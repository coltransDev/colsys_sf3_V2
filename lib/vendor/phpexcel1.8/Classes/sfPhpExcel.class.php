<?php


if (!defined('PHPEXCEL_ROOT')) {
	/**
	 * @ignore
	 */
	define('PHPEXCEL_ROOT', dirname(__FILE__) . '/../');
	require(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
}

class sfPhpExcel extends PHPExcel
{
    
    	/**
	 * Document data
	 *
	 * @var PHPExcel_DocumentProperties
         * 
         * esta variable posee la informacion del archivo excel de la siguiente manera
	 */
    private $_data;
    
    public function getData()
    {
        return $this->_data;
    }
    
    
    public function setData($d)
    {
        $this->_data=$d;
    }
    
    public function printData()
    {                
        //$objPHPExcel = new sfPhpExcel();
        foreach($this->_data as $key=>$sheet)
        {
            //echo $key;
            //echo "<pre>";print_r($sheet);echo "</pre>";
            $this->createSheet();
            $this->setActiveSheetIndex($key);
            $this->getActiveSheet()->setTitle($sheet["title"]);
            $col_ini=  isset($sheet["col_ini"])?$sheet["col_ini"]:0;
            $row_ini=  isset($sheet["row_ini"])?$sheet["row_ini"]:0;
            
            $col_current=  $col_ini;
            $row_current=  $row_ini;
            
            foreach($sheet["data"] as $j=>$row)
            {
                $col_current=  $col_ini;
                foreach($row["data"] as $k=>$cell)
                {                    
                    if(isset($cell["style"]))
                    {
                        $this->getActiveSheet()->getStyleByColumnAndRow($col_current,$row_current)->applyFromArray($cell["style"]);
                    }
                    else if(isset($row["style"]))
                        $this->getActiveSheet()->getStyleByColumnAndRow($col_current,$row_current)->applyFromArray($row["style"]);


                    $this->getActiveSheet()->setCellValueByColumnAndRow($col_current,$row_current, $cell["value"]);

                    if(isset($cell["colspan"]))
                        $this->getActiveSheet()->mergeCellsByColumnAndRow($col_current, $row_current, ((int)$col_current+(int)$cell["colspan"]-1), $row_current);
                    if(isset($cell["rowspan"]))
                    {
                        $this->getActiveSheet()->mergeCellsByColumnAndRow($col_current, $row_current, $col_current, ((int)$row_current+(int)$cell["rowspan"]-1));
                    }
                    $col_current++;
                }
                $row_current++;
            }
        }
    }
    
    
  
}
