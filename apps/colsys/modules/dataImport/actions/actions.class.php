<?php

/**
 * dataImport actions.
 *
 * @package    colsys
 * @subpackage dataImport
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class dataImportActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeIndex()
	{
	
	}


	/*
	* Lee el archivo
	*/
	public function executeImportFile(){

            set_time_limit(270);
            $header = Doctrine::getTable("FileHeader")->find($this->getRequestParameter("fileHeader"));
            $this->forward404Unless( $header );

            $directory = $header->getCaInOut();
            $processed = "processed";

            $files = sfFinder::type('file')->name('*.PO')->maxDepth(0)->in($directory);

            foreach( $files as $filename ) {
                $content = "";
                $handle = fopen($filename, 'r');

                while (!feof($handle)) {
                    $content .= stream_get_line($handle, 1024, "\n")."\n";
                }
                fclose($handle);

                $fileImported = new FileImported();
                $fileImported->setCaIdfileheader( $header->getCaIdfileheader() );
                $fileImported->setCaFchimportacion( date("Y-m-d H:i:s") );
                $fileImported->setCaContent( $content );
                $fileImported->setCaProcesado( false );
                $fileImported->setCaNombre( basename($filename) );
                $fileImported->setCaUsuario( $this->getUser()->getUserId() );
                $fileImported->setCaProceso( $this->getRequestParameter("proceso") );
                $fileImported->save();
                if( $fileImported->process() ) {
                    if ($this->getRequestParameter("proceso") == "Coltrans") {
                        rename($filename, $directory.DIRECTORY_SEPARATOR.$processed.DIRECTORY_SEPARATOR.basename($filename));
                    }else if ($this->getRequestParameter("proceso") == "Colmas") {
                        rename($filename, $directory.DIRECTORY_SEPARATOR.$processed.DIRECTORY_SEPARATOR.basename($filename));
                    }
                }
            }

            if ($this->getRequestParameter("proceso") == "Coltrans") {
                $this->redirect("falabella/list");
            }else if ($this->getRequestParameter("proceso") == "Colmas") {
                $this->redirect("falabellaAdu/list");
            }
        }


	/*
	* Carga el archivo Generado por Aprocom
	*/
	public function executeLoadFile( $request ){
            if ($request->isMethod('post')){
                $ref_mem = NULL;
                $file = $_FILES['archivo']['tmp_name'];

                $doc = new DOMDocument();
                $doc->loadHTMLFile($file);

                $elements = $doc->getElementsByTagName('table');

                $falaDeclaracionImp = new FalaDeclaracionImp();
                if (!is_null($elements)) {
                    foreach ($elements as $element) {
                        $nodes = $element->childNodes;
                        foreach ($nodes as $node) {

                            if( $node->nodeName=="tr" ) {
                                $vals = explode( "\n",$node->nodeValue);
                                $this->depurar_arreglo($vals);

                                if (count($vals) and $vals[0] == 'It'){
                                    $falaDeclaracionImp->save();
                                    if ($falaDeclaracionImp->getCaReferencia()){
                                        foreach ($nodes as $node) {
                                            if (strlen(trim($node->nodeValue))==0 or substr($node->nodeValue,0,2)=='It'){
                                                continue;
                                            }
                                            $falaDeclaracionDts = new FalaDeclaracionDts();
                                            $falaDeclaracionDts->setCaReferencia($falaDeclaracionImp->getCaReferencia());
                                            $vals = explode( "\n",$node->nodeValue);
                                            $this->depurar_arreglo($vals);
                                            $i = 0;
                                            foreach($vals as $val) {
                                                if ($i==3 or $i>=5){
                                                    $val = floatval(str_replace(",","",$val));
                                                }
                                                if ($i==0){
                                                    $falaDeclaracionDts->setCaItem($val);
                                                }else if($i==1){
                                                    $val = ($val==null)?"":$val;
                                                    $falaDeclaracionDts->setCaSubpartida($val);
                                                }else if($i==2){
                                                    $falaDeclaracionDts->setCaMod($val);
                                                }else if($i==3){
                                                    $falaDeclaracionDts->setCaCantidad($val);
                                                }else if($i==4){
                                                    $falaDeclaracionDts->setCaUnidad($val);
                                                }else if($i==5){
                                                    $falaDeclaracionDts->setCaValorFob($val);
                                                }else if($i==6){
                                                    $falaDeclaracionDts->setCaGastosDespacho($val);
                                                }else if($i==7){
                                                    $falaDeclaracionDts->setCaFlete($val);
                                                }else if($i==8){
                                                    $falaDeclaracionDts->setCaSeguro($val);
                                                }else if($i==9){
                                                    $falaDeclaracionDts->setCaGastosEmbarque($val);
                                                }else if($i==10){
                                                    $falaDeclaracionDts->setCaAjusteValor($val);
                                                }else if($i==11){
                                                    $falaDeclaracionDts->setCaValorAduana($val);
                                                }else if($i==12){
                                                    $falaDeclaracionDts->setCaArancelPorcntj($val);
                                                }else if($i==13){
                                                    $falaDeclaracionDts->setCaArancel($val);
                                                }else if($i==14){
                                                    $falaDeclaracionDts->setCaIvaPorctj($val);
                                                }else if($i==15){
                                                    $falaDeclaracionDts->setCaIva($val);
                                                }else if($i==16){
                                                    $falaDeclaracionDts->setCaSalvaguardaPorcntj($val);
                                                }else if($i==17){
                                                    $falaDeclaracionDts->setCaSalvaguarda($val);
                                                }else if($i==18){
                                                    $falaDeclaracionDts->setCaCompensaPorcntj($val);
                                                }else if($i==19){
                                                    $falaDeclaracionDts->setCaCompensa($val);
                                                }else if($i==20){
                                                    $falaDeclaracionDts->setCaAntidumpPorcntj($val);
                                                }else if($i==21){
                                                    $falaDeclaracionDts->setCaAntidump($val);
                                                }else if($i==22){
                                                    $falaDeclaracionDts->setCaSancion($val);
                                                }else if($i==23){
                                                    $falaDeclaracionDts->setCaRescate($val);
                                                }else if($i==25){
                                                    $falaDeclaracionDts->setCaPesoBruto($val);
                                                }else if($i==26){
                                                    $falaDeclaracionDts->setCaPesoNeto($val);
                                                }
                                                $i++;
                                            }
                                            $falaDeclaracionDts->save();
                                        }
                                    }
                                }

                                foreach($vals as $val) {
                                    if ($val == 'D.O. Nro') {
                                        $val = trim(current($vals));
                                        $falaDeclaracionImp->setCaReferencia($val);
                                    }elseif($val == 'Moneda de Negociación :') {         //ca_moneda
                                        $val = current($vals);
                                        $parametro = Doctrine::getTable("Parametro")->find(array("CU079",0,$val));
                                        $falaDeclaracionImp->setCaMoneda($parametro->getCaValor2());
                                    }elseif($val == 'Tasa Representativa') {         //ca_valor_trm
                                        $val = floatval(str_replace(",","",current($vals)));
                                        $falaDeclaracionImp->setCaValorTrm($val);
                                    }elseif($val == 'Año') {         //ca_ano_trm
                                        $falaDeclaracionImp->setCaAnoTrm(intval(current($vals)));
                                    }elseif($val == 'Semana') {         //ca_semana_trm
                                        $falaDeclaracionImp->setCaSemanaTrm(intval(current($vals)));
                                    }elseif($val == 'Factor') {         //ca_factor_trm
                                        $falaDeclaracionImp->setCaFactorTrm(floatval(current($vals)));
                                    }

                                }
                            }
                        }
                    }
                }
                $this->redirect("falabellaAdu/declaracion?referencia=".base64_encode($falaDeclaracionImp->getCaReferencia()));
            }
        }


	/*
	* Elimina posiciones con NULL o en blanco dentro de un arreglo
	*/
        public function depurar_arreglo(&$array_ref) {
            foreach($array_ref as $key => $value){
                if(trim($value) == ''){
                    $array_ref[$key] = NULL;
                }else{
                    $array_ref[$key] = trim(utf8_decode($value));
                }
            }
            $array_ref = array_diff($array_ref,array(NULL));
        }

}
?>