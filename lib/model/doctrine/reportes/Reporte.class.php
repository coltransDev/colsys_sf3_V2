<?php

/**
 * Reporte
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
class Reporte extends BaseReporte
{
    private $ultimoStatus=null;
	private $inoClientesSea=null;
    private $proveedoresStr=null;
    private $editable=null;
    private $nversiones=null;
    private $ultimaVersion=null;
    private $repExterior=null;
    private $cerrado=null;


    const IDLISTASEG = 3;
    const IDLISTACONS = 6;

    /*
	* Retorna el objeto Contacto asociado al reporte
	* @author Andres Botero
	*/
	public function getContacto(){
		return Doctrine::getTable("Contacto")->find( $this->getCaIdconcliente() );
	}

	/*
	* Retorna el objeto cliente asociado al contacto del reporte
	* @author Andres Botero
	*/
	public function getCliente(){

		return Doctrine::getTable("Cliente")
                        ->createQuery("cl")
                        ->innerJoin("cl.Contacto c")
                        ->where("c.ca_idcontacto = ?", $this->getCaIdconcliente())
                        ->distinct()
                        ->fetchOne();
	}


    /*
	* Retorna verdadero si es la ultima version del reporte de lo contrario retorna falso
	* Author: Andres Botero
	*/
    
	public function esUltimaVersion(){
		$version = $this->getCaVersion();

        $count = Doctrine::getTable("Reporte")
                         ->createQuery("r")
                         ->select("count(*) as count")
                         ->where("r.ca_consecutivo = ? AND r.ca_version> ? AND r.ca_fchanulado IS NULL", array($this->getCaConsecutivo(), $version))
                         ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                         ->execute();
        
		
		if( $count>0 ){
            $this->editable=false;
			return false;
		}else{
            $this->editable=true;
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

		if( Utils::parseDate($this->getCaFchultstatus(),"Y-m-d")==date("Y-m-d") ){
			return "green";
		}

		return "";
	}


	/*
	* Retorna un array conteniendo los proovedores del reporte
	* Author: Andres Botero
	*/
	public function getProveedores(){
        
		if( $this->getCaImpoexpo()==Constantes::IMPO || $this->getCaImpoexpo()==Constantes::TRIANGULACION || $this->getCaImpoexpo()=="OTM/DTA" ){
			$provId = $this->getCaIdproveedor();
			if($provId){
				$provId = explode("|", $provId);				
				$proveedores = Doctrine::getTable("Tercero")
                                         ->createQuery("t")
                                         ->whereIn("t.ca_idtercero", $provId)
                                         ->execute();                
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

        if( $this->proveedoresStr==null ){
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
            $this->proveedoresStr = $proveedoresStr;
        }
		return $this->proveedoresStr;
	}


    /*
	* Retorna el objeto InoClientesSea asociado al reporte
	* @author Andres Botero
	*/
	public function getInoClientesSea(){
		if( !$this->inoClientesSea ){			
			$this->inoClientesSea = Doctrine::getTable("InoClientesSea")
                                              ->createQuery("c")
                                              ->innerJoin("c.Reporte r")
                                              ->where("r.ca_consecutivo = ?", $this->getCaConsecutivo())
                                              ->fetchOne();
		}
		return $this->inoClientesSea;
	}


	/*
	* Retorna el ultimo status segun el orden cronologico
	* Author: Andres Botero
	*/
	public function getUltimoStatus(){
		if( $this->ultimoStatus ){
			return $this->ultimoStatus;
		}else{            
			
			$this->ultimoStatus = Doctrine::getTable("RepStatus")
                                            ->createQuery("s")
                                            ->innerJoin("s.Reporte r")
                                            ->where("r.ca_consecutivo = ?", $this->getCaConsecutivo())
                                            ->addOrderBy("s.ca_fchenvio DESC")
                                            ->limit(1)
                                            ->fetchOne();

			if( $this->ultimoStatus ){
				return $this->ultimoStatus;
			}else{
				return null;
			}
		}
	}


	

	/****************************************************************
	*
	****************************************************************/




	



	/*
	* Retorna la fecha del ultimo status, avisos, referencia, otm, etc.
	* @author Andres Botero
	*/
	public function getFchUltimoStatus( $format="Y-m-d" ){
		return $this->getCaFchultstatus( $format );

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

        if(!$this->nversiones)
        {
            $count = Doctrine::getTable("Reporte")
                               ->createQuery("r")
                               ->select("count(*)")
                               ->where("r.ca_consecutivo = ?", $this->getCaConsecutivo())
                               ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                               ->execute();

            $this->nversiones=$count;
        }

		return $this->nversiones;

	}


    /*
	* Retorna el numero de versiones existentes de este reporte
	* Author: Andres Botero
	*/
	public function getUltVersion(){

        if(!$this->ultimaVersion)
        {
            $count = Doctrine::getTable("Reporte")
                           ->createQuery("r")
                           ->select("r.ca_version")
                           ->where("r.ca_consecutivo = ? AND ca_fchanulado IS NULL", $this->getCaConsecutivo())
                           ->orderBy("r.ca_version DESC")
                           ->limit(1)
                           ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                           ->execute();
            $this->ultimaVersion=$count;
        }
		return $this->ultimaVersion;
	}

    /*
	* Retorna si el reporte puede ser modificado o no
	* Author: Mauricio Quinche
	*/
	public function getEditable($permiso=0,$user=null){

//        $this->user= sfContext::getInstance()->getUser();
//        echo $this->user->getUserId();
//        $user = sfContext::getInstance()->getUser();
//        echo $user->getUserId();
        //if(!$this->editable)
        if($user->getUserId()!="maquinche")
        {
            
            //echo "::".$this->editable."::<br>";
            if($this->esUltimaVersion())
            {
                if($this->getCerrado())
                {
                    $this->editable=false;
                }
                else
                {
                    if($this->existeReporteExteriorVersionActual())
                    {
                        $this->editable=false;
                    }
                    else
                    {
                        if($user->getUserId()!=$this->getCaUsucreado() && $user->getUserId()!=$this->getCaLogin() )
                        {
                            $this->editable = false;
                        }
                        else
                            $this->editable=true;
                    }
                    
                }
            }
        }else $this->editable=true;;
		return $this->editable;
	}

    /*
	* Retorna si esta cerrado un reporte
	* Author: mauricio Quinche
	*/
	public function getCerrado()
    {
        if($this->getCaFchcerrado() || $this->getCaUsucerrado() )
            $this->cerrado=true;
        else
            $this->cerrado=false;

        return $this->cerrado;
    }

	/*
	* Retorna los equipos asociados al reporte
	* Author: Andres Botero
	*/
	public function getRepEquipos(){
        
        
		return Doctrine::getTable("RepEquipo")
                         ->createQuery("e")
                         ->select("e.*")
                         ->innerJoin("e.Reporte r")
                         ->where("r.ca_consecutivo = ? ", $this->getCaConsecutivo())
                         ->execute();
                         
	}


	/*
	* Retorna los status asociasdos al reporte , sobrecarga getRepStatus en BaseReporte
	* Author: Andres Botero
	*/
	public function getRepStatus(){

		return Doctrine::getTable("RepStatus")
                ->createQuery("s")
                ->innerJoin("s.Reporte r")
                ->where("r.ca_consecutivo = ?", $this->getCaConsecutivo())
                ->addOrderBy("s.ca_fchenvio DESC")
                ->execute();
	}


	

	/*
	* Retorna el objeto Tercero de tipo consignatario asociado al reporte
	* @author Andres Botero
	*/
	public function getConsignatario(){
		if( $this->getCaIdconsignatario() ){			
			$consignee = Doctrine::getTable("Tercero")->find($this->getCaIdconsignatario());
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
		$consignee = Doctrine::getTable("Tercero")->find($this->getCaIdnotify());
		return $consignee;
	}

	/*
	* Retorna los objetos RepGasto asociados al reporte
	* @author Andres Botero
	*/
	public function getRecargos( $tipo=null ){
        $q = Doctrine::getTable("RepGasto")
                       ->createQuery("r");
                       
		
		$q->addWhere("r.ca_idreporte = ? ", $this->getCaIdreporte());
		if( $this->getCaImpoexpo()==Constantes::IMPO ){
			if( $tipo == "local" ){
                $q->addWhere("r.ca_recargoorigen = ?", false );
			}
            
			if( $tipo == "origen" ){
                $q->addWhere("r.ca_recargoorigen = ?", true );
			}
		}
		
		$gastos = $q->execute();

		return $gastos;
	}

	/*
	* Retorna los objetos RepCosto asociados al reporte
	* @author Andres Botero
	*/
	public function getCostos(  ){

        $q = Doctrine::getTable("RepCosto")
                  ->createQuery("c")
                  ->innerJoin("c.Costo co");
        $q->addWhere("c.ca_idreporte = ? ", $this->getCaIdreporte());
		if( $this->getCaImpoexpo()==Constantes::EXPO ){			
            $q->addWhere( "co.ca_impoexpo = ? OR co.ca_impoexpo = ? " , array("Aduanas", Constantes::EXPO) );
		}else{
            $q->addWhere( "co.ca_impoexpo = ? " , "Aduanas" );
        }
		return $q->execute();
	}

	/*
	* Retorna el objetos RepAduana asociados al reporte
	* @author Andres Botero
	*/
	public function getRepAduana( PropelPDO $con = null ){

		$repaduana =  Doctrine::getTable("RepAduana")
                                ->createQuery("a")
                                ->where("a.ca_idreporte = ? ", $this->getCaIdreporte())
                                ->fetchOne();

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
		
		$repseguro =  Doctrine::getTable("RepSeguro")
                                ->createQuery("s")
                                ->where("s.ca_idreporte = ?",$this->getCaIdreporte() )
                                ->fetchOne();

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
        $repexpo =  Doctrine::getTable("RepExpo")
                                ->createQuery("e")
                                ->where("e.ca_idreporte = ?",$this->getCaIdreporte() )
                                ->fetchOne();

		if( !$repexpo ){
			$repexpo = new RepExpo();
		}
		return $repexpo;
	}

    /*
	* Devuelve la ubicacion del directorio donde se encuentran los archivos de la referencia
	* @author Andres Botero
	*/
	public function getCotizacion(){
		return Doctrine::getTable("Cotizacion")
                                ->createQuery("c")
                                ->where("c.ca_consecutivo = ?",$this->getCaConsecutivo() )
                                ->fetchOne();
	}


	/*
	* Retorna valor a quien se le debe consignar la mercancia
	* @author Andres Botero
	*/
	public function getConsignar(){
		if(  $this->getCaImpoexpo() == constantes::EXPO ){

            $consignar = ParametroTable::retrieveByCaso( "CU048", null, null, $this->getCaIdconsignar()   );


			if( $consignar ){
				return $consignar[0]->getCaValor();
			}
		}
	}

/*
	* Retorna valor a quien se le debe consignar la mercancia
	* @author Andres Botero
	*/
	public function getConsignarmaster(){
		if(  $this->getCaImpoexpo() == constantes::EXPO ){
			$consignar = ParametroTable::retrieveByCaso( "CU048", null, null, $this->getCaIdconsignarmaster()   );

			if( $consignar ){
				return $consignar[0]->getCaValor();
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
		if( $this->getCaImpoexpo()=="Importaci�n" && $this->getCaTransporte()=="Mar�timo" ){
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
	public function getIdnave( ){
		$status = $this->getUltimoStatus();

		if( $status ){
			return $status->getCaIdnave(  );
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
	* Retorna los reportes al exterior
	* Author: Andres Botero
	*/
	public function getReporteExterior(){
		if( $this->getCaImpoexpo()==Constantes::IMPO || $this->getCaImpoexpo()==Constantes::TRIANGULACION  ){
			//Reportes al exterior
			if( $this->getCaTransporte()==Constantes::MARITIMO ){
				$tipo = 'Rep.Mar�timoExterior';
			}else{
				$tipo = 'Rep.A�reoExterior';
			}
			 
            return Doctrine::getTable("Email")
                       ->createQuery("e")
                       ->select("e.*")
                       ->innerJoin("e.Reporte r")
                       ->where( "r.ca_consecutivo = ?", $this->getCaConsecutivo() )
                       ->addWhere("e.ca_tipo = ? ", $tipo)
                       ->addOrderBy("e.ca_fchenvio DESC")
                       ->execute();
		}
        return null;
	}


    /*
	* Retorna true si existen reportes al exterior de la version actual
	* Author: Andres Botero
	*/
	public function existeReporteExteriorVersionActual(){
        if( $this->getCaImpoexpo()==Constantes::IMPO || $this->getCaImpoexpo()==Constantes::TRIANGULACION  ){
            if(!$this->repExterior)
            {
                //Reportes al exterior
                if( $this->getCaTransporte()==Constantes::MARITIMO ){
                    $tipo = 'Rep.Mar�timoExterior';
                }else{
                    $tipo = 'Rep.A�reoExterior';
                }

                $numReportes = Doctrine::getTable("Email")
                               ->createQuery("e")
                               ->select("COUNT(*)")
                               ->where( "e.ca_idcaso = ?", $this->getCaIdreporte() )
                               ->addWhere("e.ca_tipo = ? ", $tipo)
                               ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                               ->execute();
                $this->repExterior=$numReportes>0;
            }
            return $this->repExterior;
		}
        return null;

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
				if( $bodega->getCaTipo()!= "Coordinador L�gistico"){
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
		return Doctrine::getTable("Bodega")->find( $this->getCaIdconsignar() );
	}


	/*
	* Retorna los usuarios de operativos traficos
	*/

	public function getUsuariosOperativos(){

		$usuario = Doctrine::getTable("Usuario")->find( $this->getCaUsucreado() );		$q = Doctrine::getTable("Usuario")
                          ->createQuery("u")
                          ->select("u.*")
                          ->innerJoin("u.UsuarioPerfil p")
                          ->where("u.ca_activo = ?", true);

        if( $this->getCaImpoexpo()==Constantes::IMPO ){
            $global = $this->getCliente()->getProperty("cuentaglobal");
            if( $global ){
                $q->addWhere("p.ca_perfil = ?", "cuentas-globales");
            }else{
                if( $this->getCaTransporte()==Constantes::MARITIMO ){
                    $q->addWhere("p.ca_perfil = ?", "operativo-traficos");
                }else{
                    $q->addWhere("p.ca_perfil = ?", "operativo-aereo");
                }
            }
            $q->addWhere("u.ca_idsucursal = ?", $usuario->getCaIdsucursal());	
		}else{
            $q->addWhere("p.ca_perfil = ?", "operativo-expo");
		}
        return $q->execute();



	}

    /*
     * Devuelve true si corresponde a solo aduana
     */
    public function esSoloAduana(){
        $modalidadesAduana = Doctrine::getTable("Modalidad")
                                             ->createQuery("m")
                                             ->select("m.ca_idmodalidad")
                                             ->where("m.ca_modalidad = ? OR m.ca_modalidad = ?", array("NACIONALIZACION", "ADUANA"))
                                             ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                             ->execute();

        if( in_array( $this->getCaModalidad(), array("NACIONALIZACION", "ADUANA") ) ){
            return true;
        }else{
            return false;
        }
        /*
         Deberia ser algo asi
        foreach( $modalidadesAduana as $modalidad ){
            if( $this->getCaModalidad()==$modalidad["ca_idmodalidad"] ){                
                return true;
            }

        }
        return false;*/
    }

    /*
	* Devuelve la ubicacion del directorio donde se encuentran los archivos de la referencia
	* @author Andres Botero
	*/
	public function getDirectorio(){
		return sfConfig::get("app_digitalFile_root").$this->getDirectorioBase();
	}

    /*
	* Devuelve la ubicacion del directorio donde se encuentran los archivos de la referencia
	* @author Andres Botero
	*/
	public function getDirectorioBase(){
		return "reportes".DIRECTORY_SEPARATOR.$this->getCaConsecutivo().DIRECTORY_SEPARATOR;
	}
    
    
    /*
	* Copia el reporte y todas las tablas asociadas
	* @author Andres Botero
    * @param $opcion 1 indica que es un nuevo reporte 2 indica una nueva version
	*/
	public function copiar( $opcion ){
        $reporte = $this->copy(  );
        
        try{
            $conn = $this->getTable()->getConnection();
            $conn->beginTransaction();

            if( $opcion==1 ){
                //echo ReporteTable::siguienteConsecutivo(date("Y"));
                //exit();
                $reporte->setCaConsecutivo( ReporteTable::siguienteConsecutivo(date("Y")) );
                $reporte->setCaVersion( 1 );
                $reporte->setCaIdetapa( null );
                $reporte->setCaFchultstatus( null );
                $reporte->setCaFchreporte( date("Y-m-d") );
            }

            if( $opcion==2 ){
                $reporte->setCaVersion( $this->numVersiones()+1 );
            }

            $reporte->setCaDetanulado( null );
            $reporte->setCaFchcreado( null );
            $reporte->setCaUsucreado( null );
            $reporte->setCaFchactualizado( null );
            $reporte->setCaUsuactualizado( null);
            $reporte->setCaFchcerrado( null );
            $reporte->setCaUsucerrado( null);
            $reporte->save( $conn );

            //Copia los conceptos
            $conceptos = $this->getRepTarifa();
            foreach( $conceptos as $concepto ){
                $newConcepto = $concepto->copy();
                $newConcepto->setCaIdconcepto( $concepto->getCaIdconcepto() );
                $newConcepto->setCaIdreporte( $reporte->getCaIdreporte() );
                $newConcepto->save( $conn );
            }

            //Copia los gastos
            $gastos = $this->getRecargos( );
            foreach($gastos as $gasto ){
                $newGasto = $gasto->copy();
                $newGasto->setCaIdconcepto( $gasto->getCaIdconcepto() );
                $newGasto->setCaIdrecargo( $gasto->getCaIdrecargo() );
                $newGasto->setCaIdreporte( $reporte->getCaIdreporte() );
                if($gasto->getCaRecargoorigen()==false)
                    $newGasto->setCaRecargoorigen( "false" );
                if($gasto->getCaRecargoorigen()==true)
                    $newGasto->setCaRecargoorigen( "true" );               
                $newGasto->save( $conn );
            }

            $costos = $this->getCostos( );
            foreach($costos as $costo ){
                $newCosto = $costo->copy();
                $newCosto->setCaIdcosto( $costo->getCaIdcosto() );
                $newCosto->setCaIdreporte( $reporte->getCaIdreporte() );
                $newCosto->save();
            }

            if( $this->getCaImpoexpo()==Constantes::EXPO ){
                $repExpo = $this->getRepExpo();
                $repExpoNew = $repExpo->copy();
                $repExpoNew->setCaIdreporte( $reporte->getCaIdreporte() );
                $repExpoNew->save();
            }

            if( $this->getCaColmas()=="S�" ){
                $repAduana = $this->getRepAduana();
                $repAduanaNew = $repAduana->copy();
                $repAduanaNew->setCaIdreporte( $reporte->getCaIdreporte() );
                $repAduanaNew->save();
            }

            if( $this->getCaSeguro() =="S�" ){
                $repSeguro = $this->getRepSeguro();
                $repSeguroNew = $repSeguro->copy();
                $repSeguroNew->setCaIdreporte( $reporte->getCaIdreporte() );
                $repSeguroNew->save();
            }
            $conn->commit();
        }
        catch (Exception $e){

            throw $e;
            $conn->rollBack();
        }
        return $reporte;
    }

    public function importar( $reporteNew ){
        try{
            $conn = $this->getTable()->getConnection();
            $conn->beginTransaction();

            if( $reporteNew)
            {  
                //$reporte->getCa()=$reporteNew->getCa();

                $this->setCaOrigen($reporteNew->getCaOrigen());
                $this->setCaDestino($reporteNew->getCaDestino());
                $this->setCaIdcotizacion($reporteNew->getCaIdcotizacion());
                $this->setCaIdproducto($reporteNew->getCaIdproducto());
                //$reporte->setCaImpoexpo($reporteNew->getCaImpoexpo());
                //$reporte->setCaFchdespacho($reporteNew->getCaFchdespacho());
                $this->setCaIdconcliente($reporteNew->getCaIdconcliente());
                $this->setCaIdclientefac($reporteNew->getCaIdclientefac());
                $this->setCaIdclienteag($reporteNew->getCaIdclienteag());
                $this->setCaIdclienteotro($reporteNew->getCaIdclientefac());
                $this->setCaIdagente($reporteNew->getCaIdagente());
                $this->setCaMercanciaDesc($reporteNew->getCaMercanciaDesc());
                $this->setCaIdproveedor($reporteNew->getCaIdproveedor());
                $this->setCaIncoterms($reporteNew->getCaIncoterms());

                //$this->setCaOrdenProv($reporteNew->getCaOrdenProv());
                $this->setCaOrdenProv("");
                //$this->setCaOrdenClie($reporteNew->getCaOrdenClie());
                $this->setCaOrdenClie("");
                $this->setCaConfirmarClie($reporteNew->getCaConfirmarClie());

                $this->setCaIdrepresentante($reporteNew->getCaIdrepresentante());

                $this->setCaInformarRepr( $reporteNew->getCaInformarRepr() );

                $this->setCaIdconsignatario($reporteNew->getCaIdconsignatario());

                $this->setCaIdnotify($reporteNew->getCaIdnotify());

                $this->setCaIdmaster($reporteNew->getCaIdmaster());


                $this->setCaInformarMast($reporteNew->getCaInformarMast());

                //$reporte->setCaTransporte($reporteNew->getCaTransporte());

                //$reporte->setCaModalidad($reporteNew->getCaModalidad());

                $this->setCaSeguro($reporteNew->getCaSeguro());

                $this->setCaLiberacion($reporteNew->getCaLiberacion());

                $this->setCaTiempocredito($reporteNew->getCaTiempocredito());
                $this->setCaComodato($reporteNew->getCaComodato());
                $this->setCaPreferenciasClie($reporteNew->getCaPreferenciasClie());
                $this->setCaInstrucciones($reporteNew->getCaInstrucciones());

                $this->setCaIdlinea($reporteNew->getCaIdlinea());
                $this->setCaIdconsignar($reporteNew->getCaIdconsignar());

                $this->setCaIdconsignarmaster($reporteNew->getCaIdconsignarmaster());
                $this->setCaIdbodega($reporteNew->getCaIdbodega());
                $this->setCaContinuacion($reporteNew->getCaContinuacion());

                $this->setCaContinuacionDest($reporteNew->getCaContinuacionDest());
                $this->setCaContOrigen($reporteNew->getCaContOrigen());
                $this->setCaContDestino($reporteNew->getCaContDestino());


//                $reporte->setCaLogin($reporteNew->getCaLogin());

                $this->setCaContinuacionConf($reporteNew->getCaContinuacionConf());

                $this->setCaColmas($reporteNew->getCaColmas());
                $this->setCaMciaPeligrosa($reporteNew->getCaMciaPeligrosa());

                $this->save( $conn );

                $conceptos = $this->getRepTarifa();
                foreach( $conceptos as $concepto ){                    
                    $concepto->delete();
                }

                $conceptos = $reporteNew->getRepTarifa();
                foreach( $conceptos as $concepto ){
                    $newConcepto = $concepto->copy();
                    $newConcepto->setCaIdconcepto( $concepto->getCaIdconcepto() );
                    $newConcepto->setCaIdreporte( $this->getCaIdreporte() );
                    $newConcepto->save( $conn );
                }

                $gastos =   $this->getRecargos( );
                foreach($gastos as $gasto ){
                    $gasto->delete();
                }
                //Copia los gastos
                $gastos =   $reporteNew->getRecargos( );
                foreach($gastos as $gasto ){
                    $newGasto = $gasto->copy();
                    $newGasto->setCaIdconcepto( $gasto->getCaIdconcepto() );
                    $newGasto->setCaIdrecargo( $gasto->getCaIdrecargo() );
                    $newGasto->setCaIdreporte( $this->getCaIdreporte() );
                    if($gasto->getCaRecargoorigen()==false)
                        $newGasto->setCaRecargoorigen( "false" );
                    if($gasto->getCaRecargoorigen()==true)
                        $newGasto->setCaRecargoorigen( "true" );
                    $newGasto->save( $conn );
                }

                $costos = $this->getCostos( );
                foreach($costos as $costo ){
                    $costo->delete();
                }

                $costos = $reporteNew->getCostos( );
                foreach($costos as $costo ){
                    $newCosto = $costo->copy();
                    $newCosto->setCaIdcosto( $costo->getCaIdcosto() );
                    $newCosto->setCaIdreporte( $this->getCaIdreporte() );
                    $newCosto->save($conn);
                }

                if( $reporteNew->getCaImpoexpo()==Constantes::EXPO ){
                    $repExpo = $this->getRepExpo();
                    $repExpo->delete();
                    $repExpo = $reporteNew->getRepExpo();
                    $repExpoNew = $repExpo->copy();
                    $repExpoNew->setCaIdreporte( $this->getCaIdreporte() );
                    $repExpoNew->save($conn);
                }

                if( $reporteNew->getCaColmas()=="S�" ){
                    $repAduana = $this->getRepAduana();
                    $repAduana->delete();
                    $repAduana = $reporteNew->getRepAduana();
                    $repAduanaNew = $repAduana->copy();
                    $repAduanaNew->setCaIdreporte( $this->getCaIdreporte() );
                    $repAduanaNew->save($conn);
                }

                if( $reporteNew->getCaSeguro() =="S�" ){
                    $repSeguro = $this->getRepSeguro();
                    $repSeguro->delete();
                    
                    $repSeguro = $reporteNew->getRepSeguro();
                    if($repSeguro)
                    {
                        $repSeguroNew = $repSeguro->copy();
                        //echo "ss".$repSeguroNew->getCaSeguroConf();
                        //exit;
                        $repSeguroNew->setCaIdreporte( $this->getCaIdreporte() );
                        $repSeguroNew->save($conn);
                    }
                }
                //$reporte = $reporte->importar($idreportenew);
                $conn->commit();
               return true;
            }
            else
            {
                $conn->rollBack();
                return false;
            }


            //Copia los conceptos

            
        }
        catch (Exception $e){

            throw $e;
            $conn->rollBack();
            return false;
        }
        //return $reporte;
    }



    public function getTareas( $idlista=null ){
        $q = Doctrine::getTable("NotTarea")
                 ->createQuery("t")
                 ->innerJoin("t.RepAsignacion a")
                 ->innerJoin("a.Reporte r")
                 ->where("r.ca_consecutivo = ?", $this->getCaConsecutivo() )
                 ->addOrderBy("t.ca_fchvencimiento ASC");

        if( $idlista ){
            $q->addWhere("t.ca_idlistatarea = ?", $idlista );
        }

        return $q->execute();


    }





}
