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
		$header = Doctrine::getTable("FileHeader")->find( $this->getRequestParameter("fileHeader"));
		$this->forward404Unless( $header );		
		
		
		$directory=sfConfig::get('app_falabella_input');
        
		$files = sfFinder::type('file')->name('*.PO')->maxDepth(0)->in($directory);
        
		foreach( $files as $filename ){
			
			$content = "";
			// $filename = "c:\\dvd\\FAB200802261838.PO"; 	
			$handle = fopen($filename, 'r');
			
			while (!feof($handle))
			{
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
			$fileImported->save();
			if( $fileImported->process() ){		
				rename($filename, sfConfig::get('app_falabella_input_processed').DIRECTORY_SEPARATOR.basename($filename));
			}
		}
		
		$this->redirect("falabella/list");
		//header("Location: /colsys_sf/falabella/list");
		
		
	}
	
}
?>