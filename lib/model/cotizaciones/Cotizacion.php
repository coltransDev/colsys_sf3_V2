<?php

/**
 * Subclass for representing a row from the 'tb_cotizaciones' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class Cotizacion extends BaseCotizacion
{	
	const EN_SEGUIMIENTO = "SEG";  
	const TIEMPO_IDG_ENTREGA_OPORTUNA = 43200; //12 h  
	
	public function getId(){
		return $this->getCaIdcotizacion();
	}	
	
	/*
	* Retorna el objeto cliente asociado al contacto de la cotizacion 
	* @author Carlos G. López M.
	*/
	public function getCliente(){
		$c = new Criteria();
		$c->addJoin( ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE );
		$c->add( ContactoPeer::CA_IDCONTACTO, $this->getCaIdcontacto() );
		$c->setDistinct();
		return ClientePeer::doSelectOne($c);		
	}
	
	
	/*
	* Retorna los recargos locales de la cotización
	* @author Andres Botero
	*/
	public function getRecargosLocales( $transporte=null, $modalidad=null ){	
		$tipo = Constantes::RECARGO_LOCAL;
		$c = new Criteria();		
		$c->addJoin( CotRecargoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO, Criteria::LEFT_JOIN );		
		$c->add( CotRecargoPeer::CA_IDCOTIZACION , $this->getCaIdcotizacion() );
		$c->add( TipoRecargoPeer::CA_TIPO , $tipo );
		if( $transporte ){
			$c->add( TipoRecargoPeer::CA_TRANSPORTE , $transporte );
		}
		if( $modalidad ){
			$c->add( CotRecargoPeer::CA_MODALIDAD , $modalidad );
		}
		$c->setDistinct();		
		//$c->addAscendingOrderByColumn( TipoRecargoPeer::CA_TRANSPORTE );
		$c->addAscendingOrderByColumn( CotRecargoPeer::CA_MODALIDAD );
		
		return CotRecargoPeer::doSelect($c);		
	}
	
	/*
	* Retorna los recargos locales de la cotización
	* @author Andres Botero
	*/
	public function getRecargosOTMDTA( $modalidad=null ){	
		$tipo = Constantes::RECARGO_OTM_DTA;
		$c = new Criteria();		
		$c->addJoin( CotRecargoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO, Criteria::LEFT_JOIN );		
		$c->add( CotRecargoPeer::CA_IDCOTIZACION , $this->getCaIdcotizacion() );
		$c->add( TipoRecargoPeer::CA_TIPO , $tipo );
		
		$c->add( TipoRecargoPeer::CA_TRANSPORTE , Constantes::TERRESTRE );
		
		if( $modalidad ){
			$c->add( CotRecargoPeer::CA_MODALIDAD , $modalidad );
		}
		$c->setDistinct();		
		//$c->addAscendingOrderByColumn( TipoRecargoPeer::CA_TRANSPORTE );
		$c->addAscendingOrderByColumn( CotRecargoPeer::CA_MODALIDAD );
		
		return CotRecargoPeer::doSelect($c);		
	}
	
		
	/*
	* Retorna verdadero si la cotización tiene no conceptos.
	* @author Andres Botero
	*/
	public function enBlanco(){
		$count = 0;
		$productos = $this->getCotProductos();		
		$count+=count($productos); 
		$continuacion = $this->getCotContinuacions();
		$count+=count($continuacion);
		$seguros = $this->getCotSeguros();
		$count+=count($seguros);
		return $count==0;		
	}
	
	
	
	public function getTareaIDGEnvioOportuno(){
				
		$tarea=null;
		if( $this->getCaIdgEnvioOportuno() ){
			$tarea = NotTareaPeer::retrieveByPk( $this->getCaIdgEnvioOportuno() );
		}
		return $tarea;
	}
	
	/*
	*  Crea una nueva tarea IDG Envio Oportuno para la cotizacion
	*/	
	public function crearTareaIDGEnvioOportuno( $fchCreado ){
		
		$tarea = $this->getTareaIDGEnvioOportuno();	
		if( !$tarea ){
		
			$titulo = "Cotización ".$this->getCaConsecutivo()." ".$this->getCliente()->getCaCompania();
			$texto = "Debe enviar esta cotizacion por email o colocar la fecha de presentación para cumplir esta tarea.";
		
			$tarea = new NotTarea();	
			$tarea->setCaIdListaTarea( 2 );		
			$tarea->setCaUrl( "/cotizaciones/consultaCotizacion?id=".$this->getCaIdCotizacion() );					
			
			$tarea->setCaUsucreado( $this->getCaUsucreado() );
			$tarea->setCaTitulo( $titulo );		
			$tarea->setCaTexto( $texto );
			$tarea->setCaFchcreado(  $fchCreado );	
			$tarea->setCaFchvisible( time()+3600 );		
			$tarea->setCaFchvencimiento( strtotime( $fchCreado )+Cotizacion::TIEMPO_IDG_ENTREGA_OPORTUNA );
			$tarea->save();
				
			$this->setCaIdgEnvioOportuno( $tarea->getCaIdtarea() );
			$this->save();			
		}
		
		
		$tarea->setCaFchcreado(  $fchCreado );			
		$tarea->setCaFchvencimiento( strtotime( $fchCreado )+Cotizacion::TIEMPO_IDG_ENTREGA_OPORTUNA );
		$tarea->save();
		
		if( $tarea ){					
			$loginsAsignaciones = array( $this->getCaUsucreado(), $this->getCaUsuario() );	
			if( $this->getCaUsuactualizado() ){
				$loginsAsignaciones[]=$this->getCaUsuactualizado();
			}						
			$tarea->setAsignaciones( $loginsAsignaciones );				
		}
		
		return $tarea;	
						
			
		
	}
	/*
	*
	*/
	
	public function setFchPresentacion( $fchEnvio ){		
		$tarea = $this->getTareaIDGEnvioOportuno();		
		$tarea->setCaFchterminada( $fchEnvio );
		$tarea->save();
	}
	
	
	public function getFchpresentacion( $format=null ){		
		$tarea = $this->getTareaIDGEnvioOportuno();	
		if( $tarea ){	
			return $tarea->getCaFchterminada( $format );
		}else{
			return null;
		}
		
	}
	
	
	
	
	
}
?>