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
	
	private $ultimoStatus=null;	
	private $inoClientesSea=null;
	
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
	
	/*
	* Retorna un array conteniendo los proovedores del reporte
	* Author: Andres Botero
	*/
	public function getProveedores(){
		
		if( $this->getcaImpoexpo()==Constantes::IMPO || $this->getcaImpoexpo()==Constantes::TRIANGULACION ){
			$provId = $this->getCaIdproveedor();	
			if($provId){		
				$provId = explode("|", $provId);
				$c = new Criteria();
				$c->add( TerceroPeer::CA_IDTERCERO, $provId, Criteria::IN );		
				$proveedores = TerceroPeer::doSelect( $c );			
				return $proveedores;
			}	
		}
		return null;		
	}	
	
	
	/*
	* Retorna un String conteniendo los proovedores del reporte
	* Author: Andres Botero
	*/
	public function getProveedoresStr(){
		$proveedoresStr="";
		$proveedores = $this->getProveedores();	
		if( $proveedores ){	
			foreach( $proveedores as $proveedor ){
				if( $proveedoresStr ){
					$proveedoresStr.=" - ";					
				}
				$proveedoresStr.= $proveedor->getCaNombre();					
			}	
		}	
		return $proveedoresStr;
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
	
	/****************************************************************
	* 
	****************************************************************/
	
	
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
	* Retorna el color de acuerdo al estado que se encuentra en este momento la carga
	* @author: Andres Botero
	*/
	public function getColorStatus(){
		$etapa = $this->getTrackingEtapa();		
		if( $etapa && $etapa->getCaClass()){
			return $etapa->getCaClass();
		}
		
		if( $this->getCaFchUltstatus("Y-m-d")==date("Y-m-d") ){
			return "green";
		}
		
		return "";		
	}
	
		
	
	/*
	* Retorna la fecha del ultimo status, avisos, referencia, otm, etc.
	* @author Andres Botero	
	*/
	public function getFchUltimoStatus( $format="Y-m-d" ){
		return $this->getCaFchultstatus( $format );
		
	}
	
	/*
	* Retorna el objeto InoClientesSea asociado al reporte 
	* @author Andres Botero
	*/
	public function getInoClientesSea(){
		if( !$this->inoClientesSea ){
			$c = new Criteria();
			$c->addJoin( InoClientesSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE );
			$c->add( ReportePeer::CA_CONSECUTIVO, $this->getCaConsecutivo() );
			$this->inoClientesSea = InoClientesSeaPeer::doSelectOne( $c );
		}
		return $this->inoClientesSea;
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
	* Retorna el ultimo texto en status, avisos, referencia, otm, etc.
	* @author Andres Botero	
	*/
	public function getTextoStatus( ){
		$status = $this->getUltimostatus();
		
		if( $status ){
			return $status->getStatus();
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
	* Retorna los status asociasdos al reporte , sobrecarga getRepStatuss en BaseReporte
	* Author: Andres Botero
	*/
	public function getRepEquipos( $criteria = null, PropelPDO $con = null){
		
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
	public function getRepStatuss( $criteria = null, PropelPDO $con = null ){
		
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
	public function getRepAduana( PropelPDO $con = null ){
	
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
	public function getRepSeguro( PropelPDO $con = null ){	
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
	public function getRepExpo(  PropelPDO $con = null ){	
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
		$status = $this->getUltimoStatus();
		
		if( $status ){		
			return $status->getCaIdNave(  );
		}			
		return null;	
	}
	
	
	
	/*
	* Retorna los archivos del directorio especificado
	* @author: Andres Botero
	*/
	public function getFiles(){
		$directory = $this->getDirectorio();							
		if( !is_dir($directory) ){			
			mkdir($directory, 0777, true );
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
	* Retorna true si se ha hecho el reporte al exterior
	* Author: Andres Botero
	*/
	public function getReporteExterior(){
		$c = new Criteria();
		$c->addJoin( EmailPeer::CA_IDCASO, ReportePeer::CA_IDREPORTE );
		
		if( $this->getCaTransporte()==Constantes::MARITIMO ){
			$c->add( EmailPeer::CA_TIPO, "Rep.MarítimoExterior");
		}else{
			$c->add( EmailPeer::CA_TIPO, "Rep.AéreoExterior");
		}
				
		$c->add( ReportePeer::CA_CONSECUTIVO, $this->getCaConsecutivo() ); 
		$count = EmailPeer::doCount( $c );				
		return $count>0;		
	}	
	
	/*
	* Retorna true si  el reporte es AG
	* Author: Andres Botero
	*/
	public function getEsAG(){
		if( $this->getCaColmas()=='' ){
			return true;
		}else{
			return false;		
		}
	}
	
	/*
	* Retorna la cadena que indica a quien se consigna el HBL
	* Author: Andres Botero
	*/
	public function getConsignedTo(){
		
		if( $this->getCaIdconsignar()==1 ){
			$consignatario_final = ($this->getCaIdconsignatario()!=0)?$this->getConsignatario()->getCaNombre():$this->getCliente()->getCaCompania();
			return $consignatario_final;
		}else{
			$str = $this->getBodegaConsignar()->getCaNombre();
			$bodega = $this->getBodega();
			if( $bodega ){
				if( $bodega->getCaTipo()!= "Coordinador Lógistico"){
					$str.=$bodega->getCaTipo()." ".$bodega->getCaNombre();	
				}
			}
			return $str;
		}		 
	}
	
	/*
	*
	*/
	public function getBodegaConsignar(){
		return BodegaPeer::retrieveByPk( $this->getCaIdconsignar() );
	}
	
	
	/*
	* Retorna los usuarios de operativos traficos
	*/
	
	public function getUsuariosOperativos(){
	
		$usuario = UsuarioPeer::retrieveByPk( $this->getCaUsucreado() );
	
		$c = new Criteria();
		$c->addJoin( UsuarioPeer::CA_LOGIN, UsuarioPerfilPeer::CA_LOGIN );				
		if( $this->getCaImpoExpo()==Constantes::IMPO ){			
			if( $this->getCaTransporte()==Constantes::MARITIMO ){		
				$c->add( UsuarioPerfilPeer::CA_PERFIL, "operativo-traficos" );				
			}else{
				$c->add( UsuarioPerfilPeer::CA_PERFIL, "operativo-aereo" );					
			}
		}else{
			$c->add( UsuarioPerfilPeer::CA_PERFIL, "operativo-expo" );				
		}								
		$c->add( UsuarioPeer::CA_IDSUCURSAL, $usuario->getCaIdsucursal()  );
		$c->add( UsuarioPeer::CA_ACTIVO, true );
		return  UsuarioPeer::doSelect( $c );
	}
	
	
	
	
	
	
}

?>