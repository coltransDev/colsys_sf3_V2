<?php

/**
 * digitalFile actions.
 *
 * @package    colsys
 * @subpackage digitalFile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class digitalFileActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeIndex(){
		
		$this->referencias = array();		
	}

	
	/*
	* Abre la carpeta de una referencia y muestra los archivos, 
	* en caso de que la carpeta no exista la crea
	*/
	public function executeVerArchivos(){
		$this->referencia = InoMaestraFactory::crearReferencia(str_replace("|",".",$this->getRequestParameter("referencia")));	
		$this->forward404Unless( $this->referencia );
		
		
		
		$directory = $this->referencia->getDirectorio();
		$this->numReferencia = $this->referencia->getCaReferencia();
		
		switch( get_class($this->referencia) ){
			case "InoMaestraSea";
				$this->opcion = "maritimo";
				break;
			case "InoMaestraAir";
				$this->opcion = "aereo";
				break;
			default:
				$this->opcion = null;
				break;
		}
				
		
		if( !is_dir($directory) ){			
			@mkdir($directory, 0777);			
		}
			
		$this->files=sfFinder::type('file')->maxDepth(0)->in($directory);	
		
		$this->user = $this->getUser();		
		$this->user->clearFiles();
		
	}
	
	
	
	/*
	* 
	*/
	public function executeCargarArchivo(){
		$this->referencia = str_replace("|",".",$this->getRequestParameter("referencia"));	
		$this->tipo = $this->getRequestParameter("tipo");
		$this->factura = $this->getRequestParameter("factura");
		
		
		$directory = sfConfig::get("app_digitalFile_root").$this->referencia;	
						
		if( !is_dir($directory) ){			
			@mkdir($directory, 0777);			
		}	
		
		$tipo = $this->getRequestParameter("tipo");		
		if( $tipo == "FACT"){		
			$dir = $directory.DIRECTORY_SEPARATOR."FACT".DIRECTORY_SEPARATOR;
			if( !is_dir($dir) ){
				@mkdir($dir, 0777);
			}
			
			
			$destPath = $dir.str_replace("/","",$this->factura).strtolower(substr($this->getRequest()->getFileName('file'),-4,4));			
				
		}else{
			$destPath = $directory.DIRECTORY_SEPARATOR.$this->getRequest()->getFileName('file'); 
		}
  		$this->getRequest()->moveFile('file', $destPath  );
		
		
		//$this->setLayout("none");
		
		
	}
	
	/*
	* 
	*/
	public function executeCargarArchivoForm(){
		$this->referencia = str_replace("|",".",$this->getRequestParameter("referencia"));
		$this->tipo = $this->getRequestParameter("tipo");
		$this->factura = $this->getRequestParameter("factura");
			
	} 
	
	/* 
	* Realiza las busqueda por numero de referencia
	*/
	public function executeBusquedaReferencia(){		
		
		$criterio = trim($this->getRequestParameter("criterio"));
		$opcion = $this->getRequestParameter("opcion");		
		
		if( $opcion=="ca_referencia" ){
			
			$c=new Criteria();								
			$c->setLimit(50);
			
			if( substr($criterio,0,1)=="4" || substr($criterio,0,1)=="5" ){
				$c->add( InoMaestraSeaPeer::CA_REFERENCIA, $criterio."%" , Criteria::LIKE );
				$c->addDescendingOrderByColumn(InoMaestraSeaPeer::CA_FCHCREADO);	
				$this->referencias = InoMaestraSeaPeer::doSelect( $c );
			}elseif( substr($criterio,0,1)=="1" ){
				$c->addDescendingOrderByColumn(InoMaestraAirPeer::CA_FCHCREADO);
				$c->add( InoMaestraAirPeer::CA_REFERENCIA, $criterio."%" , Criteria::LIKE );
				$this->referencias = InoMaestraAirPeer::doSelect( $c );
			}elseif( substr($criterio,0,1)=="2"||substr($criterio,0,1)=="3" ){
				$c->addDescendingOrderByColumn(AduanaMaestraPeer::CA_FCHCREADO);
				$c->add( AduanaMaestraPeer::CA_REFERENCIA, $criterio."%" , Criteria::LIKE );
				$this->referencias = AduanaMaestraPeer::doSelect( $c );
			}else{
				$this->referencias = null;
			}			
		}elseif($opcion=="ca_factura"){
			$c=new Criteria();								
			$c->setLimit(50);			
			$c->addJoin( InoMaestraSeaPeer::CA_REFERENCIA, InoIngresosSeaPeer::CA_REFERENCIA );
			$c->setDistinct();
			$c->add( InoIngresosSeaPeer::CA_FACTURA, $criterio."%" , Criteria::LIKE );						
			$c->addDescendingOrderByColumn(InoMaestraSeaPeer::CA_FCHCREADO);	
			$referenciasSea = InoMaestraSeaPeer::doSelect( $c );
			
			
			$this->referencias = $referenciasSea;
		}
		
			
	}
	
	public function executeEliminarArchivo(){		
		$idx = $this->getRequestParameter("idx"); 
		$name = $this->getUser()->getFile( $idx );
		$this->referencia=str_replace("|",".",$this->getRequestParameter("referencia"));
		
		unlink( $name );
		return sfView::NONE;		
	}
	
	
	
	/*
	* Muestra la informacion de una referencia y permite subir facturas y otras imagenes
	*/	
	public function executeVerReferencia(){	
		$this->referencia = InoMaestraFactory::crearReferencia(str_replace("|",".",$this->getRequestParameter("referencia")));	
		$this->forward404Unless( $this->referencia );
		
		$this->factura = $this->getRequestParameter("factura");	
				
		$directory = $this->referencia->getDirectorio();
		$this->numReferencia = $this->referencia->getCaReferencia();
		
		switch( get_class($this->referencia) ){
			case "InoMaestraSea";
				$this->opcion = "maritimo";
				break;
			case "InoMaestraAir";
				$this->opcion = "aereo";
				break;
			default:
				$this->opcion = null;
				break;
		}
				
		
		if( !is_dir($directory) ){			
			@mkdir($directory, 0777);			
		}
			
		$this->files=sfFinder::type('file')->maxDepth(0)->in($directory);	
		
		$this->user = $this->getUser();		
		$this->user->clearFiles();
	}
}
?>