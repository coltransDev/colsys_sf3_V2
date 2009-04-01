<?php

/**
 * Base class that represents a row from the 'tb_reportes' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseReporte extends BaseObject  implements Persistent {


  const PEER = 'ReportePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ReportePeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idreporte field.
	 * @var        int
	 */
	protected $ca_idreporte;

	/**
	 * The value for the ca_fchreporte field.
	 * @var        string
	 */
	protected $ca_fchreporte;

	/**
	 * The value for the ca_consecutivo field.
	 * @var        string
	 */
	protected $ca_consecutivo;

	/**
	 * The value for the ca_version field.
	 * @var        int
	 */
	protected $ca_version;

	/**
	 * The value for the ca_idcotizacion field.
	 * @var        int
	 */
	protected $ca_idcotizacion;

	/**
	 * The value for the ca_origen field.
	 * @var        string
	 */
	protected $ca_origen;

	/**
	 * The value for the ca_destino field.
	 * @var        string
	 */
	protected $ca_destino;

	/**
	 * The value for the ca_impoexpo field.
	 * @var        string
	 */
	protected $ca_impoexpo;

	/**
	 * The value for the ca_fchdespacho field.
	 * @var        string
	 */
	protected $ca_fchdespacho;

	/**
	 * The value for the ca_idagente field.
	 * @var        int
	 */
	protected $ca_idagente;

	/**
	 * The value for the ca_incoterms field.
	 * @var        string
	 */
	protected $ca_incoterms;

	/**
	 * The value for the ca_mercancia_desc field.
	 * @var        string
	 */
	protected $ca_mercancia_desc;

	/**
	 * The value for the ca_idproveedor field.
	 * @var        string
	 */
	protected $ca_idproveedor;

	/**
	 * The value for the ca_orden_prov field.
	 * @var        string
	 */
	protected $ca_orden_prov;

	/**
	 * The value for the ca_idconcliente field.
	 * @var        int
	 */
	protected $ca_idconcliente;

	/**
	 * The value for the ca_orden_clie field.
	 * @var        string
	 */
	protected $ca_orden_clie;

	/**
	 * The value for the ca_confirmar_clie field.
	 * @var        string
	 */
	protected $ca_confirmar_clie;

	/**
	 * The value for the ca_idrepresentante field.
	 * @var        int
	 */
	protected $ca_idrepresentante;

	/**
	 * The value for the ca_informar_repr field.
	 * @var        string
	 */
	protected $ca_informar_repr;

	/**
	 * The value for the ca_idconsignatario field.
	 * @var        int
	 */
	protected $ca_idconsignatario;

	/**
	 * The value for the ca_informar_cons field.
	 * @var        string
	 */
	protected $ca_informar_cons;

	/**
	 * The value for the ca_idnotify field.
	 * @var        int
	 */
	protected $ca_idnotify;

	/**
	 * The value for the ca_informar_noti field.
	 * @var        string
	 */
	protected $ca_informar_noti;

	/**
	 * The value for the ca_notify field.
	 * @var        int
	 */
	protected $ca_notify;

	/**
	 * The value for the ca_transporte field.
	 * @var        string
	 */
	protected $ca_transporte;

	/**
	 * The value for the ca_modalidad field.
	 * @var        string
	 */
	protected $ca_modalidad;

	/**
	 * The value for the ca_seguro field.
	 * @var        string
	 */
	protected $ca_seguro;

	/**
	 * The value for the ca_liberacion field.
	 * @var        string
	 */
	protected $ca_liberacion;

	/**
	 * The value for the ca_tiempocredito field.
	 * @var        string
	 */
	protected $ca_tiempocredito;

	/**
	 * The value for the ca_preferencias_clie field.
	 * @var        string
	 */
	protected $ca_preferencias_clie;

	/**
	 * The value for the ca_instrucciones field.
	 * @var        string
	 */
	protected $ca_instrucciones;

	/**
	 * The value for the ca_idlinea field.
	 * @var        int
	 */
	protected $ca_idlinea;

	/**
	 * The value for the ca_idconsignar field.
	 * @var        int
	 */
	protected $ca_idconsignar;

	/**
	 * The value for the ca_idconsignarmaster field.
	 * @var        int
	 */
	protected $ca_idconsignarmaster;

	/**
	 * The value for the ca_idbodega field.
	 * @var        int
	 */
	protected $ca_idbodega;

	/**
	 * The value for the ca_mastersame field.
	 * @var        string
	 */
	protected $ca_mastersame;

	/**
	 * The value for the ca_continuacion field.
	 * @var        string
	 */
	protected $ca_continuacion;

	/**
	 * The value for the ca_continuacion_dest field.
	 * @var        string
	 */
	protected $ca_continuacion_dest;

	/**
	 * The value for the ca_continuacion_conf field.
	 * @var        string
	 */
	protected $ca_continuacion_conf;

	/**
	 * The value for the ca_etapa_actual field.
	 * @var        string
	 */
	protected $ca_etapa_actual;

	/**
	 * The value for the ca_login field.
	 * @var        string
	 */
	protected $ca_login;

	/**
	 * The value for the ca_fchcreado field.
	 * @var        string
	 */
	protected $ca_fchcreado;

	/**
	 * The value for the ca_usucreado field.
	 * @var        string
	 */
	protected $ca_usucreado;

	/**
	 * The value for the ca_fchactualizado field.
	 * @var        string
	 */
	protected $ca_fchactualizado;

	/**
	 * The value for the ca_usuactualizado field.
	 * @var        string
	 */
	protected $ca_usuactualizado;

	/**
	 * The value for the ca_fchanulado field.
	 * @var        string
	 */
	protected $ca_fchanulado;

	/**
	 * The value for the ca_usuanulado field.
	 * @var        string
	 */
	protected $ca_usuanulado;

	/**
	 * The value for the ca_fchcerrado field.
	 * @var        string
	 */
	protected $ca_fchcerrado;

	/**
	 * The value for the ca_usucerrado field.
	 * @var        string
	 */
	protected $ca_usucerrado;

	/**
	 * The value for the ca_colmas field.
	 * @var        string
	 */
	protected $ca_colmas;

	/**
	 * The value for the ca_propiedades field.
	 * @var        string
	 */
	protected $ca_propiedades;

	/**
	 * @var        Usuario
	 */
	protected $aUsuario;

	/**
	 * @var        Transportador
	 */
	protected $aTransportador;

	/**
	 * @var        Tercero
	 */
	protected $aTercero;

	/**
	 * @var        Agente
	 */
	protected $aAgente;

	/**
	 * @var        Bodega
	 */
	protected $aBodega;

	/**
	 * @var        array InoClientesAir[] Collection to store aggregation of InoClientesAir objects.
	 */
	protected $collInoClientesAirs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collInoClientesAirs.
	 */
	private $lastInoClientesAirCriteria = null;

	/**
	 * @var        array RepAviso[] Collection to store aggregation of RepAviso objects.
	 */
	protected $collRepAvisos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepAvisos.
	 */
	private $lastRepAvisoCriteria = null;

	/**
	 * @var        array RepStatus[] Collection to store aggregation of RepStatus objects.
	 */
	protected $collRepStatuss;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepStatuss.
	 */
	private $lastRepStatusCriteria = null;

	/**
	 * @var        array RepEquipo[] Collection to store aggregation of RepEquipo objects.
	 */
	protected $collRepEquipos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepEquipos.
	 */
	private $lastRepEquipoCriteria = null;

	/**
	 * @var        array RepGasto[] Collection to store aggregation of RepGasto objects.
	 */
	protected $collRepGastos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepGastos.
	 */
	private $lastRepGastoCriteria = null;

	/**
	 * @var        RepSeguro one-to-one related RepSeguro object
	 */
	protected $singleRepSeguro;

	/**
	 * @var        array RepCosto[] Collection to store aggregation of RepCosto objects.
	 */
	protected $collRepCostos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepCostos.
	 */
	private $lastRepCostoCriteria = null;

	/**
	 * @var        array RepTarifa[] Collection to store aggregation of RepTarifa objects.
	 */
	protected $collRepTarifas;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepTarifas.
	 */
	private $lastRepTarifaCriteria = null;

	/**
	 * @var        RepAduana one-to-one related RepAduana object
	 */
	protected $singleRepAduana;

	/**
	 * @var        RepExpo one-to-one related RepExpo object
	 */
	protected $singleRepExpo;

	/**
	 * @var        array InoClientesSea[] Collection to store aggregation of InoClientesSea objects.
	 */
	protected $collInoClientesSeas;

	/**
	 * @var        Criteria The criteria used to select the current contents of collInoClientesSeas.
	 */
	private $lastInoClientesSeaCriteria = null;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Initializes internal state of BaseReporte object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
	}

	/**
	 * Get the [ca_idreporte] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdreporte()
	{
		return $this->ca_idreporte;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchreporte] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
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
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [ca_consecutivo] column value.
	 * 
	 * @return     string
	 */
	public function getCaConsecutivo()
	{
		return $this->ca_consecutivo;
	}

	/**
	 * Get the [ca_version] column value.
	 * 
	 * @return     int
	 */
	public function getCaVersion()
	{
		return $this->ca_version;
	}

	/**
	 * Get the [ca_idcotizacion] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdcotizacion()
	{
		return $this->ca_idcotizacion;
	}

	/**
	 * Get the [ca_origen] column value.
	 * 
	 * @return     string
	 */
	public function getCaOrigen()
	{
		return $this->ca_origen;
	}

	/**
	 * Get the [ca_destino] column value.
	 * 
	 * @return     string
	 */
	public function getCaDestino()
	{
		return $this->ca_destino;
	}

	/**
	 * Get the [ca_impoexpo] column value.
	 * 
	 * @return     string
	 */
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchdespacho] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
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
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [ca_idagente] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdagente()
	{
		return $this->ca_idagente;
	}

	/**
	 * Get the [ca_incoterms] column value.
	 * 
	 * @return     string
	 */
	public function getCaIncoterms()
	{
		return $this->ca_incoterms;
	}

	/**
	 * Get the [ca_mercancia_desc] column value.
	 * 
	 * @return     string
	 */
	public function getCaMercanciaDesc()
	{
		return $this->ca_mercancia_desc;
	}

	/**
	 * Get the [ca_idproveedor] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdproveedor()
	{
		return $this->ca_idproveedor;
	}

	/**
	 * Get the [ca_orden_prov] column value.
	 * 
	 * @return     string
	 */
	public function getCaOrdenProv()
	{
		return $this->ca_orden_prov;
	}

	/**
	 * Get the [ca_idconcliente] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdconcliente()
	{
		return $this->ca_idconcliente;
	}

	/**
	 * Get the [ca_orden_clie] column value.
	 * 
	 * @return     string
	 */
	public function getCaOrdenClie()
	{
		return $this->ca_orden_clie;
	}

	/**
	 * Get the [ca_confirmar_clie] column value.
	 * 
	 * @return     string
	 */
	public function getCaConfirmarClie()
	{
		return $this->ca_confirmar_clie;
	}

	/**
	 * Get the [ca_idrepresentante] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdrepresentante()
	{
		return $this->ca_idrepresentante;
	}

	/**
	 * Get the [ca_informar_repr] column value.
	 * 
	 * @return     string
	 */
	public function getCaInformarRepr()
	{
		return $this->ca_informar_repr;
	}

	/**
	 * Get the [ca_idconsignatario] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdconsignatario()
	{
		return $this->ca_idconsignatario;
	}

	/**
	 * Get the [ca_informar_cons] column value.
	 * 
	 * @return     string
	 */
	public function getCaInformarCons()
	{
		return $this->ca_informar_cons;
	}

	/**
	 * Get the [ca_idnotify] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdnotify()
	{
		return $this->ca_idnotify;
	}

	/**
	 * Get the [ca_informar_noti] column value.
	 * 
	 * @return     string
	 */
	public function getCaInformarNoti()
	{
		return $this->ca_informar_noti;
	}

	/**
	 * Get the [ca_notify] column value.
	 * 
	 * @return     int
	 */
	public function getCaNotify()
	{
		return $this->ca_notify;
	}

	/**
	 * Get the [ca_transporte] column value.
	 * 
	 * @return     string
	 */
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	/**
	 * Get the [ca_modalidad] column value.
	 * 
	 * @return     string
	 */
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	/**
	 * Get the [ca_seguro] column value.
	 * 
	 * @return     string
	 */
	public function getCaSeguro()
	{
		return $this->ca_seguro;
	}

	/**
	 * Get the [ca_liberacion] column value.
	 * 
	 * @return     string
	 */
	public function getCaLiberacion()
	{
		return $this->ca_liberacion;
	}

	/**
	 * Get the [ca_tiempocredito] column value.
	 * 
	 * @return     string
	 */
	public function getCaTiempocredito()
	{
		return $this->ca_tiempocredito;
	}

	/**
	 * Get the [ca_preferencias_clie] column value.
	 * 
	 * @return     string
	 */
	public function getCaPreferenciasClie()
	{
		return $this->ca_preferencias_clie;
	}

	/**
	 * Get the [ca_instrucciones] column value.
	 * 
	 * @return     string
	 */
	public function getCaInstrucciones()
	{
		return $this->ca_instrucciones;
	}

	/**
	 * Get the [ca_idlinea] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdlinea()
	{
		return $this->ca_idlinea;
	}

	/**
	 * Get the [ca_idconsignar] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdconsignar()
	{
		return $this->ca_idconsignar;
	}

	/**
	 * Get the [ca_idconsignarmaster] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdconsignarmaster()
	{
		return $this->ca_idconsignarmaster;
	}

	/**
	 * Get the [ca_idbodega] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdbodega()
	{
		return $this->ca_idbodega;
	}

	/**
	 * Get the [ca_mastersame] column value.
	 * 
	 * @return     string
	 */
	public function getCaMastersame()
	{
		return $this->ca_mastersame;
	}

	/**
	 * Get the [ca_continuacion] column value.
	 * 
	 * @return     string
	 */
	public function getCaContinuacion()
	{
		return $this->ca_continuacion;
	}

	/**
	 * Get the [ca_continuacion_dest] column value.
	 * 
	 * @return     string
	 */
	public function getCaContinuacionDest()
	{
		return $this->ca_continuacion_dest;
	}

	/**
	 * Get the [ca_continuacion_conf] column value.
	 * 
	 * @return     string
	 */
	public function getCaContinuacionConf()
	{
		return $this->ca_continuacion_conf;
	}

	/**
	 * Get the [ca_etapa_actual] column value.
	 * 
	 * @return     string
	 */
	public function getCaEtapaActual()
	{
		return $this->ca_etapa_actual;
	}

	/**
	 * Get the [ca_login] column value.
	 * 
	 * @return     string
	 */
	public function getCaLogin()
	{
		return $this->ca_login;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchcreado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
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
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [ca_usucreado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsucreado()
	{
		return $this->ca_usucreado;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchactualizado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
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
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [ca_usuactualizado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuactualizado()
	{
		return $this->ca_usuactualizado;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchanulado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
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
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [ca_usuanulado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuanulado()
	{
		return $this->ca_usuanulado;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchcerrado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
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
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [ca_usucerrado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsucerrado()
	{
		return $this->ca_usucerrado;
	}

	/**
	 * Get the [ca_colmas] column value.
	 * 
	 * @return     string
	 */
	public function getCaColmas()
	{
		return $this->ca_colmas;
	}

	/**
	 * Get the [ca_propiedades] column value.
	 * 
	 * @return     string
	 */
	public function getCaPropiedades()
	{
		return $this->ca_propiedades;
	}

	/**
	 * Set the value of [ca_idreporte] column.
	 * 
	 * @param      int $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaIdreporte()

	/**
	 * Sets the value of [ca_fchreporte] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Reporte The current object (for fluent API support)
	 */
	public function setCaFchreporte($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchreporte !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchreporte !== null && $tmpDt = new DateTime($this->ca_fchreporte)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchreporte = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = ReportePeer::CA_FCHREPORTE;
			}
		} // if either are not null

		return $this;
	} // setCaFchreporte()

	/**
	 * Set the value of [ca_consecutivo] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaConsecutivo()

	/**
	 * Set the value of [ca_version] column.
	 * 
	 * @param      int $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaVersion()

	/**
	 * Set the value of [ca_idcotizacion] column.
	 * 
	 * @param      int $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaIdcotizacion()

	/**
	 * Set the value of [ca_origen] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaOrigen()

	/**
	 * Set the value of [ca_destino] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaDestino()

	/**
	 * Set the value of [ca_impoexpo] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaImpoexpo()

	/**
	 * Sets the value of [ca_fchdespacho] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Reporte The current object (for fluent API support)
	 */
	public function setCaFchdespacho($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchdespacho !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchdespacho !== null && $tmpDt = new DateTime($this->ca_fchdespacho)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchdespacho = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = ReportePeer::CA_FCHDESPACHO;
			}
		} // if either are not null

		return $this;
	} // setCaFchdespacho()

	/**
	 * Set the value of [ca_idagente] column.
	 * 
	 * @param      int $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaIdagente()

	/**
	 * Set the value of [ca_incoterms] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaIncoterms()

	/**
	 * Set the value of [ca_mercancia_desc] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaMercanciaDesc()

	/**
	 * Set the value of [ca_idproveedor] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaIdproveedor()

	/**
	 * Set the value of [ca_orden_prov] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaOrdenProv()

	/**
	 * Set the value of [ca_idconcliente] column.
	 * 
	 * @param      int $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaIdconcliente()

	/**
	 * Set the value of [ca_orden_clie] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaOrdenClie()

	/**
	 * Set the value of [ca_confirmar_clie] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaConfirmarClie()

	/**
	 * Set the value of [ca_idrepresentante] column.
	 * 
	 * @param      int $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaIdrepresentante()

	/**
	 * Set the value of [ca_informar_repr] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaInformarRepr()

	/**
	 * Set the value of [ca_idconsignatario] column.
	 * 
	 * @param      int $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaIdconsignatario()

	/**
	 * Set the value of [ca_informar_cons] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaInformarCons()

	/**
	 * Set the value of [ca_idnotify] column.
	 * 
	 * @param      int $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaIdnotify()

	/**
	 * Set the value of [ca_informar_noti] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaInformarNoti()

	/**
	 * Set the value of [ca_notify] column.
	 * 
	 * @param      int $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaNotify()

	/**
	 * Set the value of [ca_transporte] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaTransporte()

	/**
	 * Set the value of [ca_modalidad] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaModalidad()

	/**
	 * Set the value of [ca_seguro] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaSeguro()

	/**
	 * Set the value of [ca_liberacion] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaLiberacion()

	/**
	 * Set the value of [ca_tiempocredito] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaTiempocredito()

	/**
	 * Set the value of [ca_preferencias_clie] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaPreferenciasClie()

	/**
	 * Set the value of [ca_instrucciones] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaInstrucciones()

	/**
	 * Set the value of [ca_idlinea] column.
	 * 
	 * @param      int $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaIdlinea()

	/**
	 * Set the value of [ca_idconsignar] column.
	 * 
	 * @param      int $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaIdconsignar()

	/**
	 * Set the value of [ca_idconsignarmaster] column.
	 * 
	 * @param      int $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaIdconsignarmaster()

	/**
	 * Set the value of [ca_idbodega] column.
	 * 
	 * @param      int $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaIdbodega()

	/**
	 * Set the value of [ca_mastersame] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaMastersame()

	/**
	 * Set the value of [ca_continuacion] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaContinuacion()

	/**
	 * Set the value of [ca_continuacion_dest] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaContinuacionDest()

	/**
	 * Set the value of [ca_continuacion_conf] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaContinuacionConf()

	/**
	 * Set the value of [ca_etapa_actual] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaEtapaActual()

	/**
	 * Set the value of [ca_login] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaLogin()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Reporte The current object (for fluent API support)
	 */
	public function setCaFchcreado($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchcreado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchcreado !== null && $tmpDt = new DateTime($this->ca_fchcreado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchcreado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = ReportePeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaUsucreado()

	/**
	 * Sets the value of [ca_fchactualizado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Reporte The current object (for fluent API support)
	 */
	public function setCaFchactualizado($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchactualizado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchactualizado !== null && $tmpDt = new DateTime($this->ca_fchactualizado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchactualizado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = ReportePeer::CA_FCHACTUALIZADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaUsuactualizado()

	/**
	 * Sets the value of [ca_fchanulado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Reporte The current object (for fluent API support)
	 */
	public function setCaFchanulado($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchanulado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchanulado !== null && $tmpDt = new DateTime($this->ca_fchanulado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchanulado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = ReportePeer::CA_FCHANULADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchanulado()

	/**
	 * Set the value of [ca_usuanulado] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaUsuanulado()

	/**
	 * Sets the value of [ca_fchcerrado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Reporte The current object (for fluent API support)
	 */
	public function setCaFchcerrado($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchcerrado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchcerrado !== null && $tmpDt = new DateTime($this->ca_fchcerrado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchcerrado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = ReportePeer::CA_FCHCERRADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcerrado()

	/**
	 * Set the value of [ca_usucerrado] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaUsucerrado()

	/**
	 * Set the value of [ca_colmas] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaColmas()

	/**
	 * Set the value of [ca_propiedades] column.
	 * 
	 * @param      string $v new value
	 * @return     Reporte The current object (for fluent API support)
	 */
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
	} // setCaPropiedades()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			// First, ensure that we don't have any columns that have been modified which aren't default columns.
			if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
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
			$this->ca_notify = ($row[$startcol + 23] !== null) ? (int) $row[$startcol + 23] : null;
			$this->ca_transporte = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
			$this->ca_modalidad = ($row[$startcol + 25] !== null) ? (string) $row[$startcol + 25] : null;
			$this->ca_seguro = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
			$this->ca_liberacion = ($row[$startcol + 27] !== null) ? (string) $row[$startcol + 27] : null;
			$this->ca_tiempocredito = ($row[$startcol + 28] !== null) ? (string) $row[$startcol + 28] : null;
			$this->ca_preferencias_clie = ($row[$startcol + 29] !== null) ? (string) $row[$startcol + 29] : null;
			$this->ca_instrucciones = ($row[$startcol + 30] !== null) ? (string) $row[$startcol + 30] : null;
			$this->ca_idlinea = ($row[$startcol + 31] !== null) ? (int) $row[$startcol + 31] : null;
			$this->ca_idconsignar = ($row[$startcol + 32] !== null) ? (int) $row[$startcol + 32] : null;
			$this->ca_idconsignarmaster = ($row[$startcol + 33] !== null) ? (int) $row[$startcol + 33] : null;
			$this->ca_idbodega = ($row[$startcol + 34] !== null) ? (int) $row[$startcol + 34] : null;
			$this->ca_mastersame = ($row[$startcol + 35] !== null) ? (string) $row[$startcol + 35] : null;
			$this->ca_continuacion = ($row[$startcol + 36] !== null) ? (string) $row[$startcol + 36] : null;
			$this->ca_continuacion_dest = ($row[$startcol + 37] !== null) ? (string) $row[$startcol + 37] : null;
			$this->ca_continuacion_conf = ($row[$startcol + 38] !== null) ? (string) $row[$startcol + 38] : null;
			$this->ca_etapa_actual = ($row[$startcol + 39] !== null) ? (string) $row[$startcol + 39] : null;
			$this->ca_login = ($row[$startcol + 40] !== null) ? (string) $row[$startcol + 40] : null;
			$this->ca_fchcreado = ($row[$startcol + 41] !== null) ? (string) $row[$startcol + 41] : null;
			$this->ca_usucreado = ($row[$startcol + 42] !== null) ? (string) $row[$startcol + 42] : null;
			$this->ca_fchactualizado = ($row[$startcol + 43] !== null) ? (string) $row[$startcol + 43] : null;
			$this->ca_usuactualizado = ($row[$startcol + 44] !== null) ? (string) $row[$startcol + 44] : null;
			$this->ca_fchanulado = ($row[$startcol + 45] !== null) ? (string) $row[$startcol + 45] : null;
			$this->ca_usuanulado = ($row[$startcol + 46] !== null) ? (string) $row[$startcol + 46] : null;
			$this->ca_fchcerrado = ($row[$startcol + 47] !== null) ? (string) $row[$startcol + 47] : null;
			$this->ca_usucerrado = ($row[$startcol + 48] !== null) ? (string) $row[$startcol + 48] : null;
			$this->ca_colmas = ($row[$startcol + 49] !== null) ? (string) $row[$startcol + 49] : null;
			$this->ca_propiedades = ($row[$startcol + 50] !== null) ? (string) $row[$startcol + 50] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 51; // 51 = ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Reporte object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
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
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
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

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ReportePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aUsuario = null;
			$this->aTransportador = null;
			$this->aTercero = null;
			$this->aAgente = null;
			$this->aBodega = null;
			$this->collInoClientesAirs = null;
			$this->lastInoClientesAirCriteria = null;

			$this->collRepAvisos = null;
			$this->lastRepAvisoCriteria = null;

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

			$this->collInoClientesSeas = null;
			$this->lastInoClientesSeaCriteria = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
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
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
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
			ReportePeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ReportePeer::CA_IDREPORTE;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ReportePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdreporte($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ReportePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collInoClientesAirs !== null) {
				foreach ($this->collInoClientesAirs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepAvisos !== null) {
				foreach ($this->collRepAvisos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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

			if ($this->collInoClientesSeas !== null) {
				foreach ($this->collInoClientesSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
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

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

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


			if (($retval = ReportePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInoClientesAirs !== null) {
					foreach ($this->collInoClientesAirs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepAvisos !== null) {
					foreach ($this->collRepAvisos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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

				if ($this->collInoClientesSeas !== null) {
					foreach ($this->collInoClientesSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ReportePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
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
				return $this->getCaNotify();
				break;
			case 24:
				return $this->getCaTransporte();
				break;
			case 25:
				return $this->getCaModalidad();
				break;
			case 26:
				return $this->getCaSeguro();
				break;
			case 27:
				return $this->getCaLiberacion();
				break;
			case 28:
				return $this->getCaTiempocredito();
				break;
			case 29:
				return $this->getCaPreferenciasClie();
				break;
			case 30:
				return $this->getCaInstrucciones();
				break;
			case 31:
				return $this->getCaIdlinea();
				break;
			case 32:
				return $this->getCaIdconsignar();
				break;
			case 33:
				return $this->getCaIdconsignarmaster();
				break;
			case 34:
				return $this->getCaIdbodega();
				break;
			case 35:
				return $this->getCaMastersame();
				break;
			case 36:
				return $this->getCaContinuacion();
				break;
			case 37:
				return $this->getCaContinuacionDest();
				break;
			case 38:
				return $this->getCaContinuacionConf();
				break;
			case 39:
				return $this->getCaEtapaActual();
				break;
			case 40:
				return $this->getCaLogin();
				break;
			case 41:
				return $this->getCaFchcreado();
				break;
			case 42:
				return $this->getCaUsucreado();
				break;
			case 43:
				return $this->getCaFchactualizado();
				break;
			case 44:
				return $this->getCaUsuactualizado();
				break;
			case 45:
				return $this->getCaFchanulado();
				break;
			case 46:
				return $this->getCaUsuanulado();
				break;
			case 47:
				return $this->getCaFchcerrado();
				break;
			case 48:
				return $this->getCaUsucerrado();
				break;
			case 49:
				return $this->getCaColmas();
				break;
			case 50:
				return $this->getCaPropiedades();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
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
			$keys[23] => $this->getCaNotify(),
			$keys[24] => $this->getCaTransporte(),
			$keys[25] => $this->getCaModalidad(),
			$keys[26] => $this->getCaSeguro(),
			$keys[27] => $this->getCaLiberacion(),
			$keys[28] => $this->getCaTiempocredito(),
			$keys[29] => $this->getCaPreferenciasClie(),
			$keys[30] => $this->getCaInstrucciones(),
			$keys[31] => $this->getCaIdlinea(),
			$keys[32] => $this->getCaIdconsignar(),
			$keys[33] => $this->getCaIdconsignarmaster(),
			$keys[34] => $this->getCaIdbodega(),
			$keys[35] => $this->getCaMastersame(),
			$keys[36] => $this->getCaContinuacion(),
			$keys[37] => $this->getCaContinuacionDest(),
			$keys[38] => $this->getCaContinuacionConf(),
			$keys[39] => $this->getCaEtapaActual(),
			$keys[40] => $this->getCaLogin(),
			$keys[41] => $this->getCaFchcreado(),
			$keys[42] => $this->getCaUsucreado(),
			$keys[43] => $this->getCaFchactualizado(),
			$keys[44] => $this->getCaUsuactualizado(),
			$keys[45] => $this->getCaFchanulado(),
			$keys[46] => $this->getCaUsuanulado(),
			$keys[47] => $this->getCaFchcerrado(),
			$keys[48] => $this->getCaUsucerrado(),
			$keys[49] => $this->getCaColmas(),
			$keys[50] => $this->getCaPropiedades(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ReportePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
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
				$this->setCaNotify($value);
				break;
			case 24:
				$this->setCaTransporte($value);
				break;
			case 25:
				$this->setCaModalidad($value);
				break;
			case 26:
				$this->setCaSeguro($value);
				break;
			case 27:
				$this->setCaLiberacion($value);
				break;
			case 28:
				$this->setCaTiempocredito($value);
				break;
			case 29:
				$this->setCaPreferenciasClie($value);
				break;
			case 30:
				$this->setCaInstrucciones($value);
				break;
			case 31:
				$this->setCaIdlinea($value);
				break;
			case 32:
				$this->setCaIdconsignar($value);
				break;
			case 33:
				$this->setCaIdconsignarmaster($value);
				break;
			case 34:
				$this->setCaIdbodega($value);
				break;
			case 35:
				$this->setCaMastersame($value);
				break;
			case 36:
				$this->setCaContinuacion($value);
				break;
			case 37:
				$this->setCaContinuacionDest($value);
				break;
			case 38:
				$this->setCaContinuacionConf($value);
				break;
			case 39:
				$this->setCaEtapaActual($value);
				break;
			case 40:
				$this->setCaLogin($value);
				break;
			case 41:
				$this->setCaFchcreado($value);
				break;
			case 42:
				$this->setCaUsucreado($value);
				break;
			case 43:
				$this->setCaFchactualizado($value);
				break;
			case 44:
				$this->setCaUsuactualizado($value);
				break;
			case 45:
				$this->setCaFchanulado($value);
				break;
			case 46:
				$this->setCaUsuanulado($value);
				break;
			case 47:
				$this->setCaFchcerrado($value);
				break;
			case 48:
				$this->setCaUsucerrado($value);
				break;
			case 49:
				$this->setCaColmas($value);
				break;
			case 50:
				$this->setCaPropiedades($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
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
		if (array_key_exists($keys[23], $arr)) $this->setCaNotify($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCaTransporte($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setCaModalidad($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setCaSeguro($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setCaLiberacion($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setCaTiempocredito($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setCaPreferenciasClie($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setCaInstrucciones($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setCaIdlinea($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setCaIdconsignar($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setCaIdconsignarmaster($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setCaIdbodega($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setCaMastersame($arr[$keys[35]]);
		if (array_key_exists($keys[36], $arr)) $this->setCaContinuacion($arr[$keys[36]]);
		if (array_key_exists($keys[37], $arr)) $this->setCaContinuacionDest($arr[$keys[37]]);
		if (array_key_exists($keys[38], $arr)) $this->setCaContinuacionConf($arr[$keys[38]]);
		if (array_key_exists($keys[39], $arr)) $this->setCaEtapaActual($arr[$keys[39]]);
		if (array_key_exists($keys[40], $arr)) $this->setCaLogin($arr[$keys[40]]);
		if (array_key_exists($keys[41], $arr)) $this->setCaFchcreado($arr[$keys[41]]);
		if (array_key_exists($keys[42], $arr)) $this->setCaUsucreado($arr[$keys[42]]);
		if (array_key_exists($keys[43], $arr)) $this->setCaFchactualizado($arr[$keys[43]]);
		if (array_key_exists($keys[44], $arr)) $this->setCaUsuactualizado($arr[$keys[44]]);
		if (array_key_exists($keys[45], $arr)) $this->setCaFchanulado($arr[$keys[45]]);
		if (array_key_exists($keys[46], $arr)) $this->setCaUsuanulado($arr[$keys[46]]);
		if (array_key_exists($keys[47], $arr)) $this->setCaFchcerrado($arr[$keys[47]]);
		if (array_key_exists($keys[48], $arr)) $this->setCaUsucerrado($arr[$keys[48]]);
		if (array_key_exists($keys[49], $arr)) $this->setCaColmas($arr[$keys[49]]);
		if (array_key_exists($keys[50], $arr)) $this->setCaPropiedades($arr[$keys[50]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
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

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ReportePeer::DATABASE_NAME);

		$criteria->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdreporte();
	}

	/**
	 * Generic method to set the primary key (ca_idreporte column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdreporte($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Reporte (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
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


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getInoClientesAirs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addInoClientesAir($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepAvisos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepAviso($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepStatuss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepStatus($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepEquipos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepEquipo($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepGastos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepGasto($relObj->copy($deepCopy));
				}
			}

			$relObj = $this->getRepSeguro();
			if ($relObj) {
				$copyObj->setRepSeguro($relObj->copy($deepCopy));
			}

			foreach ($this->getRepCostos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepCosto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepTarifas() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepTarifa($relObj->copy($deepCopy));
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

			foreach ($this->getInoClientesSeas() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addInoClientesSea($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdreporte(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Reporte Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     ReportePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ReportePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Usuario object.
	 *
	 * @param      Usuario $v
	 * @return     Reporte The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUsuario(Usuario $v = null)
	{
		if ($v === null) {
			$this->setCaLogin(NULL);
		} else {
			$this->setCaLogin($v->getCaLogin());
		}

		$this->aUsuario = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Usuario object, it will not be re-added.
		if ($v !== null) {
			$v->addReporte($this);
		}

		return $this;
	}


	/**
	 * Get the associated Usuario object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Usuario The associated Usuario object.
	 * @throws     PropelException
	 */
	public function getUsuario(PropelPDO $con = null)
	{
		if ($this->aUsuario === null && (($this->ca_login !== "" && $this->ca_login !== null))) {
			$c = new Criteria(UsuarioPeer::DATABASE_NAME);
			$c->add(UsuarioPeer::CA_LOGIN, $this->ca_login);
			$this->aUsuario = UsuarioPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aUsuario->addReportes($this);
			 */
		}
		return $this->aUsuario;
	}

	/**
	 * Declares an association between this object and a Transportador object.
	 *
	 * @param      Transportador $v
	 * @return     Reporte The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTransportador(Transportador $v = null)
	{
		if ($v === null) {
			$this->setCaIdlinea(NULL);
		} else {
			$this->setCaIdlinea($v->getCaIdlinea());
		}

		$this->aTransportador = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Transportador object, it will not be re-added.
		if ($v !== null) {
			$v->addReporte($this);
		}

		return $this;
	}


	/**
	 * Get the associated Transportador object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Transportador The associated Transportador object.
	 * @throws     PropelException
	 */
	public function getTransportador(PropelPDO $con = null)
	{
		if ($this->aTransportador === null && ($this->ca_idlinea !== null)) {
			$c = new Criteria(TransportadorPeer::DATABASE_NAME);
			$c->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);
			$this->aTransportador = TransportadorPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aTransportador->addReportes($this);
			 */
		}
		return $this->aTransportador;
	}

	/**
	 * Declares an association between this object and a Tercero object.
	 *
	 * @param      Tercero $v
	 * @return     Reporte The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTercero(Tercero $v = null)
	{
		if ($v === null) {
			$this->setCaIdproveedor(NULL);
		} else {
			$this->setCaIdproveedor($v->getCaIdtercero());
		}

		$this->aTercero = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Tercero object, it will not be re-added.
		if ($v !== null) {
			$v->addReporte($this);
		}

		return $this;
	}


	/**
	 * Get the associated Tercero object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Tercero The associated Tercero object.
	 * @throws     PropelException
	 */
	public function getTercero(PropelPDO $con = null)
	{
		if ($this->aTercero === null && (($this->ca_idproveedor !== "" && $this->ca_idproveedor !== null))) {
			$c = new Criteria(TerceroPeer::DATABASE_NAME);
			$c->add(TerceroPeer::CA_IDTERCERO, $this->ca_idproveedor);
			$this->aTercero = TerceroPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aTercero->addReportes($this);
			 */
		}
		return $this->aTercero;
	}

	/**
	 * Declares an association between this object and a Agente object.
	 *
	 * @param      Agente $v
	 * @return     Reporte The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setAgente(Agente $v = null)
	{
		if ($v === null) {
			$this->setCaIdagente(NULL);
		} else {
			$this->setCaIdagente($v->getCaIdagente());
		}

		$this->aAgente = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Agente object, it will not be re-added.
		if ($v !== null) {
			$v->addReporte($this);
		}

		return $this;
	}


	/**
	 * Get the associated Agente object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Agente The associated Agente object.
	 * @throws     PropelException
	 */
	public function getAgente(PropelPDO $con = null)
	{
		if ($this->aAgente === null && ($this->ca_idagente !== null)) {
			$c = new Criteria(AgentePeer::DATABASE_NAME);
			$c->add(AgentePeer::CA_IDAGENTE, $this->ca_idagente);
			$this->aAgente = AgentePeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aAgente->addReportes($this);
			 */
		}
		return $this->aAgente;
	}

	/**
	 * Declares an association between this object and a Bodega object.
	 *
	 * @param      Bodega $v
	 * @return     Reporte The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setBodega(Bodega $v = null)
	{
		if ($v === null) {
			$this->setCaIdbodega(NULL);
		} else {
			$this->setCaIdbodega($v->getCaIdbodega());
		}

		$this->aBodega = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Bodega object, it will not be re-added.
		if ($v !== null) {
			$v->addReporte($this);
		}

		return $this;
	}


	/**
	 * Get the associated Bodega object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Bodega The associated Bodega object.
	 * @throws     PropelException
	 */
	public function getBodega(PropelPDO $con = null)
	{
		if ($this->aBodega === null && ($this->ca_idbodega !== null)) {
			$c = new Criteria(BodegaPeer::DATABASE_NAME);
			$c->add(BodegaPeer::CA_IDBODEGA, $this->ca_idbodega);
			$this->aBodega = BodegaPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aBodega->addReportes($this);
			 */
		}
		return $this->aBodega;
	}

	/**
	 * Clears out the collInoClientesAirs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addInoClientesAirs()
	 */
	public function clearInoClientesAirs()
	{
		$this->collInoClientesAirs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collInoClientesAirs collection (array).
	 *
	 * By default this just sets the collInoClientesAirs collection to an empty array (like clearcollInoClientesAirs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initInoClientesAirs()
	{
		$this->collInoClientesAirs = array();
	}

	/**
	 * Gets an array of InoClientesAir objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Reporte has previously been saved, it will retrieve
	 * related InoClientesAirs from storage. If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array InoClientesAir[]
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

	/**
	 * Returns the number of related InoClientesAir objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related InoClientesAir objects.
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


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

	/**
	 * Method called to associate a InoClientesAir object to this object
	 * through the InoClientesAir foreign key attribute.
	 *
	 * @param      InoClientesAir $l InoClientesAir
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoClientesAir(InoClientesAir $l)
	{
		if ($this->collInoClientesAirs === null) {
			$this->initInoClientesAirs();
		}
		if (!in_array($l, $this->collInoClientesAirs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collInoClientesAirs, $l);
			$l->setReporte($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related InoClientesAirs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
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
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;

		return $this->collInoClientesAirs;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related InoClientesAirs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
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
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinInoMaestraAir($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;

		return $this->collInoClientesAirs;
	}

	/**
	 * Clears out the collRepAvisos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepAvisos()
	 */
	public function clearRepAvisos()
	{
		$this->collRepAvisos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepAvisos collection (array).
	 *
	 * By default this just sets the collRepAvisos collection to an empty array (like clearcollRepAvisos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepAvisos()
	{
		$this->collRepAvisos = array();
	}

	/**
	 * Gets an array of RepAviso objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Reporte has previously been saved, it will retrieve
	 * related RepAvisos from storage. If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepAviso[]
	 * @throws     PropelException
	 */
	public function getRepAvisos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepAvisos === null) {
			if ($this->isNew()) {
			   $this->collRepAvisos = array();
			} else {

				$criteria->add(RepAvisoPeer::CA_IDREPORTE, $this->ca_idreporte);

				RepAvisoPeer::addSelectColumns($criteria);
				$this->collRepAvisos = RepAvisoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepAvisoPeer::CA_IDREPORTE, $this->ca_idreporte);

				RepAvisoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepAvisoCriteria) || !$this->lastRepAvisoCriteria->equals($criteria)) {
					$this->collRepAvisos = RepAvisoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepAvisoCriteria = $criteria;
		return $this->collRepAvisos;
	}

	/**
	 * Returns the number of related RepAviso objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepAviso objects.
	 * @throws     PropelException
	 */
	public function countRepAvisos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
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

		if ($this->collRepAvisos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepAvisoPeer::CA_IDREPORTE, $this->ca_idreporte);

				$count = RepAvisoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RepAvisoPeer::CA_IDREPORTE, $this->ca_idreporte);

				if (!isset($this->lastRepAvisoCriteria) || !$this->lastRepAvisoCriteria->equals($criteria)) {
					$count = RepAvisoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepAvisos);
				}
			} else {
				$count = count($this->collRepAvisos);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a RepAviso object to this object
	 * through the RepAviso foreign key attribute.
	 *
	 * @param      RepAviso $l RepAviso
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepAviso(RepAviso $l)
	{
		if ($this->collRepAvisos === null) {
			$this->initRepAvisos();
		}
		if (!in_array($l, $this->collRepAvisos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepAvisos, $l);
			$l->setReporte($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related RepAvisos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
	public function getRepAvisosJoinEmail($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepAvisos === null) {
			if ($this->isNew()) {
				$this->collRepAvisos = array();
			} else {

				$criteria->add(RepAvisoPeer::CA_IDREPORTE, $this->ca_idreporte);

				$this->collRepAvisos = RepAvisoPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepAvisoPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastRepAvisoCriteria) || !$this->lastRepAvisoCriteria->equals($criteria)) {
				$this->collRepAvisos = RepAvisoPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepAvisoCriteria = $criteria;

		return $this->collRepAvisos;
	}

	/**
	 * Clears out the collRepStatuss collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepStatuss()
	 */
	public function clearRepStatuss()
	{
		$this->collRepStatuss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepStatuss collection (array).
	 *
	 * By default this just sets the collRepStatuss collection to an empty array (like clearcollRepStatuss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepStatuss()
	{
		$this->collRepStatuss = array();
	}

	/**
	 * Gets an array of RepStatus objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Reporte has previously been saved, it will retrieve
	 * related RepStatuss from storage. If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepStatus[]
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

	/**
	 * Returns the number of related RepStatus objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepStatus objects.
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


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

	/**
	 * Method called to associate a RepStatus object to this object
	 * through the RepStatus foreign key attribute.
	 *
	 * @param      RepStatus $l RepStatus
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepStatus(RepStatus $l)
	{
		if ($this->collRepStatuss === null) {
			$this->initRepStatuss();
		}
		if (!in_array($l, $this->collRepStatuss, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepStatuss, $l);
			$l->setReporte($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related RepStatuss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
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
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepStatusPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
				$this->collRepStatuss = RepStatusPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepStatusCriteria = $criteria;

		return $this->collRepStatuss;
	}

	/**
	 * Clears out the collRepEquipos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepEquipos()
	 */
	public function clearRepEquipos()
	{
		$this->collRepEquipos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepEquipos collection (array).
	 *
	 * By default this just sets the collRepEquipos collection to an empty array (like clearcollRepEquipos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepEquipos()
	{
		$this->collRepEquipos = array();
	}

	/**
	 * Gets an array of RepEquipo objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Reporte has previously been saved, it will retrieve
	 * related RepEquipos from storage. If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepEquipo[]
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

	/**
	 * Returns the number of related RepEquipo objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepEquipo objects.
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


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

	/**
	 * Method called to associate a RepEquipo object to this object
	 * through the RepEquipo foreign key attribute.
	 *
	 * @param      RepEquipo $l RepEquipo
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepEquipo(RepEquipo $l)
	{
		if ($this->collRepEquipos === null) {
			$this->initRepEquipos();
		}
		if (!in_array($l, $this->collRepEquipos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepEquipos, $l);
			$l->setReporte($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related RepEquipos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
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
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepEquipoPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastRepEquipoCriteria) || !$this->lastRepEquipoCriteria->equals($criteria)) {
				$this->collRepEquipos = RepEquipoPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepEquipoCriteria = $criteria;

		return $this->collRepEquipos;
	}

	/**
	 * Clears out the collRepGastos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepGastos()
	 */
	public function clearRepGastos()
	{
		$this->collRepGastos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepGastos collection (array).
	 *
	 * By default this just sets the collRepGastos collection to an empty array (like clearcollRepGastos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepGastos()
	{
		$this->collRepGastos = array();
	}

	/**
	 * Gets an array of RepGasto objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Reporte has previously been saved, it will retrieve
	 * related RepGastos from storage. If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepGasto[]
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

	/**
	 * Returns the number of related RepGasto objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepGasto objects.
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


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

	/**
	 * Method called to associate a RepGasto object to this object
	 * through the RepGasto foreign key attribute.
	 *
	 * @param      RepGasto $l RepGasto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepGasto(RepGasto $l)
	{
		if ($this->collRepGastos === null) {
			$this->initRepGastos();
		}
		if (!in_array($l, $this->collRepGastos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepGastos, $l);
			$l->setReporte($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related RepGastos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
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
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related RepGastos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
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
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}

	/**
	 * Gets a single RepSeguro object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con
	 * @return     RepSeguro
	 * @throws     PropelException
	 */
	public function getRepSeguro(PropelPDO $con = null)
	{

		if ($this->singleRepSeguro === null && !$this->isNew()) {
			$this->singleRepSeguro = RepSeguroPeer::retrieveByPK($this->ca_idreporte, $con);
		}

		return $this->singleRepSeguro;
	}

	/**
	 * Sets a single RepSeguro object as related to this object by a one-to-one relationship.
	 *
	 * @param      RepSeguro $l RepSeguro
	 * @return     Reporte The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setRepSeguro(RepSeguro $v)
	{
		$this->singleRepSeguro = $v;

		// Make sure that that the passed-in RepSeguro isn't already associated with this object
		if ($v->getReporte() === null) {
			$v->setReporte($this);
		}

		return $this;
	}

	/**
	 * Clears out the collRepCostos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepCostos()
	 */
	public function clearRepCostos()
	{
		$this->collRepCostos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepCostos collection (array).
	 *
	 * By default this just sets the collRepCostos collection to an empty array (like clearcollRepCostos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepCostos()
	{
		$this->collRepCostos = array();
	}

	/**
	 * Gets an array of RepCosto objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Reporte has previously been saved, it will retrieve
	 * related RepCostos from storage. If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepCosto[]
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

	/**
	 * Returns the number of related RepCosto objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepCosto objects.
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


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

	/**
	 * Method called to associate a RepCosto object to this object
	 * through the RepCosto foreign key attribute.
	 *
	 * @param      RepCosto $l RepCosto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepCosto(RepCosto $l)
	{
		if ($this->collRepCostos === null) {
			$this->initRepCostos();
		}
		if (!in_array($l, $this->collRepCostos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepCostos, $l);
			$l->setReporte($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related RepCostos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
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
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepCostoPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastRepCostoCriteria) || !$this->lastRepCostoCriteria->equals($criteria)) {
				$this->collRepCostos = RepCostoPeer::doSelectJoinCosto($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepCostoCriteria = $criteria;

		return $this->collRepCostos;
	}

	/**
	 * Clears out the collRepTarifas collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepTarifas()
	 */
	public function clearRepTarifas()
	{
		$this->collRepTarifas = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepTarifas collection (array).
	 *
	 * By default this just sets the collRepTarifas collection to an empty array (like clearcollRepTarifas());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepTarifas()
	{
		$this->collRepTarifas = array();
	}

	/**
	 * Gets an array of RepTarifa objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Reporte has previously been saved, it will retrieve
	 * related RepTarifas from storage. If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepTarifa[]
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

	/**
	 * Returns the number of related RepTarifa objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepTarifa objects.
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


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

	/**
	 * Method called to associate a RepTarifa object to this object
	 * through the RepTarifa foreign key attribute.
	 *
	 * @param      RepTarifa $l RepTarifa
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepTarifa(RepTarifa $l)
	{
		if ($this->collRepTarifas === null) {
			$this->initRepTarifas();
		}
		if (!in_array($l, $this->collRepTarifas, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepTarifas, $l);
			$l->setReporte($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related RepTarifas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
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
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepTarifaPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastRepTarifaCriteria) || !$this->lastRepTarifaCriteria->equals($criteria)) {
				$this->collRepTarifas = RepTarifaPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepTarifaCriteria = $criteria;

		return $this->collRepTarifas;
	}

	/**
	 * Gets a single RepAduana object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con
	 * @return     RepAduana
	 * @throws     PropelException
	 */
	public function getRepAduana(PropelPDO $con = null)
	{

		if ($this->singleRepAduana === null && !$this->isNew()) {
			$this->singleRepAduana = RepAduanaPeer::retrieveByPK($this->ca_idreporte, $con);
		}

		return $this->singleRepAduana;
	}

	/**
	 * Sets a single RepAduana object as related to this object by a one-to-one relationship.
	 *
	 * @param      RepAduana $l RepAduana
	 * @return     Reporte The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setRepAduana(RepAduana $v)
	{
		$this->singleRepAduana = $v;

		// Make sure that that the passed-in RepAduana isn't already associated with this object
		if ($v->getReporte() === null) {
			$v->setReporte($this);
		}

		return $this;
	}

	/**
	 * Gets a single RepExpo object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con
	 * @return     RepExpo
	 * @throws     PropelException
	 */
	public function getRepExpo(PropelPDO $con = null)
	{

		if ($this->singleRepExpo === null && !$this->isNew()) {
			$this->singleRepExpo = RepExpoPeer::retrieveByPK($this->ca_idreporte, $con);
		}

		return $this->singleRepExpo;
	}

	/**
	 * Sets a single RepExpo object as related to this object by a one-to-one relationship.
	 *
	 * @param      RepExpo $l RepExpo
	 * @return     Reporte The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setRepExpo(RepExpo $v)
	{
		$this->singleRepExpo = $v;

		// Make sure that that the passed-in RepExpo isn't already associated with this object
		if ($v->getReporte() === null) {
			$v->setReporte($this);
		}

		return $this;
	}

	/**
	 * Clears out the collInoClientesSeas collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addInoClientesSeas()
	 */
	public function clearInoClientesSeas()
	{
		$this->collInoClientesSeas = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collInoClientesSeas collection (array).
	 *
	 * By default this just sets the collInoClientesSeas collection to an empty array (like clearcollInoClientesSeas());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initInoClientesSeas()
	{
		$this->collInoClientesSeas = array();
	}

	/**
	 * Gets an array of InoClientesSea objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Reporte has previously been saved, it will retrieve
	 * related InoClientesSeas from storage. If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array InoClientesSea[]
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

	/**
	 * Returns the number of related InoClientesSea objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related InoClientesSea objects.
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


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

	/**
	 * Method called to associate a InoClientesSea object to this object
	 * through the InoClientesSea foreign key attribute.
	 *
	 * @param      InoClientesSea $l InoClientesSea
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoClientesSea(InoClientesSea $l)
	{
		if ($this->collInoClientesSeas === null) {
			$this->initInoClientesSeas();
		}
		if (!in_array($l, $this->collInoClientesSeas, true)) { // only add it if the **same** object is not already associated
			array_push($this->collInoClientesSeas, $l);
			$l->setReporte($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related InoClientesSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
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
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related InoClientesSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
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
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->ca_idreporte);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collInoClientesAirs) {
				foreach ((array) $this->collInoClientesAirs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepAvisos) {
				foreach ((array) $this->collRepAvisos as $o) {
					$o->clearAllReferences($deep);
				}
			}
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
			if ($this->collInoClientesSeas) {
				foreach ((array) $this->collInoClientesSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collInoClientesAirs = null;
		$this->collRepAvisos = null;
		$this->collRepStatuss = null;
		$this->collRepEquipos = null;
		$this->collRepGastos = null;
		$this->singleRepSeguro = null;
		$this->collRepCostos = null;
		$this->collRepTarifas = null;
		$this->singleRepAduana = null;
		$this->singleRepExpo = null;
		$this->collInoClientesSeas = null;
			$this->aUsuario = null;
			$this->aTransportador = null;
			$this->aTercero = null;
			$this->aAgente = null;
			$this->aBodega = null;
	}

} // BaseReporte
