<?php

/**
 * widgets actions.
 *
 * @package    colsys
 * @subpackage widgets
 * @author     Andres Botero
 * @version    SVN: $Id: components.class.php 9301 2008-05-27 01:08:46Z abotero $
 */
class widgetsComponents extends sfComponents
{
	/**
	* Muestra un select con todos los paises
	*/
	public function executePaises()
	{	
		$c=new Criteria();
		$c->add( TraficoPeer::CA_IDTRAFICO, '99-999', Criteria::NOT_EQUAL );			
		$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
		$traficos_rs = TraficoPeer::doSelect( $c );
		
		$this->traficos = array();
		
		foreach($traficos_rs as $trafico){
			$row = array("idtrafico"=>$trafico->getCaIdTrafico(),"trafico"=>utf8_encode($trafico->getCaNombre()));
			$this->traficos[]=$row;
		}
		if(!isset( $this->label )){
			$this->label="";
		}
		if(!isset( $this->id )){
			$this->id="";
		}	
		if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}	
	}
	
	/**
	* Muestra un select con todas las ciudades y las encadena con los paises
	*/
	public function executeCiudades(){
		if(!isset( $this->label )){
			$this->label="";
		}
		if(!isset( $this->id )){
			$this->id="";
		}
				
		if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}	
	}
	
	/**
	* Muestra un select con todas las ciudades y las encadena con los paises
	*/
	public function executeContinuaciones(){
		
	}
	
	/**
	* Muestra un select con todas las ciudades y las encadena con los paises
	*/
	public function executeImpoexpo(){
		
	}
	
	/**
	* Muestra un select con las empresas Coltrans, Colmas  
	*/
	public function executeEmpresa(){
		
	}
	
	
	/**
	* Muestra un select vacio cuyos datos son alimentados manualmente
	*/
	public function executeEmptyCombo(){
		if(!isset( $this->label )){
			$this->label="";
		}
		if(!isset( $this->id )){
			$this->id="";
		}	
		if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}
	}	
	
	/**
	* Muestra un select con los valores de las aplicaciones 
	*/
	public function executeAplicaciones(){
		if(!isset( $this->label )){
			$this->label="";
		}
		if(!isset( $this->id )){
			$this->id="";
		}	
		if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}
		$this->aplicaciones = ParametroPeer::retrieveByCaso("CU064", null, $this->transporte );
	}
	
	/**
	* Muestra un select con las lineas de transporte 
	*/
	public function executeLineas(){
		if(!isset( $this->label )){
			$this->label="";
		}
		if(!isset( $this->id )){
			$this->id="";
		}	
		if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}
	}
	
	/**
	* Muestra un select con las modalidades
	*/
	public function executeModalidades(){
		if(!isset( $this->label )){
			$this->label="";
		}
		if(!isset( $this->id )){
			$this->id="";
		}	
		if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}
	}
	
	
	/**
	* Muestra un select con las modalidades
	*/
	public function executeComerciales(){
		if(!isset( $this->label )){
			$this->label="";
		}
		if(!isset( $this->id )){
			$this->id="";
		}	
		if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}
		
		if(!isset( $this->nivel )){
			$this->nivel=0;
		}	
		
		$comerciales = UsuarioPeer::getComerciales();
		$this->comercialesJson = array();
		foreach( $comerciales as $comercial ){
			$this->comercialesJson[]= array("login"=>$comercial->getCaLogin(),
											"nombre"=>utf8_encode($comercial->getCaNombre())
										);
		}
		
		$this->user = $this->getUser();		
		
		$this->nombre="";
		if( isset($this->value) ){
			$vendedor = UsuarioPeer::retrieveByPk($this->value);
			if( $vendedor ){
				$this->nombre=$vendedor->getCaNombre();
			}			
		}else{
			$this->value="";			
		}
		
		
	}
	
	/*
	* Muestra un campo que permite autocompletar el nombre del cliente usando JSON y el id lo guarda 
	 en el atributo id.
	*/
	public function executeComboClientes()
	{		
		if($this->idcliente){
			$this->cliente = ClientePeer::retrieveByPk( $this->cliente );
		}		
	}
	
	
	/*
	* Muestra un campo que permite autocompletar el numero de reporte.
	*/
	public function executeComboReportes()
	{
		
	}
}
?>