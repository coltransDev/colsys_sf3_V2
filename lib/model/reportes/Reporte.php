<?php

/**
 * Subclass for representing a row from the 'tb_reportes' table.
 *
 * 
 *
 * @package lib.model.sea
 */ 
class Reporte extends BaseReporte
{
	private $ultimoAviso=null; 	
	private $ultimoStatus=null;
	
	/*
	* Retorna un array conteniendo los proovedores del reporte
	* Author: Andres Botero
	*/
	public function getProovedores(){
		$provId = $this->getCaIdproveedor();
		$result = array();
		if($provId){		
			$provId = explode("|", $provId);
			foreach( $provId as $id ){
				$proovedor = TerceroPeer::retrieveByPk( $id );			
				$result[]=$proovedor;
			}			
		}	
		return $result;		
	}	
	
	/*
	* Retorna verdadero si es la ultima version del reporte de lo contrario retorna falso
	* Author: Andres Botero
	*/
	public function esUltimaVersion(){
		$version = $this->getCaVersion();
		$c = new Criteria();
		$c->add( ReportePeer::CA_CONSECUTIVO, $this->getCaConsecutivo() );
		$c->add( ReportePeer::CA_USUANULADO, NULL, Criteria::ISNULL );
		$c->add( ReportePeer::CA_VERSION, $version, Criteria::GREATER_THAN );	
		$count = ReportePeer::doCount( $c );
		if( $count>0 ){
			return false;
		}else{
			return true;
		}
		
	}
	
	/*
	* Retorna el numero de versiones existentes de este reporte
	* Author: Andres Botero
	*/
	public function numVersiones(){
		$version = $this->getCaVersion();
		$c = new Criteria();
		$c->add( ReportePeer::CA_CONSECUTIVO, $this->getCaConsecutivo() );
		$c->add( ReportePeer::CA_USUANULADO, NULL, Criteria::ISNULL );
			
		$count = ReportePeer::doCount( $c );
		return $count;
		
	}
			
	/*
	* Retorna el objeto ciudad asociado al campo ca_origen
	* Author: Andres Botero
	*/
	public function getOrigen(){
		$c = new Criteria();
		$c->add(  CiudadPeer::CA_IDCIUDAD, $this->getCaOrigen() );
		return CiudadPeer::doSelectOne( $c );		
	}
	
	
	/*
	* Retorna el objeto ciudad asociado al campo ca_destino
	* Author: Andres Botero
	*/
	public function getDestino(){
		$c = new Criteria();
		$c->add(  CiudadPeer::CA_IDCIUDAD, $this->getCaDestino() );
		return CiudadPeer::doSelectOne( $c );		
	}
	
	/*
	* Retorna el objeto ciudad asociado al campo ca_destino
	* Author: Andres Botero
	*/
	public function getDestinoCont(){
		$c = new Criteria();
		$c->add(  CiudadPeer::CA_IDCIUDAD, $this->getCaContinuacionDest() );
		return CiudadPeer::doSelectOne( $c );		
	}
	
	/*
	* Retorna los status asociasdos al reporte , sobrecarga getRepStatuss en BaseReporte
	* Author: Andres Botero
	*/
	public function getRepEquipos( $criteria = null, $con = null){
		
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}
				
