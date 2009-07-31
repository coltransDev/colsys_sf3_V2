<?php


abstract class BaseReporte extends BaseObject  implements Persistent {


  const PEER = 'ReportePeer';

	
	protected static $peer;

	
	protected $ca_idreporte;

	
	protected $ca_fchreporte;

	
	protected $ca_consecutivo;

	
	protected $ca_version;

	
	protected $ca_idcotizacion;

	
	protected $ca_origen;

	
	protected $ca_destino;

	
	protected $ca_impoexpo;

	
	protected $ca_fchdespacho;

	
	protected $ca_idagente;

	
	protected $ca_incoterms;

	
	protected $ca_mercancia_desc;

	
	protected $ca_idproveedor;

	
	protected $ca_orden_prov;

	
	protected $ca_idconcliente;

	
	protected $ca_orden_clie;

	
	protected $ca_confirmar_clie;

	
	protected $ca_idrepresentante;

	
	protected $ca_informar_repr;

	
	protected $ca_idconsignatario;

	
	protected $ca_informar_cons;

	
	protected $ca_idnotify;

	
	protected $ca_informar_noti;

	
	protected $ca_idmaster;

	
	protected $ca_informar_mast;

	
	protected $ca_notify;

	
	protected $ca_transporte;

	
	protected $ca_modalidad;

	
	protected $ca_seguro;

	
	protected $ca_liberacion;

	
	protected $ca_tiempocredito;

	
	protected $ca_preferencias_clie;

	
	protected $ca_instrucciones;

	
	protected $ca_idlinea;

	
	protected $ca_idconsignar;

	
	protected $ca_idconsignarmaster;

	
	protected $ca_idbodega;

	
	protected $ca_mastersame;

	
	protected $ca_continuacion;

	
	protected $ca_continuacion_dest;

	
	protected $ca_continuacion_conf;

	
	protected $ca_etapa_actual;

	
	protected $ca_login;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $ca_fchanulado;

	
	protected $ca_usuanulado;

	
	protected $ca_fchcerrado;

	
	protected $ca_usucerrado;

	
	protected $ca_colmas;

	
	protected $ca_propiedades;

	
	protected $ca_idetapa;

	
	protected $ca_fchultstatus;

	
	protected $ca_idtarea_rext;

	
	protected $ca_idseguimiento;

	
	protected $aUsuario;

	
	protected $aTransportador;

	
	protected $aTercero;

	
	protected $aAgente;

	
	protected $aBodega;

	
	protected $aTrackingEtapa;

	
	protected $aNotTarea;

	
	protected $collRepStatuss;

	
	private $lastRepStatusCriteria = null;

	
	protected $collRepEquipos;

	
	private $lastRepEquipoCriteria = null;

	
	protected $collRepGastos;

	
	private $lastRepGastoCriteria = null;

	
	protected $singleRepSeguro;

	
	protected $collRepCostos;

	
	private $lastRepCostoCriteria = null;

	
	protected $collRepTarifas;

	
	private $lastRepTarifaCriteria = null;

	
	protected $singleRepAduana;

	
	protected $singleRepExpo;

	
	protected $collRepAsignacions;

	
	private $lastRepAsignacionCriteria = null;

	
	protected $collInoClientesSeas;

	
	private $lastInoClientesSeaCriteria = null;

	
	protected $collInoClientesAirs;

	
	private $lastInoClientesAirCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
	}

	
	public function getCaIdreporte()
	{
		return $this->ca_idreporte;
	}

	
	public function getCaFchreporte($format = 'Y-m-d')
	{
		if ($this->ca_fchreporte === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchreporte);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchreporte, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaConsecutivo()
	{
		return $this->ca_consecutivo;
	}

	
	public function getCaVersion()
	{
		return $this->ca_version;
	}

	
	public function getCaIdcotizacion()
	{
		return $this->ca_idcotizacion;
	}

	
	public function getCaOrigen()
	{
		return $this->ca_origen;
	}

	
	public function getCaDestino()
	{
		return $this->ca_destino;
	}

	
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
	}

	
	public function getCaFchdespacho($format = 'Y-m-d')
	{
		if ($this->ca_fchdespacho === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchdespacho);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchdespacho, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaIdagente()
	{
		return $this->ca_idagente;
	}

	
	public function getCaIncoterms()
	{
		return $this->ca_incoterms;
	}

	
	public function getCaMercanciaDesc()
	{
		return $this->ca_mercancia_desc;
	}

	
	public function getCaIdproveedor()
	{
		return $this->ca_idproveedor;
	}

	
	public function getCaOrdenProv()
	{
		return $this->ca_orden_prov;
	}

	
	public function getCaIdconcliente()
	{
		return $this->ca_idconcliente;
	}

	
	public function getCaOrdenClie()
	{
		return $this->ca_orden_clie;
	}

	
	public function getCaConfirmarClie()
	{
		return $this->ca_confirmar_clie;
	}

	
	public function getCaIdrepresentante()
	{
		return $this->ca_idrepresentante;
	}

	
	public function getCaInformarRepr()
	{
		return $this->ca_informar_repr;
	}

	
	public function getCaIdconsignatario()
	{
		return $this->ca_idconsignatario;
	}

	
	public function getCaInformarCons()
	{
		return $this->ca_informar_cons;
	}

	
	public function getCaIdnotify()
	{
		return $this->ca_idnotify;
	}

	
	public function getCaInformarNoti()
	{
		return $this->ca_informar_noti;
	}

	
	public function getCaIdmaster()
	{
		return $this->ca_idmaster;
	}

	
	public function getCaInformarMast()
	{
		return $this->ca_informar_mast;
	}

	
	public function getCaNotify()
	{
		return $this->ca_notify;
	}

	
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	
	public function getCaSeguro()
	{
		return $this->ca_seguro;
	}

	
	public function getCaLiberacion()
	{
		return $this->ca_liberacion;
	}

	
	public function getCaTiempocredito()
	{
		return $this->ca_tiempocredito;
	}

	
	public function getCaPreferenciasClie()
	{
		return $this->ca_preferencias_clie;
	}

	
	public function getCaInstrucciones()
	{
		return $this->ca_instrucciones;
	}

	
	public function getCaIdlinea()
	{
		return $this->ca_idlinea;
	}

	
	public function getCaIdconsignar()
	{
		return $this->ca_idconsignar;
	}

	
	public function getCaIdconsignarmaster()
	{
		return $this->ca_idconsignarmaster;
	}

	
	public function getCaIdbodega()
	{
		return $this->ca_idbodega;
	}

	
	public function getCaMastersame()
	{
		return $this->ca_mastersame;
	}

	
	public function getCaContinuacion()
	{
		return $this->ca_continuacion;
	}

	
	public function getCaContinuacionDest()
	{
		return $this->ca_continuacion_dest;
	}

	
	public function getCaContinuacionConf()
	{
		return $this->ca_continuacion_conf;
	}

	
	public function getCaEtapaActual()
	{
		return $this->ca_etapa_actual;
	}

	
	public function getCaLogin()
	{
		return $this->ca_login;
	}

	
	public function getCaFchcreado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchcreado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcreado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcreado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsucreado()
	{
		return $this->ca_usucreado;
	}

	
	public function getCaFchactualizado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchactualizado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchactualizado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchactualizado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuactualizado()
	{
		return $this->ca_usuactualizado;
	}

	
	public function getCaFchanulado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchanulado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchanulado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchanulado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuanulado()
	{
		return $this->ca_usuanulado;
	}

	
	public function getCaFchcerrado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchcerrado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcerrado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcerrado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsucerrado()
	{
		return $this->ca_usucerrado;
	}

	
	public function getCaColmas()
	{
		return $this->ca_colmas;
	}

	
	public function getCaPropiedades()
	{
		return $this->ca_propiedades;
	}

	
	public function getCaIdetapa()
	{
		return $this->ca_idetapa;
	}

	
	public function getCaFchultstatus($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchultstatus === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchultstatus);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchultstatus, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaIdtareaRext()
	{
		return $this->ca_idtarea_rext;
	}

	
	public function getCaIdseguimiento()
	{
		return $this->ca_idseguimiento;
	}

	
	public function setCaIdreporte($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDREPORTE;
		}

		return $this;
	} 
	
	public function setCaFchreporte($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchreporte !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchreporte !== null && $tmpDt = new DateTime($this->ca_fchreporte)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchreporte = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = ReportePeer::CA_FCHREPORTE;
			}
		} 
		return $this;
	} 
	
	public function setCaConsecutivo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_consecutivo !== $v) {
			$this->ca_consecutivo = $v;
			$this->modifiedColumns[] = ReportePeer::CA_CONSECUTIVO;
		}

		return $this;
	} 
	
	public function setCaVersion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_version !== $v) {
			$this->ca_version = $v;
			$this->modifiedColumns[] = ReportePeer::CA_VERSION;
		}

		return $this;
	} 
	
	public function setCaIdcotizacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcotizacion !== $v) {
			$this->ca_idcotizacion = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDCOTIZACION;
		}

		return $this;
	} 
	
	public function setCaOrigen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_origen !== $v) {
			$this->ca_origen = $v;
			$this->modifiedColumns[] = ReportePeer::CA_ORIGEN;
		}

		return $this;
	} 
	
	public function setCaDestino($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_destino !== $v) {
			$this->ca_destino = $v;
			$this->modifiedColumns[] = ReportePeer::CA_DESTINO;
		}

		return $this;
	} 
	
	public function setCaImpoexpo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IMPOEXPO;
		}

		return $this;
	} 
	
	public function setCaFchdespacho($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchdespacho !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchdespacho !== null && $tmpDt = new DateTime($this->ca_fchdespacho)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchdespacho = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = ReportePeer::CA_FCHDESPACHO;
			}
		} 
		return $this;
	} 
	
	public function setCaIdagente($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idagente !== $v) {
			$this->ca_idagente = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDAGENTE;
		}

		if ($this->aAgente !== null && $this->aAgente->getCaIdagente() !== $v) {
			$this->aAgente = null;
		}

		return $this;
	} 
	
	public function setCaIncoterms($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_incoterms !== $v) {
			$this->ca_incoterms = $v;
			$this->modifiedColumns[] = ReportePeer::CA_INCOTERMS;
		}

		return $this;
	} 
	
	public function setCaMercanciaDesc($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mercancia_desc !== $v) {
			$this->ca_mercancia_desc = $v;
			$this->modifiedColumns[] = ReportePeer::CA_MERCANCIA_DESC;
		}

		return $this;
	} 
	
	public function setCaIdproveedor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idproveedor !== $v) {
			$this->ca_idproveedor = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDPROVEEDOR;
		}

		if ($this->aTercero !== null && $this->aTercero->getCaIdtercero() !== $v) {
			$this->aTercero = null;
		}

		return $this;
	} 
	
	public function setCaOrdenProv($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_orden_prov !== $v) {
			$this->ca_orden_prov = $v;
			$this->modifiedColumns[] = ReportePeer::CA_ORDEN_PROV;
		}

		return $this;
	} 
	
	public function setCaIdconcliente($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idconcliente !== $v) {
			$this->ca_idconcliente = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDCONCLIENTE;
		}

		return $this;
	} 
	
	public function setCaOrdenClie($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_orden_clie !== $v) {
			$this->ca_orden_clie = $v;
			$this->modifiedColumns[] = ReportePeer::CA_ORDEN_CLIE;
		}

		return $this;
	} 
	
	public function setCaConfirmarClie($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_confirmar_clie !== $v) {
			$this->ca_confirmar_clie = $v;
			$this->modifiedColumns[] = ReportePeer::CA_CONFIRMAR_CLIE;
		}

		return $this;
	} 
	
	public function setCaIdrepresentante($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idrepresentante !== $v) {
			$this->ca_idrepresentante = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDREPRESENTANTE;
		}

		return $this;
	} 
	
	public function setCaInformarRepr($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_informar_repr !== $v) {
			$this->ca_informar_repr = $v;
			$this->modifiedColumns[] = ReportePeer::CA_INFORMAR_REPR;
		}

		return $this;
	} 
	
	public function setCaIdconsignatario($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idconsignatario !== $v) {
			$this->ca_idconsignatario = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDCONSIGNATARIO;
		}

		return $this;
	} 
	
	public function setCaInformarCons($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_informar_cons !== $v) {
			$this->ca_informar_cons = $v;
			$this->modifiedColumns[] = ReportePeer::CA_INFORMAR_CONS;
		}

		return $this;
	} 
	
	public function setCaIdnotify($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idnotify !== $v) {
			$this->ca_idnotify = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDNOTIFY;
		}

		return $this;
	} 
	
	public function setCaInformarNoti($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_informar_noti !== $v) {
			$this->ca_informar_noti = $v;
			$this->modifiedColumns[] = ReportePeer::CA_INFORMAR_NOTI;
		}

		return $this;
	} 
	
	public function setCaIdmaster($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idmaster !== $v) {
			$this->ca_idmaster = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDMASTER;
		}

		return $this;
	} 
	
	public function setCaInformarMast($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_informar_mast !== $v) {
			$this->ca_informar_mast = $v;
			$this->modifiedColumns[] = ReportePeer::CA_INFORMAR_MAST;
		}

		return $this;
	} 
	
	public function setCaNotify($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_notify !== $v) {
			$this->ca_notify = $v;
			$this->modifiedColumns[] = ReportePeer::CA_NOTIFY;
		}

		return $this;
	} 
	
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = ReportePeer::CA_TRANSPORTE;
		}

		return $this;
	} 
	
	public function setCaModalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = ReportePeer::CA_MODALIDAD;
		}

		return $this;
	} 
	
	public function setCaSeguro($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_seguro !== $v) {
			$this->ca_seguro = $v;
			$this->modifiedColumns[] = ReportePeer::CA_SEGURO;
		}

		return $this;
	} 
	
	public function setCaLiberacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_liberacion !== $v) {
			$this->ca_liberacion = $v;
			$this->modifiedColumns[] = ReportePeer::CA_LIBERACION;
		}

		return $this;
	} 
	
	public function setCaTiempocredito($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tiempocredito !== $v) {
			$this->ca_tiempocredito = $v;
			$this->modifiedColumns[] = ReportePeer::CA_TIEMPOCREDITO;
		}

		return $this;
	} 
	
	public function setCaPreferenciasClie($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_preferencias_clie !== $v) {
			$this->ca_preferencias_clie = $v;
			$this->modifiedColumns[] = ReportePeer::CA_PREFERENCIAS_CLIE;
		}

		return $this;
	} 
	
	public function setCaInstrucciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_instrucciones !== $v) {
			$this->ca_instrucciones = $v;
			$this->modifiedColumns[] = ReportePeer::CA_INSTRUCCIONES;
		}

		return $this;
	} 
	
	public function setCaIdlinea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idlinea !== $v) {
			$this->ca_idlinea = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
		}

		return $this;
	} 
	
	public function setCaIdconsignar($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idconsignar !== $v) {
			$this->ca_idconsignar = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDCONSIGNAR;
		}

		return $this;
	} 
	
	public function setCaIdconsignarmaster($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idconsignarmaster !== $v) {
			$this->ca_idconsignarmaster = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDCONSIGNARMASTER;
		}

		return $this;
	} 
	
	public function setCaIdbodega($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idbodega !== $v) {
			$this->ca_idbodega = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDBODEGA;
		}

		if ($this->aBodega !== null && $this->aBodega->getCaIdbodega() !== $v) {
			$this->aBodega = null;
		}

		return $this;
	} 
	
	public function setCaMastersame($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mastersame !== $v) {
			$this->ca_mastersame = $v;
			$this->modifiedColumns[] = ReportePeer::CA_MASTERSAME;
		}

		return $this;
	} 
	
	public function setCaContinuacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_continuacion !== $v) {
			$this->ca_continuacion = $v;
			$this->modifiedColumns[] = ReportePeer::CA_CONTINUACION;
		}

		return $this;
	} 
	
	public function setCaContinuacionDest($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_continuacion_dest !== $v) {
			$this->ca_continuacion_dest = $v;
			$this->modifiedColumns[] = ReportePeer::CA_CONTINUACION_DEST;
		}

		return $this;
	} 
	
	public function setCaContinuacionConf($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_continuacion_conf !== $v) {
			$this->ca_continuacion_conf = $v;
			$this->modifiedColumns[] = ReportePeer::CA_CONTINUACION_CONF;
		}

		return $this;
	} 
	
	public function setCaEtapaActual($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_etapa_actual !== $v) {
			$this->ca_etapa_actual = $v;
			$this->modifiedColumns[] = ReportePeer::CA_ETAPA_ACTUAL;
		}

		return $this;
	} 
	
	public function setCaLogin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = ReportePeer::CA_LOGIN;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
		}

		return $this;
	} 
	
	public function setCaFchcreado($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchcreado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchcreado !== null && $tmpDt = new DateTime($this->ca_fchcreado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchcreado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = ReportePeer::CA_FCHCREADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = ReportePeer::CA_USUCREADO;
		}

		return $this;
	} 
	
	public function setCaFchactualizado($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchactualizado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchactualizado !== null && $tmpDt = new DateTime($this->ca_fchactualizado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchactualizado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = ReportePeer::CA_FCHACTUALIZADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = ReportePeer::CA_USUACTUALIZADO;
		}

		return $this;
	} 
	
	public function setCaFchanulado($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchanulado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchanulado !== null && $tmpDt = new DateTime($this->ca_fchanulado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchanulado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = ReportePeer::CA_FCHANULADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuanulado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuanulado !== $v) {
			$this->ca_usuanulado = $v;
			$this->modifiedColumns[] = ReportePeer::CA_USUANULADO;
		}

		return $this;
	} 
	
	public function setCaFchcerrado($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchcerrado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchcerrado !== null && $tmpDt = new DateTime($this->ca_fchcerrado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchcerrado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = ReportePeer::CA_FCHCERRADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsucerrado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucerrado !== $v) {
			$this->ca_usucerrado = $v;
			$this->modifiedColumns[] = ReportePeer::CA_USUCERRADO;
		}

		return $this;
	} 
	
	public function setCaColmas($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_colmas !== $v) {
			$this->ca_colmas = $v;
			$this->modifiedColumns[] = ReportePeer::CA_COLMAS;
		}

		return $this;
	} 
	
	public function setCaPropiedades($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_propiedades !== $v) {
			$this->ca_propiedades = $v;
			$this->modifiedColumns[] = ReportePeer::CA_PROPIEDADES;
		}

		return $this;
	} 
	
	public function setCaIdetapa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idetapa !== $v) {
			$this->ca_idetapa = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDETAPA;
		}

		if ($this->aTrackingEtapa !== null && $this->aTrackingEtapa->getCaIdetapa() !== $v) {
			$this->aTrackingEtapa = null;
		}

		return $this;
	} 
	
	public function setCaFchultstatus($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchultstatus !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchultstatus !== null && $tmpDt = new DateTime($this->ca_fchultstatus)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchultstatus = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = ReportePeer::CA_FCHULTSTATUS;
			}
		} 
		return $this;
	} 
	
	public function setCaIdtareaRext($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtarea_rext !== $v) {
			$this->ca_idtarea_rext = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDTAREA_REXT;
		}

		return $this;
	} 
	
	public function setCaIdseguimiento($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idseguimiento !== $v) {
			$this->ca_idseguimiento = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDSEGUIMIENTO;
		}

		if ($this->aNotTarea !== null && $this->aNotTarea->getCaIdtarea() !== $v) {
			$this->aNotTarea = null;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->ca_idreporte = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_fchreporte = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_consecutivo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_version = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->ca_idcotizacion = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->ca_origen = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_destino = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_impoexpo = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_fchdespacho = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_idagente = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->ca_incoterms = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_mercancia_desc = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_idproveedor = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_orden_prov = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_idconcliente = ($row[$startcol + 14] !== null) ? (int) $row[$startcol + 14] : null;
			$this->ca_orden_clie = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_confirmar_clie = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_idrepresentante = ($row[$startcol + 17] !== null) ? (int) $row[$startcol + 17] : null;
			$this->ca_informar_repr = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_idconsignatario = ($row[$startcol + 19] !== null) ? (int) $row[$startcol + 19] : null;
			$this->ca_informar_cons = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_idnotify = ($row[$startcol + 21] !== null) ? (int) $row[$startcol + 21] : null;
			$this->ca_informar_noti = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->ca_idmaster = ($row[$startcol + 23] !== null) ? (int) $row[$startcol + 23] : null;
			$this->ca_informar_mast = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
			$this->ca_notify = ($row[$startcol + 25] !== null) ? (int) $row[$startcol + 25] : null;
			$this->ca_transporte = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
			$this->ca_modalidad = ($row[$startcol + 27] !== null) ? (string) $row[$startcol + 27] : null;
			$this->ca_seguro = ($row[$startcol + 28] !== null) ? (string) $row[$startcol + 28] : null;
			$this->ca_liberacion = ($row[$startcol + 29] !== null) ? (string) $row[$startcol + 29] : null;
			$this->ca_tiempocredito = ($row[$startcol + 30] !== null) ? (string) $row[$startcol + 30] : null;
			$this->ca_preferencias_clie = ($row[$startcol + 31] !== null) ? (string) $row[$startcol + 31] : null;
			$this->ca_instrucciones = ($row[$startcol + 32] !== null) ? (string) $row[$startcol + 32] : null;
			$this->ca_idlinea = ($row[$startcol + 33] !== null) ? (int) $row[$startcol + 33] : null;
			$this->ca_idconsignar = ($row[$startcol + 34] !== null) ? (int) $row[$startcol + 34] : null;
			$this->ca_idconsignarmaster = ($row[$startcol + 35] !== null) ? (int) $row[$startcol + 35] : null;
			$this->ca_idbodega = ($row[$startcol + 36] !== null) ? (int) $row[$startcol + 36] : null;
			$this->ca_mastersame = ($row[$startcol + 37] !== null) ? (string) $row[$startcol + 37] : null;
			$this->ca_continuacion = ($row[$startcol + 38] !== null) ? (string) $row[$startcol + 38] : null;
			$this->ca_continuacion_dest = ($row[$startcol + 39] !== null) ? (string) $row[$startcol + 39] : null;
			$this->ca_continuacion_conf = ($row[$startcol + 40] !== null) ? (string) $row[$startcol + 40] : null;
			$this->ca_etapa_actual = ($row[$startcol + 41] !== null) ? (string) $row[$startcol + 41] : null;
			$this->ca_login = ($row[$startcol + 42] !== null) ? (string) $row[$startcol + 42] : null;
			$this->ca_fchcreado = ($row[$startcol + 43] !== null) ? (string) $row[$startcol + 43] : null;
			$this->ca_usucreado = ($row[$startcol + 44] !== null) ? (string) $row[$startcol + 44] : null;
			$this->ca_fchactualizado = ($row[$startcol + 45] !== null) ? (string) $row[$startcol + 45] : null;
			$this->ca_usuactualizado = ($row[$startcol + 46] !== null) ? (string) $row[$startcol + 46] : null;
			$this->ca_fchanulado = ($row[$startcol + 47] !== null) ? (string) $row[$startcol + 47] : null;
			$this->ca_usuanulado = ($row[$startcol + 48] !== null) ? (string) $row[$startcol + 48] : null;
			$this->ca_fchcerrado = ($row[$startcol + 49] !== null) ? (string) $row[$startcol + 49] : null;
			$this->ca_usucerrado = ($row[$startcol + 50] !== null) ? (string) $row[$startcol + 50] : null;
			$this->ca_colmas = ($row[$startcol + 51] !== null) ? (string) $row[$startcol + 51] : null;
			$this->ca_propiedades = ($row[$startcol + 52] !== null) ? (string) $row[$startcol + 52] : null;
			$this->ca_idetapa = ($row[$startcol + 53] !== null) ? (string) $row[$startcol + 53] : null;
			$this->ca_fchultstatus = ($row[$startcol + 54] !== null) ? (string) $row[$startcol + 54] : null;
			$this->ca_idtarea_rext = ($row[$startcol + 55] !== null) ? (int) $row[$startcol + 55] : null;
			$this->ca_idseguimiento = ($row[$startcol + 56] !== null) ? (int) $row[$startcol + 56] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 57; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Reporte object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aAgente !== null && $this->ca_idagente !== $this->aAgente->getCaIdagente()) {
			$this->aAgente = null;
		}
		if ($this->aTercero !== null && $this->ca_idproveedor !== $this->aTercero->getCaIdtercero()) {
			$this->aTercero = null;
		}
		if ($this->aTransportador !== null && $this->ca_idlinea !== $this->aTransportador->getCaIdlinea()) {
			$this->aTransportador = null;
		}
		if ($this->aBodega !== null && $this->ca_idbodega !== $this->aBodega->getCaIdbodega()) {
			$this->aBodega = null;
		}
		if ($this->aUsuario !== null && $this->ca_login !== $this->aUsuario->getCaLogin()) {
			$this->aUsuario = null;
		}
		if ($this->aTrackingEtapa !== null && $this->ca_idetapa !== $this->aTrackingEtapa->getCaIdetapa()) {
			$this->aTrackingEtapa = null;
		}
		if ($this->aNotTarea !== null && $this->ca_idseguimiento !== $this->aNotTarea->getCaIdtarea()) {
			$this->aNotTarea = null;
		}
	} 
	
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = ReportePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aUsuario = null;
			$this->aTransportador = null;
			$this->aTercero = null;
			$this->aAgente = null;
			$this->aBodega = null;
			$this->aTrackingEtapa = null;
			$this->aNotTarea = null;
			$this->collRepStatuss = null;
			$this->lastRepStatusCriteria = null;

			$this->collRepEquipos = null;
			$this->lastRepEquipoCriteria = null;

			$this->collRepGastos = null;
			$this->lastRepGastoCriteria = null;

			$this->singleRepSeguro = null;

			$this->collRepCostos = null;
			$this->lastRepCostoCriteria = null;

			$this->collRepTarifas = null;
			$this->lastRepTarifaCriteria = null;

			$this->singleRepAduana = null;

			$this->singleRepExpo = null;

			$this->collRepAsignacions = null;
			$this->lastRepAsignacionCriteria = null;

			$this->collInoClientesSeas = null;
			$this->lastInoClientesSeaCriteria = null;

			$this->collInoClientesAirs = null;
			$this->lastInoClientesAirCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseReporte:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ReportePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseReporte:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseReporte:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseReporte:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			ReportePeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

												
			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->aTransportador !== null) {
				if ($this->aTransportador->isModified() || $this->aTransportador->isNew()) {
					$affectedRows += $this->aTransportador->save($con);
				}
				$this->setTransportador($this->aTransportador);
			}

			if ($this->aTercero !== null) {
				if ($this->aTercero->isModified() || $this->aTercero->isNew()) {
					$affectedRows += $this->aTercero->save($con);
				}
				$this->setTercero($this->aTercero);
			}

			if ($this->aAgente !== null) {
				if ($this->aAgente->isModified() || $this->aAgente->isNew()) {
					$affectedRows += $this->aAgente->save($con);
				}
				$this->setAgente($this->aAgente);
			}

			if ($this->aBodega !== null) {
				if ($this->aBodega->isModified() || $this->aBodega->isNew()) {
					$affectedRows += $this->aBodega->save($con);
				}
				$this->setBodega($this->aBodega);
			}

			if ($this->aTrackingEtapa !== null) {
				if ($this->aTrackingEtapa->isModified() || $this->aTrackingEtapa->isNew()) {
					$affectedRows += $this->aTrackingEtapa->save($con);
				}
				$this->setTrackingEtapa($this->aTrackingEtapa);
			}

			if ($this->aNotTarea !== null) {
				if ($this->aNotTarea->isModified() || $this->aNotTarea->isNew()) {
					$affectedRows += $this->aNotTarea->save($con);
				}
				$this->setNotTarea($this->aNotTarea);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ReportePeer::CA_IDREPORTE;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ReportePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdreporte($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ReportePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collRepStatuss !== null) {
				foreach ($this->collRepStatuss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepEquipos !== null) {
				foreach ($this->collRepEquipos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepGastos !== null) {
				foreach ($this->collRepGastos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->singleRepSeguro !== null) {
				if (!$this->singleRepSeguro->isDeleted()) {
						$affectedRows += $this->singleRepSeguro->save($con);
				}
			}

			if ($this->collRepCostos !== null) {
				foreach ($this->collRepCostos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepTarifas !== null) {
				foreach ($this->collRepTarifas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->singleRepAduana !== null) {
				if (!$this->singleRepAduana->isDeleted()) {
						$affectedRows += $this->singleRepAduana->save($con);
				}
			}

			if ($this->singleRepExpo !== null) {
				if (!$this->singleRepExpo->isDeleted()) {
						$affectedRows += $this->singleRepExpo->save($con);
				}
			}

			if ($this->collRepAsignacions !== null) {
				foreach ($this->collRepAsignacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoClientesSeas !== null) {
				foreach ($this->collInoClientesSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoClientesAirs !== null) {
				foreach ($this->collInoClientesAirs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}

			if ($this->aTransportador !== null) {
				if (!$this->aTransportador->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransportador->getValidationFailures());
				}
			}

			if ($this->aTercero !== null) {
				if (!$this->aTercero->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTercero->getValidationFailures());
				}
			}

			if ($this->aAgente !== null) {
				if (!$this->aAgente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAgente->getValidationFailures());
				}
			}

			if ($this->aBodega !== null) {
				if (!$this->aBodega->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBodega->getValidationFailures());
				}
			}

			if ($this->aTrackingEtapa !== null) {
				if (!$this->aTrackingEtapa->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTrackingEtapa->getValidationFailures());
				}
			}

			if ($this->aNotTarea !== null) {
				if (!$this->aNotTarea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNotTarea->getValidationFailures());
				}
			}


			if (($retval = ReportePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRepStatuss !== null) {
					foreach ($this->collRepStatuss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepEquipos !== null) {
					foreach ($this->collRepEquipos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepGastos !== null) {
					foreach ($this->collRepGastos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->singleRepSeguro !== null) {
					if (!$this->singleRepSeguro->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singleRepSeguro->getValidationFailures());
					}
				}

				if ($this->collRepCostos !== null) {
					foreach ($this->collRepCostos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepTarifas !== null) {
					foreach ($this->collRepTarifas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->singleRepAduana !== null) {
					if (!$this->singleRepAduana->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singleRepAduana->getValidationFailures());
					}
				}

				if ($this->singleRepExpo !== null) {
					if (!$this->singleRepExpo->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singleRepExpo->getValidationFailures());
					}
				}

				if ($this->collRepAsignacions !== null) {
					foreach ($this->collRepAsignacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoClientesSeas !== null) {
					foreach ($this->collInoClientesSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoClientesAirs !== null) {
					foreach ($this->collInoClientesAirs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ReportePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdreporte();
				break;
			case 1:
				return $this->getCaFchreporte();
				break;
			case 2:
				return $this->getCaConsecutivo();
				break;
			case 3:
				return $this->getCaVersion();
				break;
			case 4:
				return $this->getCaIdcotizacion();
				break;
			case 5:
				return $this->getCaOrigen();
				break;
			case 6:
				return $this->getCaDestino();
				break;
			case 7:
				return $this->getCaImpoexpo();
				break;
			case 8:
				return $this->getCaFchdespacho();
				break;
			case 9:
				return $this->getCaIdagente();
				break;
			case 10:
				return $this->getCaIncoterms();
				break;
			case 11:
				return $this->getCaMercanciaDesc();
				break;
			case 12:
				return $this->getCaIdproveedor();
				break;
			case 13:
				return $this->getCaOrdenProv();
				break;
			case 14:
				return $this->getCaIdconcliente();
				break;
			case 15:
				return $this->getCaOrdenClie();
				break;
			case 16:
				return $this->getCaConfirmarClie();
				break;
			case 17:
				return $this->getCaIdrepresentante();
				break;
			case 18:
				return $this->getCaInformarRepr();
				break;
			case 19:
				return $this->getCaIdconsignatario();
				break;
			case 20:
				return $this->getCaInformarCons();
				break;
			case 21:
				return $this->getCaIdnotify();
				break;
			case 22:
				return $this->getCaInformarNoti();
				break;
			case 23:
				return $this->getCaIdmaster();
				break;
			case 24:
				return $this->getCaInformarMast();
				break;
			case 25:
				return $this->getCaNotify();
				break;
			case 26:
				return $this->getCaTransporte();
				break;
			case 27:
				return $this->getCaModalidad();
				break;
			case 28:
				return $this->getCaSeguro();
				break;
			case 29:
				return $this->getCaLiberacion();
				break;
			case 30:
				return $this->getCaTiempocredito();
				break;
			case 31:
				return $this->getCaPreferenciasClie();
				break;
			case 32:
				return $this->getCaInstrucciones();
				break;
			case 33:
				return $this->getCaIdlinea();
				break;
			case 34:
				return $this->getCaIdconsignar();
				break;
			case 35:
				return $this->getCaIdconsignarmaster();
				break;
			case 36:
				return $this->getCaIdbodega();
				break;
			case 37:
				return $this->getCaMastersame();
				break;
			case 38:
				return $this->getCaContinuacion();
				break;
			case 39:
				return $this->getCaContinuacionDest();
				break;
			case 40:
				return $this->getCaContinuacionConf();
				break;
			case 41:
				return $this->getCaEtapaActual();
				break;
			case 42:
				return $this->getCaLogin();
				break;
			case 43:
				return $this->getCaFchcreado();
				break;
			case 44:
				return $this->getCaUsucreado();
				break;
			case 45:
				return $this->getCaFchactualizado();
				break;
			case 46:
				return $this->getCaUsuactualizado();
				break;
			case 47:
				return $this->getCaFchanulado();
				break;
			case 48:
				return $this->getCaUsuanulado();
				break;
			case 49:
				return $this->getCaFchcerrado();
				break;
			case 50:
				return $this->getCaUsucerrado();
				break;
			case 51:
				return $this->getCaColmas();
				break;
			case 52:
				return $this->getCaPropiedades();
				break;
			case 53:
				return $this->getCaIdetapa();
				break;
			case 54:
				return $this->getCaFchultstatus();
				break;
			case 55:
				return $this->getCaIdtareaRext();
				break;
			case 56:
				return $this->getCaIdseguimiento();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = ReportePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdreporte(),
			$keys[1] => $this->getCaFchreporte(),
			$keys[2] => $this->getCaConsecutivo(),
			$keys[3] => $this->getCaVersion(),
			$keys[4] => $this->getCaIdcotizacion(),
			$keys[5] => $this->getCaOrigen(),
			$keys[6] => $this->getCaDestino(),
			$keys[7] => $this->getCaImpoexpo(),
			$keys[8] => $this->getCaFchdespacho(),
			$keys[9] => $this->getCaIdagente(),
			$keys[10] => $this->getCaIncoterms(),
			$keys[11] => $this->getCaMercanciaDesc(),
			$keys[12] => $this->getCaIdproveedor(),
			$keys[13] => $this->getCaOrdenProv(),
			$keys[14] => $this->getCaIdconcliente(),
			$keys[15] => $this->getCaOrdenClie(),
			$keys[16] => $this->getCaConfirmarClie(),
			$keys[17] => $this->getCaIdrepresentante(),
			$keys[18] => $this->getCaInformarRepr(),
			$keys[19] => $this->getCaIdconsignatario(),
			$keys[20] => $this->getCaInformarCons(),
			$keys[21] => $this->getCaIdnotify(),
			$keys[22] => $this->getCaInformarNoti(),
			$keys[23] => $this->getCaIdmaster(),
			$keys[24] => $this->getCaInformarMast(),
			$keys[25] => $this->getCaNotify(),
			$keys[26] => $this->getCaTransporte(),
			$keys[27] => $this->getCaModalidad(),
			$keys[28] => $this->getCaSeguro(),
			$keys[29] => $this->getCaLiberacion(),
			$keys[30] => $this->getCaTiempocredito(),
			$keys[31] => $this->getCaPreferenciasClie(),
			$keys[32] => $this->getCaInstrucciones(),
			$keys[33] => $this->getCaIdlinea(),
			$keys[34] => $this->getCaIdconsignar(),
			$keys[35] => $this->getCaIdconsignarmaster(),
			$keys[36] => $this->getCaIdbodega(),
			$keys[37] => $this->getCaMastersame(),
			$keys[38] => $this->getCaContinuacion(),
			$keys[39] => $this->getCaContinuacionDest(),
			$keys[40] => $this->getCaContinuacionConf(),
			$keys[41] => $this->getCaEtapaActual(),
			$keys[42] => $this->getCaLogin(),
			$keys[43] => $this->getCaFchcreado(),
			$keys[44] => $this->getCaUsucreado(),
			$keys[45] => $this->getCaFchactualizado(),
			$keys[46] => $this->getCaUsuactualizado(),
			$keys[47] => $this->getCaFchanulado(),
			$keys[48] => $this->getCaUsuanulado(),
			$keys[49] => $this->getCaFchcerrado(),
			$keys[50] => $this->getCaUsucerrado(),
			$keys[51] => $this->getCaColmas(),
			$keys[52] => $this->getCaPropiedades(),
			$keys[53] => $this->getCaIdetapa(),
			$keys[54] => $this->getCaFchultstatus(),
			$keys[55] => $this->getCaIdtareaRext(),
			$keys[56] => $this->getCaIdseguimiento(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ReportePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdreporte($value);
				break;
			case 1:
				$this->setCaFchreporte($value);
				break;
			case 2:
				$this->setCaConsecutivo($value);
				break;
			case 3:
				$this->setCaVersion($value);
				break;
			case 4:
				$this->setCaIdcotizacion($value);
				break;
			case 5:
				$this->setCaOrigen($value);
				break;
			case 6:
				$this->setCaDestino($value);
				break;
			case 7:
				$this->setCaImpoexpo($value);
				break;
			case 8:
				$this->setCaFchdespacho($value);
				break;
			case 9:
				$this->setCaIdagente($value);
				break;
			case 10:
				$this->setCaIncoterms($value);
				break;
			case 11:
				$this->setCaMercanciaDesc($value);
				break;
			case 12:
				$this->setCaIdproveedor($value);
				break;
			case 13:
				$this->setCaOrdenProv($value);
				break;
			case 14:
				$this->setCaIdconcliente($value);
				break;
			case 15:
				$this->setCaOrdenClie($value);
				break;
			case 16:
				$this->setCaConfirmarClie($value);
				break;
			case 17:
				$this->setCaIdrepresentante($value);
				break;
			case 18:
				$this->setCaInformarRepr($value);
				break;
			case 19:
				$this->setCaIdconsignatario($value);
				break;
			case 20:
				$this->setCaInformarCons($value);
				break;
			case 21:
				$this->setCaIdnotify($value);
				break;
			case 22:
				$this->setCaInformarNoti($value);
				break;
			case 23:
				$this->setCaIdmaster($value);
				break;
			case 24:
				$this->setCaInformarMast($value);
				break;
			case 25:
				$this->setCaNotify($value);
				break;
			case 26:
				$this->setCaTransporte($value);
				break;
			case 27:
				$this->setCaModalidad($value);
				break;
			case 28:
				$this->setCaSeguro($value);
				break;
			case 29:
				$this->setCaLiberacion($value);
				break;
			case 30:
				$this->setCaTiempocredito($value);
				break;
			case 31:
				$this->setCaPreferenciasClie($value);
				break;
			case 32:
				$this->setCaInstrucciones($value);
				break;
			case 33:
				$this->setCaIdlinea($value);
				break;
			case 34:
				$this->setCaIdconsignar($value);
				break;
			case 35:
				$this->setCaIdconsignarmaster($value);
				break;
			case 36:
				$this->setCaIdbodega($value);
				break;
			case 37:
				$this->setCaMastersame($value);
				break;
			case 38:
				$this->setCaContinuacion($value);
				break;
			case 39:
				$this->setCaContinuacionDest($value);
				break;
			case 40:
				$this->setCaContinuacionConf($value);
				break;
			case 41:
				$this->setCaEtapaActual($value);
				break;
			case 42:
				$this->setCaLogin($value);
				break;
			case 43:
				$this->setCaFchcreado($value);
				break;
			case 44:
				$this->setCaUsucreado($value);
				break;
			case 45:
				$this->setCaFchactualizado($value);
				break;
			case 46:
				$this->setCaUsuactualizado($value);
				break;
			case 47:
				$this->setCaFchanulado($value);
				break;
			case 48:
				$this->setCaUsuanulado($value);
				break;
			case 49:
				$this->setCaFchcerrado($value);
				break;
			case 50:
				$this->setCaUsucerrado($value);
				break;
			case 51:
				$this->setCaColmas($value);
				break;
			case 52:
				$this->setCaPropiedades($value);
				break;
			case 53:
				$this->setCaIdetapa($value);
				break;
			case 54:
				$this->setCaFchultstatus($value);
				break;
			case 55:
				$this->setCaIdtareaRext($value);
				break;
			case 56:
				$this->setCaIdseguimiento($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ReportePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdreporte($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaFchreporte($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaConsecutivo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaVersion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdcotizacion($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaOrigen($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaDestino($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaImpoexpo($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaFchdespacho($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaIdagente($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaIncoterms($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaMercanciaDesc($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaIdproveedor($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaOrdenProv($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaIdconcliente($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaOrdenClie($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaConfirmarClie($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaIdrepresentante($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaInformarRepr($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaIdconsignatario($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaInformarCons($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaIdnotify($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaInformarNoti($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaIdmaster($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCaInformarMast($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setCaNotify($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setCaTransporte($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setCaModalidad($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setCaSeguro($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setCaLiberacion($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setCaTiempocredito($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setCaPreferenciasClie($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setCaInstrucciones($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setCaIdlinea($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setCaIdconsignar($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setCaIdconsignarmaster($arr[$keys[35]]);
		if (array_key_exists($keys[36], $arr)) $this->setCaIdbodega($arr[$keys[36]]);
		if (array_key_exists($keys[37], $arr)) $this->setCaMastersame($arr[$keys[37]]);
		if (array_key_exists($keys[38], $arr)) $this->setCaContinuacion($arr[$keys[38]]);
		if (array_key_exists($keys[39], $arr)) $this->setCaContinuacionDest($arr[$keys[39]]);
		if (array_key_exists($keys[40], $arr)) $this->setCaContinuacionConf($arr[$keys[40]]);
		if (array_key_exists($keys[41], $arr)) $this->setCaEtapaActual($arr[$keys[41]]);
		if (array_key_exists($keys[42], $arr)) $this->setCaLogin($arr[$keys[42]]);
		if (array_key_exists($keys[43], $arr)) $this->setCaFchcreado($arr[$keys[43]]);
		if (array_key_exists($keys[44], $arr)) $this->setCaUsucreado($arr[$keys[44]]);
		if (array_key_exists($keys[45], $arr)) $this->setCaFchactualizado($arr[$keys[45]]);
		if (array_key_exists($keys[46], $arr)) $this->setCaUsuactualizado($arr[$keys[46]]);
		if (array_key_exists($keys[47], $arr)) $this->setCaFchanulado($arr[$keys[47]]);
		if (array_key_exists($keys[48], $arr)) $this->setCaUsuanulado($arr[$keys[48]]);
		if (array_key_exists($keys[49], $arr)) $this->setCaFchcerrado($arr[$keys[49]]);
		if (array_key_exists($keys[50], $arr)) $this->setCaUsucerrado($arr[$keys[50]]);
		if (array_key_exists($keys[51], $arr)) $this->setCaColmas($arr[$keys[51]]);
		if (array_key_exists($keys[52], $arr)) $this->setCaPropiedades($arr[$keys[52]]);
		if (array_key_exists($keys[53], $arr)) $this->setCaIdetapa($arr[$keys[53]]);
		if (array_key_exists($keys[54], $arr)) $this->setCaFchultstatus($arr[$keys[54]]);
		if (array_key_exists($keys[55], $arr)) $this->setCaIdtareaRext($arr[$keys[55]]);
		if (array_key_exists($keys[56], $arr)) $this->setCaIdseguimiento($arr[$keys[56]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ReportePeer::DATABASE_NAME);

		if ($this->isColumnModified(ReportePeer::CA_IDREPORTE)) $criteria->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(ReportePeer::CA_FCHREPORTE)) $criteria->add(ReportePeer::CA_FCHREPORTE, $this->ca_fchreporte);
		if ($this->isColumnModified(ReportePeer::CA_CONSECUTIVO)) $criteria->add(ReportePeer::CA_CONSECUTIVO, $this->ca_consecutivo);
		if ($this->isColumnModified(ReportePeer::CA_VERSION)) $criteria->add(ReportePeer::CA_VERSION, $this->ca_version);
		if ($this->isColumnModified(ReportePeer::CA_IDCOTIZACION)) $criteria->add(ReportePeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(ReportePeer::CA_ORIGEN)) $criteria->add(ReportePeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(ReportePeer::CA_DESTINO)) $criteria->add(ReportePeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(ReportePeer::CA_IMPOEXPO)) $criteria->add(ReportePeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(ReportePeer::CA_FCHDESPACHO)) $criteria->add(ReportePeer::CA_FCHDESPACHO, $this->ca_fchdespacho);
		if ($this->isColumnModified(ReportePeer::CA_IDAGENTE)) $criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);
		if ($this->isColumnModified(ReportePeer::CA_INCOTERMS)) $criteria->add(ReportePeer::CA_INCOTERMS, $this->ca_incoterms);
		if ($this->isColumnModified(ReportePeer::CA_MERCANCIA_DESC)) $criteria->add(ReportePeer::CA_MERCANCIA_DESC, $this->ca_mercancia_desc);
		if ($this->isColumnModified(ReportePeer::CA_IDPROVEEDOR)) $criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idproveedor);
		if ($this->isColumnModified(ReportePeer::CA_ORDEN_PROV)) $criteria->add(ReportePeer::CA_ORDEN_PROV, $this->ca_orden_prov);
		if ($this->isColumnModified(ReportePeer::CA_IDCONCLIENTE)) $criteria->add(ReportePeer::CA_IDCONCLIENTE, $this->ca_idconcliente);
		if ($this->isColumnModified(ReportePeer::CA_ORDEN_CLIE)) $criteria->add(ReportePeer::CA_ORDEN_CLIE, $this->ca_orden_clie);
		if ($this->isColumnModified(ReportePeer::CA_CONFIRMAR_CLIE)) $criteria->add(ReportePeer::CA_CONFIRMAR_CLIE, $this->ca_confirmar_clie);
		if ($this->isColumnModified(ReportePeer::CA_IDREPRESENTANTE)) $criteria->add(ReportePeer::CA_IDREPRESENTANTE, $this->ca_idrepresentante);
		if ($this->isColumnModified(ReportePeer::CA_INFORMAR_REPR)) $criteria->add(ReportePeer::CA_INFORMAR_REPR, $this->ca_informar_repr);
		if ($this->isColumnModified(ReportePeer::CA_IDCONSIGNATARIO)) $criteria->add(ReportePeer::CA_IDCONSIGNATARIO, $this->ca_idconsignatario);
		if ($this->isColumnModified(ReportePeer::CA_INFORMAR_CONS)) $criteria->add(ReportePeer::CA_INFORMAR_CONS, $this->ca_informar_cons);
		if ($this->isColumnModified(ReportePeer::CA_IDNOTIFY)) $criteria->add(ReportePeer::CA_IDNOTIFY, $this->ca_idnotify);
		if ($this->isColumnModified(ReportePeer::CA_INFORMAR_NOTI)) $criteria->add(ReportePeer::CA_INFORMAR_NOTI, $this->ca_informar_noti);
		if ($this->isColumnModified(ReportePeer::CA_IDMASTER)) $criteria->add(ReportePeer::CA_IDMASTER, $this->ca_idmaster);
		if ($this->isColumnModified(ReportePeer::CA_INFORMAR_MAST)) $criteria->add(ReportePeer::CA_INFORMAR_MAST, $this->ca_informar_mast);
		if ($this->isColumnModified(ReportePeer::CA_NOTIFY)) $criteria->add(ReportePeer::CA_NOTIFY, $this->ca_notify);
		if ($this->isColumnModified(ReportePeer::CA_TRANSPORTE)) $criteria->add(ReportePeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(ReportePeer::CA_MODALIDAD)) $criteria->add(ReportePeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(ReportePeer::CA_SEGURO)) $criteria->add(ReportePeer::CA_SEGURO, $this->ca_seguro);
		if ($this->isColumnModified(ReportePeer::CA_LIBERACION)) $criteria->add(ReportePeer::CA_LIBERACION, $this->ca_liberacion);
		if ($this->isColumnModified(ReportePeer::CA_TIEMPOCREDITO)) $criteria->add(ReportePeer::CA_TIEMPOCREDITO, $this->ca_tiempocredito);
		if ($this->isColumnModified(ReportePeer::CA_PREFERENCIAS_CLIE)) $criteria->add(ReportePeer::CA_PREFERENCIAS_CLIE, $this->ca_preferencias_clie);
		if ($this->isColumnModified(ReportePeer::CA_INSTRUCCIONES)) $criteria->add(ReportePeer::CA_INSTRUCCIONES, $this->ca_instrucciones);
		if ($this->isColumnModified(ReportePeer::CA_IDLINEA)) $criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(ReportePeer::CA_IDCONSIGNAR)) $criteria->add(ReportePeer::CA_IDCONSIGNAR, $this->ca_idconsignar);
		if ($this->isColumnModified(ReportePeer::CA_IDCONSIGNARMASTER)) $criteria->add(ReportePeer::CA_IDCONSIGNARMASTER, $this->ca_idconsignarmaster);
		if ($this->isColumnModified(ReportePeer::CA_IDBODEGA)) $criteria->add(ReportePeer::CA_IDBODEGA, $this->ca_idbodega);
		if ($this->isColumnModified(ReportePeer::CA_MASTERSAME)) $criteria->add(ReportePeer::CA_MASTERSAME, $this->ca_mastersame);
		if ($this->isColumnModified(ReportePeer::CA_CONTINUACION)) $criteria->add(ReportePeer::CA_CONTINUACION, $this->ca_continuacion);
		if ($this->isColumnModified(ReportePeer::CA_CONTINUACION_DEST)) $criteria->add(ReportePeer::CA_CONTINUACION_DEST, $this->ca_continuacion_dest);
		if ($this->isColumnModified(ReportePeer::CA_CONTINUACION_CONF)) $criteria->add(ReportePeer::CA_CONTINUACION_CONF, $this->ca_continuacion_conf);
		if ($this->isColumnModified(ReportePeer::CA_ETAPA_ACTUAL)) $criteria->add(ReportePeer::CA_ETAPA_ACTUAL, $this->ca_etapa_actual);
		if ($this->isColumnModified(ReportePeer::CA_LOGIN)) $criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(ReportePeer::CA_FCHCREADO)) $criteria->add(ReportePeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(ReportePeer::CA_USUCREADO)) $criteria->add(ReportePeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(ReportePeer::CA_FCHACTUALIZADO)) $criteria->add(ReportePeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(ReportePeer::CA_USUACTUALIZADO)) $criteria->add(ReportePeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(ReportePeer::CA_FCHANULADO)) $criteria->add(ReportePeer::CA_FCHANULADO, $this->ca_fchanulado);
		if ($this->isColumnModified(ReportePeer::CA_USUANULADO)) $criteria->add(ReportePeer::CA_USUANULADO, $this->ca_usuanulado);
		if ($this->isColumnModified(ReportePeer::CA_FCHCERRADO)) $criteria->add(ReportePeer::CA_FCHCERRADO, $this->ca_fchcerrado);
		if ($this->isColumnModified(ReportePeer::CA_USUCERRADO)) $criteria->add(ReportePeer::CA_USUCERRADO, $this->ca_usucerrado);
		if ($this->isColumnModified(ReportePeer::CA_COLMAS)) $criteria->add(ReportePeer::CA_COLMAS, $this->ca_colmas);
		if ($this->isColumnModified(ReportePeer::CA_PROPIEDADES)) $criteria->add(ReportePeer::CA_PROPIEDADES, $this->ca_propiedades);
		if ($this->isColumnModified(ReportePeer::CA_IDETAPA)) $criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);
		if ($this->isColumnModified(ReportePeer::CA_FCHULTSTATUS)) $criteria->add(ReportePeer::CA_FCHULTSTATUS, $this->ca_fchultstatus);
		if ($this->isColumnModified(ReportePeer::CA_IDTAREA_REXT)) $criteria->add(ReportePeer::CA_IDTAREA_REXT, $this->ca_idtarea_rext);
		if ($this->isColumnModified(ReportePeer::CA_IDSEGUIMIENTO)) $criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idseguimiento);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ReportePeer::DATABASE_NAME);

		$criteria->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdreporte();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdreporte($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFchreporte($this->ca_fchreporte);

		$copyObj->setCaConsecutivo($this->ca_consecutivo);

		$copyObj->setCaVersion($this->ca_version);

		$copyObj->setCaIdcotizacion($this->ca_idcotizacion);

		$copyObj->setCaOrigen($this->ca_origen);

		$copyObj->setCaDestino($this->ca_destino);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaFchdespacho($this->ca_fchdespacho);

		$copyObj->setCaIdagente($this->ca_idagente);

		$copyObj->setCaIncoterms($this->ca_incoterms);

		$copyObj->setCaMercanciaDesc($this->ca_mercancia_desc);

		$copyObj->setCaIdproveedor($this->ca_idproveedor);

		$copyObj->setCaOrdenProv($this->ca_orden_prov);

		$copyObj->setCaIdconcliente($this->ca_idconcliente);

		$copyObj->setCaOrdenClie($this->ca_orden_clie);

		$copyObj->setCaConfirmarClie($this->ca_confirmar_clie);

		$copyObj->setCaIdrepresentante($this->ca_idrepresentante);

		$copyObj->setCaInformarRepr($this->ca_informar_repr);

		$copyObj->setCaIdconsignatario($this->ca_idconsignatario);

		$copyObj->setCaInformarCons($this->ca_informar_cons);

		$copyObj->setCaIdnotify($this->ca_idnotify);

		$copyObj->setCaInformarNoti($this->ca_informar_noti);

		$copyObj->setCaIdmaster($this->ca_idmaster);

		$copyObj->setCaInformarMast($this->ca_informar_mast);

		$copyObj->setCaNotify($this->ca_notify);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaSeguro($this->ca_seguro);

		$copyObj->setCaLiberacion($this->ca_liberacion);

		$copyObj->setCaTiempocredito($this->ca_tiempocredito);

		$copyObj->setCaPreferenciasClie($this->ca_preferencias_clie);

		$copyObj->setCaInstrucciones($this->ca_instrucciones);

		$copyObj->setCaIdlinea($this->ca_idlinea);

		$copyObj->setCaIdconsignar($this->ca_idconsignar);

		$copyObj->setCaIdconsignarmaster($this->ca_idconsignarmaster);

		$copyObj->setCaIdbodega($this->ca_idbodega);

		$copyObj->setCaMastersame($this->ca_mastersame);

		$copyObj->setCaContinuacion($this->ca_continuacion);

		$copyObj->setCaContinuacionDest($this->ca_continuacion_dest);

		$copyObj->setCaContinuacionConf($this->ca_continuacion_conf);

		$copyObj->setCaEtapaActual($this->ca_etapa_actual);

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaFchanulado($this->ca_fchanulado);

		$copyObj->setCaUsuanulado($this->ca_usuanulado);

		$copyObj->setCaFchcerrado($this->ca_fchcerrado);

		$copyObj->setCaUsucerrado($this->ca_usucerrado);

		$copyObj->setCaColmas($this->ca_colmas);

		$copyObj->setCaPropiedades($this->ca_propiedades);

		$copyObj->setCaIdetapa($this->ca_idetapa);

		$copyObj->setCaFchultstatus($this->ca_fchultstatus);

		$copyObj->setCaIdtareaRext($this->ca_idtarea_rext);

		$copyObj->setCaIdseguimiento($this->ca_idseguimiento);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getRepStatuss() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepStatus($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepEquipos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepEquipo($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepGastos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepGasto($relObj->copy($deepCopy));
				}
			}

			$relObj = $this->getRepSeguro();
			if ($relObj) {
				$copyObj->setRepSeguro($relObj->copy($deepCopy));
			}

			foreach ($this->getRepCostos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepCosto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepTarifas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepTarifa($relObj->copy($deepCopy));
				}
			}

			$relObj = $this->getRepAduana();
			if ($relObj) {
				$copyObj->setRepAduana($relObj->copy($deepCopy));
			}

			$relObj = $this->getRepExpo();
			if ($relObj) {
				$copyObj->setRepExpo($relObj->copy($deepCopy));
			}

			foreach ($this->getRepAsignacions() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepAsignacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoClientesSeas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoClientesSea($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoClientesAirs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoClientesAir($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdreporte(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ReportePeer();
		}
		return self::$peer;
	}

	
	public function setUsuario(Usuario $v = null)
	{
		if ($v === null) {
			$this->setCaLogin(NULL);
		} else {
			$this->setCaLogin($v->getCaLogin());
		}

		$this->aUsuario = $v;

						if ($v !== null) {
			$v->addReporte($this);
		}

		return $this;
	}


	
	public function getUsuario(PropelPDO $con = null)
	{
		if ($this->aUsuario === null && (($this->ca_login !== "" && $this->ca_login !== null))) {
			$c = new Criteria(UsuarioPeer::DATABASE_NAME);
			$c->add(UsuarioPeer::CA_LOGIN, $this->ca_login);
			$this->aUsuario = UsuarioPeer::doSelectOne($c, $con);
			
		}
		return $this->aUsuario;
	}

	
	public function setTransportador(Transportador $v = null)
	{
		if ($v === null) {
			$this->setCaIdlinea(NULL);
		} else {
			$this->setCaIdlinea($v->getCaIdlinea());
		}

		$this->aTransportador = $v;

						if ($v !== null) {
			$v->addReporte($this);
		}

		return $this;
	}


	
	public function getTransportador(PropelPDO $con = null)
	{
		if ($this->aTransportador === null && ($this->ca_idlinea !== null)) {
			$c = new Criteria(TransportadorPeer::DATABASE_NAME);
			$c->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);
			$this->aTransportador = TransportadorPeer::doSelectOne($c, $con);
			
		}
		return $this->aTransportador;
	}

	
	public function setTercero(Tercero $v = null)
	{
		if ($v === null) {
			$this->setCaIdproveedor(NULL);
		} else {
			$this->setCaIdproveedor($v->getCaIdtercero());
		}

		$this->aTercero = $v;

						if ($v !== null) {
			$v->addReporte($this);
		}

		return $this;
	}


	
	public function getTercero(PropelPDO $con = null)
	{
		if ($this->aTercero === null && (($this->ca_idproveedor !== "" && $this->ca_idproveedor !== null))) {
			$c = new Criteria(TerceroPeer::DATABASE_NAME);
			$c->add(TerceroPeer::CA_IDTERCERO, $this->ca_idproveedor);
			$this->aTercero = TerceroPeer::doSelectOne($c, $con);
			
		}
		return $this->aTercero;
	}

	
	public function setAgente(Agente $v = null)
	{
		if ($v === null) {
			$this->setCaIdagente(NULL);
		} else {
			$this->setCaIdagente($v->getCaIdagente());
		}

		$this->aAgente = $v;

						if ($v !== null) {
			$v->addReporte($this);
		}

		return $this;
	}


	
	public function getAgente(PropelPDO $con = null)
	{
		if ($this->aAgente === null && ($this->ca_idagente !== null)) {
			$c = new Criteria(AgentePeer::DATABASE_NAME);
			$c->add(AgentePeer::CA_IDAGENTE, $this->ca_idagente);
			$this->aAgente = AgentePeer::doSelectOne($c, $con);
			
		}
		return $this->aAgente;
	}

	
	public function setBodega(Bodega $v = null)
	{
		if ($v === null) {
			$this->setCaIdbodega(NULL);
		} else {
			$this->setCaIdbodega($v->getCaIdbodega());
		}

		$this->aBodega = $v;

						if ($v !== null) {
			$v->addReporte($this);
		}

		return $this;
	}


	
	public function getBodega(PropelPDO $con = null)
	{
		if ($this->aBodega === null && ($this->ca_idbodega !== null)) {
			$c = new Criteria(BodegaPeer::DATABASE_NAME);
			$c->add(BodegaPeer::CA_IDBODEGA, $this->ca_idbodega);
			$this->aBodega = BodegaPeer::doSelectOne($c, $con);
			
		}
		return $this->aBodega;
	}

	
	public function setTrackingEtapa(TrackingEtapa $v = null)
	{
		if ($v === null) {
			$this->setCaIdetapa(NULL);
		} else {
			$this->setCaIdetapa($v->getCaIdetapa());
		}

		$this->aTrackingEtapa = $v;

						if ($v !== null) {
			$v->addReporte($this);
		}

		return $this;
	}


	
	public function getTrackingEtapa(PropelPDO $con = null)
	{
		if ($this->aTrackingEtapa === null && (($this->ca_idetapa !== "" && $this->ca_idetapa !== null))) {
			$c = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
			$c->add(TrackingEtapaPeer::CA_IDETAPA, $this->ca_idetapa);
			$this->aTrackingEtapa = TrackingEtapaPeer::doSelectOne($c, $con);
			
		}
		return $this->aTrackingEtapa;
	}

	
	public function setNotTarea(NotTarea $v = null)
	{
		if ($v === null) {
			$this->setCaIdseguimiento(NULL);
		} else {
			$this->setCaIdseguimiento($v->getCaIdtarea());
		}

		$this->aNotTarea = $v;

						if ($v !== null) {
			$v->addReporte($this);
		}

		return $this;
	}


	
	public function getNotTarea(PropelPDO $con = null)
	{
		if ($this->aNotTarea === null && ($this->ca_idseguimiento !== null)) {
			$c = new Criteria(NotTareaPeer::DATABASE_NAME);
			$c->add(NotTareaPeer::CA_IDTAREA, $this->ca_idseguimiento);
			$this->aNotTarea = NotTareaPeer::doSelectOne($c, $con);
			
		}
		return $this->aNotTarea;
	}

	
	public function clearRepStatuss()
	{
		$this->collRepStatuss = null; 	}

	
	public function initRepStatuss()
	{
		$this->collRepStatuss = array();
	}

	
	public function getRepStatuss($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
			   $this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDREPORTE, $this->ca_idreporte);

				RepStatusPeer::addSelectColumns($criteria);
				$this->collRepStatuss = RepStatusPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepStatusPeer::CA_IDREPORTE, $this->ca_idreporte);

				RepStatusPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
					$this->collRepStatuss = RepStatusPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepStatusCriteria = $criteria;
		return $this->collRepStatuss;
	}

	
	public function countRepStatuss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepStatusPeer::CA_IDREPORTE, $this->ca_idreporte);

				$count = RepStatusPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepStatusPeer::CA_IDREPORTE, $this->ca_idreporte);

				if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
					$count = RepStatusPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepStatuss);
				}
			} else {
				$count = count($this->collRepStatuss);
			}
		}
		return $count;
	}

	
	public function addRepStatus(RepStatus $l)
	{
		if ($this->collRepStatuss === null) {
			$this->initRepStatuss();
		}
		if (!in_array($l, $this->collRepStatuss, true)) { 			array_push($this->collRepStatuss, $l);
			$l->setReporte($this);
		}
	}


	
	public function getRepStatussJoinEmail($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDREPORTE, $this->ca_idreporte);

				$this->collRepStatuss = RepStatusPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepStatusPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
				$this->collRepStatuss = RepStatusPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepStatusCriteria = $criteria;

		return $this->collRepStatuss;
	}


	
	public function getRepStatussJoinTrackingEtapa($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDREPORTE, $this->ca_idreporte);

				$this->collRepStatuss = RepStatusPeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepStatusPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
				$this->collRepStatuss = RepStatusPeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepStatusCriteria = $criteria;

		return $this->collRepStatuss;
	}

	
	public function clearRepEquipos()
	{
		$this->collRepEquipos = null; 	}

	
	public function initRepEquipos()
	{
		$this->collRepEquipos = array();
	}

	
	public function getRepEquipos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepEquipos === null) {
			if ($this->isNew()) {
			   $this->collRepEquipos = array();
			} else {

				$criteria->add(RepEquipoPeer::CA_IDREPORTE, $this->ca_idreporte);

				RepEquipoPeer::addSelectColumns($criteria);
				$this->collRepEquipos = RepEquipoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepEquipoPeer::CA_IDREPORTE, $this->ca_idreporte);

				RepEquipoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepEquipoCriteria) || !$this->lastRepEquipoCriteria->equals($criteria)) {
					$this->collRepEquipos = RepEquipoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepEquipoCriteria = $criteria;
		return $this->collRepEquipos;
	}

	
	public function countRepEquipos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepEquipos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepEquipoPeer::CA_IDREPORTE, $this->ca_idreporte);

				$count = RepEquipoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepEquipoPeer::CA_IDREPORTE, $this->ca_idreporte);

				if (!isset($this->lastRepEquipoCriteria) || !$this->lastRepEquipoCriteria->equals($criteria)) {
					$count = RepEquipoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepEquipos);
				}
			} else {
				$count = count($this->collRepEquipos);
			}
		}
		return $count;
	}

	
	public function addRepEquipo(RepEquipo $l)
	{
		if ($this->collRepEquipos === null) {
			$this->initRepEquipos();
		}
		if (!in_array($l, $this->collRepEquipos, true)) { 			array_push($this->collRepEquipos, $l);
			$l->setReporte($this);
		}
	}


	
	public function getRepEquiposJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepEquipos === null) {
			if ($this->isNew()) {
				$this->collRepEquipos = array();
			} else {

				$criteria->add(RepEquipoPeer::CA_IDREPORTE, $this->ca_idreporte);

				$this->collRepEquipos = RepEquipoPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepEquipoPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastRepEquipoCriteria) || !$this->lastRepEquipoCriteria->equals($criteria)) {
				$this->collRepEquipos = RepEquipoPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepEquipoCriteria = $criteria;

		return $this->collRepEquipos;
	}

	
	public function clearRepGastos()
	{
		$this->collRepGastos = null; 	}

	
	public function initRepGastos()
	{
		$this->collRepGastos = array();
	}

	
	public function getRepGastos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
			   $this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->ca_idreporte);

				RepGastoPeer::addSelectColumns($criteria);
				$this->collRepGastos = RepGastoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->ca_idreporte);

				RepGastoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
					$this->collRepGastos = RepGastoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepGastoCriteria = $criteria;
		return $this->collRepGastos;
	}

	
	public function countRepGastos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->ca_idreporte);

				$count = RepGastoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->ca_idreporte);

				if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
					$count = RepGastoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepGastos);
				}
			} else {
				$count = count($this->collRepGastos);
			}
		}
		return $count;
	}

	
	public function addRepGasto(RepGasto $l)
	{
		if ($this->collRepGastos === null) {
			$this->initRepGastos();
		}
		if (!in_array($l, $this->collRepGastos, true)) { 			array_push($this->collRepGastos, $l);
			$l->setReporte($this);
		}
	}


	
	public function getRepGastosJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->ca_idreporte);

				$this->collRepGastos = RepGastoPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}


	
	public function getRepGastosJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->ca_idreporte);

				$this->collRepGastos = RepGastoPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}

	
	public function getRepSeguro(PropelPDO $con = null)
	{

		if ($this->singleRepSeguro === null && !$this->isNew()) {
			$this->singleRepSeguro = RepSeguroPeer::retrieveByPK($this->ca_idreporte, $con);
		}

		return $this->singleRepSeguro;
	}

	
	public function setRepSeguro(RepSeguro $v)
	{
		$this->singleRepSeguro = $v;

				if ($v->getReporte() === null) {
			$v->setReporte($this);
		}

		return $this;
	}

	
	public function clearRepCostos()
	{
		$this->collRepCostos = null; 	}

	
	public function initRepCostos()
	{
		$this->collRepCostos = array();
	}

	
	public function getRepCostos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepCostos === null) {
			if ($this->isNew()) {
			   $this->collRepCostos = array();
			} else {

				$criteria->add(RepCostoPeer::CA_IDREPORTE, $this->ca_idreporte);

				RepCostoPeer::addSelectColumns($criteria);
				$this->collRepCostos = RepCostoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepCostoPeer::CA_IDREPORTE, $this->ca_idreporte);

				RepCostoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepCostoCriteria) || !$this->lastRepCostoCriteria->equals($criteria)) {
					$this->collRepCostos = RepCostoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepCostoCriteria = $criteria;
		return $this->collRepCostos;
	}

	
	public function countRepCostos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepCostos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepCostoPeer::CA_IDREPORTE, $this->ca_idreporte);

				$count = RepCostoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepCostoPeer::CA_IDREPORTE, $this->ca_idreporte);

				if (!isset($this->lastRepCostoCriteria) || !$this->lastRepCostoCriteria->equals($criteria)) {
					$count = RepCostoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepCostos);
				}
			} else {
				$count = count($this->collRepCostos);
			}
		}
		return $count;
	}

	
	public function addRepCosto(RepCosto $l)
	{
		if ($this->collRepCostos === null) {
			$this->initRepCostos();
		}
		if (!in_array($l, $this->collRepCostos, true)) { 			array_push($this->collRepCostos, $l);
			$l->setReporte($this);
		}
	}


	
	public function getRepCostosJoinCosto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepCostos === null) {
			if ($this->isNew()) {
				$this->collRepCostos = array();
			} else {

				$criteria->add(RepCostoPeer::CA_IDREPORTE, $this->ca_idreporte);

				$this->collRepCostos = RepCostoPeer::doSelectJoinCosto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepCostoPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastRepCostoCriteria) || !$this->lastRepCostoCriteria->equals($criteria)) {
				$this->collRepCostos = RepCostoPeer::doSelectJoinCosto($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepCostoCriteria = $criteria;

		return $this->collRepCostos;
	}

	
	public function clearRepTarifas()
	{
		$this->collRepTarifas = null; 	}

	
	public function initRepTarifas()
	{
		$this->collRepTarifas = array();
	}

	
	public function getRepTarifas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepTarifas === null) {
			if ($this->isNew()) {
			   $this->collRepTarifas = array();
			} else {

				$criteria->add(RepTarifaPeer::CA_IDREPORTE, $this->ca_idreporte);

				RepTarifaPeer::addSelectColumns($criteria);
				$this->collRepTarifas = RepTarifaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepTarifaPeer::CA_IDREPORTE, $this->ca_idreporte);

				RepTarifaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepTarifaCriteria) || !$this->lastRepTarifaCriteria->equals($criteria)) {
					$this->collRepTarifas = RepTarifaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepTarifaCriteria = $criteria;
		return $this->collRepTarifas;
	}

	
	public function countRepTarifas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepTarifas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepTarifaPeer::CA_IDREPORTE, $this->ca_idreporte);

				$count = RepTarifaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepTarifaPeer::CA_IDREPORTE, $this->ca_idreporte);

				if (!isset($this->lastRepTarifaCriteria) || !$this->lastRepTarifaCriteria->equals($criteria)) {
					$count = RepTarifaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepTarifas);
				}
			} else {
				$count = count($this->collRepTarifas);
			}
		}
		return $count;
	}

	
	public function addRepTarifa(RepTarifa $l)
	{
		if ($this->collRepTarifas === null) {
			$this->initRepTarifas();
		}
		if (!in_array($l, $this->collRepTarifas, true)) { 			array_push($this->collRepTarifas, $l);
			$l->setReporte($this);
		}
	}


	
	public function getRepTarifasJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepTarifas === null) {
			if ($this->isNew()) {
				$this->collRepTarifas = array();
			} else {

				$criteria->add(RepTarifaPeer::CA_IDREPORTE, $this->ca_idreporte);

				$this->collRepTarifas = RepTarifaPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepTarifaPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastRepTarifaCriteria) || !$this->lastRepTarifaCriteria->equals($criteria)) {
				$this->collRepTarifas = RepTarifaPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepTarifaCriteria = $criteria;

		return $this->collRepTarifas;
	}

	
	public function getRepAduana(PropelPDO $con = null)
	{

		if ($this->singleRepAduana === null && !$this->isNew()) {
			$this->singleRepAduana = RepAduanaPeer::retrieveByPK($this->ca_idreporte, $con);
		}

		return $this->singleRepAduana;
	}

	
	public function setRepAduana(RepAduana $v)
	{
		$this->singleRepAduana = $v;

				if ($v->getReporte() === null) {
			$v->setReporte($this);
		}

		return $this;
	}

	
	public function getRepExpo(PropelPDO $con = null)
	{

		if ($this->singleRepExpo === null && !$this->isNew()) {
			$this->singleRepExpo = RepExpoPeer::retrieveByPK($this->ca_idreporte, $con);
		}

		return $this->singleRepExpo;
	}

	
	public function setRepExpo(RepExpo $v)
	{
		$this->singleRepExpo = $v;

				if ($v->getReporte() === null) {
			$v->setReporte($this);
		}

		return $this;
	}

	
	public function clearRepAsignacions()
	{
		$this->collRepAsignacions = null; 	}

	
	public function initRepAsignacions()
	{
		$this->collRepAsignacions = array();
	}

	
	public function getRepAsignacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepAsignacions === null) {
			if ($this->isNew()) {
			   $this->collRepAsignacions = array();
			} else {

				$criteria->add(RepAsignacionPeer::CA_IDREPORTE, $this->ca_idreporte);

				RepAsignacionPeer::addSelectColumns($criteria);
				$this->collRepAsignacions = RepAsignacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepAsignacionPeer::CA_IDREPORTE, $this->ca_idreporte);

				RepAsignacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepAsignacionCriteria) || !$this->lastRepAsignacionCriteria->equals($criteria)) {
					$this->collRepAsignacions = RepAsignacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepAsignacionCriteria = $criteria;
		return $this->collRepAsignacions;
	}

	
	public function countRepAsignacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepAsignacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepAsignacionPeer::CA_IDREPORTE, $this->ca_idreporte);

				$count = RepAsignacionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepAsignacionPeer::CA_IDREPORTE, $this->ca_idreporte);

				if (!isset($this->lastRepAsignacionCriteria) || !$this->lastRepAsignacionCriteria->equals($criteria)) {
					$count = RepAsignacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepAsignacions);
				}
			} else {
				$count = count($this->collRepAsignacions);
			}
		}
		return $count;
	}

	
	public function addRepAsignacion(RepAsignacion $l)
	{
		if ($this->collRepAsignacions === null) {
			$this->initRepAsignacions();
		}
		if (!in_array($l, $this->collRepAsignacions, true)) { 			array_push($this->collRepAsignacions, $l);
			$l->setReporte($this);
		}
	}


	
	public function getRepAsignacionsJoinNotTarea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepAsignacions === null) {
			if ($this->isNew()) {
				$this->collRepAsignacions = array();
			} else {

				$criteria->add(RepAsignacionPeer::CA_IDREPORTE, $this->ca_idreporte);

				$this->collRepAsignacions = RepAsignacionPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepAsignacionPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastRepAsignacionCriteria) || !$this->lastRepAsignacionCriteria->equals($criteria)) {
				$this->collRepAsignacions = RepAsignacionPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepAsignacionCriteria = $criteria;

		return $this->collRepAsignacions;
	}

	
	public function clearInoClientesSeas()
	{
		$this->collInoClientesSeas = null; 	}

	
	public function initInoClientesSeas()
	{
		$this->collInoClientesSeas = array();
	}

	
	public function getInoClientesSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
			   $this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->ca_idreporte);

				InoClientesSeaPeer::addSelectColumns($criteria);
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->ca_idreporte);

				InoClientesSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
					$this->collInoClientesSeas = InoClientesSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;
		return $this->collInoClientesSeas;
	}

	
	public function countInoClientesSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->ca_idreporte);

				$count = InoClientesSeaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->ca_idreporte);

				if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
					$count = InoClientesSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoClientesSeas);
				}
			} else {
				$count = count($this->collInoClientesSeas);
			}
		}
		return $count;
	}

	
	public function addInoClientesSea(InoClientesSea $l)
	{
		if ($this->collInoClientesSeas === null) {
			$this->initInoClientesSeas();
		}
		if (!in_array($l, $this->collInoClientesSeas, true)) { 			array_push($this->collInoClientesSeas, $l);
			$l->setReporte($this);
		}
	}


	
	public function getInoClientesSeasJoinTercero($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->ca_idreporte);

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}


	
	public function getInoClientesSeasJoinCliente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->ca_idreporte);

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}


	
	public function getInoClientesSeasJoinInoMaestraSea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->ca_idreporte);

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}

	
	public function clearInoClientesAirs()
	{
		$this->collInoClientesAirs = null; 	}

	
	public function initInoClientesAirs()
	{
		$this->collInoClientesAirs = array();
	}

	
	public function getInoClientesAirs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
			   $this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->ca_idreporte);

				InoClientesAirPeer::addSelectColumns($criteria);
				$this->collInoClientesAirs = InoClientesAirPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->ca_idreporte);

				InoClientesAirPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
					$this->collInoClientesAirs = InoClientesAirPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;
		return $this->collInoClientesAirs;
	}

	
	public function countInoClientesAirs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->ca_idreporte);

				$count = InoClientesAirPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->ca_idreporte);

				if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
					$count = InoClientesAirPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoClientesAirs);
				}
			} else {
				$count = count($this->collInoClientesAirs);
			}
		}
		return $count;
	}

	
	public function addInoClientesAir(InoClientesAir $l)
	{
		if ($this->collInoClientesAirs === null) {
			$this->initInoClientesAirs();
		}
		if (!in_array($l, $this->collInoClientesAirs, true)) { 			array_push($this->collInoClientesAirs, $l);
			$l->setReporte($this);
		}
	}


	
	public function getInoClientesAirsJoinTercero($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->ca_idreporte);

				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;

		return $this->collInoClientesAirs;
	}


	
	public function getInoClientesAirsJoinInoMaestraAir($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->ca_idreporte);

				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinInoMaestraAir($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinInoMaestraAir($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;

		return $this->collInoClientesAirs;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collRepStatuss) {
				foreach ((array) $this->collRepStatuss as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepEquipos) {
				foreach ((array) $this->collRepEquipos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepGastos) {
				foreach ((array) $this->collRepGastos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->singleRepSeguro) {
				$this->singleRepSeguro->clearAllReferences($deep);
			}
			if ($this->collRepCostos) {
				foreach ((array) $this->collRepCostos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepTarifas) {
				foreach ((array) $this->collRepTarifas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->singleRepAduana) {
				$this->singleRepAduana->clearAllReferences($deep);
			}
			if ($this->singleRepExpo) {
				$this->singleRepExpo->clearAllReferences($deep);
			}
			if ($this->collRepAsignacions) {
				foreach ((array) $this->collRepAsignacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoClientesSeas) {
				foreach ((array) $this->collInoClientesSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoClientesAirs) {
				foreach ((array) $this->collInoClientesAirs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collRepStatuss = null;
		$this->collRepEquipos = null;
		$this->collRepGastos = null;
		$this->singleRepSeguro = null;
		$this->collRepCostos = null;
		$this->collRepTarifas = null;
		$this->singleRepAduana = null;
		$this->singleRepExpo = null;
		$this->collRepAsignacions = null;
		$this->collInoClientesSeas = null;
		$this->collInoClientesAirs = null;
			$this->aUsuario = null;
			$this->aTransportador = null;
			$this->aTercero = null;
			$this->aAgente = null;
			$this->aBodega = null;
			$this->aTrackingEtapa = null;
			$this->aNotTarea = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseReporte:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseReporte::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 