		$criteria->addJoin( RepEquipoPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE );		
		$criteria->add( ReportePeer::CA_CONSECUTIVO, $this->getCaConsecutivo() );
		
				
		return RepEquipoPeer::doSelect( $criteria, $con );		
	}	
		
	
	/*
	* Retorna los status asociasdos al reporte , sobrecarga getRepStatuss en BaseReporte
	* Author: Andres Botero
	*/
	public function getRepStatuss( $criteria = null, $con = null){
		
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}
				
		$criteria->addJoin( RepStatusPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE );		
		$criteria->add( ReportePeer::CA_CONSECUTIVO, $this->getCaConsecutivo() );
		$criteria->addDescendingOrderByColumn( RepStatusPeer::CA_FCHSTATUS );
				
		return RepStatusPeer::doSelect( $criteria, $con );		
	}
	
	/*
	* Retorna los avisos asociasdos al reporte , sobrecarga getRepAvisos en BaseReporte
	* Author: Andres Botero
	*/
	public function getRepAvisos( $criteria = null, $con = null ){
		
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}
		
		$criteria->add( RepAvisoPeer::CA_IDREPORTE, $this->getCaIdreporte() );
		$criteria->addDescendingOrderByColumn( RepAvisoPeer::CA_FCHENVIO );
			
		return RepAvisoPeer::doSelect( $criteria, $con );		
	}
	
	/*
	* Retorna el ultimo aviso segun el orden cronologico
	* Author: Andres Botero
	*/	
	public function getUltimoAviso(){
		if( $this->ultimoAviso ){
			return $this->ultimoAviso;
		}else{	
			$c =new Criteria();
			$c->add( RepStatusPeer::CA_IDREPORTE, $this->getCaIdreporte() );
			$c->addDescendingOrderByColumn( RepStatusPeer::CA_FCHENVIO );
			$c->add( RepStatusPeer::CA_ETAPA, "ETA");
			
			$c->setLimit(1);
			
			$aviso = RepStatusPeer::doSelectOne( $c );
			
			$this->ultimoAviso = $aviso;
			
			if( $this->ultimoAviso ){
				return $this->ultimoAviso;
			}else{
				return null;
			}
		}
	}
	
	/*
	* Retorna el ultimo status segun el orden cronologico
	* Author: Andres Botero
	*/	
	public function getUltimoStatus(){
		if( $this->ultimoStatus ){
			return $this->ultimoStatus;
		}else{	
			$c =new Criteria();
			
			$c->add( ReportePeer::CA_CONSECUTIVO, $this->getCaConsecutivo() );	
			$c->addJoin( RepStatusPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE );
			$c->addDescendingOrderByColumn( RepStatusPeer::CA_FCHENVIO );
			$c->setLimit(1);
			
			$this->ultimoStatus = RepStatusPeer::doSelectOne( $c );
	
			if( $this->ultimoStatus ){
				return $this->ultimoStatus;
			}else{
				return null;
			}
		}
	}
	
	/*
	* Retorna el objeto Contacto asociado al reporte 
	* @author Andres Botero
	*/
	public function getContacto(){
		return ContactoPeer::retrieveByPk( $this->getCaIdconcliente() );		
	}
	
	/*
	* Retorna el objeto cliente asociado al contacto del reporte 
	* @author Andres Botero
	*/
	public function getCliente(){
		$c = new Criteria();
		$c->addJoin( ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE );
		$c->add( ContactoPeer::CA_IDCONTACTO, $this->getCaIdconcliente() );
		$c->setDistinct();
		return ClientePeer::doSelectOne($c);		
	}
	
	/*
	* Retorna el objeto Tercero de tipo consignatario asociado al reporte 
	* @author Andres Botero
	*/
	public function getConsignatario(){
		if( $this->getCaIdconsignatario() ){
			$c = new Criteria();
			$c->add( TerceroPeer::CA_IDTERCERO, $this->getCaIdconsignatario() );		
			$consignee = TerceroPeer::doSelectOne( $c );	
			return $consignee;
		}else{
			return null;
		}
	}
	
	
	/*
	* Retorna el objeto Tercero de tipo notify asociado al reporte 
	* @author Andres Botero
	*/
	public function getNotify(){
		$c = new Criteria();
		$c->add( TerceroPeer::CA_IDTERCERO, $this->getCaIdnotify() );		
		$consignee = TerceroPeer::doSelectOne( $c );	
		return $consignee;
	}
	
	
	/*
	* Retorna el objeto Tercero de tipo proveedor asociado al reporte 
	* @author Andres Botero
	*/
	public function getProveedor(){
		$c = new Criteria();
		$c->add( TerceroPeer::CA_IDTERCERO, $this->getCaIdProveedor() );
		$consignee = TerceroPeer::doSelectOne( $c );
		return $consignee;
	}
	
	
	
	/*
	* Retorna el objeto InoClientesSea asociado al reporte 
	* @author Andres Botero
	*/
	public function getInoClientesSea(){
		$c = new Criteria();
		$c->addJoin( InoClientesSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE );
		$c->add( ReportePeer::CA_CONSECUTIVO, $this->getCaConsecutivo() );
		return InoClientesSeaPeer::doSelectOne( $c );
	}
	
	/*
	* Retorna el objeto InoClientesAir asociado al reporte 
	* @author Andres Botero
	*/
	public function getInoClientesAir(){
		
		$c = new Criteria();
		$c->add( InoClientesAirPeer::CA_IDREPORTE, $this->getCaConsecutivo()  );		
		return InoClientesAirPeer::doSelectOne( $c );
	}
	
	/*
	* Retorna los objetos RepGasto asociados al reporte 
	* @author Andres Botero
	*/
	public function getRecargos( $tipo=null ){
	
		$c = new Criteria();
		$c->addJoin(  TipoRecargoPeer::CA_IDRECARGO, RepGastoPeer::CA_IDRECARGO );
		if( $this->getCaImpoExpo()=="Importación"){
			if( $tipo == "local" ){
				$c->add( TipoRecargoPeer::CA_TIPO, "Recargo Local" );		
			}
			
			if( $tipo == "origen" ){
				$c->add( TipoRecargoPeer::CA_TIPO, "Recargo en Origen" );		
			}
		}		
		$c->addAscendingOrderByColumn( RepGastoPeer::OID );		
		$c->add( RepGastoPeer::CA_IDREPORTE, $this->getCAIdreporte() );
		$gastos = RepGastoPeer::doSelect( $c );
		
		return $gastos;
	}
	
	/*
	* Retorna los objetos RepCosto asociados al reporte 
	* @author Andres Botero
	*/
	public function getCostos(  ){
	
		$c = new Criteria();
		$c->addJoin(  RepCostoPeer::CA_IDCOSTO,  CostoPeer::CA_IDCOSTO  );
		$c->addAscendingOrderByColumn( RepCostoPeer::OID );
		
		
		$c->add( CostoPeer::CA_IMPOEXPO , "Aduanas" );
				
		if( $this->getCaImpoExpo()=="Exportación" ){
			$c->addOr( CostoPeer::CA_IMPOEXPO , "Exportacion" );
		}
				
		return $this->getRepCostos( $c );	
	}
	
	/*
	* Retorna el objetos RepAduana asociados al reporte 
	* @author Andres Botero
	*/
	public function getRepAduana( ){
	
		$c = new Criteria();
		$c->add(  RepAduanaPeer::CA_IDREPORTE, $this->getCaIdreporte() );
		$repaduana =  RepAduanaPeer::doSelectOne( $c );
		
		if( !$repaduana ){
			$repaduana = new RepAduana();
		}		
		return $repaduana;
	}
	
	
	/*
	* Retorna el objetos RepSeguro asociados al reporte 
	* @author Andres Botero
	*/
	public function getRepSeguro( ){	
		$c = new Criteria();
		$c->add(  RepSeguroPeer::CA_IDREPORTE, $this->getCaIdreporte() );
		$repseguro =  RepSeguroPeer::doSelectOne( $c );
		
		if( !$repseguro ){
			$repseguro = new RepSeguro();
		}		
		return $repseguro;
	}
	
	/*
	* Retorna el objetos RepExpo asociados al reporte 
	* @author Andres Botero
	*/
	public function getRepExpo(){	
		$c = new Criteria();
		$c->add(  RepExpoPeer::CA_IDREPORTE, $this->getCaIdreporte() );
		$repexpo =  RepExpoPeer::doSelectOne( $c );
		
		if( !$repexpo ){
			$repexpo = new RepExpo();
		}		
		return $repexpo;
	}
	
	
	/*
	* Retorna valor a quien se le debe consignar la mercancia  
	* @author Andres Botero
	*/
	public function getConsignar(){	
		if(  $this->getCaImpoexpo() =="Exportación" ){
			$c=new Criteria();
			$c->add( ParametroPeer::CA_CASOUSO, "CU048" );
			$c->add( ParametroPeer::CA_IDENTIFICACION, $this->getCaIdconsignar() );		
			$consignar = ParametroPeer::doSelectOne( $c );
			
			if( $consignar ){
				return $consignar->getCaValor();
			}else{
				return $consignar;
			}
		}
	}
	
/*
	* Retorna valor a quien se le debe consignar la mercancia  
	* @author Andres Botero
	*/
	public function getConsignarmaster(){	
		if(  $this->getCaImpoexpo() =="Exportación" ){
			$c=new Criteria();
			$c->add( ParametroPeer::CA_CASOUSO, "CU048" );
			$c->add( ParametroPeer::CA_IDENTIFICACION, $this->getCaIdconsignarmaster() );		
			$consignar = ParametroPeer::doSelectOne( $c );
			
			if( $consignar ){
				return $consignar->getCaValor();
			}else{
				return $consignar;
			}
		}
	}
	
	/*
	* Retorna valor incoterm de la carga 
	* @author Andres Botero
	*/
	public function getIncoterm(){
		$c=new Criteria();
		$c->add( ParametroPeer::CA_CASOUSO, "CU021" );
		$c->add( ParametroPeer::CA_IDENTIFICACION, $this->ca_incoterm );		
		$incoterms = ParametroPeer::doSelectOne( $c );
		
		if( $incoterms ){
			return $incoterms->getCaValor();
		}else{
			return null;
		}
	}
	
	/*
	* Retorna valor a se debe transladar la mercancia  
	* @author Andres Botero
	*/
	public function getNombreBodega(){	
		$bodega = BodegaPeer::retrieveByPk( $this->getCaIdBodega() );
		if( $bodega ){
			return $bodega->getCaNombre();
		}
	}
	
	/*
	* Devuelve la ubicacion del directorio donde se encuentran los archivos de la referencia 
	* @author Andres Botero	
	*/
	public function getDirectorio(){
		return sfConfig::get("app_digitalFile_root")."reportes".DIRECTORY_SEPARATOR.$this->getCaConsecutivo();
	}
	
	/*
	* Devuelve el numero de piezas del reporte, en caso de que se haya enlazado con una referencia devuelve 
	* los valores de la referencia y omite los del reporte
	* @author Andres Botero	
	*/
	public function getPiezas(){
		if( $this->getCaImpoexpo()=="Importación" && $this->getCaTransporte()=="Marítimo" ){
			$inoclientesSea = $this->getInoClientesSea();
						
			if( $inoclientesSea ){
				$refSea = $inoclientesSea->getInoMaestraSea();					
				if( $refSea->getCaFchconfirmado(  ) ){					
					return str_replace("|"," ",$inoclientesSea->getCaNumpiezas());
				}				
			}
			
		}
		$status = $this->getUltimoStatus();
		if( $status ){		
			return str_replace("|"," ",$status->getCaPiezas());
		}			
		return null;		
	}
	
	
	/*
	* Devuelve el peso del reporte, en caso de que se haya enlazado con una referencia devuelve 
	* los valores de la referencia y omite los del reporte
	* @author Andres Botero	
	*/
	public function getPeso(){
		if( $this->getCaImpoexpo()=="Importación" && $this->getCaTransporte()=="Marítimo" ){
			$inoclientesSea = $this->getInoClientesSea();
					
			if( $inoclientesSea ){
				$refSea = $inoclientesSea->getInoMaestraSea();					
				if( $refSea->getCaFchconfirmado(  ) ){					
					return $inoclientesSea->getCaPeso()." Kilos";
				}				
			}
			
		}
		$status = $this->getUltimoStatus();
		if( $status ){		
			return str_replace("|"," ",$status->getCaPeso());
		}			
		return null;		
	}
	
	/*
	* Devuelve el peso del reporte, en caso de que se haya enlazado con una referencia devuelve 
	* los valores de la referencia y omite los del reporte
	* @author Andres Botero	
	*/
	public function getVolumen(){
		if( $this->getCaImpoexpo()=="Importación" && $this->getCaTransporte()=="Marítimo" ){
			$inoclientesSea = $this->getInoClientesSea();						
			if( $inoclientesSea ){
				$refSea = $inoclientesSea->getInoMaestraSea();					
				if( $refSea->getCaFchconfirmado(  ) ){					
					return $inoclientesSea->getCaVolumen()." M&sup3;";
				}				
			}			
		}
		$status = $this->getUltimoStatus();
		if( $status ){		
			return str_replace("|"," ",$status->getCaVolumen());
		}			
		return null;		
	}
	
	/*
	* Devuelve el Documento de transporte del reporte, en caso de que se haya enlazado con una referencia devuelve 
	* los valores de la referencia y omite los del reporte
	* @author Andres Botero	
	*/
	public function getDoctransporte(){
		if( $this->getCaImpoexpo()=="Importación" && $this->getCaTransporte()=="Marítimo" ){
			$inoclientesSea = $this->getInoClientesSea();
			if( $inoclientesSea ){
				$refSea = $inoclientesSea->getInoMaestraSea();					
				if( $refSea->getCaFchconfirmado(  ) ){					
					return str_replace("|"," ",$inoclientesSea->getCaHbls());
				}
				
			}
		}
		$status = $this->getUltimoStatus();
		if( $status ){		
			return $status->getCaDoctransporte();
		}			
		return null;		
	}
	
	/*
	* Devuelve el numero de la referencia asociada al reporte
	* @author Andres Botero	
	*/
	public function getNumReferencia(){
		if( $this->getCaImpoexpo()=="Importación" && $this->getCaTransporte()=="Marítimo" ){
			$inoclientesSea = $this->getInoClientesSea();
			if( $inoclientesSea ){
				return $inoclientesSea->getCaReferencia();
			}
		}
	}
	
	
	/*
	* Devuelve la fecha estimada de salida del reporte
	* @author Andres Botero	
	*/
		
	public function getETS( $format="Y-m-d" ){
		if( $this->getCaImpoexpo()=="Importación" && $this->getCaTransporte()=="Marítimo" ){			
			$inoclientesSea = $this->getInoClientesSea();			
			if( $inoclientesSea ){
				$refSea = $inoclientesSea->getInoMaestraSea();					
				if( $refSea->getCaFchconfirmado(  ) ){
					return $refSea->getCaFchEmbarque( $format );
				}
			}
		}
		$status = $this->getUltimoStatus();
		if( $status ){		
			return $status->getCaFchsalida( $format );
		}			
		return null;	
	}
	
	
	/*
	* Devuelve la fecha estimada de llegada del reporte
	* @author Andres Botero	
	*/
	public function getETA( $format="Y-m-d" ){
		
		if( $this->getCaImpoexpo()=="Importación" && $this->getCaTransporte()=="Marítimo" ){			
			$inoclientesSea = $this->getInoClientesSea();			
			if( $inoclientesSea ){
				$refSea = $inoclientesSea->getInoMaestraSea();					
				if( $refSea->getCaFchconfirmado(  ) ){
					return $refSea->getCaFchconfirmacion( $format );
				}
			}
		}
		$status = $this->getUltimoStatus();
		
		if( $status ){		
			return $status->getCaFchllegada( $format );
		}			
		return null;	
	}
	

	/*
	* Retorna la fecha de continuacion del ultimo status enviado
	* Author: Andres Botero
	*/
	public function getFchLlegadaCont( $format="Y-m-d" ){
		$status = $this->getUltimoStatus();
		if( $status ){		
			return $status->getCaFchcontinuacion( $format );
		}			
		return null;	
	}

	
	/*
	* Retorna la fecha de continuacion del ultimo status enviado
	* Author: Andres Botero
	*/
	public function getIdNave( ){
		if( $this->getCaImpoexpo()=="Importación" && $this->getCaTransporte()=="Marítimo" ){			
			$inoclientesSea = $this->getInoClientesSea();			
			if( $inoclientesSea ){
				$refSea = $inoclientesSea->getInoMaestraSea();					
				if( $refSea->getCaFchconfirmado(  ) ){
					if( $refSea->getCaMnLlegada(  ) ){
						return $refSea->getCaMnLlegada(  );
					}else{
						return $refSea->getCaMotonave(  );
					}
				}
			}
		}
		$status = $this->getUltimoStatus();
		
		if( $status ){		
			return $status->getCaIdNave(  );
		}			
		return null;	
	}
	
	
	/*
	* Devuelve la fecha de embarque del reporte que se encuentra en la referencia
	* @author Andres Botero	
	*/
	public function getFchEmbarque( $format="Y-m-d" ){
		if( $this->getCaImpoexpo()=="Importación" && $this->getCaTransporte()=="Marítimo" ){			
			$inoclientesSea = $this->getInoClientesSea();			
			if( $inoclientesSea ){
				$refSea = $inoclientesSea->getInoMaestraSea();	
				return $refSea->getCaFchEmbarque( $format );
			}
		}
	}
	
	
	/*
	* Devuelve la fecha de arribo del reporte que se encuentra en la referencia
	* @author Andres Botero	
	*/
	public function getFcharribo( $format="Y-m-d" ){
		if( $this->getCaImpoexpo()=="Importación" && $this->getCaTransporte()=="Marítimo" ){			
			$inoclientesSea = $this->getInoClientesSea();			
			if( $inoclientesSea ){
				$refSea = $inoclientesSea->getInoMaestraSea();	
				return $refSea->getCaFcharribo( $format );
			}
		}
	}
	
	/*
	* Retorna el ultimo cambio realizado en status, avisos, referencia, otm, etc.
	* @author Andres Botero	
	*/
	public function getUltimaActualizacion( $format="Y-m-d" ){
		if( $this->getCaImpoexpo()=="Importación" && $this->getCaTransporte()=="Marítimo" ){
			$inoclientesSea = $this->getInoClientesSea();
			if( $inoclientesSea ){
				$statusOTM = $inoclientesSea->getUltimoStatusOTM();
				if( $statusOTM ){
					return $statusOTM->getCaFchaviso($format);
				}else{
					$refSea = $inoclientesSea->getInoMaestraSea();	
					if( $refSea->getCaFchconfirmado( $format ) ){
						return $refSea->getCaFchconfirmado( $format );
					}					
				}
			}
		}
		$aviso = $this->getUltimoAviso();		
		$status = $this->getUltimoStatus();
				
		if( $aviso && $status ){
			if( Utils::compararFechas( $aviso->getCaFchEnvio("Y-m-d"), $status->getCaFchStatus("Y-m-d") )>=0 ){
				return $aviso->getCaFchEnvio( $format );
			}else{
				return $status->getCaFchStatus( $format );
			}											
		}else{
			if( $aviso ){
				return $aviso->getCaFchEnvio( $format );
			}
			
			if( $status ){
				return $status->getCaFchStatus( $format );
			}
		}					
	}
	
	/*
	* Retorna el ultimo texto en status, avisos, referencia, otm, etc.
	* @author Andres Botero	
	*/
	public function getTextoStatus( ){
		//Se puede mejorar sacando solamente el ultimo status
		// la diversidad de las tablas haccen dificil un procedimiento estandar
		$historial = $this->getHistorialStatus();
		
		if( count($historial)>0 ){
			ksort($historial);
			$ultimo = array_pop($historial);
			return $ultimo['status'];
		}
		return "";		
						
	}
	
	/*
	* Retorna los archivos del directorio especificado
	* @author: Andres Botero
	*/
	public function getFiles(){
		$directory = $this->getDirectorio();							
		if( !is_dir($directory) ){			
			mkdir($directory, 0777);			
		}		
		return sfFinder::type('file')->maxDepth(0)->in($directory);
	}
	
	/*
	* Agrega un correo a la lista de confirmaciones
	* @author: Andres Botero
	*/
	public function addConfirmarClie($address){
		$str = $this->getCaConfirmarClie();
		if( $str ){
			$str.=",";
		}
		$str.= $address;
		$this->setCaConfirmarClie( $str );
	}
	
	/*
	* Retorna el color de acuerdo al estado que se encuentra en este momento la carga
	* @author: Andres Botero
	*/
	public function getColorStatus(){
		$etapa = $this->getCaEtapaActual(); 
		
		$status = $this->getUltimoStatus();
		if( $status && $status->getCaFchstatus("Y-m-d")==date("Y-m-d") && $etapa!="Carga Embarcada" && $etapa!="ETA" && $etapa!="Orden Anulada" && $etapa!="Carga en Aeropuerto de Destino"){			
			$etapa = "nuevo";			
		}
		switch( $etapa ){				
			case "Pendiente de Instrucciones":
				$class = "yellow";
				break;
			case "Carga Embarcada":
				$class = "blue";
				break;
			case "ETA":
				$class = "blue";
				break;
			
			case "Carga en Tránsito a Destino":
				$class = "blue";
				break;	
			case "Orden Anulada":
				$class = "pink";
				break;
			case "nuevo":
				$class = "green";
				break;	
			case "Carga Entregada":
				$class = "orange";
				break;		
			case "Carga en Aeropuerto de Destino":
				$class = "orange";
				break;	
			default:				
				$class = "";
				break;
		 
		}
		return $class;		
	}
	
	/*
	* Retorna un array con los status y las fechas (timestamp) correspondientes
	* @author: Andres Botero
	* */
	public function getHistorialStatus(){
		
		$resultados = array();
		if( $this->getCaImpoexpo()=="Importación" && $this->getCaTransporte()=="Marítimo"  ){
			
			$inoclientesSea = $this->getInoClientesSea();
			
			if( $inoclientesSea ){
										
				$refSea = $inoclientesSea->getInoMaestraSea();											
				if( $refSea->getCaFchconfirmado( ) ){	
					$resultados[strtotime($refSea->getCaFchconfirmado( ))]["tipo"] = "status maritimo";
					$resultados[strtotime($refSea->getCaFchconfirmado( ))]["status"] = $inoclientesSea->getStatus(); 						
					$resultados[strtotime($refSea->getCaFchconfirmado( ))]["etapa"] = "Confirmacion de llegada";
					$c = new Criteria();
					$c->add( EmailPeer::CA_IDCASO , $inoclientesSea->getOid() );
					$email = EmailPeer::doSelectOne( $c );
					
					if( $email ){
						$resultados[strtotime($refSea->getCaFchconfirmado( ))]["emailid"] = $email->getCaIdEmail();				
					}
					
				}						
								
				/*
				* Status de OTM
				*/
				$statuss = $inoclientesSea->getStatuss();
				foreach( $statuss as $status){			
					if( $status->getCaAviso () ){
						$resultados[strtotime($status->getCaFchEnvio ())]["emailid"] = $status->getCaIdEmail();
						$resultados[strtotime($status->getCaFchEnvio ())]["tipo"] = "status OTM";
						$resultados[strtotime($status->getCaFchEnvio ())]["status"] = $status->getCaAviso (); 
						$resultados[strtotime($status->getCaFchEnvio ())]["etapa"] = "";
					}								 
				}
			}
		}
		
		
		$i=0; 					
		$statuss = $this->getRepStatuss();		
				
		foreach( $statuss as $status){			
			$resultados[strtotime($status->getCaFchEnvio ())]["emailid"] = $status->getCaIdEmail();
			$resultados[strtotime($status->getCaFchEnvio ())]["tipo"] = "status";
			$resultados[strtotime($status->getCaFchEnvio ())]["status"] = $status->getStatus (); 
			$resultados[strtotime($status->getCaFchEnvio ())]["etapa"] = $status->getCaEtapa ();
						 
		}		
	
		krsort ($resultados);
		return $resultados;		
		
	}		
	
	/*
	* Retorna true si se ha hecho el reporte al exterior
	* Author: Andres Botero
	*/
	public function getReporteExterior(){
		$c = new Criteria();
		$c->addJoin( EmailPeer::CA_IDCASO, ReportePeer::CA_IDREPORTE );
		$c->add( EmailPeer::CA_TIPO, "Rep.MarítimoExterior");
		$c->add( ReportePeer::CA_CONSECUTIVO, $this->getCaConsecutivo() ); 
		$count = EmailPeer::doCount( $c );				
		return $count>0;		
	}	
	
	/*
	* Retorna true si  el reporte es AG
	* Author: Andres Botero
	*/
	public function getEsAG(){
		if( $this->getCaIncoterms() ){
			return false;
		}else{
			return true;		
		}
	}
	
	
	/*
	* Agrega una nueva propiedad en la columna ca_propiedades, según CU059 
	* @author: Andres Botero
	*/	
	public function setProperty( $param, $value ){
		$array = sfToolkit::stringToArray( $this->getCaPropiedades() );	
		$array[$param]=$value;
		$str = "";
				
		foreach( $array as $key=>$value ){
			if(strlen($str)>0){
				$str.=" ";
			}
			$str.=$key."=".$value;
		}
		$this->setCaPropiedades( $str );
	}
	
	/*
	* Retorna una propiedad
	* @author: Andres Botero
	*/	
	public function getProperty( $param ){
		$array = sfToolkit::stringToArray( $this->getCaPropiedades() );			
		return isset($array[$param])?$array[$param]:null;
	}
	
}

?>